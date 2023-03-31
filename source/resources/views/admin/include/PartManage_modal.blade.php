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
                <form id="partform" action="/PartAdd" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">材料名稱<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" id="name" placeholder="請輸入材料名稱">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">規格</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="content" id="content" placeholder="請輸入規格">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">品牌</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="brand" id="brand" placeholder="請輸入品牌">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">數量<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="amount" id="amount" placeholder="請輸入數量">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">單價<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="price" id="price" placeholder="請輸入單價">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">圖片上傳</label>
                        <div class="col-sm-8">
                            <input type="file" name="pic" id="pic" >
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
                <form id="editform" method="post" action="/partEdit" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">材料名稱<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="ed_name" id="ed_name" placeholder="請輸入材料名稱">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">規格</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="ed_content" id="ed_content" placeholder="請輸入規格">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">品牌</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="ed_brand" id="ed_brand" placeholder="請輸入品牌">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">數量<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="ed_amount" id="ed_amount" placeholder="請輸入數量">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">單價<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="ed_price" id="ed_price" placeholder="請輸入單價">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">圖片上傳</label>
                        <div class="col-sm-8">
                            <input type="file" name="ed_pic" id="ed_pic" >
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
