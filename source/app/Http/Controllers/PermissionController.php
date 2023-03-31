<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Mail;
use Session;

class PermissionController extends Controller
{
  public function index(Request $request)
  {
    // code...
    return view('admin.permissionManagement');
  }

  public function settingName(Request $request)
  {
      $member = DB::table('admin_user')->where('username',Session::get('adminUser'))->first();
      return view('admin.generalInformation')->with([
        'member'  =>  $member
      ]);
  }
  public function settingPassword(Request $request)
  {
    $member = DB::table('admin_user')->where('username',Session::get('adminUser'))->first();
    return view('admin.changePassword')->with([
      'member'  =>  $member
    ]);
  }
  
  public function settingUpdate(Request $request)
  {
    if($request->isMethod('post'))
    {
      if ($request->hasfile('pic_file'))
      {
          $file = $request->file('pic_file');
          if ($file->isValid())
          {
              $path = base_path().env('UPLOAD_URL', '\uploads\\');
              // $filetype = $file->getClientOriginalExtension();
              $filename = uniqid() . ".png";
              $file->move($path, $filename);
          }
          else
          {
              $filename = '5be2b51b26999.png';
          }
          DB::table('admin_user')->where('username',Session::get('adminUser'))
          ->update([
              'realname'  =>  $request->username,
              'pic'       =>  $filename,
              // 'tip'       =>  $request->tip,
          ]);
          Session::put('adminUserPic',$filename);
      }
      else
      {
          DB::table('admin_user')->where('username',Session::get('adminUser'))
          ->update([
              'realname'  =>  $request->username,
              // 'tip'       =>  $request->tip,
          ]);
      }
      // return redirect('/generalInformation');
      Session::put('adminUserName',$request->username);

      echo "<script>alert('修改成功');window.location='/generalInformation';</script>";
    }
    else
    {
      return redirect('/generalInformation');
    }
  }

  public function updPassword(Request $request)
  {
      $old_ps = md5($request->old_ps);
      $check = DB::table('admin_user')->where('password',$old_ps)->first();
      if(empty($check))
      {
        echo "<script>alert('舊密碼錯誤!');window.history.go(-1);</script>";
      }
      else
      {
        DB::table('admin_user')->where('id',$request->eid)
        ->update([
          'password'  => md5($request->new_ps)
        ]);
        $acc = DB::table('admin_user')->where('id',$request->eid)->first();
        DB::table('active_log')->insert([
          'mid'         =>  Session::get('adminID'),
          'type'        =>  '帳號設置',
          'detail'      =>  '[修改密碼] 帳號:'.$acc->username,
          'createDate'  =>  date('Y-m-d H-i-s')
        ]);
        // return redirect('/changePassword');
        echo "<script>alert('修改成功!');window.history.go(-1);</script>";
      }
  }
  public function memberList(Request $request)
  {
      $data = DB::table('admin_user')->where('level','<>','1')->get()->toArray();
      $array =$data;
      foreach ($data as $key => $value)
      {
        $ip = DB::table('admin_log')->where('sid',$value->id)->orderby('updateDate','desc')->first();
        if(!empty($ip))
        {
          $temp = json_decode(json_encode($array[$key]),true);
          $temp['ip'] = $ip->ip;
          $array[$key]=json_decode(json_encode($temp));
        }
        else
        {
          $temp = json_decode(json_encode($array[$key]),true);
          $temp['ip'] = "";
          $array[$key]=json_decode(json_encode($temp));
        }
      }
      $array = collect($array);
      // dd($array);
      return json_encode(['data'=>$array]);
  }

  public function getMemberData(Request $request)
  {
    $member = DB::table('admin_user')->where('id',$request->id)->first();
    return json_encode(['data'=>$member]);
  }

  public function getRecord(Request $request)
  {
    $record = DB::table('active_log')->where('mid',$request->id)->orderby('createDate','desc')->limit(10)->get();
    return json_encode(['data'=>$record]);
  }

  public function updPermission(Request $request)
  {
      // dd($request->all());
      if($request->ed_password=='')
      {
        DB::table('admin_user')->where('id',$request->edid)
        ->update([
          'level'       =>  $request->ed_group,
          'realname'    =>  $request->ed_name,
          'username'    =>  $request->ed_account,
          'enable'      =>  $request->ed_enable?'Y':'N',
          'func1'       =>  $request->ed_func1?"Y":"N",
          'func2'       =>  $request->ed_func2?"Y":"N",
          'func3'       =>  $request->ed_func3?"Y":"N",
          'func4'       =>  $request->ed_func4?"Y":"N",
          'func5'       =>  $request->ed_func5?"Y":"N",
          'updateDate'  =>  date('Y-m-d H-i-s')
        ]);
      }
      else
      {
        DB::table('admin_user')->where('id',$request->edid)
        ->update([
          'level'       =>  $request->ed_group,
          'realname'    =>  $request->ed_name,
          'username'    =>  $request->ed_account,
          'password'    =>  md5($request->ed_password),
          'enable'      =>  $request->ed_enable?'Y':'N',
          'func1'       =>  $request->ed_func1?"Y":"N",
          'func2'       =>  $request->ed_func2?"Y":"N",
          'func3'       =>  $request->ed_func3?"Y":"N",
          'func4'       =>  $request->ed_func4?"Y":"N",
          'func5'       =>  $request->ed_func5?"Y":"N",
          'updateDate'  =>  date('Y-m-d H-i-s')
        ]);
      }
      $array = [$request->ed_func1?'Y':'N',$request->ed_func2?'Y':'N',$request->ed_func3?'Y':'N',$request->ed_func4?'Y':'N',$request->ed_func5?'Y':'N'];
      Session::put('adminn',$array);
      $acc = DB::table('admin_user')->where('id',$request->edid)->first();
      DB::table('active_log')->insert([
        'mid'         =>  Session::get('adminID'),
        'type'        =>  '權限管理',
        'detail'      =>  '[修改] 帳號:'.$acc->username,
        'createDate'  =>  date('Y-m-d H-i-s')
      ]);
      return redirect('/permissionManagement');
  }

  public function permissionDelete(Request $request)
  {
    $acc = DB::table('admin_user')->where('id',$request->id)->first();
    DB::table('active_log')->insert([
      'mid'         =>  Session::get('adminID'),
      'type'        =>  '權限管理',
      'detail'      =>  '[刪除] 帳號:'.$acc->username,
      'createDate'  =>  date('Y-m-d H-i-s')
    ]);
    $status = DB::table('admin_user')->where('id',$request->id)->delete();
    return $status;
  }

  public function permissionAdd(Request $request)
  {
      // dd($request->all());
      $check = DB::table('admin_user')->where('username',$request->account)->first();
      if(empty($check))
      {
          $search = DB::table('admin_user')->where('level','3')->max('mcode');
          if(empty($search))
          {
            $mcode = 'm00001';
          }
          else
          {
            $search=(int)substr($search,1,5)+1;
            $mcode = 'm'.str_pad($search,5,"0",STR_PAD_LEFT);
          }

          if($request->group=='2')
          {
            DB::table('admin_user')->insert([
              'mcode'     =>  $mcode,
              'level'     =>  $request->group,
              'parent'    =>  '1',
              'phone'     =>  '0912345678',
              'username'  =>  $request->account,
              'password'  =>  md5($request->password),
              'realname'  =>  $request->username,
              'pic'       =>  '5be2b51b26999.png',
              'func1'     =>  $request->func1?"Y":"N",
              'func2'     =>  $request->func2?"Y":"N",
              'func3'     =>  $request->func3?"Y":"N",
              'func4'     =>  $request->func4?"Y":"N",
              'func5'     =>  $request->func5?"Y":"N",
              'enable'    =>  $request->enable?"Y":"N",
              'createDate'=>  date('Y-m-d H-i-s'),
              'updateDate'=>  date('Y-m-d H-i-s'),
            ]);
            DB::table('active_log')->insert([
              'mid'         =>  Session::get('adminID'),
              'type'        =>  '權限管理',
              'detail'      =>  '[新增員工] 帳號:'.$request->account,
              'createDate'  =>  date('Y-m-d H-i-s')
            ]);
          }
          else
          {
            DB::table('admin_user')->insert([
              'mcode'     =>  $mcode,
              'level'     =>  $request->group,
              'parent'    =>  '0',
              'phone'     =>  '0912345678',
              'username'  =>  $request->account,
              'password'  =>  md5($request->password),
              'realname'  =>  $request->username,
              'pic'       =>  '5be2b51b26999.png',
              'func1'     =>  $request->func1?"Y":"N",
              'func2'     =>  $request->func2?"Y":"N",
              'func3'     =>  $request->func3?"Y":"N",
              'func4'     =>  $request->func4?"Y":"N",
              'func5'     =>  $request->func5?"Y":"N",
              'enable'    =>  $request->enable?"Y":"N",
              'createDate'=>  date('Y-m-d H-i-s'),
              'updateDate'=>  date('Y-m-d H-i-s'),
            ]);
            DB::table('active_log')->insert([
              'mid'         =>  Session::get('adminID'),
              'type'        =>  '權限管理',
              'detail'      =>  '[新增客戶] 帳號:'.$request->account,
              'createDate'  =>  date('Y-m-d H-i-s')
            ]);
          }
          return redirect('/permissionManagement');
      }
      else
      {
        echo "<script>alert('此帳號已存在!');window.history.go(-1);</script>";
      }
  }
}
