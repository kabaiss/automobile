<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Application\Transformers\RegionTransformers;
use App\Application\Requests\Website\Region\ApiAddRequestRegion;
use App\Application\Requests\Website\Region\ApiUpdateRequestRegion;

class RegionApi extends Controller
{

    protected $request;
    protected $model;

    public function __construct(Region $model , Request $request)
    {
        $this->model = $model;
        $this->request = $request;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function index($limit = 10 , $offset = 0 , $lang = "en"){
       $data =  $this->model->limit($limit)->offset($offset)->get();
       if($data){
             return response(apiReturn(RegionTransformers::transform($data))  , 200 );
       }
       return response(apiReturn('' , '' , 'No Data Found')  , 200 );
    }

    public function getById($id , $lang = "en"){
        $data =  $this->model->find($id);
        if($data){
             return response(apiReturn(RegionTransformers::transform($data))  , 200 );
        }
        return response(apiReturn('' , '' , 'No Data Found')  , 200 );
    }

    public function add(ApiAddRequestRegion $validation){
        $request = $this->checkRequestType();
        $v = Validator::make($this->request->all(), $validation->rules());
        if ($v->fails()) {
             return response(apiReturn('' , 'error' , $v->errors())  , 401 );
        }
        $data = $this->model->create(transformArray(checkApiHaveImage($request)));
        return response(apiReturn(RegionTransformers::transform($data))  , 200 );

    }

    public function update($id , ApiUpdateRequestRegion $validation){
        $request = $this->checkRequestType();
         $v = Validator::make($this->request->all(), $validation->rules());
         if ($v->fails()) {
            return response(apiReturn('' , 'error' , $v->errors())  , 401 );
         }
        $data = $this->model->find($id)->update(transformArray(checkApiHaveImage($request)));
         return response(apiReturn($data)  , 200 );
    }

    public function delete($id){
        $data = $this->model->find($id)->delete();
        return response(apiReturn($data)  , 200 );
    }

    protected function checkRequestType(){
        return $this->request->getContentType() == "json" ? extractJsonInfo($this->request->getContent()) : $this->request->all();
    }

}
