<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Mail;
use Session;
use Excel;
use Ecpay;
use Illuminate\PHPExcel\PHPExcel;


class ProductController extends Controller
{
  public function productList($value='')
  {

    Session::forget('code');
    Session::forget('codearr');
    Session::forget('product');
    $status = DB::table('col')->where('type','3')->orderby('name','asc')->get();
    $customer = DB::table('admin_user')->where('level','3')->orderby('mcode','asc')->get();
    return view('admin.goodsManagement')->with([
      'status'    =>  $status,
      'customer'  =>  $customer

    ]);
  }
  public function getProduct(Request $request)
  {
      $product = DB::table('product as p')
      ->where('p.type','=','1')
      ->LEFTJOIN('orders as o', function($join)
      {
        $join->on('p.incode', '=', 'o.order_id');
      })
      ->select('p.*','o.product','o.price','o.receiveStore','o.receiveName','o.receivePhone')
      ->get();
      return json_encode(['data'=>$product]);
  }
  public function reloads(Request $request)
  {
    $product = DB::table('product as p')
    ->where('p.createDate','>=',$request->start)
    ->where('p.createDate','<=',$request->end)
    ->where('p.type','=',$request->type)
    ->LEFTJOIN('orders as o', function($join)
    {
      $join->on('p.incode', '=', 'o.order_id');
    })
    ->select('p.*','o.product','o.price','o.receiveStore','o.receiveName','o.receivePhone')
    ->get();
    return json_encode(['data'=>$product]);
  }
  public function getProductData(Request $request)
  {
      $product = DB::table('product')->where('id',$request->id)->first();
      $status = DB::table('col')->where('type','3')->where('name2',$product->status)->first();
      $store  = DB::table('orders')->where('order_id',$product->incode)->first();
      $store = $store->logisticType;
      return json_encode(['data'=>$product,'status'=>$status,'store'=>$store],JSON_UNESCAPED_UNICODE);
  }

  public function productAdd(Request $request)
  {
      // dd( $request->all());
      $incode = str_replace(' ','',$request->incode);
      $str = explode(',',$incode);
      for($i=0;$i<count($str);$i++)
      {
        $str[$i]=trim($str[$i]);
      }

      $outcode = str_replace(' ','',$request->outcode);
      $str2 = explode(',',$outcode);
      for($i=0;$i<count($str2);$i++)
      {
        $str2[$i]=trim($str2[$i]);
      }

      $array = Session::get('codearr');
      $member = DB::table('admin_user')->where('id',$_COOKIE['customer'])->first();
      $status = DB::table('col')->where('id',$_COOKIE['status'])->first();

      for($i=0;$i<count($str);$i++)
      {
        $check = DB::table('orders')->where('order_id',$str[$i])->first(); //檢查訂單內有無此筆商品
        if(empty($check)) // 若訂單內無此商品,但使用者新增此商品
        {
          DB::table('product')->insert([
            'parent'    =>    $request->parents,
            'mid'       =>    $member->mcode,
            'c_name'    =>    $member->realname,
            'c_tel'     =>    $member->phone,
            'status'    =>    $status->name2,
            'ecs_code'   =>    $array[$i][7],
            'incode'    =>    $str[$i],
            'outcode'   =>    $str2[$i],
            'in_time'   =>    date('Y-m-d H-i-s'),
            'out_time'  =>    date('Y-m-d H-i-s'),
            'logistic'  =>    $array[$i][5],
            'ck_order'  =>    'N',
            'RtnCode'   =>    $array[$i][13],
            'RtnMsg'    =>    $array[$i][15],
            'createDate'=>    date('Y-m-d H-i-s'),
            'updateDate'=>    date('Y-m-d H-i-s'),
          ]);
        }
        else //訂單內有此商品
        {
          DB::table('product')->insert([
            'parent'    =>    $request->parents,
            'mid'       =>    $member->mcode,
            'c_name'    =>    $member->realname,
            'c_tel'     =>    $member->phone,
            'status'    =>    $status->name2,
            'ecs_code'   =>    $array[$i][7],
            'incode'    =>    $str[$i],
            'outcode'   =>    $str2[$i],
            'in_time'   =>    date('Y-m-d H-i-s'),
            'out_time'  =>    date('Y-m-d H-i-s'),
            'logistic'  =>    $array[$i][5],
            'ck_order'  =>    'Y',
            'RtnCode'   =>    $array[$i][13],
            'RtnMsg'    =>    $array[$i][15],
            'createDate'=>    date('Y-m-d H-i-s'),
            'updateDate'=>    date('Y-m-d H-i-s'),
          ]);
        }
      }

      setcookie ("status", "", time() - 3600,"/");
      setcookie ("customer", "", time() - 3600,"/");
      setcookie ("parent", "", time() - 3600,"/");
      Session::forget('code');
      Session::forget('code1');
      Session::forget('codearr');
      Session::forget('product');

      return redirect('/goodsManagement');
  }

  public function clearProduct($value='')
  {
    setcookie ("status", "", time() - 3600,"/");
    setcookie ("customer", "", time() - 3600,"/");
    setcookie ("parent", "", time() - 3600,"/");
    Session::forget('code');
    Session::forget('code1');
    Session::forget('codearr');
    Session::forget('product');
    return redirect('/goodsManagement');
  }

  public function productEdit(Request $request)
  {
      $check_orders  = DB::table('orders')->where('order_id',$request->ed_incode)->first();
      $status = DB::table('col')->where('id',$request->ed_status)->first();
      if($request->ed_logistic=='1')
      {
        $lg = 'UNIMARTC2C';
      }
      else if($request->ed_logistic=='1')
      {
        $lg = 'FAMIC2C';
      }
      else
      {
        $lg = 'HILIFEC2C';
      }
      if($check_orders)
      {
        // if(($check_product)&&($check_product->outcode!=''))
        // {
        //   //此新編號訂單中已成立,也已經建立物流單號
        //   DB::table('product')->where('id',$request->edid)
        //   ->update([
        //     'mid'        =>    $request->ed_customer,
        //     'status'     =>    $status->name2,
        //     'parent'     =>    $request->ed_parent,
        //     'logistic'   =>    $lg,
        //     'incode'     =>    $request->ed_incode,
        //   ]);
        //    return redirect('/goodsManagement');
        // }
        // else
        // {

          //此新編號訂單中已成立,尚未建立物流單號
          DB::table('product')->where('id',$request->edid)
          ->update([
            'mid'        =>    $request->ed_customer,
            'status'     =>    $status->name2,
            'parent'     =>    $request->ed_parent,
            'logistic'   =>    $lg,
            'incode'     =>    $request->ed_incode,
          ]);
          DB::table('active_log')->insert([
            'mid'         =>  Session::get('adminID'),
            'type'        =>  '超商物流',
            'detail'      =>  '[商品補正] 編號:'.$request->ed_incode,
            'createDate'  =>  date('Y-m-d H-i-s')
          ]);
          Ecpay::i()->Send['ReturnURL']         = "http://www.ecpay.com.tw/receive.php" ;
          Ecpay::i()->Send['MerchantTradeNo']   = "Test".time() ;           //訂單編號
          Ecpay::i()->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');      //交易時間
          Ecpay::i()->Send['LogisticsType'] =  'CVS';      //物流類型  CVS or Home
          Ecpay::i()->Send['LogisticsSubType'] =  'UNIMART';
          // Ecpay::i()->Send['LogisticsSubType'] =  $request->type;
          $check_product = DB::table('product')->where('incode',$request->ed_incode)->first();

          //---B2C---FAMI:全家 UNIMART:統一超商 HILIFE:萊爾富---C2C---FAMIC2C:全家店到店UNIMARTC2C:統一超商交貨便HILIFEC2C:萊爾富店到店---HOME---TCAT:黑貓ECAN:宅配通
          Ecpay::i()->Send['GoodsAmount'] =  $check_orders->price;
          Ecpay::i()->Send['GoodsName'] =  $check_orders->product;
          Ecpay::i()->Send['SenderName'] =  $check_product->c_name;
          Ecpay::i()->Send['SenderCellPhone'] = $check_product->c_tel ;
          Ecpay::i()->Send['ReceiverName'] =  $check_orders->receiveName;
          Ecpay::i()->Send['ReceiverCellPhone'] =   $check_orders->receivePhone;
          Ecpay::i()->Send['ReceiverEmail'] =   $check_orders->receiveEmail;
          Ecpay::i()->Send['ReceiverAddress'] =  '測試收件地址';
          Ecpay::i()->Send['BookingNote'] =  'test123456';

          Ecpay::i()->Send['ServerReplyURL'] =  'http://express.com/statusreturn';   //狀態return
          Ecpay::i()->Send['ClientReplyURL'] =  'http://express.com/ecpayreturn';//用戶return
          // Ecpay::i()->Send['ChoosePayment']     = \ECPay_PaymentMethod::ALL ;     //付款方式
          Ecpay::i()->Send['TotalAmount']   = 2000;                     //交易金額
          Ecpay::i()->Send['TradeDesc']     = "good to drink" ;         //交易描述
          array_push(Ecpay::i()->Send['Items'], array('Name' => "緑界黑芝麻豆漿", 'Price' => (int)"2000",
          'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed"));
          //Go to ECPay
          // echo "緑界頁面導向中...";
          Session::put('product',$request->ed_incode);
          Session::put('lgtype','1');
          echo Ecpay::i()->CheckOutString();
          // echo '2';
        // }
      }
      else
      {
        //此新商品編號不存在訂單中
        echo "<script>alert('此條碼不存在訂單中');window.history.go(-1);</script>";
      }
  }

  public function deleteProduct(Request $request)
  {
     $data = DB::table('product')->where('id',$request->del_id)->first();
     DB::table('product')->where('id',$request->del_id)->delete();
     // config(['ecpay.ServiceURL' => 'https://logistics-stage.ecpay.com.tw/Express/CancelC2COrder']);
     // Ecpay::i()->Send['ReturnURL']         = "http://www.ecpay.com.tw/receive.php" ;
     // Ecpay::i()->Send['MerchantTradeNo']   = "Test".time() ;           //訂單編號
     // Ecpay::i()->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');      //交易時間
     // Ecpay::i()->Send['AllPayLogisticsID'] = $data->outcode ;                //**
     // Ecpay::i()->Send['CVSPaymentNo']      = $data->CVSPaymentNo ;                     //**
     // Ecpay::i()->Send['CVSValidationNo']   = $data->CVSValidationNo ;                  //**
     // Ecpay::i()->Send['TotalAmount']   = 2000;                     //交易金額
     // Ecpay::i()->Send['TradeDesc']     = "good to drink" ;         //交易描述
     // array_push(Ecpay::i()->Send['Items'], array('Name' => "緑界黑芝麻豆漿", 'Price' => (int)"2000",
     //            'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed"));
     // //訂單的商品資料
     // //Go to ECPay
     // // echo "緑界頁面導向中...";
     // echo Ecpay::i()->CheckOutString();
     setcookie ("status", "", time() - 3600,"/");
     setcookie ("customer", "", time() - 3600,"/");
     setcookie ("parent", "", time() - 3600,"/");
     Session::forget('code');
     Session::forget('codearr');
     Session::forget('product');
     DB::table('active_log')->insert([
       'mid'         =>  Session::get('adminID'),
       'type'        =>  '超商物流',
       'detail'      =>  '[商品刪除] 編號:'.$data->incode,
       'createDate'  =>  date('Y-m-d H-i-s')
     ]);
     echo "<script>window.history.go(-1);</script>";
  }



  public function bugExport(Request $request)
  {
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
    $objPHPExcel->getActiveSheet()->setCellValue('A1', '客戶ID');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', '客戶名稱');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', '商品名稱');
    $objPHPExcel->getActiveSheet()->setCellValue('D1', '商品價格');
    $objPHPExcel->getActiveSheet()->setCellValue('E1', '收件門市');
    $objPHPExcel->getActiveSheet()->setCellValue('F1', '收件人姓名');
    $objPHPExcel->getActiveSheet()->setCellValue('G1', '收件人手機');
    $objPHPExcel->getActiveSheet()->setCellValue('H1', '廠商訂單編號');
    $objPHPExcel->getActiveSheet()->setCellValue('I1', '配送物流');
    $objPHPExcel->getActiveSheet()->setCellValue('J1', '訂單建立日期');
    $objPHPExcel->getActiveSheet()->setCellValue('K1', '訂單修改日期');
    $objPHPExcel->getActiveSheet()->setCellValue('L1', '核對');

    $end = $request->ex_end;
    $end = strtotime($end);
    $end = strtotime("+1 day",$end);
    $end = date('Y-m-d',$end);
    // dd($end);

    $product = DB::table('product as p')
    ->where('p.type','=',$request->ex_type)
    ->where('p.ck_order','=','N')
    ->where('p.createDate','>=',$request->ex_start)
    ->where('p.createDate','<=',$end)
    ->LEFTJOIN('orders as o', function($join)
    {
      $join->on('p.incode', '=', 'o.order_id');
    })
    ->select('p.*','o.product','o.price','o.receiveStore','o.receiveName','o.receivePhone')
    ->get();


      foreach($product as $key=>$pp)
      {
        if($pp->logistic=='1')
        {
          $logisticType = 'UNIMARTC2C(7-11)';
        }
        else if($pp->logistic=='2')
        {
          $logisticType = 'FAMIC2C(全家)';
        }
        else if($pp->logistic=='3')
        {
          $logisticType = 'HILIFEC2C(萊爾富)';
        }
        else if($pp->logistic=='4')
        {
          $logisticType = 'UNIMART(7-11)';
        }
        else if($pp->logistic=='5')
        {
          $logisticType = 'FAMI(全家)';
        }
        else if($pp->logistic=='6')
        {
          $logisticType = 'HILIFE(萊爾富)';
        }
        else
        {
          $logisticType = '無';
        }


        $i=$key+2;
        $objPHPExcel->getActiveSheet()->setCellValue("A$i", "\t".$pp->mid."\t");
        $objPHPExcel->getActiveSheet()->setCellValue("B$i", $pp->c_name);
        $objPHPExcel->getActiveSheet()->setCellValue("C$i", $pp->product);
        $objPHPExcel->getActiveSheet()->setCellValue("D$i", $pp->price);
        $objPHPExcel->getActiveSheet()->setCellValue("E$i","\t".$pp->receiveStore."\t");
        $objPHPExcel->getActiveSheet()->setCellValue("F$i", $pp->receiveName);
        $objPHPExcel->getActiveSheet()->setCellValue("G$i", $pp->receivePhone);
        $objPHPExcel->getActiveSheet()->setCellValue("H$i", $pp->incode);
        $objPHPExcel->getActiveSheet()->setCellValue("I$i", $logisticType);
        $objPHPExcel->getActiveSheet()->setCellValue("J$i", $pp->createDate);
        $objPHPExcel->getActiveSheet()->setCellValue("K$i", $pp->updateDate);
        $objPHPExcel->getActiveSheet()->setCellValue("L$i", $pp->ck_order);

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
     $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
     $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
     $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(13);
     $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
     $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
     $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
     $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
     $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);


    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    if($request->ex_type==1)
    {
      header('Content-Disposition: attachment;filename="超商-問題訂單.xlsx"');
    }
    else
    {
      header('Content-Disposition: attachment;filename="大宗-問題訂單.xlsx"');
    }
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
