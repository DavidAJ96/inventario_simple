<?php
namespace App\Transformers;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginatorDTOMapper
{
    /**
     * Mapea la colección de un LengthAwarePaginator a DTOs
     *
     * @param LengthAwarePaginator $paginador
     * @param string $dtoClass Nombre completo de la clase DTO
     * @return LengthAwarePaginator
     */
    public static function map(LengthAwarePaginator $paginador, string $dtoClass): LengthAwarePaginator
    {
        $dtoCollection = $paginador->getCollection()->map(function($item) use ($dtoClass) {
            return $dtoClass::from_model($item);
        });

        $paginador->setCollection($dtoCollection);

        return $paginador;
    }
}
