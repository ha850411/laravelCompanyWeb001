<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class PartController extends Controller
{
  public function PartList(Request $request)
  {
    return view('admin.PartManage');
  }

  public function getPart(Request $request)
  {
      $part = DB::table('part')->where('status','1')->get();
      return json_encode(['data'=>$part]);
  }

  public function getPartData(Request $request)
  {
      $part = DB::table('part')->where('id',$request->id)->first();
      return json_encode($part);
  }

  public function PartAdd(Request $request)
  {
      if($request->isMethod('post'))
      {
        if ($request->hasfile('pic'))
        {
            $file = $request->file('pic');
            if ($file->isValid())
            {
                $path = base_path().env('UPLOAD_URL', '\uploads\\');
                $filename = uniqid() . ".png";
                $file->move($path, $filename);
            }
            else
            {
                $filename = '';
            }
            DB::table('part')->insert([
              'name'        =>    $request->name,
              'content'     =>    $request->content,
              'brand'       =>    $request->brand,
              'price'       =>    $request->price,
              'amount'      =>    $request->amount,
              'pic'         =>    $filename,
              'createDate'  =>    date('Y-m-d H-i-s'),
              'updateDate'  =>    date('Y-m-d H-i-s')
            ]);
            return redirect('/PartManage');
        }
        else
        {
          DB::table('part')->insert([
            'name'        =>    $request->name,
            'content'     =>    $request->content,
            'brand'       =>    $request->brand,
            'price'       =>    $request->price,
            'amount'      =>    $request->amount,
            'createDate'  =>    date('Y-m-d H-i-s'),
            'updateDate'  =>    date('Y-m-d H-i-s')
          ]);
          return redirect('/PartManage');
        }

      }
      else
      {
        return redirect('/PartManage');
      }
  }

  public function partEdit(Request $request)
  {
    if($request->isMethod('post'))
    {
      if ($request->hasfile('ed_pic'))
      {
          $file = $request->file('ed_pic');
          if ($file->isValid())
          {
              $origin = DB::table("part")->where('id',$request->ed_id)->first();
              $path = base_path().env('UPLOAD_URL', '\uploads\\');
              if($origin->pic)
              {
                $filename = $origin->pic;
                $full_path = $path . $filename;
                unlink($full_path);
                $file->move($path, $filename);
              }
              else
              {
                $filename = uniqid() . ".png";
                $file->move($path, $filename);
              }
          }
          else
          {
              $filename = '';
          }
          DB::table('part')->where('id',$request->ed_id)
            ->update([
              'name'        =>    $request->ed_name,
              'content'     =>    $request->ed_content,
              'brand'       =>    $request->ed_brand,
              'price'       =>    $request->ed_price,
              'pic'         =>    $filename,
              'amount'      =>    $request->ed_amount,
              'updateDate'  =>    date('Y-m-d H-i-s')
            ]);
            return redirect('/PartManage');
          return redirect('/PartManage');
      }
      else
      {
        DB::table('part')->where('id',$request->ed_id)
          ->update([
            'name'        =>    $request->ed_name,
            'content'     =>    $request->ed_content,
            'brand'       =>    $request->ed_brand,
            'price'       =>    $request->ed_price,
            'amount'      =>    $request->ed_amount,
            'updateDate'  =>    date('Y-m-d H-i-s')
          ]);
          return redirect('/PartManage');
        }
    }
    else
    {
        return redirect('/PartManage');
    }
  }

  public function partDelete(Request $request)
  {
      DB::table('part')->where('id',$request->id)->update([
        'status'=>'0'
      ]);
      return 1;
  }

}
