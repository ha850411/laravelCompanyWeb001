<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Mail;
use Session;
use Excel;
use Illuminate\PHPExcel\PHPExcel;

class MemberController extends Controller
{
  public function memberlist(Request $request)
  {
    return view('admin.customerManagement');
  }

  public function getmember(Request $request)
  {
      $member = DB::table('company')->get();
      $data = [];
      foreach($member as $kk=>$vv)
      {
        $vv->createDate = date('Y-m-d',strtotime($vv->createDate));
        array_push($data,$vv);
      }  
      return json_encode(['data'=>$data]);
  }

  public function getdata(Request $request)
  {
      $member = DB::table('company')->where('id',$request->id)->first();
      return json_encode($member);
  }

  public function memberAdd(Request $request)
  {
      if($request->isMethod('post'))
      {
          DB::table('company')->insert([
            'name'        =>    $request->name,
            'phone'       =>    $request->phone,
            'address'     =>    $request->address,
            'createDate'  =>    date('Y-m-d H-i-s'),
            'updateDate'  =>    date('Y-m-d H-i-s')
          ]);
          DB::table('active_log')->insert([
            'mid'         =>  Session::get('adminID'),
            'type'        =>  '客戶管理',
            'detail'      =>  '[新增客戶] 名稱:'.$request->name,
            'createDate'  =>  date('Y-m-d H-i-s')
          ]);
          return redirect('/customerManagement');
        }
        else
        {
          return redirect('/customerManagement');
        }
  }

  public function memberEdit(Request $request)
  {
    if($request->isMethod('post'))
    {
      DB::table('company')->where('id',$request->ed_id)
        ->update([
          'name'          =>  $request->ed_name,
          'phone'         =>  $request->ed_phone,
          'address'       =>  $request->ed_address,
        ]);
      DB::table('active_log')->insert([
        'mid'         =>  Session::get('adminID'),
        'type'        =>  '客戶管理',
        'detail'      =>  '[修改客戶資料] id:'.$request->ed_id,
        'createDate'  =>  date('Y-m-d H-i-s')
      ]);
        return redirect('/customerManagement');
    }
    else
    {
        return redirect('/customerManagement');
    }
  }

  public function memberDelete(Request $request)
  {
      $status = DB::table('company')->where('id',$request->id)->delete();
      DB::table('active_log')->insert([
        'mid'         =>  Session::get('adminID'),
        'type'        =>  '客戶管理',
        'detail'      =>  '[刪除客戶帳號] id:'.$request->id,
        'createDate'  =>  date('Y-m-d H-i-s')
      ]);
      return 1;
  }

  public function memberExcel(Request $request)
  {
    DB::table('active_log')->insert([
      'mid'         =>  Session::get('adminID'),
      'type'        =>  '客戶管理',
      'detail'      =>  '[匯出客戶Excel]',
      'createDate'  =>  date('Y-m-d H-i-s')
    ]);

    $objPHPExcel = new \PHPExcel();

    //Set properties 設置文件屬性
    $objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
    $objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
    $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
    $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
    $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
    $objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
    $objPHPExcel->getProperties()->setCategory("Test result file");

    //Add some data 添加數據
    $objPHPExcel->setActiveSheetIndex(0);
    // 廠商訂單編號','物流廠商','商品名稱','貨物價值','配送方式','收件人姓名','收件人手機','收件人Email','收件門市','訂單建立日期','訂單修改日期','備註
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID編號');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', '客戶名稱');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', '聯絡方式');
    $objPHPExcel->getActiveSheet()->setCellValue('D1', '帳號');
    $objPHPExcel->getActiveSheet()->setCellValue('E1', '建立日期');
    $objPHPExcel->getActiveSheet()->setCellValue('F1', '修改日期');


    $member = DB::table('admin_user')->where('level','3')->get();
    // $len = count($orders);
    // for($i=2;$i<$len+2;$i++)
    // {
      foreach($member as $key=>$mem)
      {
        $i=$key+2;
        $objPHPExcel->getActiveSheet()->setCellValue("A$i", "\t".$mem->mcode."\t");
        $objPHPExcel->getActiveSheet()->setCellValue("B$i", $mem->realname);
        $objPHPExcel->getActiveSheet()->setCellValue("C$i", "\t".$mem->phone."\t");
        $objPHPExcel->getActiveSheet()->setCellValue("D$i", $mem->username);
        $objPHPExcel->getActiveSheet()->setCellValue("E$i", $mem->createDate);
        $objPHPExcel->getActiveSheet()->setCellValue("F$i", $mem->updateDate);

      }

    // }
    // foreach($objPHPExcel->getActiveSheet()->getColumnDimension() as $col) {
    //     $col->setAutoSize(true);
    // }
    // $objPHPExcel->getActiveSheet()->calculateColumnWidths();
     $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(16);
     $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
     $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(16);
     $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
     $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
     $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="客戶資料.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0

    $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
    $objWriter->save('php://output');
  }

}
