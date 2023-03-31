<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\FixedController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PermissionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('visit')->group(function () {
    //登入
    Route::get('/test', [IndexController::class, 'test']);
    Route::any('/login', [IndexController::class, 'login']);
    Route::any('/logout', [IndexController::class, 'logout']);
    
        //驗證//
        Route::middleware('redec')->group(function () {
    
            Route::get('/', function () {
                return redirect('/fixedManage');
            });
    
            /*維修單管理*/
            Route::get('/fixedManage',[FixedController::class, 'getList']);
            Route::any('/getFixed', [FixedController::class, 'getFixed']);
            Route::any('/getFixedData', [FixedController::class, 'getFixedData']);
            Route::any('/fixedEdit', [FixedController::class, 'fixedEdit']);
            Route::any('/FixedAdd', [FixedController::class, 'FixedAdd']);
            Route::any('/FixedDelete', [FixedController::class, 'FixedDelete']);
            Route::any('/viewFixed', [FixedController::class, 'viewFixed']);
    
             //材料管理
             Route::get('/PartManage',[PartController::class, 'Partlist']);
             Route::any('/getPart',[PartController::class, 'getPart']);
             Route::any('/getPartData',[PartController::class, 'getPartData']);
             Route::any('/partEdit',[PartController::class, 'partEdit']);
             Route::any('/PartAdd',[PartController::class, 'PartAdd']);
             Route::any('/partDelete',[PartController::class, 'partDelete']);
             //機種管理
             Route::get('/model1', [ModelController::class, 'getModel1']);
             Route::any('/getModel1List', [ModelController::class, 'getModel1List']);
             Route::any('/model1Add', [ModelController::class, 'model1Add']);
             Route::any('/model1Edit', [ModelController::class, 'model1Edit']);
             Route::any('/getmodel1Data', [ModelController::class, 'getmodel1Data']);
             Route::any('/model1Delete', [ModelController::class, 'model1Delete']);
             //機型管理
             Route::get('/model2', [ModelController::class, 'getModel2']);
             Route::any('/getModel2List', [ModelController::class, 'getModel2List']);
             Route::any('/model2Add', [ModelController::class, 'model2Add']);
             Route::any('/model2Edit', [ModelController::class, 'model2Edit']);
             Route::any('/getmodel2Data', [ModelController::class, 'getmodel2Data']);
             Route::any('/model2Delete', [ModelController::class, 'model2Delete']);
             Route::any('/getModelItem', [ModelController::class, 'getModelItem']);
    
            //客戶管理
            Route::get('/customerManagement', [MemberController::class, 'memberlist']);
            Route::any('/getmember', [MemberController::class, 'getmember']);
            Route::any('/getdata', [MemberController::class, 'getdata']);
            Route::any('/memberEdit', [MemberController::class, 'memberEdit']);
            Route::any('/memberAdd', [MemberController::class, 'memberAdd']);
            Route::any('/memberDelete', [MemberController::class, 'memberDelete']);
    
            //-帳號設置
            Route::get('/generalInformation', [PermissionController::class, 'settingName']);
            Route::post('/setting/update', [PermissionController::class, 'settingUpdate']);
            Route::any('/updPassword', [PermissionController::class, 'updPassword']);
            Route::get('/changePassword',  [PermissionController::class, 'settingPassword']);
        });
    });
    