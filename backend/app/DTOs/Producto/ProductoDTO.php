<?php
namespace Backend\App\DTOs\Producto;

use App\Models\Producto;

class ProductoDTO {
    private $id_producto;
    private $cod_producto;
    private $nombre;
    private $date_added;
    private $id_categoria;
    private $modelo;
    private $estado;
    private $fecha_venc;

    public function __construct(
        $id_producto,
        $cod_producto,
        $nombre,
        $id_categoria,
        $modelo,
        $fecha_venc,
        $estado,
    ) {
        $this->id_producto = $id_producto;
        $this->cod_producto = $cod_producto;
        $this->nombre       = $nombre;
        $this->id_categoria = $id_categoria;
        $this->modelo       = $modelo;
        $this->fecha_venc   = $fecha_venc;
        $this->estado       = $estado;
    }

    public function getArray() {
        return [
            'id_producto'       => $this->getId_producto(),
            'cod_producto'      => $this->getCod_producto(),
            'nombre_producto'   => $this->getNombre(),
            'id_categoria'      => $this->getId_categoria(),
            'modelo'            => $this->getModelo(),
            'fecha_venc'        => $this->getFecha_venc(),
            'estado'            => $this->getEstado()
        ];
    }

    /**
    * Método: from_model
    * Descripción: Devuelve el DTO a partir del modelo
    * Fecha: 24-10-2025
    * @param Producto $producto
    * @return void
    */
    public static function from_model( $producto ) {
        if ( $producto ) {
            return new self(
                $producto->id_producto,
                $producto->cod_producto,
                $producto->nom_producto,
                $producto->id_categoria,
                $producto->modelo,
                $producto->fecha_venc,
                $producto->estado
            );
        }

        return null;
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
    * Get the value of id_categoria
    */

    public function getId_categoria() {
        return $this->id_categoria;
    }

    /**
    * Set the value of id_categoria
    *
    * @return  self
    */

    public function setId_categoria( $id_categoria ) {
        $this->id_categoria = $id_categoria;

        return $this;
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

    /**
    * Get the value of id_producto
    */

    public function getId_producto() {
        return $this->id_producto;
    }

    /**
    * Set the value of id_producto
    *
    * @return  self
    */

    public function setId_producto( $id_producto ) {
        $this->id_producto = $id_producto;

        return $this;
    }
}
