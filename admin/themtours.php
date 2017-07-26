<?php 
require_once('header.php'); 
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$url = isset($_GET['url']) ? $_GET['url'] : '';
$tours = new Tours();
$danhmuctours = new DanhMucTour();$danhmucdiemden = new DanhMucDiemDen();
if($id && $act=='del'){
    $tours->id = $id; $t = $tours->get_one();
    if($t['hinhanh']){
        foreach($t['hinhanh'] as $h){
            if(file_exists($target_images_home . $h['aliasname'])){
                @unlink($target_images_home . $h['aliasname']);
            }
        }
    }
    if($tours->delete()) transfers_to('tours.html?msg=Xóa thành công!');
}
$list = $tours->get_all_list();
$danhmuctours_list = $danhmuctours->get_all_list();
$danhmucdiemden_list = $danhmucdiemden->get_all_list();
$id_danhmucdiemden = ''; $id_danhmuctour='';
if(isset($_POST['submit'])){
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $id_danhmuctour = isset($_POST['id_danhmuctour']) ? $_POST['id_danhmuctour'] : '';
    $id_danhmucdiemden = isset($_POST['id_danhmucdiemden']) ? $_POST['id_danhmucdiemden'] : '';
    $act = isset($_POST['act']) ? $_POST['act'] : '';
    $url = isset($_POST['url']) ? $_POST['url'] : '';
    $tieude = isset($_POST['tieude']) ? $_POST['tieude'] : '';
    $giatour = isset($_POST['giatour']) ? $_POST['giatour'] : '';
    $giagiamtour = isset($_POST['giagiamtour']) ? $_POST['giagiamtour'] : '';
    /*$ngaykhoihanh = isset($_POST['ngaykhoihanh']) ? $_POST['ngaykhoihanh'] : '';
    $ngayketthuc = isset($_POST['ngayketthuc']) ? $_POST['ngayketthuc'] : '';
    $arr_ngaykhoihanh = array();$arr_ngayketthuc = array();
    if($ngaykhoihanh){
        foreach($ngaykhoihanh as $key => $value){
            $date_1 = $value ? new MongoDate(convert_date_yyyy_mm_dd($value)) : '';
            $date_2 = $ngayketthuc[$key] ? new MongoDate(convert_date_yyyy_mm_dd($ngayketthuc[$key])) : '';
            array_push($arr_ngaykhoihanh, $date_1);
            array_push($arr_ngayketthuc, $date_2);
        }
    }*/
    $mota = isset($_POST['mota']) ? $_POST['mota'] : '';
    $noidung = isset($_POST['noidung']) ? $_POST['noidung'] : '';
    $giave = isset($_POST['giave']) ? $_POST['giave'] : '';
    $hienthi = isset($_POST['hienthi']) ? $_POST['hienthi'] : 0;
    $stick = isset($_POST['stick']) ? $_POST['stick'] : 0;
    $orders = isset($_POST['orders']) ? $_POST['orders'] : '';
    $arr_hinhanh = array();
    $hinhanh_aliasname = isset($_POST['hinhanh_aliasname']) ? $_POST['hinhanh_aliasname'] : '';
    $hinhanh_filename = isset($_POST['hinhanh_filename']) ? $_POST['hinhanh_filename'] : '';
    $hinhanh_mota = isset($_POST['hinhanh_mota']) ? $_POST['hinhanh_mota'] : '';
    $hinhanh_orders = isset($_POST['hinhanh_orders']) ? $_POST['hinhanh_orders'] : '';
    if($hinhanh_aliasname){
        foreach ($hinhanh_aliasname as $key => $value) {
            array_push($arr_hinhanh, array('filename' => $hinhanh_filename[$key], 'aliasname' => $value, 'mota' => $hinhanh_mota[$key], 'orders' => $hinhanh_orders[$key]));
        }
    }
    $arr_hinhanh = sort_array_1($arr_hinhanh, 'orders', SORT_ASC);
    $tours->id_danhmuctour = $id_danhmuctour;
    $tours->id_danhmucdiemden = $id_danhmucdiemden;
    $tours->tieude = $tieude;
    $tours->giatour = $giatour;
    $tours->giagiamtour = $giagiamtour;
    //$tours->ngaykhoihanh = $ngaykhoihanh  ? new MongoDate(convert_date_yyyy_mm_dd($ngaykhoihanh)) : '';
    //$tours->ngayketthuc = $ngayketthuc  ? new MongoDate(convert_date_yyyy_mm_dd($ngayketthuc)) : '';
    //$tours->ngaykhoihanh = $arr_ngaykhoihanh;
    //$tours->ngayketthuc = $arr_ngayketthuc;
    $tours->mota = $mota;
    $tours->noidung = $noidung;
    $tours->giave = $giave;
    $tours->hinhanh = $arr_hinhanh;
    $tours->hienthi = $hienthi;
    $tours->stick = $stick;
    $tours->video = $video;
    $tours->orders = $orders;
    if($act == 'edit'){
        $tours->id = $id;
        if($tours->edit()){
            if($url) transfers_to($url);
            else transfers_to('tours.html?msg=Chỉnh sửa thành công');
        } 
    } else {
        if($tours->insert()){
            if($url) transfers_to($url);
            else transfers_to('tours.html?msg=Thêm thành công');
        }
    }
}

if($id && $act == 'edit'){
    $tours->id = $id; $t = $tours->get_one();
    $id_danhmuctour = $t['id_danhmuctour'];
    $id_danhmucdiemden = $t['id_danhmucdiemden'];
    $tieude = $t['tieude'];
    $giatour = isset($t['giatour']) ? $t['giatour'] : 0;
    $giagiamtour = isset($t['giagiamtour']) ? $t['giagiamtour'] : 0;
    //$ngaykhoihanh = is_array($t['ngaykhoihanh']) ? $t['ngaykhoihanh'] : date("d/m/Y", $t['ngaykhoihanh']->sec);
    //$ngayketthuc = is_array($t['ngayketthuc']) ? $t['ngayketthuc'] : date("d/m/Y", $t['ngayketthuc']->sec);
    $mota = $t['mota'];
    $noidung = $t['noidung'];
    $giave = isset($t['giave']) ? $t['giave'] : '';
    $hinhanh = $t['hinhanh'];
    $hienthi = $t['hienthi'];
    $stick = isset($t['stick']) ? $t['stick'] : 0; 
    $orders = isset($t['orders']) ? $t['orders'] : 0;
}
?>
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
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
                <h4 class="panel-title"><i class="fa fa-gears"></i> Nhập thông tin tin tức</h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Loại Tours</label>
                    <div class="col-md-9">
                    <select name="id_danhmuctour[]" id="id_danhmuctour" multiple="multiple" class="form-control select2" style="width:100%">
                    <?php
                        if($danhmuctours_list){
                            $list_tree = iterator_to_array($danhmuctours_list);
                            showCategories($list_tree,'','',$id_danhmuctour);
                        }
                    ?>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Điểm đến</label>
                    <div class="col-md-9">
                    <select name="id_danhmucdiemden[]" id="id_danhmucdiemden" multiple="multiple" class="form-control select2" style="width:100%">
                    <?php
                        if($danhmucdiemden_list){
                            $list_tree = iterator_to_array($danhmucdiemden_list);
                            showCategories($list_tree,'','',$id_danhmucdiemden);
                        }
                    ?>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tên Tour</label>
                    <div class="col-md-9">
                        <input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : '';?>">
                        <input type="hidden" name="act" id="act" value="<?php echo isset($act) ? $act : ''; ?>">
                        <input type="hidden" name="url" id="url" value="<?php echo isset($url) ? $url : ''; ?>">
                        <input class="form-control" type="text" id="tieude" name="tieude" placeholder="Tiêu đề" data-parsley-required="true" value="<?php echo isset($tieude) ? $tieude : ''; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Giá Tour</label>
                    <div class="col-md-3">
                        <input class="form-control" type="text" id="giatour" name="giatour" placeholder="Giá Tour" data-parsley-required="true" value="<?php echo isset($giatour) ? $giatour : ''; ?>" />
                    </div>
                    <label class="col-md-3 control-label">Giá giảm Tour</label>
                    <div class="col-md-3">
                        <input class="form-control" type="text" id="giagiamtour" name="giagiamtour" placeholder="Giá giảm giá Tour" data-parsley-required="true" value="<?php echo isset($giagiamtour) ? $giagiamtour : 0; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Mô tả Tour</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="mota" id="mota" placeholder="Mô tả" rows="10" data-parsley-required="true"><?php echo isset($mota) ? $mota : ''; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Thông tin hành trình</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="noidung" id="noidung" placeholder="Mô tả" rows="5" data-parsley-required="true"><?php echo isset($noidung) ? $noidung : ''; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Thông tin giá vé</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="giave" id="giave" placeholder="Mô tả" rows="5" data-parsley-required="true"><?php echo isset($giave) ? $giave : ''; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Hiển thị</label>
                    <div class="col-md-2" id="hienthi_html">
                        <input type="checkbox" name="hienthi" id="hienthi" value="1" data-render="switchery" data-theme="default" <?php echo ($id && $hienthi == 0) ? '' : 'checked';?> /> 
                    </div>
                    <label class="col-md-2 control-label">Stick</label>
                    <div class="col-md-2" id="stick_html">
                        <input type="checkbox" name="stick" id="stick" value="1" data-render="switchery" data-theme="default" <?php echo ($id && $stick == 0) ? '' : 'checked';?> /> 
                    </div>
                    <label class="col-md-2 control-label">Sắp xếp</label>
                    <div class="col-md-2" id="hienthi_html">
                        <input type="number" name="orders" id="orders" value="<?php echo isset($orders) ? $orders : 0; ?>" class="form-control"/> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Chọn hình ảnh</label>
                    <div class="col-md-3">
                        <span class="btn btn-primary fileinput-button">
                            <i class="fa fa-file-image-o"></i>
                            <span>Chọn hình ảnh tốt nhất (950px x 700px)...</span>
                            <input type="file" name="hinhanh_files[]" multiple accept="image/*" class="hinhanh_dinhkem">
                        </span>
                    </div>
                </div>
                <div id="hinhanh_list">
                <?php
                if(isset($hinhanh) && $hinhanh){
                    foreach($hinhanh as $h){
                        $orders = isset($h['orders']) ? $h['orders'] : 0;
                        echo '<div class="items form-group">';
                        echo '<div class="col-md-2">
                            <input type="number" class="form-control" name="hinhanh_orders[]" value="'.$orders.'" />
                          </div>';
                        echo '<div class="col-md-5"><input type="text" name="hinhanh_mota[]" value="'.$h['mota'].'" class="form-control" placeholder="Mô tả hình ảnh"></div>';
                        echo '<div class="col-md-5">';
                        echo '<div class="input-group">
                                <input type="hidden" class="form-control" name="hinhanh_aliasname[]" value="'.$h['aliasname'].'" readonly/>
                                <input type="text" class="form-control" name="hinhanh_filename[]" value="'.$h['filename'].'" readonly/>
                                <span class="input-group-addon"><a href="get.xoahinhanh.html?filename='.$h['aliasname'].'" onclick="return false;" class="delete_file"><i class="fa fa-trash"></i></a></span>
                            </div></div></div>';
                    }
                }
                ?>
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
<!--<div id="date_html" style="display: none;">
    <div class="form-group">
        <label class="col-md-3 control-label">Ngày khởi hành</label>
        <div class="col-md-3">
            <input type="text" name="ngaykhoihanh[]" placeholder="Ngày khởi hành"  class="form-control ngaythangnam" data-date-format="dd/mm/yyyy" data-inputmask="'alias': 'date'" data-parsley-required="true" value="<?php //echo date("d/m/Y"); ?>"/>
        </div>
        <label class="col-md-3 control-label">Ngày kết thúc</label>
        <div class="col-md-3">
            <div class="input-group">
                <input type="text" name="ngayketthuc[]" id="ngayketthuc" placeholder="Ngày kết thúc"  class="form-control ngaythangnam" data-date-format="dd/mm/yyyy" data-inputmask="'alias': 'date'" data-parsley-required="true" value="<?php //echo date("d/m/Y"); ?>"/>
                <span class="input-group-addon"><a href="#" class="remove_date" onclick="return false;"><i class="fa fa-trash"></i></a></span>
            </div>
        </div>
    </div>
</div>-->
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script type="text/javascript" src="assets/js/trangchu.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="assets/js/form-slider-switcher.demo.min.js"></script>
<script src="assets/plugins/ckeditor/ckeditor.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        upload_hinhanh();delete_file();
        $(".select2").select2();
        $(".ngaythangnam").datepicker({todayHighlight:!0});
        $(".ngaythangnam").inputmask();
        /*$("#add_date").click(function(){
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
        });*/
        <?php if(isset($msg) && $msg) : ?>
        $.gritter.add({
            title:"Thông báo !",
            text:"<?php echo $msg; ?>",
            image:"assets/img/login.png",
            sticky:false,
            time:""
        });
        <?php endif; ?>
        CKEDITOR.replace('noidung', {
            filebrowserBrowseUrl: 'assets/plugins/ckfinder/ckfinder.html',
            filebrowserUploadUrl: 'assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserWindowWidth: '1000',
            filebrowserWindowHeight: '700'
        });
        CKEDITOR.replace('giave', {
            filebrowserBrowseUrl: 'assets/plugins/ckfinder/ckfinder.html',
            filebrowserUploadUrl: 'assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserWindowWidth: '1000',
            filebrowserWindowHeight: '700'
        });
        App.init();FormSliderSwitcher.init();
    });
</script>