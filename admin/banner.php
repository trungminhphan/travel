<?php
require_once('header.php');
$banner = new Banner();
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$t = $banner->get_one();

if(isset($_POST['submit'])){
    $act = isset($_POST['act']) ? $_POST['act'] : '';
    if($act == 'banner'){
        $arr_banner = array();
        $banner_aliasname = isset($_POST['banner_aliasname']) ? $_POST['banner_aliasname'] : '';
        $banner_filename = isset($_POST['banner_filename']) ? $_POST['banner_filename'] : '';
        $banner_link = isset($_POST['banner_link']) ? $_POST['banner_link'] : '';
        $banner_mota = isset($_POST['banner_mota']) ? $_POST['banner_mota'] : '';
        $banner_orders = isset($_POST['banner_orders']) ? $_POST['banner_orders'] : '';
        if($banner_aliasname){
            foreach ($banner_aliasname as $key => $value) {
                array_push($arr_banner, array('filename' => $banner_filename[$key], 'aliasname' => $value,'mota' => $banner_mota[$key], 'link' => $banner_link[$key], 'orders' => $banner_orders[$key]));
            }
        }
        $arr_banner = sort_array_1($arr_banner, 'orders', SORT_ASC);

        $arr_banner_right = array();
        $banner_right_aliasname = isset($_POST['banner_right_aliasname']) ? $_POST['banner_right_aliasname'] : '';
        $banner_right_filename = isset($_POST['banner_right_filename']) ? $_POST['banner_right_filename'] : '';
        $banner_right_link = isset($_POST['banner_right_link']) ? $_POST['banner_right_link'] : '';
        $banner_right_mota = isset($_POST['banner_right_mota']) ? $_POST['banner_right_mota'] : '';
        $banner_right_orders = isset($_POST['banner_right_orders']) ? $_POST['banner_right_orders'] : '';
        if($banner_right_aliasname){
            foreach ($banner_right_aliasname as $key => $value) {
                array_push($arr_banner_right, array('filename' => $banner_right_filename[$key], 'aliasname' => $value,'mota' => $banner_right_mota[$key], 'link' => $banner_right_link[$key], 'orders' => $banner_right_orders[$key]));
            }
        }
        $arr_banner = sort_array_1($arr_banner, 'orders', SORT_ASC);
        $arr_banner_right = sort_array_1($arr_banner_right, 'orders', SORT_ASC);

        $banner->banner = $arr_banner;
        $banner->banner_right = $arr_banner_right;
        if($banner->edit_banner()) transfers_to('banner.html?msg=Lưu Banner thành công');
    }
}

?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<!-- begin page-header -->
<h1 class="page-header">QUẢN LÝ BANNER TRANG CHỦ</h1>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" class="form-horizontal" data-parsley-validate="true" id="bannerform" enctype="multipart/form-data">
<input type="hidden" name="act" value="banner">
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-gears"></i> Banner</h4>
            </div>
            <div class="panel-body">
            	<div class="form-group">
                    <label class="col-md-3 control-label">Chọn hình ảnh BANNER</label>
                    <div class="col-md-3">
						<span class="btn btn-primary fileinput-button">
                            <i class="fa fa-file-image-o"></i>
                            <span>Chọn hình Banner tốt nhất (1920px x 500px)...</span>
                            <input type="file" name="banner_files[]" multiple class="banner_dinhkem">
                        </span>
                    </div>
                </div>
                <div id="banner_list">
                <?php
                if($t['banner']){
                    foreach($t['banner'] as $banner){
                        $orders = isset($banner['orders']) ? $banner['orders'] : 0;
                        $mota = isset($banner['mota']) ? $banner['mota'] : '';
                        echo '<div class="items form-group">';
                        echo '<div class="col-md-1">
                            <input type="number" class="form-control" name="banner_orders[]" value="'.$orders.'" />
                          </div>';
                          echo '<div class="col-md-4"><input type="text" name="banner_mota[]" class="form-control" placeholder="Mô tả" value="'.$mota.'"></div>';
                        echo '<div class="col-md-4"><input type="text" name="banner_link[]" value="'.$banner['link'].'" class="form-control" placeholder="Liên kết"></div>';
                        echo '<div class="col-md-3">';
                        echo '<div class="input-group">
                                <input type="hidden" class="form-control" name="banner_aliasname[]" value="'.$banner['aliasname'].'" readonly/>
                                <input type="text" class="form-control" name="banner_filename[]" value="'.$banner['filename'].'" readonly/>
                                <span class="input-group-addon"><a href="get.xoabanner.html?filename='.$banner['aliasname'].'" onclick="return false;" class="delete_file"><i class="fa fa-trash"></i></a></span>
                            </div></div></div>';
                    }
                }
                ?>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Chọn BANNER RIGHT LIÊN HỆ</label>
                    <div class="col-md-3">
                        <span class="btn btn-primary fileinput-button">
                            <i class="fa fa-file-image-o"></i>
                            <span>Chọn hình Banner tốt nhất (260px x #xxx!px)...</span>
                            <input type="file" name="banner_right_files[]" multiple class="banner_right_dinhkem">
                        </span>
                    </div>
                </div>
                <div id="banner_right_list">
                <?php
                if(isset($t['banner_right']) && $t['banner_right']){
                    foreach($t['banner_right'] as $banner_right){
                        $orders = isset($banner_right['orders']) ? $banner_right['orders'] : 0;
                        $mota = isset($banner_right['mota']) ? $banner_right['mota'] : '';
                        echo '<div class="items form-group">';
                        echo '<div class="col-md-1">
                            <input type="number" class="form-control" name="banner_right_orders[]" value="'.$orders.'" />
                          </div>';
                          echo '<div class="col-md-4"><input type="text" name="banner_right_mota[]" class="form-control" placeholder="Mô tả" value="'.$mota.'"></div>';
                        echo '<div class="col-md-4"><input type="text" name="banner_right_link[]" value="'.$banner_right['link'].'" class="form-control" placeholder="Liên kết"></div>';
                        echo '<div class="col-md-3">';
                        echo '<div class="input-group">
                                <input type="hidden" class="form-control" name="banner_right_aliasname[]" value="'.$banner_right['aliasname'].'" readonly/>
                                <input type="text" class="form-control" name="banner_right_filename[]" value="'.$banner_right['filename'].'" readonly/>
                                <span class="input-group-addon"><a href="get.xoabanner.html?filename='.$banner_right['aliasname'].'" onclick="return false;" class="delete_file"><i class="fa fa-trash"></i></a></span>
                            </div></div></div>';
                    }
                }
                ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-check-circle-o"></i> Lưu</button>
            </div>
        </div>
    </div>
</div>
</form>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script type="text/javascript" src="assets/js/trangchu.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        upload_banner();upload_banner_right();delete_file();
        <?php if(isset($msg) && $msg) : ?>
        $.gritter.add({
            title:"Thông báo !",
            text:"<?php echo $msg; ?>",
            image:"assets/img/login.png",
            sticky:false,
            time:""
        });
        <?php endif; ?>
        App.init();
    });
</script>