<?php 
require_once('header.php'); 
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$lichkhoihanh = new LichKhoiHanh();
$tours = new Tours();
$list = $tours->get_all_list();$ngaykhoihanh='';$id_tours=array();
if(isset($_POST['submit'])){
    $ngaykhoihanh = isset($_POST['ngaykhoihanh']) ? $_POST['ngaykhoihanh'] : '';
    $ngayketthuc = isset($_POST['ngayketthuc']) ? $_POST['ngayketthuc'] : '';
    $id_tours = isset($_POST['id_tours']) ? $_POST['id_tours'] : '';
    $arr_ngaykhoihanh = array();$arr_ngayketthuc = array();
    if($ngaykhoihanh){
        foreach($ngaykhoihanh as $key => $value){
            $date_1 = $value ? new MongoDate(convert_date_yyyy_mm_dd($value)) : '';
            $date_2 = $ngayketthuc[$key] ? new MongoDate(convert_date_yyyy_mm_dd($ngayketthuc[$key])) : '';
            array_push($arr_ngaykhoihanh, $date_1);
            array_push($arr_ngayketthuc, $date_2);
        }
    }
    $lichkhoihanh->ngaykhoihanh = $arr_ngaykhoihanh;
    $lichkhoihanh->ngayketthuc = $arr_ngayketthuc;
    $lichkhoihanh->id_tours = $id_tours;
    if($act == 'edit'){
        $lichkhoihanh->id = $id;
        if($lichkhoihanh->edit()) transfers_to('lichkhoihanh.html?msg=Chỉnh sửa thành công');
    } else {
        if($lichkhoihanh->insert()) transfers_to('lichkhoihanh.html?msg=Thêm thành công');
    }
}
if($id && $act == 'edit'){
    $lichkhoihanh->id = $id; $t = $lichkhoihanh->get_one();
    $ngaykhoihanh = is_array($t['ngaykhoihanh']) ? $t['ngaykhoihanh'] : date("d/m/Y", $t['ngaykhoihanh']->sec);
    $ngayketthuc = is_array($t['ngayketthuc']) ? $t['ngayketthuc'] : date("d/m/Y", $t['ngayketthuc']->sec);
    $id_tours = $t['id_tours'];
}
?>
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" class="form-horizontal" data-parsley-validate="true" name="bannerform" id="tintucform" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : '';?>">
<input type="hidden" name="act" id="act" value="<?php echo isset($act) ? $act : ''; ?>">
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-gears"></i> Nhập thông tin lịch khởi hành</h4>
            </div>
            <div class="panel-body">
            	<div id="ngaydulich">
                <?php if($ngaykhoihanh && is_array($ngaykhoihanh) && is_array($ngayketthuc)): ?>
                    <?php
                    foreach($ngaykhoihanh as $key => $value):
                    $date_1 = date("d/m/Y", $value->sec);
                    $date_2 = date("d/m/Y", $ngayketthuc[$key]->sec);
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Ngày khởi hành</label>
                        <div class="col-md-3">
                            <input type="text" name="ngaykhoihanh[]" placeholder="Ngày khởi hành"  class="form-control ngaythangnam" data-date-format="dd/mm/yyyy" data-inputmask="'alias': 'date'" data-parsley-required="true" value="<?php echo isset($date_1) ? $date_1 : date("d/m/Y"); ?>"/>
                        </div>
                        <label class="col-md-3 control-label">Ngày kết thúc</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" name="ngayketthuc[]" id="ngayketthuc" placeholder="Ngày kết thúc"  class="form-control ngaythangnam" data-date-format="dd/mm/yyyy" data-inputmask="'alias': 'date'" data-parsley-required="true" value="<?php echo isset($date_2) ? $date_2 : date("d/m/Y"); ?>"/>
                                <?php if($key == 0): ?>
                                    <span class="input-group-addon"><a href="#" id="add_date" onclick="return false;"><i class="fa fa-plus"></i></a></span>
                                <?php else: ?>
                                    <span class="input-group-addon"><a href="#" class="remove_date" onclick="return false;"><i class="fa fa-trash"></i></a></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Ngày khởi hành</label>
                        <div class="col-md-3">
                            <input type="text" name="ngaykhoihanh[]" placeholder="Ngày khởi hành"  class="form-control ngaythangnam" data-date-format="dd/mm/yyyy" data-inputmask="'alias': 'date'" data-parsley-required="true" value="<?php echo isset($ngaykhoihanh) ? $ngaykhoihanh : date("d/m/Y"); ?>"/>
                        </div>
                        <label class="col-md-3 control-label">Ngày kết thúc</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" name="ngayketthuc[]" id="ngayketthuc" placeholder="Ngày kết thúc"  class="form-control ngaythangnam" data-date-format="dd/mm/yyyy" data-inputmask="'alias': 'date'" data-parsley-required="true" value="<?php echo isset($ngayketthuc) ? $ngayketthuc : date("d/m/Y"); ?>"/>
                                <span class="input-group-addon"><a href="#" id="add_date" onclick="return false;"><i class="fa fa-plus"></i></a></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                </div>

            	<div class="form-group">
            		<label class="col-md-3 control-label">Tours</label>
            		<div class="col-md-9">
	            		<select name="id_tours[]" id="id_tours" multiple="multiple" style="width:100%;">
                        option
	            		<?php
	            		if($list){
	            			foreach($list as $l){
	            				echo '<option value="'.$l['_id'].'" '.(in_array($l['_id'], $id_tours) ? ' selected' : '').'>'.$l['tieude'].'</option>';
	            			}
	            		}
	            		?>
	            		</select>
            		</div>
            	</div>
            </div>
            <div class="panel-footer">
                <a href="tours.html" class="btn btn-white"><i class="fa fa-reply-all"></i> Trở về</a>
                <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
            </div>
        </div>
    </div>
</div>
</form>
<div id="date_html" style="display: none;">
    <div class="form-group">
        <label class="col-md-3 control-label">Ngày khởi hành</label>
        <div class="col-md-3">
            <input type="text" name="ngaykhoihanh[]" placeholder="Ngày khởi hành"  class="form-control ngaythangnam" data-date-format="dd/mm/yyyy" data-inputmask="'alias': 'date'" data-parsley-required="true" value="<?php echo date("d/m/Y"); ?>"/>
        </div>
        <label class="col-md-3 control-label">Ngày kết thúc</label>
        <div class="col-md-3">
            <div class="input-group">
                <input type="text" name="ngayketthuc[]" id="ngayketthuc" placeholder="Ngày kết thúc"  class="form-control ngaythangnam" data-date-format="dd/mm/yyyy" data-inputmask="'alias': 'date'" data-parsley-required="true" value="<?php echo date("d/m/Y"); ?>"/>
                <span class="input-group-addon"><a href="#" class="remove_date" onclick="return false;"><i class="fa fa-trash"></i></a></span>
            </div>
        </div>
    </div>
</div>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="assets/js/apps.min.js"></script>
<script>
    $(document).ready(function() {
    	$(".ngaythangnam").datepicker({todayHighlight:!0});
        $(".ngaythangnam").inputmask();
        $("#add_date").click(function(){
            var html = $("#date_html").html();
            $("#ngaydulich").append(html);
            $(".ngaythangnam").datepicker({todayHighlight:!0});
            $(".ngaythangnam").inputmask();
            $(".remove_date").click(function(){
                var _this = $(this);
                _this.parents(".form-group").remove();
            });
        });
        $(".remove_date").click(function(){
            var _this = $(this);
            _this.parents(".form-group").remove();
        });
        $(".select2").select2();
        $("#id_tours").select2({placeholder : 'Chọn Tours'});
        App.init();
    });
</script>
