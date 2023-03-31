<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class FixedController extends Controller
{
    function getList(Request $request)
    {
      $part = DB::table('part')->where('status',1)->get();
      return view('admin.FixedManage')
      ->with([
        'part'    => $part,
      ]);
    }

    function viewFixed(Request $request)
    {
      $part = DB::table('part')->where('status',1)->get();
      $view_id = $request->view_id;
      DB::table('fixed')->where('id',$view_id)->update([
        'tip'  =>  '1'
      ]);
      return view('admin.FixedManage')
      ->with([
        'part' => $part,
      ]);
    }

    function getFixed(Request $request)
    {
      $fix = DB::table('fixed')->limit(10)->get();
      $data = [];
      foreach($fix as $kk=>$vv)
      {
        $data = json_decode($vv->data);
        foreach($data as $k=>$v)
        {
          $name = DB::table('part')->where('id',$v->id)->first();
          if(!empty($name)) {
              $data[$k]->name  = $name->name;
          }
        }
        $fix[$kk]->data = json_encode($data,JSON_UNESCAPED_UNICODE);
        $model1 = DB::table("model_1")->where("id",$vv->type)->first();
        $model2 = DB::table("model_2")->where("id",$vv->sn)->first();
        $company = DB::table("company")->where("id",$vv->customer)->first();
        if($model1)
        {
          if(empty($model1->brand))
          {
            $fix[$kk]->model1 = $model1->name ;
          }
          else
          {
            $fix[$kk]->model1 = $model1->name . ' ( '.$model1->brand . ' )';
          }
        }
        else
        {
          $fix[$kk]->model1 = $vv->type;
        }
        if($model2)
        {
          $fix[$kk]->model2 = $model2->name;
        }
        else
        {
          $fix[$kk]->model2 = $vv->sn;
        }
        if($company)
        {
          $fix[$kk]->customer = $company->name;
        }
        else
        {
          $fix[$kk]->customer = $vv->customer;
        }
        array_push($data,$vv);
      }
      return json_encode(['data'=>$fix],JSON_UNESCAPED_UNICODE);
    }

    function FixedAdd(Request $request)
    {
      $total = 0;
      $data = [];
      if(!empty($request->data))
      {
        foreach($request->data as $kk=>$val)
        {
          $price = DB::table('part')->where('id',$val)->first();
          DB::table('part')->where('id',$val)
          ->update([
            'amount'  => intval($price->amount -  $request->amount[$kk])
          ]);
          $total += $price->price * intval($request->amount[$kk]);
          array_push($data,['id'=>$request->data[$kk],'amount'=>intval($request->amount[$kk]),'price'=>$price->price]);
        }
        $total = $total - $request->discount;
      }
      $data = json_encode($data);
      DB::table('fixed')->insert([
        'customer'  =>  $request->name,
        'type'      =>  $request->type,
        'sn'        =>  $request->sn,
        'car'       =>  $request->car,
        'detail'    =>  $request->detail,
        'address'   =>  $request->adr,
        'tel'       =>  $request->tel,
        'uni'       =>  $request->uni,
        'data'      =>  $data,
        'discount'  =>  intval($request->discount),
        'warranty'  =>  $request->warranty,
        'total'     =>  (intval($total)<0)?'0':intval($total),
        'createDate'=>  $request->createDate . date(' H:i:s'),
        'updateDate'=>  date('Y-m-d H:i:s')
      ]);
      return redirect('/fixedManage');
    }

    public function getFixedData(Request $request)
    {
      $data = DB::table('fixed')->where('id',$request->id)->first();
      $part = DB::table('part')->where('status',1)->get();
      $model1 = DB::table('model_1')->get();
      $model2 = DB::table('model_2')->get();
      $company = DB::table('company')->get();
      return json_encode(['data'=>$data,'part'=>$part,'model1'=>$model1,'model2'=>$model2,'company'=>$company]);
    }

    public function fixedEdit(Request $request)
    {
      $total = 0;
      $data = [];
      if(!empty($request->data))
      {
        /*將修改前的商品數量加回去 B */
        $origin = DB::table('fixed')->where('id',$request->ed_id)->first();
        $origin = json_decode($origin->data,true);
        foreach($origin as $ori)
        {
          $price = DB::table('part')->where('id',$ori['id'])->first();
          DB::table('part')->where('id',$ori['id'])
          ->update([
            'amount'  => intval($price->amount + $ori['amount'])
          ]);
        }
        /*將修改前的商品數量加回去 E */
        foreach($request->data as $kk=>$val)
        {
          $price = DB::table('part')->where('id',$val)->first();
          DB::table('part')->where('id',$val)
          ->update([
            'amount'  => intval($price->amount -  $request->amount[$kk])
          ]);
          $total += $price->price * intval($request->amount[$kk]);
          array_push($data,['id'=>$request->data[$kk],'amount'=>intval($request->amount[$kk]),'price'=>$price->price]);
        }
        $total = $total - $request->ed_discount;
      }
      $data = json_encode($data);
      DB::table('fixed')->where('id',$request->ed_id)->update([
        'customer'  =>  $request->ed_name,
        'type'      =>  $request->ed_type,
        'sn'        =>  $request->ed_sn,
        'car'       =>  $request->ed_car,
        'detail'    =>  $request->ed_detail,
        'address'   =>  $request->ed_adr,
        'tel'       =>  $request->ed_tel,
        'uni'       =>  $request->ed_uni,
        'data'      =>  $data,
        'discount'  =>  intval($request->ed_discount),
        'warranty'  =>  $request->ed_warranty,
        'total'     =>  (intval($total)<0)?'0':intval($total),
        'createDate'=>  $request->createDate . date(' H:i:s'),
        'updateDate'=>  date('Y-m-d H:i:s')
      ]);
      return redirect('/fixedManage');
    }

    public function FixedDelete(Request $request)
    {
        DB::table('fixed')->where('id',$request->id)->delete();
        return 1;
    }

}
