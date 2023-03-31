@extends('admin.layout.layout')

@section('style')
<link href="{{asset('/admin/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{asset('/admin/vendors/datatables.net-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{asset('/admin/vendors/datatables.responsive/css/responsive.dataTables.min.css')}}"
    rel="stylesheet">
<link href="{{asset('/datepicker/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('/select/selectize.css')}}" rel="stylesheet">
@endsection


@section('content')
<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    @include('admin.include.header')
    <!-- /header -->
    <!-- Header-->
    @include('admin.include.FixedManage_modal')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>維修單管理</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="{{url('/')}}">首頁</a></li>
                        <li class="active">維修單管理</li>
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
                        <strong class="card-title">維修單管理</strong>
                        <button type="button" id="addbtn" onclick="addFun()" class="btn btn-success ml-3 mb-1" data-toggle="modal">新增維修單</button>
                        <!-- <a href="/memberExcel"><button type="button" class="btn btn-success ml-3 mb-1">匯出</button></a> -->
                    </div>
                    <div class="card-body">
                        <div class="card-body  card-body-template">
                            <table id="FixedManagement"
                                class="example display responsive table table-striped table-bordered" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>客戶名稱</th>
                                        <th>地址</th>
                                        <th>電話</th>
                                        <th>統編</th>
                                        <th>保固</th>
                                        <th>機種</th>
                                        <th>引擎</th>
                                        <th>車號</th>
                                        <th>檢修原因</th>
                                        <th>工作項目</th>
                                        <th>折扣</th>
                                        <th>總價</th>
                                        <th>建立日期</th>
                                        <th>修改日期</th>
                                        <th>功能選項</th>
                                    </tr>

                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>客戶名稱</th>
                                        <th>地址</th>
                                        <th>電話</th>
                                        <th>統編</th>
                                        <th>保固</th>
                                        <th>機種</th>
                                        <th>引擎</th>
                                        <th>車號</th>
                                        <th>檢修原因</th>
                                        <th>工作項目</th>
                                        <th>折扣</th>
                                        <th>總價</th>
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
<script src="{{ asset('/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('/select/selectize.js') }}"></script>


<script>
    jQuery(document).ready(function ($) {

      $('#createDate').datepicker({
        format:'yyyy-mm-dd'
      });
      $('#ed_createDate').datepicker({
        format:'yyyy-mm-dd'
      });
        $('#editPassword').click(function (e) {
            e.preventDefault();
            if ($('#password1').is(':disabled')) {
                $('#password1').removeAttr('disabled');
                $('#password2').removeAttr('disabled');
            } else {
                $('#password1').attr('disabled','');
                $('#password2').attr('disabled','');
            }
        });
    });

    function addFun()
    {
      $('#addbtn').attr('data-target','#addCustomer');
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/getModelItem',
          contentType:'application/x-www-form-urlencoded',
          type: 'POST',
          dataType:'json',
          error: function(xhr)
          {
              console.log(xhr);
              console.log('Ajax error');
          },
          success: function(data)
          {
            $('#type').html('<option selected disabled value="">請選擇機種</option>');
            $('#sn').html('<option selected disabled value="">請選擇引擎</option>');
            $('#name').html('<option selected disabled value="">請選擇客戶</option>');
            var model1 = data.model1;
            var model2 = data.model2;
            var company = data.company;
            var opt1 = '';
            var opt2 = '';
            var opt3 = '';
            for(var i=0;i<model1.length;i++)
            {
              if(model1[i].brand!=null)
              {
                opt1 += '<option value="'+model1[i].id+'">'+model1[i].name+' ( '+model1[i].brand+' )'+'</option>';
              }
              else
              {
                opt1 += '<option value="'+model1[i].id+'">'+model1[i].name+'</option>';
              }
            }
            $('#type').append(opt1);
            for(var i=0;i<model2.length;i++)
            {
              opt2 += '<option value="'+model2[i].id+'">'+model2[i].name+'</option>';
            }
            $('#sn').append(opt2);
            for(var i=0;i<company.length;i++)
            {
              opt3 += '<option value="'+company[i].id+'">'+company[i].name+'</option>';
            }
            $('#name').append(opt3);
            $('#sn').selectize({
                create: true,
                sortField: 'text'
            });
            $('#type').selectize({
                create: true,
                sortField: 'text'
            });
            $('#name').selectize({
                create: true,
                sortField: 'text'
            });
          }
        });
    }

    function more()
    {
      $(".more" ).slideToggle( "slow" );
    }

    function addPart(id)
    {
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/getPart',
          contentType:'application/x-www-form-urlencoded',
          type: 'POST',
          dataType:'json',
          error: function(xhr)
          {
              console.log(xhr);
              console.log('Ajax error');
          },
          success: function(data)
          {
            var data = data.data;
            var content;
            var item = '<div class="form-group row"><select name="data[]" class="col-sm-8 " style="margin-left:12px;display:inline-block">';
            for(i=0;i<data.length;i++)
            {
              content='';
              content += ' ( 單價 : '+data[i].price+' 元';
              if(data[i].content!=null)
              {
                 content += ',規格 : '+data[i].content+' )';
              }
              else
              {
                 content += ' )';
              }
              // if(data[i].amount>0)
              // {
                item += '<option value="'+data[i].id+'">' + data[i].name+content +'</option>';
              // }
            }
            item += '</select><div class="col-sm-2"><input type="number" class="form-control" name="amount[]" placeholder="請輸入數量" value="1" min="0"></div><button type="button" class="col-sm-1 btn" style="background-color:red;color:#ffffff" onclick="delSel(this)">刪除</button></div>';
            $('#add_'+id).append(item);
            $('select[name="data[]"]').selectize({
                create: true,
                sortField: 'text'
            });
          }
      });
    }
    function delSel(obj)
    {
      var test = obj.parentNode;
      test.remove();
    }
    function checkform()
    {
      var name = $('#name').val();
      if(name==''||name==null)
      {
        alert('請選擇客戶');
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
      if(name==''||name==null)
      {
        alert('請選擇客戶');
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
      $('#add_2').html('');
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/getFixedData',
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
            var part = data.part;
            var model1 = data.model1;
            var model2 = data.model2;
            var company = data.company;
            var data = data.data;
            $('#ed_type').html('<option selected disabled value="">請選擇機種</option>');
            $('#ed_sn').html('<option selected disabled value="">請選擇引擎</option>');
            $('#ed_name').html('<option selected disabled value="">請選擇客戶</option>');

            var obj = JSON.parse(data.data);
            var item = '';
            var content = '';
            var opt1 = '<select class="selectize" name="ed_type" id="ed_type" >';
            var opt2 = '<select class="selectize" name="ed_sn" id="ed_sn" >';
            var opt3 = '<select class="selectize" name="ed_name" id="ed_name" >';
            $('#nameArea').html('');
            $('#typeArea').html('');
            $('#snArea').html('');
            check = 0;
            for(i=0;i<model1.length;i++)
            {
              if((data.type==model1[i].id)||(data.type==model1[i].name))
              {
                ck = "selected";
                check = 1;
              }
              else
              {
                ck = "";
              }
              if(model1[i].brand!=null)
              {
                opt1 += '<option '+ck+' value="'+model1[i].id+'">'+model1[i].name+' ( '+model1[i].brand+' )'+'</option>';
              }
              else
              {
                opt1 += '<option '+ck+' value="'+model1[i].id+'">'+model1[i].name+'</option>';
              }
            }
            if((check==0)&&(data.type!=null))
            {
              opt1 += '<option selected value="'+data.type+'">'+data.type+'</option>';
            }
            opt1 += '</select>';
            $('#typeArea').append(opt1);
            if(data.type==null)
            {
              $('#ed_type').val('');
            }
            check = 0;
            for(i=0;i<model2.length;i++)
            {
              if((data.sn==model2[i].id)||(data.sn==model2[i].name))
              {
                ck = "selected";
                check = 1;
              }
              else
              {
                ck = "";
              }
              opt2 += '<option '+ck+' value="'+model2[i].id+'">'+model2[i].name+'</option>';
            }
            if((check==0)&&(data.sn!=null))
            {
              opt2 += '<option selected value="'+data.sn+'">'+data.sn+'</option>';
            }
            opt2 += '</select>';
            $('#snArea').append(opt2);
            if(data.sn==null)
            {
              $('#ed_sn').val('');
            }
            check = 0;
            for(i=0;i<company.length;i++)
            {
              if((data.customer==company[i].id)||(data.customer==company[i].name))
              {
                opt3 += '<option value="'+company[i].id+'" selected>'+company[i].name+'</option>';
                check = 1;
              }
              else
              {
                opt3 += '<option value="'+company[i].id+'">'+company[i].name+'</option>';
              }
            }
            if((check==0)&&(data.customer!=null))
            {
              opt3 += '<option selected value="'+data.customer+'">'+data.customer+'</option>';
            }
            opt3 += '</select>';
            $('#nameArea').append(opt3);
            if(data.customer==null)
            {
              $('#ed_name').val('');
            }

            for(x=0;x<obj.length;x++)
            {
              item += '<div class="form-group row"><select name="data[]" class="col-sm-8 selectize" style="margin-left:12px;display:inline-block">';
              for(i=0;i<part.length;i++)
              {
                content = '';
                // if(part[i].amount>0)
                // {
                  content += ' ( 單價 : '+part[i].price+' 元';
                  if(part[i].content!=null)
                  {
                     content += ',規格 : '+part[i].content+' )';
                  }
                  else
                  {
                     content += ' )';
                  }
                  if(obj[x].id==part[i].id)
                  {
                    item += '<option value="'+part[i].id+'" selected>' + part[i].name+content +'</option>';
                  }
                  else
                  {
                    item += '<option value="'+part[i].id+'">' + part[i].name+content +'</option>';
                  }
                // }
              }
              item += '</select><div class="col-sm-2"><input type="number" class="form-control" name="amount[]" placeholder="請輸入數量" value="'+obj[x].amount+'" min="0"></div><button type="button" class="col-sm-1 btn" style="background-color:red;color:#ffffff" onclick="delSel(this)">刪除</button></div>';
            }
            $('#ed_id').val(id);
            $('#ed_adr').val(data.address);
            $('#ed_tel').val(data.tel);
            $('#ed_uni').val(data.uni);
            $('#ed_car').val(data.car);
            $('#ed_detail').val(data.detail);
            $('#ed_discount').val(data.discount);
            $('#ed_warranty').val(data.warranty);
            var date = data.createDate.split(' ');
            $('#ed_createDate').val(date[0]);
            $('#add_2').append(item);
            $('#ed_type').selectize({
                create: true,
                sortField: 'text'
            });
            $('#ed_sn').selectize({
                create: true,
                sortField: 'text'
            });
            $('#ed_name').selectize({
                create: true,
                sortField: 'text'
            });
            $('select[name="data[]"]').selectize({
                create: true,
                sortField: 'text'
            });
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
          url: '/FixedDelete',
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
            tableForFixed.ajax.reload();
          }
       });
      }
    }
</script>
@endsection
