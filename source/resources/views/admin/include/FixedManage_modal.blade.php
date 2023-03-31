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
                <form id="memberform" action="/FixedAdd" method="post">
                {{ csrf_field() }}
                    <button type="button" class="btn" onclick="more()">詳細客戶資料</button>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">客戶名稱<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <select class="selectize" name="name" id="name">
                            <option selected disabled value="">請選擇客戶</option>
                          </select>
                        </div>
                    </div>
                    <div class="more" style="display:none">
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">地址</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="adr" id="adr" placeholder="請輸入地址">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">電話</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="tel" id="tel" placeholder="請輸入電話">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">統編</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="uni" id="uni" placeholder="請輸入統編">
                        </div>
                    </div>
                  </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">機種</label>
                        <div class="col-sm-8">
                            <select class="selectize" name="type" id="type">
                              <option selected disabled>請選擇機種</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">引擎</label>
                        <div class="col-sm-8">
                          <select class="selectize" name="sn" id="sn">
                            <option selected disabled>請選擇引擎</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">車號</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="car" id="car" placeholder="請輸入車號">
                            </div>
                     </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">檢修原因</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="detail" id="detail" ></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">折扣</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="discount" id="discount" placeholder="請輸入折扣" min=0>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">日期</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="createDate" id="createDate" value="<?=date('Y-m-d')?>" placeholder="請選擇日期" readonly style="background:#ffffff" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">保固</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="warranty" id="warranty">
                              <option value="">無</option>
                              <?php
                                for($i=1;$i<=12;$i++)
                                {
                                  echo "<option value='".$i."'>".$i." 個月</option>";
                                }
                              ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8">
                          <button type="button" onclick="addPart(1)" class="btn btn-success mb-1">新增工作項目</button>
                        </div>
                    </div>
                    <div id="add_1"></div>
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
                <form id="editform" method="post" action="/fixedEdit">
                {{csrf_field()}}
                  <input type="hidden" name="ed_id" id="ed_id" value="">
                  <button type="button" class="btn" onclick="more()">詳細客戶資料</button>
                  <div class="form-group row">
                      <label for="color_rendering" class="col-sm-4 col-form-label">客戶名稱<span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                          <div id="nameArea">
                            <!-- <select class="selectize" name="ed_name" id="ed_name" ></select> -->
                          </div>
                      </div>
                  </div>
                  <div class="more" style="display:none">
                  <div class="form-group row">
                      <label for="color_rendering" class="col-sm-4 col-form-label">地址</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" name="ed_adr" id="ed_adr" placeholder="請輸入地址">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="color_rendering" class="col-sm-4 col-form-label">電話</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" name="ed_tel" id="ed_tel" placeholder="請輸入電話">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="color_rendering" class="col-sm-4 col-form-label">統編</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" name="ed_uni" id="ed_uni" placeholder="請輸入統編">
                      </div>
                  </div>
                </div>
                  <div class="form-group row">
                      <label for="color_rendering" class="col-sm-4 col-form-label">機種</label>
                      <div class="col-sm-8">
                          <!-- <select class="selectize" name="ed_type" id="ed_type" ></select> -->
                          <div id="typeArea">
                            <!-- <select class="selectize" name="ed_name" id="ed_name" ></select> -->
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="color_rendering" class="col-sm-4 col-form-label">引擎</label>
                      <div class="col-sm-8">
                          <!-- <select class="selectize" name="ed_sn" id="ed_sn"></select> -->
                          <div id="snArea">
                            <!-- <select class="selectize" name="ed_name" id="ed_name" ></select> -->
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                        <label for="color_rendering" class="col-sm-4 col-form-label">車號</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ed_car" id="ed_car" placeholder="請輸入車號">
                            </div>
                     </div>
                  <div class="form-group row">
                      <label for="color_rendering" class="col-sm-4 col-form-label">檢修原因</label>
                      <div class="col-sm-8">
                          <textarea class="form-control" name="ed_detail" id="ed_detail" ></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="color_rendering" class="col-sm-4 col-form-label">折扣</label>
                      <div class="col-sm-8">
                          <input type="number" class="form-control" name="ed_discount" id="ed_discount" placeholder="請輸入折扣" min="0">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="color_rendering" class="col-sm-4 col-form-label">日期</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" name="createDate" id="ed_createDate" value="" placeholder="請選擇日期" readonly style="background:#ffffff" >
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="color_rendering" class="col-sm-4 col-form-label">保固</label>
                      <div class="col-sm-8">
                          <select class="form-control" name="ed_warranty" id="ed_warranty">
                            <option value="">無</option>
                            <?php
                              for($i=1;$i<=12;$i++)
                              {
                                echo "<option value='".$i."'>".$i." 個月</option>";
                              }
                            ?>
                          </select>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-8">
                        <button type="button" onclick="addPart(2)" class="btn btn-success mb-1">新增工作項目</button>
                      </div>
                  </div>
                  <div id="add_2"></div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                <button type="button" onclick="checkedit()" class="btn btn-primary">確定</button>
            </div>
        </div>
    </div>
</div>
