@extends('admin.layout.layout')

@section('style')
@endsection


@section('content')
<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    @include('admin.include.header')
    <!-- /header -->
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>帳號設置</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="{{url('/')}}">首頁</a></li>
                        <li class="active">帳號設置</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <!-- <div class="row"> -->


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <i class="mr-2 fa fa-check-square-o"></i> -->
                        <strong class="card-title">基本資料</strong>
                        <a href="" class="btn btn-primary ml-3 mb-1" id="giEditBtn">修改資料</a>

                        <a href="{{ url('/changePassword') }}"  class="btn btn-primary ml-3 mb-1">變更密碼</a>
                    </div>
                    <div class="card-body">
                        <form action="/setting/update" method="post" id="updform" enctype="multipart/form-data">
                            {{ csrf_field() }}
                          <input type="hidden" name="test" value="test">
                            <div id="gi">
                                <div class="form-group row">
                                    <label for="productModal" class="col-sm-4 col-form-label">使用者姓名</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="username" name="username"  value="{{$member->realname}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="productModal" class="col-sm-4 col-form-label d-flex flex-column">上傳圖片<small>建議尺寸32px*32px</small></label>
                                    <div class="col-sm-8">
                                        <input type="file" class="" id="pic_file" name="pic_file"  >
                                        @if($member->pic!='5be2b51b26999.png')
                                        <img class="user-avatar rounded-circle" width="60" src="{{asset('/uploads')}}/{{$member->pic}}" alt="User Avatar">
                                        @else
                                        <img class="user-avatar rounded-circle" width="60" src="{{asset('/admin/images/admin.jpg')}}" alt="User Avatar">
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="card-footer" id="giSubmit" style="display: none;">
                        <button onclick="check()" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> 確定修改
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> 取消
                        </button>
                    </div>
                </div>
            </div>

            <!-- </div>.row -->
        </div><!-- .animated -->
    </div>
    <!-- .content -->
</div>

<!-- /#right-panel -->

@endsection


@section('javascript')

<script>
    jQuery(document).ready(function ($) {
      $('#giSubmit').show();

        // $('#giEditBtn').click(function (e) {
        //     e.preventDefault();
        //     $('#gi input,select').removeAttr("disabled");
        // });
        // $('#giSubmit').click(function (e) {
        //     e.preventDefault();
        //     // $('#giSubmit').hide();
        //     $('#gi input,select').attr("disabled", "disabled");
        //     $('#updform').submit();
        // });


    });

    function check()
    {
      $('#updform').submit();
    }
</script>
@endsection
