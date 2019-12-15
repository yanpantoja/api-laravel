<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\MasterApiController;
use App\Models\Telefone;

class TelefoneApiController extends MasterApiController
{
    protected $model;
    protected $upload;
    protected $path;

    public function __construct(Telefone $tel, Request $request)
    {
        $this->model = $tel;
        $this->request = $request;
    }

    public function cliente($id)
    {
        $data = $this->model->with('cliente')->find($id);
        if($data){
            return response()->json($data);
        }else{
            return response()->json(["error" => "id does not exist"], 404);
        }
    }
}
