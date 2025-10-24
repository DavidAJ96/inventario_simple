<?php

namespace App\Services;

use App\Repositories\ProductoRepository;
use App\Transformers\PaginatorDTOMapper;
use Backend\App\DTOs\Producto\ProductoDTO;
use Backend\App\DTOs\Producto\ProductoListDTO;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class ProductoService {
    private $repository;

    public function __construct( ProductoRepository $productoRepository ) {
        $this->repository = $productoRepository;
    }

    public function registrarError( $e ) {
        Log::error( 'Error inesperado al registrar el producto', [
            'codigo' => $e->getCode(),
            'mensaje' => $e->getMessage(),
            'linea' => $e->getLine(),
            'archivo' => $e->getFile(),
        ] );

    }

    /**
    * Metodo: consultarProductosPaginado
    * @param array $filtros
    * @param int $porPagina
    * @param int $pagina
    * @return LengthAwarePaginator
    */

    public function consultarProductosPaginado( array $filtros = [], int $porPagina = 10, int $pagina = 1 ): LengthAwarePaginator {
        $paginador = $this->repository->consultarProductosPaginado( $filtros, $porPagina, $pagina );

        return PaginatorDTOMapper::map( $paginador, ProductoListDTO::class );
    }

    public function registrarProducto( $unProducto ) {
        try {
            $this->getRepository()->iniciarTransaccion();
            $prod = $this->getRepository()->registrarProducto( $unProducto->toArray() );
            $this->getRepository()->commit();
            return ProductoDTO::from_model( $prod );
        } catch ( \Exception $e ) {
            // Cualquier otro error general

            $this->getRepository()->rollback();

            throw new \Exception( 'No se pudo registrar el producto' );
        }

    }

    public function ver_producto( $id ) {
        try {
            $producto = $this->getRepository()->ver_producto( $id );
            return $producto;
        } catch( Exception $e ) {

            if ( !( $e instanceof ModelNotFoundException ) ) {
                $this->registrarError( $e );
            }

        }
    }

    /**
    * Método: actualizar_producto
    * Descripción: Actualiza un producto de la base de datos
    * @param ProductoDTO $producto
    * @return void
    */

    public function actualizar_producto( $producto ) {
        try {
            $this->getRepository()->iniciarTransaccion();
            $producto = $this->getRepository()->actualizarProducto( $producto->getArray() );
            $this->getRepository()->commit();
            return $producto;
        } catch( Exception $e ) {
            $this->getRepository()->rollback();
            if ( !( $e instanceof ModelNotFoundException ) ) {
                $this->registrarError( $e );
            }

        }
    }

    /**
    * Get the value of repository
    */

    public function getRepository() {
        return $this->repository;
    }
}
