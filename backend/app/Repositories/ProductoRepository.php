<?php
namespace App\Repositories;

use App\Models\Producto;
use Backend\App\DTOs\Producto\ProductoDTO;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductoRepository extends BaseRepository {

    /**
    * Summary of consultarProductosPaginado
    * @param array $filtros
    * @param int $porPagina
    * @param int $pagina
    * @return LengthAwarePaginator
    */

    public function consultarProductosPaginado( array $filtros = [], int $porPagina = 10, int $pagina = 1 ): LengthAwarePaginator {
        $query = Producto::query();

        if ( isset( $filtros[ 'id_categoria' ] ) ) {
            $query->where( 'id_categoria', $filtros[ 'categoria_id' ] );
        }

        if ( isset( $filtros[ 'activo' ] ) ) {
            $query->where( 'activo', $filtros[ 'activo' ] );
        }

        if ( isset( $filtros[ 'nombre' ] ) ) {
            $query->where( 'nombre', 'like', '%' . $filtros[ 'nombre' ] . '%' );
        }

        // Paginación respetando la página solicitada
        return $query->paginate( $porPagina, [ '*' ], 'page', $pagina );

    }

    /**
    * Método: registrarProducto
    * Descripcion: Registra un poducto en la base de datos
    * Fecha: 23-10-2025
    * @param array $producto
    * @return Producto
    */

    public function registrarProducto( array $producto ) {
        $unProducto = new Producto();
        $unProducto->fill( $producto );
        $unProducto->save();
        return $unProducto;
    }

    /**
    * Método: verProducto
    * Descripcion: Muestra los datos de un producto
    * Fecha: 23-10-2025
    * @param mixed $id_producto
    * @return object|\Illuminate\Database\Eloquent\Builder<Producto>|\Illuminate\Database\Eloquent\Model|null
    */

    public function ver_producto( $id_producto ) {
        $unProducto = Producto::query()->where( 'id_producto', '=', $id_producto )->first();
        if ( ! $unProducto ) {
            throw new ModelNotFoundException( "Producto con ID {$id_producto} no encontrado." );
        }

        return $unProducto;

    }

    /**
    * Método: actualizarProducto
    * Descripcion: actualiza un poducto en la base de datos
    * Fecha: 23-10-2025
    * @param array $producto
    * @return object|\Illuminate\Database\Eloquent\Builder<Producto>|\Illuminate\Database\Eloquent\Model|null
    */

    public function actualizarProducto( $producto ) {
        $unProducto = $this->ver_producto( id_producto: $producto[ 'id_producto' ] ) ;

        $unProducto->fill( $producto );
        $unProducto->save();

        return $unProducto;

    }

    /**
    * Método: eliminar_producto
    * Descripción: Elimina un producto de la base de datos
    * Fecha: 24-10-2025
    * @param mixed $id
    * @return bool|mixed|null
    */

    public function eliminar_producto( $id ) {
        $producto = $this->ver_producto( $id );
        return $producto->delete();
        // devuelve true o false
    }

}
