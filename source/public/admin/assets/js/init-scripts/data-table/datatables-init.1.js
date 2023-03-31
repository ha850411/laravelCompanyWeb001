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

	//
	/* Formatting function for row details - modify as you need */
	var typeStatus = function (source, type, val) {
		let status1 = '';
		let word1 = '無';
		let title1 = '無';
		let status2 = '';
		let word2 = '無';
		let title2 = '無';
		let status3 = '';
		let word3 = '無';
		let title3 = '無';
		let status4 = '';
		let word4 = '無';
		let title4 = '無';
		let status5 = '';
		let word5 = '無';
		let title5 = '無';

		if (source.status1 == '1') {
			status1 = 'passed';
			word1 = '送';
			title1 = '已確認送出';
		} else if (source.status1 == '2') {
			status1 = 'submit';
			word1 = '審';
			title1 = '審核確認';
		} else if (source.status1 == '3') {
			status1 = 'back';
			word1 = '退';
			title1 = '已退回';
		} else if (source.status1 == '4') {
			status1 = 'changed';
			word1 = '變';
			title1 = '已被變更';
		}

		if (source.status2 == '1') {
			status2 = 'passed';
			word2 = '中';
			title2 = '處理中';
		} else if (source.status2 == '2') {
			status2 = 'submit';
			word2 = '已';
			title2 = '已處理';
		} else if (source.status2 == '3') {
			status2 = 'back';
			word2 = '退';
			title2 = '已退回';
		} else if (source.status2 == '4') {
			status2 = 'changed';
			word2 = '未';
			title2 = '未處理';
		}
		if (source.status3 == '1') {
			status3 = 'passed';
			word3 = '中';
			title3 = '處理中';
		} else if (source.status3 == '2') {
			status3 = 'submit';
			word3 = '結';
			title3 = '已處理結案';
		} else if (source.status3 == '3') {
			status3 = 'back';
			word3 = '退';
			title3 = '已退回';
		} else if (source.status3 == '4') {
			status3 = 'changed';
			word3 = '未';
			title3 = '未處理';
		}
		if (source.status4 == '1') {
			status4 = 'passed';
			word4 = '中';
			title4 = '處理中';
		} else if (source.status4 == '2') {
			status4 = 'submit';
			word4 = '結';
			title4 = '已處理結案';
		} else if (source.status4 == '3') {
			status4 = 'back';
			word4 = '退';
			title4 = '已退回';
		} else if (source.status4 == '4') {
			status4 = 'changed';
			word4 = '未';
			title4 = '未處理';
		}
		if (source.status5 == '1') {
			status5 = 'passed';
			word5 = '中';
			title5 = '處理中';
		} else if (source.status5 == '2') {
			status5 = 'submit';
			word5 = '已';
			title5 = '已處理';
		} else if (source.status5 == '3') {
			status5 = 'back';
			word5 = '退';
			title5 = '已退回';
		} else if (source.status5 == '4') {
			status5 = 'changed';
			word5 = '未';
			title5 = '未處理';
		}

		return `
					<div title="訂單:${title1}" class="nodeStatus ${status1}"> ${word1}  </div>
					<div title="生產管理:${title2}" class="nodeStatus ${status2}"> ${word2}  </div>
					<div title="採購管理:${title3}" class="nodeStatus ${status3}"> ${word3}  </div>
					<div title="庫存管理:${title4}" class="nodeStatus ${status4}"> ${word4}  </div>
					<div title="出貨管理:${title5}" class="nodeStatus ${status5}"> ${word5}  </div>
					`;
	}

	var tablesBtnForOrder = `<a data-toggle="modal" data-target="#editNodeControl_1" href="#" title="修改" class="">
	<i class="fa fa-edit"></i>
	</a>
	<a href="#" title="審核確認" class="ml-3">
	<i class="ti-stamp" aria-hidden="true"></i>
	</a>
	<a href="#" title="確認送出" class="ml-3">
	<i class="fa  fa-check" aria-hidden="true"></i>
	</a>
	<a href="#" title="退回" class="ml-3">
	<i class="fa fa-times" aria-hidden="true"></i>
	</a>
	<a href="#" title="刪除" class="ml-3">
	<i class="fa fa-trash-o"></i>
	</a>`;

	var tablesBtnForOther =
	`<a  title="新近訂單" class="text-danger">
	<i class="fa fa-warning" aria-hidden="true"></i>
	</a>
	<a data-toggle="modal" data-target="#editNodeControl_2" href="#" title="修改" class="ml-3">
	<i class="fa fa-edit"></i>
	</a>
	<a href="#" title="開啟處理中狀態" class="ml-3">
	<i class="ti-stamp" aria-hidden="true"></i>
	</a>
	<a href="#" title="已處理" class="ml-3">
	<i class="fa  fa-check" aria-hidden="true"></i>
	</a>
	<a href="#" title="退回" class="ml-3">
	<i class="fa fa-times" aria-hidden="true"></i>
	</a>
	`


	//客戶資料table
	var tableForCustomerInformation = $('#customerInformation').addClass('nowrap').DataTable({
		"ajax": "/public/admin/assets/js/init-scripts/data-table/data/customerInformationData.txt",
		responsive: {
			breakpoints: [
			  {name: 'bigdesktop', width: Infinity},
			  {name: 'desktop', width: 1820},
			  {name: 'meddesktop', width: 1480},
			  {name: 'smalldesktop', width: 1280},
			  {name: 'medium', width: 1188},
			  {name: 'tabletl', width: 1024},
			  {name: 'btwtabllandp', width: 848},
			  {name: 'tabletp', width: 768},
			  {name: 'mobilel', width: 480},
			  {name: 'mobilep', width: 320}
			]},
		"columns": [{
				"data": "company"
			},
			{
				"data": "country",className: 'min-btwtabllandp'
			},
			{
				"data": "source",className: 'min-btwtabllandp'
			},
			{
				"data": "createdDate"
			},
			{
				"data": "modifiedDate"
			},
			{
				"className": '',
				"orderable": false,
				"data": null,
				"defaultContent": `<a data-toggle="modal" data-target="#editCustomerInformation" href="#" title="修改" class="ml-3"><i class="fa fa-edit"></i></a><a href="#" title="刪除" class="ml-3"><i class="fa fa-trash-o"></i></a>`
			},
			// {
			// 	"data": "features",className:'none'
			// },
			{
				"data": "name",
				className: 'none'
			},
			{
				"data": "phone",
				className: 'none'
			},
			{
				"data": "address",
				className: 'none'
			},
			{
				"data": "email",
				className: 'none'
			},
			{
				"data": "otherContact",
				className: 'none'
			},
		],
		"order": [
			[1, 'asc']
		],
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

	//客戶資料 新增訂單用
	var tableForAddOrder = $('#customerInformationForOrder').addClass('nowrap').DataTable({
		"ajax": "/public/admin/assets/js/init-scripts/data-table/data/customerInformationData.txt",
		// "data": data,
		// responsive: true,
		// columnDefs: [{
		// 	targets: [-1, -3],
		// 	className: 'dt-body-right'
		// }],
		"columns": [{
				"data": "company"
			},
			{
				"data": "country"
			},
			{
				"data": "source"
			},
			{
				"data": "createdDate"
			},
			{
				"data": "modifiedDate"
			},
			{
				"className": '',
				"orderable": false,
				"data": null,
				"defaultContent": `<button type="button" class="btn btn-primary">選擇此客戶</button>`
			},
			// {
			// 	"data": "features",className:'none'
			// },
			{
				"data": "name",
				className: 'none'
			},
			{
				"data": "phone",
				className: 'none'
			},
			{
				"data": "address",
				className: 'none'
			},
			{
				"data": "email",
				className: 'none'
			},
			{
				"data": "otherContact",
				className: 'none'
			},
		],
		"order": [
			[1, 'asc']
		],
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

	//訂單資料
	var tableForOrder = $('#nodeControl_1').addClass('nowrap').DataTable({
		"ajax": "/public/admin/assets/js/init-scripts/data-table/data/nodeControlData.txt",
		responsive: {
			breakpoints: [
			  {name: 'bigdesktop', width: Infinity},
			  {name: 'desktop', width: 1820},
			  {name: 'meddesktop', width: 1480},
			  {name: 'smalldesktop', width: 1280},
			  {name: 'medium', width: 1188},
			  {name: 'tabletl', width: 1024},
			  {name: 'btwtabllandp', width: 848},
			  {name: 'tabletp', width: 768},
			  {name: 'mobilel', width: 480},
			  {name: 'mobilep', width: 320}
			]},
		"columns": [{
				"data": "orderNumber"
			},
			{
				"data": "PI",className: 'min-btwtabllandp'
			},
			{
				"data": "sales",className: 'min-desktop'
			},
			{
				"data": "orderAttributes",className: 'min-desktop'
			},
			{
				"data": "name",className: 'min-meddesktop'
			},
			{
				"data": "productTemplate",className: 'min-meddesktop'
			},
			// {
			// 	"data": "productAttributes",className:'none'
			// },
			{
				"data": "productQuantity",
				className: 'none'
			},
			{
				"data": "deadLine",
				className: 'none'
			},
			{
				"data": "typeOfPacking",
				className: 'none'
			},
			{
				"data": typeStatus,className: 'min-btwtabllandp'
			},
			{
				"data": "createdDate"
			},
			{
				"data": "modifiedDate"
			},
			{
				"className": '',
				"orderable": false,
				"data": null,
				"defaultContent": tablesBtnForOrder,
			},
		],
		"order": [
			[1, 'asc']
		],
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

	//生產管理
	var tableForProduction = $('#nodeControl_2').addClass('nowrap').DataTable({
		"ajax": "/public/admin/assets/js/init-scripts/data-table/data/nodeControlData.txt",
		responsive: {
			breakpoints: [
			  {name: 'bigdesktop', width: Infinity},
			  {name: 'desktop', width: 1820},
			  {name: 'meddesktop', width: 1480},
			  {name: 'smalldesktop', width: 1280},
			  {name: 'medium', width: 1188},
			  {name: 'tabletl', width: 1024},
			  {name: 'btwtabllandp', width: 848},
			  {name: 'tabletp', width: 768},
			  {name: 'mobilel', width: 480},
			  {name: 'mobilep', width: 320}
			]},
		"columns": [{
				"data": "orderNumber"
			},
			{
				"data": "PI",className: 'min-btwtabllandp'
			},
			{
				"data": "sales",className: 'min-desktop'
			},
			{
				"data": "orderAttributes",className: 'min-desktop'
			},
			{
				"data": "name",className: 'min-meddesktop'
			},
			{
				"data": "productTemplate",className: 'min-meddesktop'
			},
			{
				"data": "productAttributes",
				className: 'none'
			},
			{
				"data": "productQuantity",
				className: 'none'
			},
			{
				"data": "deadLine",
				className: 'none'
			},
			{
				"data": "typeOfPacking",
				className: 'none'
			},
			{
				"data": typeStatus,className: 'min-btwtabllandp'

				// "defaultContent": `<button type="button" class="btn btn-success">送</button>`
			},
			{
				"data": "createdDate"
			},
			{
				"data": "modifiedDate"
			},
			{
				"className": '',
				"orderable": false,
				"data": null,
				"defaultContent": tablesBtnForOther,
			},
		],
		"order": [
			[1, 'asc']
		],
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

	//採購管理
	var tableForPurchasing = $('#nodeControl_3').addClass('nowrap').DataTable({
		"ajax": "/public/admin/assets/js/init-scripts/data-table/data/nodeControlData.txt",
		responsive: {
			breakpoints: [
			  {name: 'bigdesktop', width: Infinity},
			  {name: 'desktop', width: 1820},
			  {name: 'meddesktop', width: 1480},
			  {name: 'smalldesktop', width: 1280},
			  {name: 'medium', width: 1188},
			  {name: 'tabletl', width: 1024},
			  {name: 'btwtabllandp', width: 848},
			  {name: 'tabletp', width: 768},
			  {name: 'mobilel', width: 480},
			  {name: 'mobilep', width: 320}
			]},
		"columns": [{
				"data": "orderNumber"
			},
			{
				"data": "PI",className: 'min-btwtabllandp'
			},
			{
				"data": "sales",className: 'min-desktop'
			},
			{
				"data": "orderAttributes",className: 'min-desktop'
			},
			{
				"data": "name",className: 'min-meddesktop'
			},
			{
				"data": "productTemplate",className: 'min-meddesktop'
			},
			{
				"data": "productAttributes",
				className: 'none'
			},
			{
				"data": "productQuantity",
				className: 'none'
			},
			{
				"data": "deadLine",
				className: 'none'
			},
			{
				"data": "typeOfPacking",
				className: 'none'
			},
			{
				"data": "purchaseDate",
				className: 'none'
			},
			{
				"data": "purchaseOrder",
				className: 'none'
			},
			{
				"data": typeStatus,className: 'min-btwtabllandp'
			},
			{
				"data": "createdDate"
			},
			{
				"data": "modifiedDate"
			},
			{
				"className": '',
				"orderable": false,
				"data": null,
				"defaultContent": tablesBtnForOther,
			},
		],
		"order": [
			[1, 'asc']
		],
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

	//庫存管理
	var tableForInventory = $('#nodeControl_4').addClass('nowrap').DataTable({
		"ajax": "/public/admin/assets/js/init-scripts/data-table/data/nodeControlData.txt",
		responsive: {
			breakpoints: [
			  {name: 'bigdesktop', width: Infinity},
			  {name: 'desktop', width: 1820},
			  {name: 'meddesktop', width: 1480},
			  {name: 'smalldesktop', width: 1280},
			  {name: 'medium', width: 1188},
			  {name: 'tabletl', width: 1024},
			  {name: 'btwtabllandp', width: 848},
			  {name: 'tabletp', width: 768},
			  {name: 'mobilel', width: 480},
			  {name: 'mobilep', width: 320}
			]},
		"columns": [{
				"data": "orderNumber"
			},
			{
				"data": "PI",className: 'min-btwtabllandp'
			},
			{
				"data": "sales",className: 'min-desktop'
			},
			{
				"data": "orderAttributes",className: 'min-desktop'
			},
			{
				"data": "name",className: 'min-meddesktop'
			},
			{
				"data": "productTemplate",className: 'min-meddesktop'
			},
			{
				"data": "productAttributes",
				className: 'none'
			},
			{
				"data": "productQuantity",
				className: 'none'
			},
			{
				"data": "deadLine",
				className: 'none'
			},
			{
				"data": "typeOfPacking",
				className: 'none'
			},
			{
				"data": "purchaseDate",
				className: 'none'
			},
			{
				"data": "purchaseOrder",
				className: 'none'
			},
			{
				"data": "inventoryStatus",
				className: 'none'
			},
			{
				"data": typeStatus,className: 'min-btwtabllandp'

				// "defaultContent": `<button type="button" class="btn btn-success">送</button>`
			},
			{
				"data": "createdDate"
			},
			{
				"data": "modifiedDate"
			},
			{
				"className": '',
				"orderable": false,
				"data": null,
				"defaultContent": tablesBtnForOther,
			},
		],
		"order": [
			[1, 'asc']
		],
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

	//出貨管理
	var tableForShipment = $('#nodeControl_5').addClass('nowrap').DataTable({
		"ajax": "/public/admin/assets/js/init-scripts/data-table/data/nodeControlData.txt",
		responsive: {
			breakpoints: [
			  {name: 'bigdesktop', width: Infinity},
			  {name: 'desktop', width: 1820},
			  {name: 'meddesktop', width: 1480},
			  {name: 'smalldesktop', width: 1280},
			  {name: 'medium', width: 1188},
			  {name: 'tabletl', width: 1024},
			  {name: 'btwtabllandp', width: 848},
			  {name: 'tabletp', width: 768},
			  {name: 'mobilel', width: 480},
			  {name: 'mobilep', width: 320}
			]},
		"columns": [{
				"data": "orderNumber"
			},
			{
				"data": "PI",className: 'min-btwtabllandp'
			},
			{
				"data": "sales",className: 'min-desktop'
			},
			{
				"data": "orderAttributes",className: 'min-desktop'
			},
			{
				"data": "name",className: 'min-meddesktop'
			},
			{
				"data": "productTemplate",className: 'min-meddesktop'
			},
			{
				"data": "productAttributes",
				className: 'none'
			},
			{
				"data": "productQuantity",
				className: 'none'
			},
			{
				"data": "deadLine",
				className: 'none'
			},
			{
				"data": "typeOfPacking",
				className: 'none'
			},
			{
				"data": "purchaseDate",
				className: 'none'
			},
			{
				"data": "purchaseOrder",
				className: 'none'
			},
			{
				"data": "inventoryStatus",
				className: 'none'
			},
			{
				"data": "shipmentType",
				className: 'none'
			},
			{
				"data": "shipmentDate",
				className: 'none'
			},
			{
				"data": "shipmentCompany",
				className: 'none'
			},
			{
				"data": "trackingNumber",
				className: 'none'
			},
			{
				"data": "signingDate",
				className: 'none'
			},
			{
				"data": typeStatus,className: 'min-btwtabllandp'

				// "defaultContent": `<button type="button" class="btn btn-success">送</button>`
			},
			{
				"data": "createdDate"
			},
			{
				"data": "modifiedDate"
			},
			{
				"className": '',
				"orderable": false,
				"data": null,
				"defaultContent":tablesBtnForOther,
			},
		],
		"order": [
			[1, 'asc']
		],
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


	//範本資料

	//產品資料
	//範本選擇table


	$('#typeForProductData-modal tbody').on('click', 'tr', function () {
		$(this).addClass('selected').siblings().removeClass('selected');
	});


	//序號操作table



	//產品補登table
	var tableForProductUpdate = $('#productUpdate').addClass('nowrap').DataTable({
		// "ajax": "https://codepen.io/aunitz/pen/vdwRLL.js",
		"ajax": "/public/admin/assets/js/init-scripts/data-table/data/productData.txt",
		// "data": data,
		// responsive: true,
		// columnDefs: [{
		// 	targets: [-1, -3],
		// 	className: 'dt-body-right'
		// }],
		"columns": [{
				"data": "vendorName",
			},
			{
				"data": "productName"
			},
			{
				"data": "model"
			},
			{
				"data": "sn"
			},
			{
				"data": "status"
			},
			{
				"data": "createdDate"
			},
			{
				"data": "modifiedDate"
			},
			{
				"className": '',
				"orderable": false,
				"data": null,
				"defaultContent": `<a href="#" title="複製" class=""><i class="fa fa-files-o" aria-hidden="true"></i></a><a data-toggle="modal" data-target="#updateSn" href="#" title="修改" class="ml-3"><i class="fa fa-edit"></i></a><a href="#" title="刪除" class="ml-3"><i class="fa fa-trash-o"></i></a>`
			},
			{
				"data": "features",
				className: 'none'
			},
			{
				"data": "color_emperature",
				className: 'none'
			},
			{
				"data": "color_rendering",
				className: 'none'
			},
			{
				"data": "luminous_flux",
				className: 'none'
			},
			{
				"data": "pcb",
				className: 'none'
			},
			{
				"data": "end_cap_type",
				className: 'none'
			},
		],
		"order": [
			[1, 'asc']
		],
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

	//標章管理table

	//報告管理table
	var tableForCertificationMark = $('#inspectionReportTable').addClass('nowrap').DataTable({
		// "ajax": "https://codepen.io/aunitz/pen/vdwRLL.js",
		// "ajax": "./public/admin/assets/js/init-scripts/data-table/data/memberData.txt",
		// "data": data,
		// responsive: true,
		// columnDefs: [{
		// 	targets: [-1, -3],
		// 	className: 'dt-body-right'
		// }],
		// "columns": [{
		// 		"className": 'details-control',
		// 		"orderable": false,
		// 		"data": "account",
		// 		"defaultContent": ''
		// 	},
		// 	{
		// 		"data": "email"
		// 	},
		// 	{
		// 		"data": "name"
		// 	},
		// 	{
		// 		"data": "company"
		// 	},
		// 	{
		// 		"className": '',
		// 		"orderable": false,
		// 		"data": null,
		// 		"defaultContent": `<a data-toggle="modal" data-target="#editCertificationMark" href="#" title="修改" class="ml-3"><i class="fa fa-edit"></i></a><a href="#" title="刪除" class="ml-3"><i class="fa fa-trash-o"></i></a>`
		// 	},
		// ],
		"order": [
			[1, 'asc']
		],
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

	//會員資料table
	var tableForMemberData = $('#memberTable').addClass('nowrap').DataTable({
		// "ajax": "https://codepen.io/aunitz/pen/vdwRLL.js",
		"ajax": "/appadmin/getmember",
		"type": 'json',

		// "data": data,
		// responsive: true,
		// columnDefs: [{
		// 	targets: [-1, -3],
		// 	className: 'dt-body-right'
		// }],
		"columns": [{
				"data": "account",
			},
			{
				"data": "name"
			},
			{
				"data": "email"
			},
			{
				"data": "createDate"
			},
			{
				"data": "updateDate"
			},
			{
				 "data":function(source,type,val)
				 {
					 return '<a data-toggle="modal" id="edit'+source.id+'" href="" onclick="edit('+source.id+')" title="修改" class=""><i class="fa fa-edit"></i></a><a href="#" title="刪除" class="ml-3"><i class="fa fa-trash-o"></i></a>';
				 }

			},
			{
				"data": "company",
				className: 'none'
			},
			{
				"data": "country",
				className: 'none'
			},
			{
				"data": "phone1",
				className: 'none'
			},
		],
		"order": [
			[1, 'asc']
		],
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

	//保固資料table
	var tableForWarrantyData = $('#warrantyTable').addClass('nowrap').DataTable({
		// "ajax": "https://codepen.io/aunitz/pen/vdwRLL.js",
		"ajax": "/public/admin/assets/js/init-scripts/data-table/data/warrantyData.txt",
		// "data": data,
		responsive: true,
		// columnDefs: [{
		// 	targets: [-1, -3],
		// 	className: 'dt-body-right'
		// }],
		"columns": [{
				"data": "account",
			},
			{
				"data": "name"
			},
			{
				"data": "productName"
			},
			{
				"data": "productModel"
			},
			{
				"data": "productSn"
			},
			{
				"data": "registrationStatus"
			},
			{
				"data": "status"
			},
			{
				"data": "datePurchase"
			},
			{
				"data": "placePurchase"
			},
			{
				"className": '',
				"orderable": false,
				"data": null,
				"defaultContent": `<a data-toggle="modal" data-target="#editWarranty" href="#" title="修改" class=""><i class="fa fa-edit"></i></a><a href="#" title="刪除" class="ml-3"><i class="fa fa-trash-o"></i></a>
				<a data-toggle="modal" data-target="#viewWarranty" href="#" title="查看所有者" class="ml-3"><i class="fa fa-search"></i></a>`
			},
			{
				"data": "email",
				className: 'none'
			},
			{
				"data": "warranty",
				className: 'none'
			},
			{
				"data": "warrantyExpiryDate",
				className: 'none'
			},
		],
		"order": [
			[1, 'asc']
		],
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


	//系統帳號table
	var tableForSystemAccount = $('#systemAccountTable').addClass('nowrap').DataTable({
		// "ajax": "https://codepen.io/aunitz/pen/vdwRLL.js",
		"ajax": "/public/admin/assets/js/init-scripts/data-table/data/systemAccount.txt",
		// "data": data,
		// responsive: true,
		// columnDefs: [{
		// 	targets: [-1, -3],
		// 	className: 'dt-body-right'
		// }],
		"columns": [{
				"data": "account"
			},
			{
				"data": "name"
			},
			{
				"data": "status"
			},
			{
				"data": "createdDate"
			},
			{
				"data": "modifiedDate"
			},
			{
				"className": '',
				"orderable": false,
				"data": null,
				"defaultContent": `<a data-toggle="modal" data-target="#editSystemAccount" href="#" title="修改" class=""><i class="fa fa-edit"></i></a><a href="#" title="刪除" class="ml-3"><i class="fa fa-trash-o"></i></a>
				<a data-toggle="modal" data-target="#systemAccountRecord" href="#" title="查看操作紀錄" class="ml-3"><i class="fa fa-search"></i></a>`
			},
		],
		"order": [
			[1, 'asc']
		],
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
	//系統帳號操作紀錄table
	var tableForSystemAccountRecord = $('#systemAccountRecordTable').DataTable({
		responsive: true,
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

	//廠商帳號table
	var tableForVendorAccount = $('#vendorAccountTable').addClass('nowrap').DataTable({
		// "ajax": "https://codepen.io/aunitz/pen/vdwRLL.js",
		// "ajax": "/public/admin/assets/js/init-scripts/data-table/data/vendorAccount.txt",
		"ajax": "/appadmin/getcompany",

		"columns": [{
				"data": "account"
			},
			{
				"data": "cname"
			},
			{
				"data": "number"
			},
			{
				"data": "address",
				className: 'none'
			},
			{
				"data": "country",
				className: 'none'
			},
			{
				"data": "phone"
			},
			{
				"data": function (source, type, val) {
					if (source.enable == 'Y') {
						return "<i class='fa fa-check text-success' title='啟動'></i>";
					} else {
						return "<i class='fa fa-times text-danger' title='關閉'></i>";
					}
				}
			},
			{
				"data": "createDate"
			},
			{
				"data": "updateDate"
			},
			{
				"data": function (source, type, val) {
					return '<a data-toggle="modal" id="edit_button' + source.id + '" href="#" onclick="edit(' + source.id + ')" title="修改" class=""><i class="fa fa-edit"></i></a><a href="#" title="刪除" onclick="c_del(' + source.id + ')" class="ml-3"><i class="fa fa-trash-o"></i></a><a data-toggle="modal" data-target="#vendorAccountRecord" href="#" title="查看操作紀錄" class="ml-3"><i class="fa fa-search"></i></a>';
				}
			},
		],
		"order": [
			[8, 'desc'],
			[0, 'desc'],

		],
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
	//廠商帳號操作紀錄table
	var tableForVendorAccountRecord = $('#vendorAccountRecordTable').DataTable({
		responsive: true,
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

})(jQuery);
