<?php

namespace App\Http\Requests;

use Backend\App\DTOs\Producto\ProductoDTO;
use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest {
    /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */

    public function authorize() {
        return false;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */

    public function rules() {
        return [
            'cod_producto' =>'required|min:1|max:20',
            'nombre' => 'required|min:5|max:60',
            'id_categoria' => 'required|min:5|max:60',
            'modelo' => 'required|min:5|max:60',
            'estado' => 'required|min:5|max:60',
            'fecha_venc' => 'required|min:5|max:60',

        ];
    }

    /**
    * Método: getDto
    * Descripción devuelve el objeto DTO con los datos de la validacion
    * @return ProductoDTO
    */
    public function getDto() {
       $data = $this->validated();
       return new ProductoDTO($data['cod_producto'],
       $data['nombre'],$data['id_categoria'],$data['modelo'], $data['fecha_venc'],$data['estado']

        );
    }

}
