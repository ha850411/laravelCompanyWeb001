<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Mail;
use Session;
use Excel;

class SystemController extends Controller
{
  public function getStore($value='')
  {
    $store = DB::table('col')->where('type','2')->get();
    return json_encode(['data'=>$store]);
  }

  public function getStoreData(Request $request)
  {
    $store = DB::table('col')->where('id',$request->id)->first();
    return json_encode(['data'=>$store]);
  }
  public function getStatusData(Request $request)
  {
    $status = DB::table('col')->where('id',$request->id)->first();
    return json_encode(['data'=>$status]);
  }

  public function updStore(Request $request)
  {
    $check = DB::table('col')->where('type','2')->where('id',$request->edid)->first();

    if(($request->e_id==$check->name)&&($request->e_name==$check->name2))
    {
      return redirect('/systemManagement2');
    }
    else if(($request->e_id==$check->name)&&($request->e_name!=$check->name2))
    {
      $check3 = DB::table('col')->where('type','2')->where('name2',$request->e_name)->first();
      if(empty($check3))
      {
        DB::table('col')->where('id',$request->edid)
        ->update([
          'name2'  =>  $request->e_name,
          'store'  =>  $request->e_store,
        ]);
        return redirect('/systemManagement2');
      }
      else
      {
        echo "<script>alert('門市名稱重複');window.history.go(-1);</script>";
      }
    }
    else if(($request->e_id!=$check->name)&&($request->e_name==$check->name2))
    {
      $check2 = DB::table('col')->where('type','2')->where('name',$request->e_id)->first();
      if(empty($check2))
      {
        DB::table('col')->where('id',$request->edid)
        ->update([
          'name'  =>  $request->e_id,
          'store'  =>  $request->e_store,

        ]);
        return redirect('/systemManagement2');
      }
      else
      {
        echo "<script>alert('門市代號重複');window.history.go(-1);</script>";
      }
    }
    else
    {
      $check2 = DB::table('col')->where('type','2')->where('name',$request->e_id)->first();
      $check3 = DB::table('col')->where('type','2')->where('name2',$request->e_name)->first();
      if(empty($check2) && empty($check3))
      {
        DB::table('col')->where('id',$request->edid)
        ->update([
          'name'  =>  $request->e_id,
          'name2'  =>  $request->e_name,
          'store'  =>  $request->e_store,

        ]);
        return redirect('/systemManagement2');
      }
      else
      {
        echo "<script>alert('門市代號或名稱重複');window.history.go(-1);</script>";
      }
    }
  }

  public function updStatus(Request $request)
  {
    $check = DB::table('col')->where('type','3')->where('id',$request->edid)->first();

    if(($request->e_id==$check->name)&&($request->e_name==$check->name2))
    {
      return redirect('/systemManagement3');
    }
    else if(($request->e_id==$check->name)&&($request->e_name!=$check->name2))
    {
      $check3 = DB::table('col')->where('type','3')->where('name2',$request->e_name)->first();
      if(empty($check3))
      {
        DB::table('col')->where('id',$request->edid)
        ->update([
          'name2'  =>  $request->e_name,
        ]);
        return redirect('/systemManagement3');
      }
      else
      {
        echo "<script>alert('狀態名稱重複');window.history.go(-1);</script>";
      }
    }
    else if(($request->e_id!=$check->name)&&($request->e_name==$check->name2))
    {
      $check2 = DB::table('col')->where('type','3')->where('name',$request->e_id)->first();
      if(empty($check2))
      {
        DB::table('col')->where('id',$request->edid)
        ->update([
          'name'  =>  $request->e_id,
        ]);
        return redirect('/systemManagement3');
      }
      else
      {
        echo "<script>alert('ID編號重複');window.history.go(-1);</script>";
      }
    }
    else
    {
      $check2 = DB::table('col')->where('type','3')->where('name',$request->e_id)->first();
      $check3 = DB::table('col')->where('type','3')->where('name2',$request->e_name)->first();
      if(empty($check2) && empty($check3))
      {
        DB::table('col')->where('id',$request->edid)
        ->update([
          'name'  =>  $request->e_id,
          'name2'  =>  $request->e_name,
        ]);
        return redirect('/systemManagement3');
      }
      else
      {
        echo "<script>alert('ID編號或狀態名稱重複');window.history.go(-1);</script>";
      }
    }
  }
  public function addStore(Request $request)
  {
    Session::forget('store');
    $ckname = DB::table('col')->where('name',$request->a_name)->first();
    $ckname2 = DB::table('col')->where('name2',$request->a_name2)->first();
    if(empty($ckname)&&empty($ckname2))
    {
      DB::table('col')->insert([
        'name'    =>  $request->a_name,
        'name2'   =>  $request->a_name2,
        'type'    =>  '2',
        'store'  =>  $request->a_store,
        'createDate'  =>  date('Y-m-d'),
        'updateDate'  =>  date('Y-m-d')
      ]);

        return redirect('/systemManagement2');

    }
    else if((empty($ckname))&&(!empty($ckname2)))
    {
      echo "<script>alert('門市名稱重複');window.history.go(-1);</script>";
    }
    else if((!empty($ckname))&&(empty($ckname2)))
    {
      echo "<script>alert('門市代號重複');window.history.go(-1);</script>";
    }
    else
    {
      echo "<script>alert('門市代號及名稱重複');window.history.go(-1);</script>";
    }
  }

  public function addStatus(Request $request)
  {
    $ckname = DB::table('col')->where('name',$request->a_name)->first();
    $ckname2 = DB::table('col')->where('name2',$request->a_name2)->first();
    if(empty($ckname)&&empty($ckname2))
    {
      DB::table('col')->insert([
        'name'    =>  $request->a_name,
        'name2'   =>  $request->a_name2,
        'type'    =>  '3',
        'createDate'  =>  date('Y-m-d'),
        'updateDate'  =>  date('Y-m-d')
      ]);
      return redirect('/systemManagement3');

    }
    else if((empty($ckname))&&(!empty($ckname2)))
    {
      echo "<script>alert('狀態名稱重複');window.history.go(-1);</script>";
    }
    else if((!empty($ckname))&&(empty($ckname2)))
    {
      echo "<script>alert('ID編號重複');window.history.go(-1);</script>";
    }
    else
    {
      echo "<script>alert('ID編號及狀態名稱重複');window.history.go(-1);</script>";
    }
  }

  public function deleteStore(Request $request)
  {
    $delete = DB::table('col')->where('id',$request->id)->delete();
    return json_encode(['data'=>$delete]);
  }
  public function deleteStatus(Request $request)
  {
    $delete = DB::table('col')->where('id',$request->id)->delete();
    return json_encode(['data'=>$delete]);
  }
  public function getStatus($value='')
  {
    $status = DB::table('col')->where('type','3')->get();
    return json_encode(['data'=>$status]);
  }

  public function returnStore1(Request $request)
  {
      // dd($request->all());
      $array=[];
      $array[0]=$request->storeid;
      $array[1]=$request->storename;
      $array[2]='UNI';

      Session::put('store',$array);
      return redirect('/systemManagement2');
  }

  public function returnStore2(Request $request)
  {
      // dd($request->all());
      $array=[];
      if($request->st_cate=='TFM')
      {
        $array[0]=str_pad($request->st_code,6,"0",STR_PAD_LEFT);
      }
      else
      {
        $array[0]=$request->st_code;
      }
      $array[1]=$request->rstore_name;
      $array[2]=$request->st_cate;
      Session::put('store',$array);
      return redirect('/systemManagement2');
  }
}
