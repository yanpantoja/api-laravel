<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Models\Cliente;


class ClienteApiController extends Controller
{

    public function __construct(Cliente $cliente, Request $request)
    {
        $this->cliente = $cliente;
        $this->request = $request;
    }


    public function index()
    {
        $data = $this->cliente->all();
        return response()->json($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->cliente->rules());

        $dataForm = $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $ext = $request->image->extension();

            $name = uniqid(date('His'));

            $nameFile = "{$name}.{$ext}";

            $upload = Image::make($dataForm['image'])->resize(177,236)->save(\storage_path("app/public/clientes/$nameFile", 70));

            if(!$upload){
                return response()->json(['error' => 'Falha ao fazer upload'], 500);
            }else{
                $dataForm['image'] = $nameFile;
            }
        }
        $data = $this->cliente->create($dataForm);

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $data = $this->cliente->find($id);
        if($data){
            return response()->json($data);
        }else{
            return response()->json(["error" => "id does not exist"], 404);
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        if(!$data = $this->cliente->find($id))
            return response()->json(["error" => "id does not exist"], 404);


        $dataForm = $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid()){

            if($data->image){
                Storage::disk('public')->delete("/clientes/$data->image");
            }

            $ext = $request->image->extension();

            $name = uniqid(date('His'));

            $nameFile = "{$name}.{$ext}";

            $upload = Image::make($dataForm['image'])->resize(177,236)->save(\storage_path("app/public/clientes/$nameFile", 70));

            if(!$upload){
                return response()->json(['error' => 'Falha ao fazer upload'], 500);
            }else{
                $dataForm['image'] = $nameFile;
            }
        }

        $data->update($dataForm);

        return response()->json($data);
    }

    public function destroy($id)
    {
        if(!$data = $this->cliente->find($id))
            return response()->json(["error" => "id does not exist"], 404);
        if($data->image){
            Storage::disk('public')->delete("/clientes/$data->image");
        }
        $data->delete();
        return response()->json(['success' => "successfuly deleted"]);
    }
}
