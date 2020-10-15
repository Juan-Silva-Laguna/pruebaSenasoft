<?php
namespace modeloVendedor;
use PDO;
use DateTime;
include_once("../Entity/vendedor.entidad.php");
include_once("../Environment/conexion.php");

class Vendedor{
   private $id_venta;
   private $nombre;
   private $productos;
   private $tipo_doc;
   private $num_doc;
    private $conexion;
    private $consulta;
    private $resultado;
    private $retorno;
    
    public function __construct(\entidadVendedor\Vendedor $VendedorE)
    {
         $this->conexion = new \Conexion();
         $this->id_venta=$VendedorE->getId_venta();
         $this->nombre=$VendedorE->getNombre();
         $this->productos=$VendedorE->getProductos();
         $this->tipo_doc=$VendedorE->getTipo_doc();
         $this->num_doc=$VendedorE->getNum_doc();
    }

    public function agregar()
    {
        session_start();
        
        $user = $_SESSION['id_user'];
        $sucursal = $_SESSION['id_sucursal'];
        $this->consulta="SELECT id_factura, producto FROM factura WHERE id_sucursal=$sucursal AND estado=0";   
        $this->resultado=$this->conexion->con->prepare($this->consulta); 
        $this->resultado->execute();
        if($this->resultado->rowCount()>=1){
            foreach ($this->resultado->fetchAll(PDO::FETCH_ASSOC) as $key => $value) {
                $caracter = explode("-",$this->productos);
                $pos = strpos($value['producto'], $caracter[2]);
                if ($pos === false) {
                    $car = $value['producto']."-".$this->productos;
                    $id_factura = $value['id_factura'];
                    $this->consulta="UPDATE factura SET producto='$car' WHERE id_factura=$id_factura";
                    $this->resultado=$this->conexion->con->prepare($this->consulta);
                    $this->resultado->execute();
                    if($this->resultado->rowCount()>=1){
                        $this->retorno = "Producto agregado a factura!! ";
                    }
                    else{
                        $this->retorno = "No se logro agregar el producto";
                    }
                }else{
                    $this->retorno = "ERROR: Este producto ya lo agrego";
                }
                
            }
        }
        else{              
            $this->consulta="INSERT INTO factura VALUES(NULL, '$sucursal', '', '', '', '$this->productos', '', '', '', 0, '', '')";
            $this->resultado=$this->conexion->con->prepare($this->consulta);
            $this->resultado->execute();
            if($this->resultado->rowCount()>=1){
                $this->retorno = "Producto agregado a factura!!";
            }
            else{
                $this->retorno = "No se logro agregar el producto ";
            }
        }
        
       
       return $this->retorno;
    }
    
    public function mostrarProductos()
    {
      session_start();
      $sucursal = $_SESSION['id_sucursal'];
       $this->consulta="SELECT * FROM bodega INNER JOIN producto ON bodega.id_producto = producto.id_producto WHERE id_sucursal='$sucursal'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarVendedorEmpresa()
    {
       $this->consulta="DELETE FROM persona WHERE id_persona='$this->id_Vendedor'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
         $this->retorno=1;
      }
      else{
        $this->retorno=0;
      }
      return $this->retorno;
    }

    public function mostrarEditarVendedorEmpresa()
    {
      $array = explode( '-', $this->id_Vendedor);
       $this->consulta="SELECT * FROM usuario INNER JOIN persona ON usuario.id_persona = persona.id_persona INNER JOIN empresa ON usuario.id_usuario = empresa.id_usuario WHERE persona.id_persona='$array[0]' AND usuario.id_usuario='$array[1]' AND empresa.id_empresa='$array[2]'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarVendedorEmpresa()
    {
       $this->consulta="SELECT persona.id_persona, persona.primer_nombre, persona.primer_apellido, persona.correo, persona.num_celular, persona.num_documento, usuario.id_usuario, usuario.usuario, usuario.rol_usuario, usuario.codigo_contrato, empresa.id_empresa, empresa.nombre_empresa FROM usuario INNER JOIN persona ON usuario.id_persona = persona.id_persona INNER JOIN empresa ON usuario.id_usuario = empresa.id_usuario WHERE $this->rol LIKE '%$this->Vendedor%'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarVendedorEmpresa()
    {
      $array = explode( '-', $this->id_Vendedor);
      $contador = 0;
      $eje='';
      $this->consulta="UPDATE persona SET primer_nombre='$this->primer_nombre', segundo_nombre='$this->segundo_nombre', primer_apellido='$this->primer_apellido', segundo_apellido='$this->segundo_apellido', correo='$this->correo', num_celular='$this->celular', tipo_documento='$this->tipo_doc', num_documento='$this->num_doc' WHERE id_persona='$array[0]'";
      $this->resultado=$this->conexion->con->prepare($this->consulta);
      $this->resultado->execute();
      if($this->resultado->rowCount()>=1){
          $contador++;
      }
      
      $this->consulta="UPDATE usuario SET usuario='$this->Vendedor', password='$this->password', rol_usuario='$this->rol', codigo_contrato='$this->cod_contrato' WHERE id_usuario='$array[1]'";
      $this->resultado=$this->conexion->con->prepare($this->consulta);
      $this->resultado->execute();
      if($this->resultado->rowCount()>=1){
          $contador++;
      }
      $this->consulta="UPDATE empresa SET nombre_empresa='$this->empresa' WHERE id_empresa='$array[2]'";
      $this->resultado=$this->conexion->con->prepare($this->consulta);
      $this->resultado->execute();
      if($this->resultado->rowCount()>=1){
          $contador++;
      }

      if ($contador!=0) {
        $this->retorno=2; 
      }else{
        $this->retorno=0; 
      }

      return $this->retorno;       
    }
}

?>