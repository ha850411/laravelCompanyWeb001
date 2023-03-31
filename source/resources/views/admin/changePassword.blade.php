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
                    <h1>變更密碼</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="{{ url('/generalInformation') }}">帳號設置</a></li>
                        <li class="active">變更密碼</li>
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
                        <strong class="card-title">變更密碼</strong>
                    </div>
                    <div class="card-body">
                        <form id="updform" action="/updPassword" method="post">
                            {{csrf_field()}}
                          <input type="hidden" name="eid" value="{{$member->id}}">
                                <div class="form-group row">
                                    <label for="productModal" class="col-sm-4 col-form-label">舊密碼</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" name="old_ps" id="old_ps" placeholder="請輸入舊的密碼">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="productModal" class="col-sm-4 col-form-label">新密碼</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" name="new_ps" id="new_ps" placeholder="請輸入新的密碼">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="productModal" class="col-sm-4 col-form-label">請再次輸入密碼</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" name="new_ps2" id="new_ps2" placeholder="請再次輸入新的密碼">
                                    </div>
                                </div>

                        </form>
                    </div>
                    <div class="card-footer" id="">
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


    });

    function check()
    {
      // alert('123');
      if($('#old_ps').val()=='')
      {
        alert('請輸入舊密碼');
        $('#old_ps').focus();
        return false;
      }
      else if($('#new_ps').val()=='')
      {
        alert('請輸入新密碼');
        $('#new_ps').focus();
        return false;
      }
      else if($('#new_ps2').val()=='')
      {
        alert('請再次輸入新密碼');
        $('#new_ps2').focus();
        return false;
      }
      else if($('#new_ps').val()!=$('#new_ps2').val())
      {
        alert('請再次確認密碼');
        $('#new_ps').focus();
        return false;
      }
      $('#updform').submit();
    }
</script>
@endsection
