<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\MasterApiController;
use App\Models\Cliente;

class ClienteApiController extends MasterApiController
{

    protected $model;
    protected $path = 'clientes';
    protected $upload = 'image';
    protected $width = 177;
    protected $height = 236;

    public function __construct(Cliente $clientes, Request $request)
    {
        $this->model = $clientes;
        $this->request = $request;
    }

    public function documento($id)
    {
        $data = $this->model->with('document')->find($id);
        if($data){
            return response()->json($data);
        }else{
            return response()->json(["error" => "id does not exist"], 404);
        }
    }

    public function telefone($id)
    {
        $data = $this->model->with('telefone')->find($id);
        if($data){
            return response()->json($data);
        }else{
            return response()->json(["error" => "id does not exist"], 404);
        }
    }
    public function alugados($id)
    {
        $data = $this->model->with('filmesAlugados')->find($id);
        if($data){
            return response()->json($data);
        }else{
            return response()->json(["error" => "id does not exist"], 404);
        }
    }

}
