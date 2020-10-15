<?php
namespace entidadUser;
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

    

    /**
     * Get the value of id_user
     */ 
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */ 
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    } 


    /**
     * Get the value of primer_nombre
     */ 
    public function getPrimer_nombre()
    {
        return $this->primer_nombre;
    }

    /**
     * Set the value of primer_nombre
     *
     * @return  self
     */ 
    public function setPrimer_nombre($primer_nombre)
    {
        $this->primer_nombre = $primer_nombre;

        return $this;
    }

    public function getSegundo_nombre()
    {
        return $this->segundo_nombre;
    }

    public function setSegundo_nombre($segundo_nombre)
    {
        $this->segundo_nombre = $segundo_nombre;

        return $this;
    } 
    
    public function getPrimer_apellido()
    {
        return $this->primer_apellido;
    }

    public function setPrimer_apellido($primer_apellido)
    {
        $this->primer_apellido = $primer_apellido;

        return $this;
    } 

    public function getSegundo_apellido()
    {
        return $this->segundo_apellido;
    }

    public function setSegundo_apellido($segundo_apellido)
    {
        $this->segundo_apellido = $segundo_apellido;

        return $this;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function setCelular($celular)
    {
        $this->celular = $celular;

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

    public function getCod_contrato()
    {
        return $this->cod_contrato;
    }

    public function setCod_contrato($cod_contrato)
    {
        $this->cod_contrato = $cod_contrato;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }
}

?>