<?php
require_once('header.php');
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$tours = new Tours();$danhmuctours = new DanhMucTour();
$list = $tours->get_list_condition(array('stick' => 1));
$danhmuctours_list = $danhmuctours->get_all_list();
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<!-- begin page-header -->
<h1 class="page-header">DANH SÁCH CÁC TOURS STICK</h1>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-gears"></i> Danh sách Tours STICK</h4>
            </div>
            <div class="panel-body">
            <a href="themtours.html&url=<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-primary m-b-10" id="themmoi"><i class="fa fa-plus"></i> Thêm mới</a>
            <table id="data-table" class="table table-striped table-bordered table-hovered">
                <thead>
                	<tr>
                		<th>STT</th>
                		<th width="50%">Tiêu đề</th>
                		<th class="text-center">Ngày cập nhật</th>
                		<th class="text-center">Hiển thị</th>
                        <th class="text-center">Sắp xếp</th>
                		<th class="text-center"><i class="fa fa-trash"></i></th>
                		<th class="text-center"><i class="fa fa-pencil"></i></th>
                	</tr>
                </thead>
                <tbody>
                <?php
                if($list){
                    $i = 1;
                	foreach ($list as $ds) {
                        $hienthi = $ds['hienthi'] == 1 ? '<i class="fa fa-eye text-primary"></i>' : '<i class="fa fa-eye-slash text-danger"></i>';
                        $orders = isset($ds['orders']) ? $ds['orders'] : 0;
                		echo '<tr>';
                		echo '<td>'.$i.'</td>';
                		echo '<td>'.$ds['tieude'].'</td>';
                		echo '<td class="text-center">'.date("d/m/Y", $ds['date_post']->sec).'</td>';
                		echo '<td class="text-center">'.$hienthi.'</td>';
                        echo '<td class="text-center">'.$orders.'</td>';
                		echo '<td class="text-center"><a href="themtours.html?id='.$ds['_id'].'&act=del&url='.$_SERVER['REQUEST_URI'].'" onclick="return confirm(\'Chắc chắn muốn xóa?\')"><i class="fa fa-trash"></i></a></td>';
                        echo '<td class="text-center"><a href="themtours.html?id='.$ds['_id'].'&act=edit&url='.$_SERVER['REQUEST_URI'].'"><i class="fa fa-pencil"></i></a></td>';
                		echo '</tr>';$i++;
                	}
                }
                ?>
                </tbody>
            </table>
           	</div>
        </div>
    </div>
</div>

<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        <?php if(isset($msg) && $msg) : ?>
        $.gritter.add({
            title:"Thông báo !",
            text:"<?php echo $msg; ?>",
            image:"assets/img/login.png",
            sticky:false,
            time:""
        });
        <?php endif; ?>
        $("#data-table").DataTable({responsive:!0, "pageLength": 100, "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'});
        App.init();
    });
</script>