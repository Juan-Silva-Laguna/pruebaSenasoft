<?php
namespace entidadVendedor;
class Vendedor{
    private $id_venta;
    private $productos;
    private $nombre;
    private $tipo_doc;
    private $num_doc;

    

    /**
     * Get the value of id_venta
     */ 
    public function getId_venta()
    {
        return $this->id_venta;
    }

    /**
     * Set the value of id_venta
     *
     * @return  self
     */ 
    public function setId_venta($id_venta)
    {
        $this->id_venta = $id_venta;

        return $this;
    } 


    /**
     * Get the value of productos
     */ 
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * Set the value of productos
     *
     * @return  self
     */ 
    public function setProductos($productos)
    {
        $this->productos = $productos;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    } 
    

    public function getTipo_doc()
    {
        return $this->tipo_doc;
    }

    public function setTipo_doc($tipo_doc)
    {
        $this->tipo_doc = $tipo_doc;

        return $this;
    }

    public function getNum_doc()
    {
        return $this->num_doc;
    }

    public function setNum_doc($num_doc)
    {
        $this->num_doc = $num_doc;

        return $this;
    }

}

?>