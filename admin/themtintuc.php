<?php 
require_once('header.php'); 
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$tintuc = new TinTuc();$danhmuctintuc = new DanhMucTinTuc();
if($id && $act=='del'){
    $tintuc->id = $id; $t = $tintuc->get_one();
    if($t['hinhanh']){
        foreach($t['hinhanh'] as $h){
            if(file_exists($target_images_home . $h['aliasname'])){
                @unlink($target_images_home . $h['aliasname']);
            }
        }
    }
    if($tintuc->delete()) transfers_to('tintuc.html?msg=Xóa thành công!');
}
$list = $tintuc->get_all_list();
$danhmuctintuc_list = $danhmuctintuc->get_all_list();
if($id && $act == 'edit'){
    $tintuc->id = $id; $t = $tintuc->get_one();
    $id_danhmuctintuc = $t['id_danhmuctintuc'];
    $tieude = $t['tieude'];
    $mota = $t['mota'];
    $noidung = $t['noidung'];
    $hinhanh = $t['hinhanh'];
    $hienthi = $t['hienthi'];
    $orders = isset($t['orders']) ? $t['orders'] : 0;
}

if(isset($_POST['submit'])){
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $id_danhmuctintuc = isset($_POST['id_danhmuctintuc']) ? $_POST['id_danhmuctintuc'] : '';
    $act = isset($_POST['act']) ? $_POST['act'] : '';
    $tieude = isset($_POST['tieude']) ? $_POST['tieude'] : '';
    $mota = isset($_POST['mota']) ? $_POST['mota'] : '';
    $noidung = isset($_POST['noidung']) ? $_POST['noidung'] : '';
    $hienthi = isset($_POST['hienthi']) ? $_POST['hienthi'] : '';
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
    $tintuc->id_danhmuctintuc = $id_danhmuctintuc;
    $tintuc->tieude = $tieude;
    $tintuc->mota = $mota;
    $tintuc->noidung = $noidung;
    $tintuc->hinhanh = $arr_hinhanh;
    $tintuc->hienthi = $hienthi;
    $tintuc->video = $video;
    $tintuc->orders = $orders;

    if($act == 'edit'){
        $tintuc->id = $id;
        if($tintuc->edit()) transfers_to('tintuc.html?msg=Chỉnh sửa thành công');
    } else {
        if($tintuc->insert()) transfers_to('tintuc.html?msg=Thêm thành công');
    }
}
?>
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
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
                    <label class="col-md-3 control-label">Loại tin tức</label>
                    <div class="col-md-9">
                    <select name="id_danhmuctintuc[]" id="id_danhmuctintuc" multiple="multiple" class="form-control select2" style="width:100%">
                    <?php
                    if($danhmuctintuc_list){
                        foreach($danhmuctintuc_list as $dm){
                            echo '<option value="'.$dm['_id'].'"'.(in_array($dm['_id'],$id_danhmuctintuc) ? ' selected' : '').'>'.$dm['ten'].'</option>';
                        }
                    }
                    ?>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tiêu đề</label>
                    <div class="col-md-9">
                        <input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : '';?>">
                        <input type="hidden" name="act" id="act" value="<?php echo isset($act) ? $act : ''; ?>">
                        <input class="form-control" type="text" id="tieude" name="tieude" placeholder="Tiêu đề" data-parsley-required="true" value="<?php echo isset($tieude) ? $tieude : ''; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Mô tả</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="mota" id="mota" placeholder="Mô tả" rows="10" data-parsley-required="true"><?php echo isset($mota) ? $mota : ''; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Nội dung</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="noidung" id="noidung" placeholder="Mô tả" rows="5" data-parsley-required="true"><?php echo isset($noidung) ? $noidung : ''; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Hiển thị</label>
                    <div class="col-md-3" id="hienthi_html">
                        <input type="checkbox" name="hienthi" id="hienthi" value="1" data-render="switchery" data-theme="default" <?php echo ($id && $hienthi == 0) ? '' : 'checked';?> /> 
                    </div>
                    <label class="col-md-3 control-label">Sắp xếp</label>
                    <div class="col-md-3" id="hienthi_html">
                        <input type="number" name="orders" id="orders" value="<?php echo isset($orders) ? $orders : 0; ?>" class="form-control"/> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Chọn hình ảnh</label>
                    <div class="col-md-3">
                        <span class="btn btn-primary fileinput-button">
                            <i class="fa fa-file-image-o"></i>
                            <span>Chọn hình ảnh tốt nhất (800px x 600px)...</span>
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
                <a href="tintuc.html" class="btn btn-white"><i class="fa fa-reply-all"></i> Trở về</a>
                <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
            </div>
        </div>
    </div>
</div>
</form>

<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script type="text/javascript" src="assets/js/trangchu.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>
<script src="assets/js/form-slider-switcher.demo.min.js"></script>
<script src="assets/plugins/ckeditor/ckeditor.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        upload_hinhanh();delete_file();
        $(".select2").select2();
        <?php if(isset($msg) && $msg) : ?>
        $.gritter.add({
            title:"Thông báo !",
            text:"<?php echo $msg; ?>",
            image:"assets/img/login.png",
            sticky:false,
            time:""
        });
        <?php endif; ?>
        /*CKEDITOR.replace('noidung', {
            filebrowserBrowseUrl: 'assets/plugins/kcfinder/browse.php?opener=ckeditor&type=files',
            filebrowserImageBrowseUrl: 'assets/plugins/kcfinder/browse.php?opener=ckeditor&type=images',
            filebrowserFlashBrowseUrl: 'assets/plugins/kcfinder/browse.php?opener=ckeditor&type=flash',
            filebrowserUploadUrl: 'assets/plugins/kcfinder/upload.php?opener=ckeditor&type=files',
            filebrowserImageUploadUrl: 'assets/plugins/kcfinder/upload.php?opener=ckeditor&type=images',
            filebrowserFlashUploadUrl: 'assets/plugins/kcfinder/upload.php?opener=ckeditor&type=flash',
        });*/
        CKEDITOR.replace( 'noidung', {
            filebrowserBrowseUrl: 'assets/plugins/ckfinder/ckfinder.html',
            filebrowserUploadUrl: 'assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserWindowWidth: '1000',
            filebrowserWindowHeight: '700'
        });
        App.init();FormSliderSwitcher.init();
    });
</script>