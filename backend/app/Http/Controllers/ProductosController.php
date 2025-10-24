<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Services\ProductoService;
use Exception;
use Illuminate\Http\Request;

class ProductosController extends Controller {

    protected $service;

    public function __construct( ProductoService $servicio ) {
        $this->service = $servicio;
    }

    public function store( ProductoRequest $productoRequest ) {
        try {
            $user = $this->service->registrarProducto( $productoRequest->getDto() );
            return response()->json( [
                'success' => true,
                'data' => $user
            ], 201 );
        } catch ( Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => $e->getMessage()
            ], 400 );
        }

    }

}
