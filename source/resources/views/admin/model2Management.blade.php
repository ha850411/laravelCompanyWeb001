@extends('admin.layout.layout')

@section('style')
<link href="{{asset('/admin/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{asset('/admin/vendors/datatables.net-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{asset('/admin/vendors/datatables.responsive/css/responsive.dataTables.min.css')}}"
    rel="stylesheet">
@endsection


@section('content')
<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    @include('admin.include.header')
    <!-- /header -->
    <!-- Header-->
    @include('admin.include.model2Management_modal')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>引擎管理</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="{{url('/')}}">首頁</a></li>
                        <li class="active">引擎管理</li>
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
                        <strong class="card-title">引擎管理</strong>
                        <button type="button" class="btn btn-success ml-3 mb-1" data-toggle="modal" data-target="#addCustomer">新增引擎型號</button>
                        <!-- <a href="/memberExcel"><button type="button" class="btn btn-success ml-3 mb-1">匯出</button></a> -->
                    </div>
                    <div class="card-body">

                        <div class="card-body  card-body-template">
                            <table id="model2Management"
                                class="example display responsive table table-striped table-bordered" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>引擎名稱</th>
                                        <th>建立日期</th>
                                        <th>修改日期</th>
                                        <th>功能選項</th>
                                    </tr>

                                </thead>

                                <tfoot>
                                    <tr>
                                      <th>引擎名稱</th>
                                      <th>建立日期</th>
                                      <th>修改日期</th>
                                      <th>功能選項</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>

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

<script src="{{ asset('/admin/vendors/datatables.net/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/admin/vendors/datatables.responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/admin/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admin/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/admin/vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('/admin/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('/admin/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/admin/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/admin/vendors/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<!-- //DataTable 調整用 -->
<script src="{{ asset('/admin/assets/js/init-scripts/data-table/datatables-init.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    function checkform()
    {
      var name = $('#name').val();
      if(name=='')
      {
        alert('請輸入引擎名稱');
        $('#name').focus();
        return false;
      }
      else
      {
        $('#memberform').submit();
      }

    }

    function checkedit()
    {
      var name = $('#ed_name').val();
      if(name=='')
      {
        alert('請輸入引擎名稱');
        $('#ed_name').focus();
        return false;
      }
      else
      {
        $('#editform').submit();
      }
    }

    function edit(id)
    {
      $('#edit'+id).attr('data-target','#editCustomer');

      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/getmodel2Data',
          contentType:'application/x-www-form-urlencoded',
          type: 'POST',
          dataType:'json',
          data: {
            id:id
          },
          error: function(xhr)
          {
              console.log(xhr);
              console.log('Ajax error');
          },
          success: function(data)
          {
            console.log(data);
            $('#ed_id').val(data.id);
            $('#ed_name').val(data.name);
          }
      });

    }

    function del(id)
    {
      if(confirm('確定刪除?')==true)
      {
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/model2Delete',
          contentType:'application/x-www-form-urlencoded',
          type: 'POST',
          dataType:'text',
          data: {
            id:id
          },
          error: function(xhr)
          {
              console.log(xhr);
              console.log('Ajax error');
          },
          success: function(data)
          {
            tableForModel2.ajax.reload();
          }
       });
      }
    }
</script>
@endsection
