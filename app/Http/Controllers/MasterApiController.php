<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;


class MasterApiController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $data = $this->model->all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->model->rules());

        $dataForm = $request->all();

        if($request->hasFile($this->upload) && $request->file($this->upload)->isValid()){

            $ext = $request->file($this->upload)->extension();

            $name = uniqid(date('His'));

            $nameFile = "{$name}.{$ext}";

            $upload = Image::make($dataForm[$this->upload])->resize(177,236)->save(\storage_path("app/public/{$this->path}/{$nameFile}", 70));

            if(!$upload){
                return response()->json(['error' => 'Falha ao fazer upload'], 500);
            }else{
                $dataForm[$this->upload] = $nameFile;
            }
        }
        $data = $this->model->create($dataForm);

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $data = $this->model->find($id);
        if($data){
            return response()->json($data);
        }else{
            return response()->json(["error" => "id does not exist"], 404);
        }
    }

    public function update(Request $request, $id)
    {
        if(!$data = $this->model->find($id))
            return response()->json(["error" => "id does not exist"], 404);


        $dataForm = $request->all();

        if($request->hasFile($this->upload) && $request->file($this->upload)->isValid()){

            $file = $this->model->file($id); //funcao do model Cliente

            if($file){
                Storage::disk('public')->delete("/{$this->path}/$file");
            }

            $ext = $request->file($this->upload)->extension();

            $name = uniqid(date('His'));

            $nameFile = "{$name}.{$ext}";

            $upload = Image::make($dataForm[$this->upload])->resize(177,236)->save(\storage_path("app/public/{$this->path}/{$nameFile}", 70));

            if(!$upload){
                return response()->json(['error' => 'Falha ao fazer upload'], 500);
            }else{
                $dataForm[$this->upload] = $nameFile;
            }
        }

        $data->update($dataForm);

        return response()->json($data);
    }

    public function destroy($id)
    {
        if($data = $this->model->find($id)){
            if(method_exists($this->model, 'file')){
                Storage::disk('public')->delete("/{$this->path}/{$this->model->file($id)}");
            }
            $data->delete();
            return response()->json(['success' => "successfuly deleted"]);
        }else{
            return response()->json(["error" => "id does not exist"], 404);
        }
    }

}
