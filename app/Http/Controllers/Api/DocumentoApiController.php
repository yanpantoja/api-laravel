<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\MasterApiController;
use App\Models\Documento;

class DocumentoApiController extends MasterApiController
{
    protected $model;
    protected $upload;
    protected $path;

    public function __construct(Documento $doc, Request $request)
    {
        $this->model = $doc;
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
