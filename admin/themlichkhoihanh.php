<?php 
require_once('header.php'); 
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$tours = new Tours();
$list = $tours->get_all_list();
?>
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" class="form-horizontal" data-parsley-validate="true" name="bannerform" id="tintucform" enctype="multipart/form-data">
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
            	<div class="form-group">
            		 <label class="col-md-3 control-label">Ngày khởi hành</label>
            		 <div class="col-md-3">
                        <input type="text" name="ngaykhoihanh" placeholder="Ngày khởi hành"  class="form-control ngaythangnam" data-date-format="dd/mm/yyyy" data-inputmask="'alias': 'date'" data-parsley-required="true" value="<?php echo isset($ngaykhoihanh) ? $ngaykhoihanh : date("d/m/Y"); ?>"/>
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
            	<div class="form-group">
            		<label class="col-md-3 control-label">Tours</label>
            		<div class="col-md-9">
	            		<select name="id_tours" id="id_tours" multiple="multiple" class="select2" style="width:100%;">
	            		<?php
	            		if($list){
	            			foreach($list as $l){
	            				echo '<option value="'.$l['_id'].'">'.$l['tieude'].'</option>';
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
        $(".select2").select2();
        App.init();
    });
</script>
