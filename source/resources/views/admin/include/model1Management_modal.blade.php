<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">新增</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="memberform" action="/model1Add" method="post">
                {{csrf_field()}}
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">機種名稱<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" id="name" placeholder="請輸入機種名稱">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">廠牌</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="brand" id="brand" placeholder="請輸入廠牌">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                <button type="button" onclick="checkform()" class="btn btn-primary">確定</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="editCustomer" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">修改</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editform" method="post" action="/model1Edit">
                {{csrf_field()}}
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">機種名稱<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ed_name" name="ed_name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">廠牌</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="ed_brand" id="ed_brand" placeholder="請輸入廠牌">
                        </div>
                    </div>
                    <input type="hidden" name="ed_id" id="ed_id" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                <button type="button" onclick="checkedit()" class="btn btn-primary">確定</button>
            </div>
        </div>
    </div>
</div>
