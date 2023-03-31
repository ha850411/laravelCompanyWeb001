<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ModelController extends Controller
{
    function getModelItem(Request $request)
    {
      $model1 = DB::table('model_1')->get();
      $model2 = DB::table('model_2')->get();
      $company = DB::table('company')->get();
      return json_encode(['model1'=>$model1,'model2'=>$model2,'company'=>$company]);
    }

    function getModel1(Request $request)
    {
      $model = DB::table('model_1')->get();
      return view('admin.model1Management')
      ->with([
        'model'    => $model,
      ]);
    }

    function getModel2(Request $request)
    {
      $model = DB::table('model_2')->get();
      return view('admin.model2Management')
      ->with([
        'model'    => $model,
      ]);
    }

    function getModel1List(Request $request)
    {
      $model = DB::table('model_1')->get();
      return json_encode(['data'=>$model]);
    }

    function getModel2List(Request $request)
    {
      $model = DB::table('model_2')->get();
      return json_encode(['data'=>$model]);
    }

    function model1Add(Request $request)
    {
      DB::table('model_1')->insert([
        'name'  =>  $request->name,
        'brand'  =>  $request->brand,
        'createDate'=>  date('Y-m-d H:i:s'),
        'updateDate'=>  date('Y-m-d H:i:s')
      ]);
      return redirect('/model1');
    }

    function model2Add(Request $request)
    {
      DB::table('model_2')->insert([
        'name'  =>  $request->name,
        'createDate'=>  date('Y-m-d H:i:s'),
        'updateDate'=>  date('Y-m-d H:i:s')
      ]);
      return redirect('/model2');
    }

    public function getmodel1Data(Request $request)
    {
      $data = DB::table('model_1')->where('id',$request->id)->first();
      return json_encode($data);
    }

    public function getmodel2Data(Request $request)
    {
      $data = DB::table('model_2')->where('id',$request->id)->first();
      return json_encode($data);
    }

    public function model1Edit(Request $request)
    {
          $data = DB::table('model_1')->where('id',$request->ed_id)->first();
          DB::table('model_1')->where('id',$data->id)
          ->update([
            'name'  => $request->ed_name,
            'brand'  =>  $request->ed_brand,
            'updateDate'=> date('Y-m-d H:i:s')
          ]);
          return redirect('/model1');
    }

    public function model2Edit(Request $request)
    {
          $data = DB::table('model_2')->where('id',$request->ed_id)->first();
          DB::table('model_2')->where('id',$data->id)
          ->update([
            'name'  => $request->ed_name,
            'updateDate'=> date('Y-m-d H:i:s')
          ]);
          return redirect('/model2');
    }
    public function model1Delete(Request $request)
    {
        DB::table('model_1')->where('id',$request->id)->delete();
        return 1;
    }
    public function model2Delete(Request $request)
    {
        DB::table('model_2')->where('id',$request->id)->delete();
        return 1;
    }
}
