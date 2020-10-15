<?php
namespace modeloUser;
use PDO;
use DateTime;
include_once("../Entity/user.entidad.php");
include_once("../Environment/conexion.php");

class User{
   private $id_user;
   private $primer_nombre;
   private $segundo_nombre;
   private $primer_apellido;
   private $segundo_apellido;
   private $correo;
   private $celular;
   private $tipo_doc;
   private $num_doc;
   private $cod_contrato;
   private $user;
   private $password;
   private $empresa;
   private $rol;
    private $conexion;
    private $consulta;
    private $resultado;
    private $retorno;
    
    public function __construct(\entidadUser\User $UserE)
    {
         $this->conexion = new \Conexion();
         $this->id_user=$UserE->getId_user();
         $this->primer_nombre=$UserE->getPrimer_nombre();
         $this->segundo_nombre=$UserE->getSegundo_nombre();
         $this->primer_apellido=$UserE->getPrimer_apellido();
         $this->segundo_apellido=$UserE->getSegundo_apellido();
         $this->correo=$UserE->getCorreo();
         $this->celular=$UserE->getCelular();
         $this->tipo_doc=$UserE->getTipo_doc();
         $this->num_doc=$UserE->getNum_doc();
         $this->cod_contrato=$UserE->getCod_contrato();
         $this->user=$UserE->getUser();
         $this->password=$UserE->getPassword();
         $this->empresa=$UserE->getEmpresa(); 
         $this->rol=$UserE->getRol(); 
    }

    public function registrarUserEmpresa()
    {
      $fecha = new DateTime();
      $timestamp = $fecha->format('Y-m-d H:i:s');
      $contador =  0;
       $this->consulta="INSERT INTO persona VALUES(null, '$this->primer_nombre', '$this->segundo_nombre', '$this->primer_apellido', '$this->segundo_apellido', '$this->correo', '$this->celular', '$this->tipo_doc', '$this->num_doc', '1', '$timestamp')";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            $contador++;
       }

       $this->consulta="SELECT id_persona FROM persona WHERE num_documento='$this->num_doc'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       while( $datos = $this->resultado->fetch() ){
         $hash = password_hash($this->password, PASSWORD_ARGON2I);
         $this->consulta="INSERT INTO usuario VALUES(null, '$this->cod_contrato', '$datos[0]', '$this->user', '$hash', '$this->rol', '1', '$timestamp')";
         $this->resultado=$this->conexion->con->prepare($this->consulta);
         $this->resultado->execute();
         if($this->resultado->rowCount()>=1){
               $contador++;
         }
       }

       $this->consulta="SELECT id_usuario FROM usuario WHERE usuario='$this->user'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       while( $datos = $this->resultado->fetch() ){
         
         $this->consulta="INSERT INTO empresa VALUES(null, '$datos[0]', '$this->empresa', '1', '$timestamp')";
         $this->resultado=$this->conexion->con->prepare($this->consulta);
         $this->resultado->execute();
         if($this->resultado->rowCount()>=1){
               $contador++;
         }
       }

       if ($contador>=3) {
         $this->retorno =1;
       }else{
         $this->retorno =0;
       }

       return $this->retorno;
    }

    public function mostrarUserEmpresa()
    {
       $this->consulta="SELECT persona.id_persona, persona.primer_nombre, persona.primer_apellido, persona.correo, persona.num_celular, persona.num_documento, usuario.id_usuario, usuario.usuario, usuario.rol_usuario, usuario.codigo_contrato, empresa.id_empresa, empresa.nombre_empresa FROM usuario INNER JOIN persona ON usuario.id_persona = persona.id_persona INNER JOIN empresa ON usuario.id_usuario = empresa.id_usuario";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarUserEmpresa()
    {
       $this->consulta="DELETE FROM persona WHERE id_persona='$this->id_user'";
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

    public function mostrarEditarUserEmpresa()
    {
      $array = explode( '-', $this->id_user);
       $this->consulta="SELECT * FROM usuario INNER JOIN persona ON usuario.id_persona = persona.id_persona INNER JOIN empresa ON usuario.id_usuario = empresa.id_usuario WHERE persona.id_persona='$array[0]' AND usuario.id_usuario='$array[1]' AND empresa.id_empresa='$array[2]'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarUserEmpresa()
    {
       $this->consulta="SELECT persona.id_persona, persona.primer_nombre, persona.primer_apellido, persona.correo, persona.num_celular, persona.num_documento, usuario.id_usuario, usuario.usuario, usuario.rol_usuario, usuario.codigo_contrato, empresa.id_empresa, empresa.nombre_empresa FROM usuario INNER JOIN persona ON usuario.id_persona = persona.id_persona INNER JOIN empresa ON usuario.id_usuario = empresa.id_usuario WHERE $this->rol LIKE '%$this->user%'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarUserEmpresa()
    {
        $array = explode( '-', $this->id_user);
        $contador = 0;
        $eje='';
        $this->consulta="UPDATE persona SET primer_nombre='$this->primer_nombre', segundo_nombre='$this->segundo_nombre', primer_apellido='$this->primer_apellido', segundo_apellido='$this->segundo_apellido', correo='$this->correo', num_celular='$this->celular', tipo_documento='$this->tipo_doc', num_documento='$this->num_doc' WHERE id_persona='$array[0]'";
        $this->resultado=$this->conexion->con->prepare($this->consulta);
        $this->resultado->execute();
        if($this->resultado->rowCount()>=1){
            $contador++;
        }
        
        $posicion_coincidencia = strpos($this->password, '$argon2i$v=19$m=65536,t=4,');
        if ($posicion_coincidencia === true) {
            $hash = $this->password;
        } else {
            $hash = password_hash($this->password, PASSWORD_ARGON2I);
        }
        $this->consulta="UPDATE usuario SET usuario='$this->user', password='$hash', rol_usuario='$this->rol', codigo_contrato='$this->cod_contrato' WHERE id_usuario='$array[1]'";
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

    public function loginUser()
    {
       $this->consulta="SELECT * FROM usuario WHERE usuario='$this->user'";
       $this->resultado=$this->conexion->con->prepare($this->consulta);
       $this->resultado->execute();
       if($this->resultado->rowCount()>=1){
            
           foreach ($this->resultado->fetchAll(PDO::FETCH_ASSOC) as $dato) {
            if (password_verify($this->password, $dato['password']))  {
                session_start();
                $_SESSION['id_user'] = $dato['id_usuario'];
                $_SESSION['usuario'] = $dato['usuario'];
                $_SESSION['rol'] = $dato['rol_usuario'];
                if ($dato['rol_usuario'] == "Administrador empresa") {
                  $id = $dato['id_usuario'];
                  $this->consulta="SELECT id_empresa FROM empresa WHERE id_usuario='$id'";
                  $this->resultado=$this->conexion->con->prepare($this->consulta);
                  $this->resultado->execute();
                  foreach ($this->resultado->fetchAll(PDO::FETCH_ASSOC) as $datoEmepresa) {
                    $_SESSION['id_empresa'] = $datoEmepresa['id_empresa'];
                  }
                }
                if ($dato['rol_usuario'] == "Empleado") {
                  $id = $dato['id_usuario'];
                  $this->consulta="SELECT id_sucursal FROM sucursal WHERE id_usuario='$id'";
                  $this->resultado=$this->conexion->con->prepare($this->consulta);
                  $this->resultado->execute();
                  foreach ($this->resultado->fetchAll(PDO::FETCH_ASSOC) as $datoEmepresa) {
                    $_SESSION['id_sucursal'] = $datoEmepresa['id_sucursal'];
                  }
                }
                $this->retorno=$dato['rol_usuario'];
            }
            else{
                $this->retorno='Clave Incorrecta por favor intente nuevamente';
            }
           }
            
       }
       else{
        $this->retorno='Hay un error de autenticación por favor vuelva a intentarlo';
       }
       return $this->retorno;
    }

    public function closeUser()
    {
       session_start();      
       session_destroy();
    }
}

?>