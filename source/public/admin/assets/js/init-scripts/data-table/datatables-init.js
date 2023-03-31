	var responsiveClassName;
	var tableForCustomer;
	var tableForFixed;
	var tableForPart;
	var tableForModel1;
	var tableForModel2;

(function ($) {
	//    "use strict";


	/*  Data Table
	-------------*/

	$('#bootstrap-data-table').DataTable({
		lengthMenu: [
			[10, 20, 50, -1],
			[10, 20, 50, "All"]
		],
	});

	$('#bootstrap-data-table-export').DataTable({

		lengthMenu: [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
		"language": {
			"lengthMenu": "顯示 _MENU_ 個項目",
			// "zeroRecords": "Nothing found - sorry",
			"info": "正在顯示 _PAGES_ 頁中的第 _PAGE_ 頁 ",
			// "infoEmpty": "No records available",
			// "infoFiltered": "(filtered from _MAX_ total records)",
			"search": "搜尋:",
			"paginate": {
				"first": "First",
				"last": "Last",
				"next": "下一頁",
				"previous": "上一頁"
			},
		},
	});
	$('#row-select').DataTable({
		initComplete: function () {
			this.api().columns().every(function () {
				var column = this;
				var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo($(column.footer()).empty())
					.on('change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
						);

						column
							.search(val ? '^' + val + '$' : '', true, false)
							.draw();
					});

				column.data().unique().sort().each(function (d, j) {
					select.append('<option value="' + d + '">' + d + '</option>')
				});
			});
		}
	});

	//維修單管理
	tableForFixed = $('#FixedManagement').addClass('nowrap').DataTable({
		"ajax": "/getFixed",
		responsive: {
			breakpoints: responsiveClassName
		},
		"columns": [
			{
				"data": "customer"
			},
			{
				"data": "address",
				className: 'none'
			},
			{
				"data": "tel",
				className: 'min-desktop'
			},
			{
				"data": "uni",
				className: 'none'
			},
			{
				"data": function(source,type,val){
					if(source.warranty==null)
					{
						return '無';
					}
					else
					{
						return source.warranty+' 個月';
					}
				},
				className: 'none'
			},
			{
				"data": "model1"
			},
			{
				"data": "model2"
			},
			{
				"data": "car",
				className: 'none'
			},
			{
				"data": "detail"
			},
			{
				"data": function(source,type,val){
						var obj = JSON.parse(source.data);
						var len = Object.keys(obj).length;
						if(len>0)
						{
							var res = '<br><br><table><tr><td>材料名稱</td><td>數量</td><td>單價</td></tr>';
							for(i=0;i<len;i++)
							{
								res += "<tr><td>"+obj[i].name+"</td><td>"+obj[i].amount+"</td><td>"+obj[i].price+"</td></tr>";
							}
							res += '</table>';
						}
						else
						{
							res = '無項目';
						}
						return res;
				},
				className: 'none'
			},
			{
				"data": "discount",
				className: 'none'
			},
			{
				"data": "total",
				className: 'none'
			},
			{
				"data": "createDate",
				className: 'none'
			},
			{
				"data": "updateDate",
				className: 'none'
			},
			{
				"data":function(source,type,val)
				{
					return '<a data-toggle="modal" id="edit'+source.id+'" href="#" onclick="edit('+source.id+')" title="修改" class=""><i class="fa fa-edit"></i></a><a href="#" title="刪除" onclick="del('+source.id+')" class="ml-3"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
				}
			},
		],
		"order": [
			[12, 'desc']
		],
		lengthMenu: [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		// dom: 'Bfrtip',
		// buttons: [{
		// 	text: '下載EXCEL',
		// 	extend: 'excelHtml5',
		// 	title: 'Data export'
		// }, ],
		"language": {
			"lengthMenu": "顯示 _MENU_ 個項目",
			// "zeroRecords": "Nothing found - sorry",
			"info": "正在顯示 _PAGES_ 頁中的第 _PAGE_ 頁 ",
			// "infoEmpty": "No records available",
			// "infoFiltered": "(filtered from _MAX_ total records)",
			"search": "搜尋:",
			"paginate": {
				"first": "First",
				"last": "Last",
				"next": "下一頁",
				"previous": "上一頁"
			},
		},
	});


	//客戶管理
	tableForCustomer = $('#customerManagement').addClass('nowrap').DataTable({
		"ajax": "/getmember",
		responsive: {
			breakpoints: responsiveClassName
		},
		"columns": [{
				"data": "name"
			},
			{
				"data": "phone"
			},
			{
				"data": "address",
				className: 'min-medium'
			},
			{
				"data": "createDate",
				className: 'min-medium'
			},
			{
				"data": "updateDate",
				className: 'none'
			},
			{
				"data":function(source,type,val)
				{
					return '<a data-toggle="modal" id="edit'+source.id+'" href="#" onclick="edit('+source.id+')" title="修改" class=""><i class="fa fa-edit"></i></a><a href="#" title="刪除" onclick="del('+source.id+')" class="ml-3"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
				}
			},
		],
		"order": [
			[3, 'desc']
		],
		lengthMenu: [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		"language": {
			"lengthMenu": "顯示 _MENU_ 個項目",
			"info": "正在顯示 _PAGES_ 頁中的第 _PAGE_ 頁 ",
			"search": "搜尋:",
			"paginate": {
				"first": "First",
				"last": "Last",
				"next": "下一頁",
				"previous": "上一頁"
			},
		},
	});

	//材料管理
	tableForPart = $('#PartManagement').addClass('nowrap').DataTable({
		"ajax": "/getPart",
		responsive: {
			breakpoints: responsiveClassName
		},
		"columns": [
			{
				"data": "name"
			},
			{
				"data": "content"
			},
      {
        "data": "brand"
      },
			{
				"data": "amount"
			},
			{
				"data": "price"
			},
      {
        "data": function(source,type,val){
          if(source.pic!=null)
          {
            return "<br><br><img src='/public/uploads/"+source.pic+"' style='max-height:300px;max-width:300px;'>";
          }
          else
          {
            return "無上傳圖片";
          }
        },
        className: 'none'
      },
			{
				"data": "createDate",
				className: 'min-medium'
			},
			{
				"data": "updateDate",
				className: 'min-medium'
			},
			{
				"data":function(source,type,val)
				{
					return '<a data-toggle="modal" id="edit'+source.id+'" href="#" onclick="edit('+source.id+')" title="修改" class=""><i class="fa fa-edit"></i></a><a href="#" title="刪除" onclick="del('+source.id+')" class="ml-3"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
				}
			},
		],
		"order": [
			[4, 'desc']
		],
		lengthMenu: [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		// dom: 'Bfrtip',
		// buttons: [{
		// 	text: '下載EXCEL',
		// 	extend: 'excelHtml5',
		// 	title: 'Data export'
		// }, ],
		"language": {
			"lengthMenu": "顯示 _MENU_ 個項目",
			// "zeroRecords": "Nothing found - sorry",
			"info": "正在顯示 _PAGES_ 頁中的第 _PAGE_ 頁 ",
			// "infoEmpty": "No records available",
			// "infoFiltered": "(filtered from _MAX_ total records)",
			"search": "搜尋:",
			"paginate": {
				"first": "First",
				"last": "Last",
				"next": "下一頁",
				"previous": "上一頁"
			},
		},
	});
	//機種管理
	tableForModel1 = $('#model1Management').addClass('nowrap').DataTable({
		"ajax": "/getModel1List",
		responsive: {
			breakpoints: responsiveClassName
		},
		"columns": [{
				"data": "name"
			},
			{
				"data": "brand",
			},
			{
				"data": "createDate",
			},
			{
				"data": "updateDate",
			},
			{
				"data":function(source,type,val)
				{
					return '<a data-toggle="modal" id="edit'+source.id+'" href="#" onclick="edit('+source.id+')" title="修改" class=""><i class="fa fa-edit"></i></a><a href="#" title="刪除" onclick="del('+source.id+')" class="ml-3"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
				}
			},
		],
		"order": [
			[3, 'desc']
		],
		lengthMenu: [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		"language": {
			"lengthMenu": "顯示 _MENU_ 個項目",
			"info": "正在顯示 _PAGES_ 頁中的第 _PAGE_ 頁 ",
			"search": "搜尋:",
			"paginate": {
				"first": "First",
				"last": "Last",
				"next": "下一頁",
				"previous": "上一頁"
			},
		},
	});
	tableForModel2 = $('#model2Management').addClass('nowrap').DataTable({
		"ajax": "/getModel2List",
		responsive: {
			breakpoints: responsiveClassName
		},
		"columns": [{
				"data": "name"
			},
			{
				"data": "createDate",
			},
			{
				"data": "updateDate",
			},
			{
				"data":function(source,type,val)
				{
					return '<a data-toggle="modal" id="edit'+source.id+'" href="#" onclick="edit('+source.id+')" title="修改" class=""><i class="fa fa-edit"></i></a><a href="#" title="刪除" onclick="del('+source.id+')" class="ml-3"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
				}
			},
		],
		"order": [
			[3, 'desc']
		],
		lengthMenu: [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		"language": {
			"lengthMenu": "顯示 _MENU_ 個項目",
			"info": "正在顯示 _PAGES_ 頁中的第 _PAGE_ 頁 ",
			"search": "搜尋:",
			"paginate": {
				"first": "First",
				"last": "Last",
				"next": "下一頁",
				"previous": "上一頁"
			},
		},
	});
})(jQuery);
