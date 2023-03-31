<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Mail;
use Session;
use Ecpay;

class IndexController extends Controller
{
    public function index(Request $request)
    {
      $level3  = DB::table('col')->where('level','3')->get();
      return view('index')->with([
        'level' =>  $level3
      ]);

    }

    public function login(Request $request)
    {
      $password = md5($request->password);
      if($request->isMethod('post'))
      {
        $account = DB::table('admin_user')->where('username',$request->account)->where('password',$password)->first();
        if(empty($account))
        {
          echo "<script>alert('帳號密碼錯誤');window.location=window.location;</script>";
        }
        else
        {
            if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                $myip = $_SERVER['HTTP_CLIENT_IP'];
            }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $myip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }else{
                $myip= $_SERVER['REMOTE_ADDR'];
            }
            Session::put('adminUser',$account->username);
            Session::put('adminID',$account->id);
            Session::put('adminUserName',$account->realname);
            Session::put('adminUserPic',$account->pic);
            // $array = [$account->func1,$account->func2,$account->func3,$account->func4,$account->func5];
            // Session::put('adminn',$array);

            DB::table('admin_log')->insert([
              'sid' =>  $account->id,
              'ip'  =>  $myip,
              'updateDate'  => date('Y-m-d H-i-s')
            ]);
            return redirect('/fixedManage');
        }
      }
      else
      {
        return view('admin.login');
      }
    }

    public function logout(Request $request)
    {
      Session::flush();
      return redirect('/login');

    }

    public function test(Request $request)
    {
      DB::table('fixed')->update([
        'tip' =>  '0'
      ]);
      echo "<script>alert('重置成功');window.location = '/fixedManage'</script>";
    }
  }
