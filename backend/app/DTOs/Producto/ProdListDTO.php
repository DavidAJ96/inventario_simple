<?php
namespace Backend\App\DTOs\Producto;

class ProductoListDTO {
    private $id_producto;
    private $cod_producto;
    private $nombre;
    private $date_added;
    private $categoria;
    private $modelo;
    private $estado;
    private $fecha_venc;

    public function __construct(
        $id_producto,
        $cod_producto,
        $nombre,
        $categoria,
        $modelo,
        $fecha_venc,
        $estado,
    ) {
        $this->id_producto = $id_producto;
        $this->cod_producto = $cod_producto;
        $this->nombre       = $nombre;
        $this->categoria    = $categoria;
        $this->modelo       = $modelo;
        $this->fecha_venc   = $fecha_venc;
        $this->estado       = $estado;
    }

    public static function from_model( $producto ) {
        return new self(
            $producto->id_producto,
            $producto->cod_producto,
            $producto->nombre,
            $producto->nombre_categoria,
            $producto->modelo,
            $producto->fecha_venc,
            $producto->estado
        );
    }

    /**
    * Get the value of cod_producto
    */

    public function getCod_producto() {
        return $this->cod_producto;
    }

    /**
    * Set the value of cod_producto
    *
    * @return  self
    */

    public function setCod_producto( $cod_producto ) {
        $this->cod_producto = $cod_producto;

        return $this;
    }

    /**
    * Get the value of nombre
    */

    public function getNombre() {
        return $this->nombre;
    }

    /**
    * Set the value of nombre
    *
    * @return  self
    */

    public function setNombre( $nombre ) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
    * Get the value of date_added
    */

    public function getDate_added() {
        return $this->date_added;
    }

    /**
    * Set the value of date_added
    *
    * @return  self
    */

    public function setDate_added( $date_added ) {
        $this->date_added = $date_added;

        return $this;
    }

    /**
    * Get the value of categoria
    */

    public function getCategoria() {
        return $this->categoria;
    }

    /**
    * Get the value of modelo
    */

    public function getModelo() {
        return $this->modelo;
    }

    /**
    * Set the value of modelo
    *
    * @return  self
    */

    public function setModelo( $modelo ) {
        $this->modelo = $modelo;

        return $this;
    }

    /**
    * Get the value of estado
    */

    public function getEstado() {
        return $this->estado;
    }

    /**
    * Set the value of estado
    *
    * @return  self
    */

    public function setEstado( $estado ) {
        $this->estado = $estado;

        return $this;
    }

    /**
    * Get the value of fecha_venc
    */

    public function getFecha_venc() {
        return $this->fecha_venc;
    }

    /**
    * Set the value of fecha_venc
    *
    * @return  self
    */

    public function setFecha_venc( $fecha_venc ) {
        $this->fecha_venc = $fecha_venc;

        return $this;
    }
}
