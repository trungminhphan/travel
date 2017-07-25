<?php 
require_once('header.php');
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$lichkhoihanh = new LichKhoiHanh();$tours = new Tours();
$list = $lichkhoihanh->get_all_list();
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />

<div class="col-md-12">
	<div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
            <h4 class="panel-title"><i class="fa fa-calendar"></i> Danh sách Lịch khởi hành</h4>
        </div>
        <div class="panel-body">
        	<a href="themlichkhoihanh.html" class="btn btn-primary m-b-10"><i class="fa fa-plus"></i> Thêm mới</a>
        	<table id="data-table" class="table table-striped table-bordered table-hovered">
            <thead>
                    <tr>
                        <th>STT</th>
                        <th width="200">Ngày khởi hành - Kết thúc</th>
                        <th>Tours</th>
                        <th class="text-center"><i class="fa fa-trash"></i></th>
                        <th class="text-center"><i class="fa fa-pencil"></i></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if($list){
                    $i = 1;
                    foreach ($list as $ds) {
                        echo '<tr>';
                        echo '<td style="vertical-align:middle;" class="text-center">'.$i.'</td>';
                        echo '<td style="vertical-align:middle;">';
                        if($ds['ngaykhoihanh']){
                            echo '<ul style="padding:0px 0px 0px 10px;">';
                            foreach ($ds['ngaykhoihanh'] as $key => $value) {
                                echo '<li>'.date("d/m/Y", $value->sec). ' --- '.date("d/m/Y", $ds['ngayketthuc'][$key]->sec).'</li>';
                            }
                            echo '</ul>';
                        }
                        echo '</td>';
                        echo '<td style="vertical-align:middle;">';
                        if($ds['id_tours']){
                            echo '<ul style="padding:0px 0px 0px 10px;">';
                            foreach ($ds['id_tours'] as $key => $value) {
                                $tours->id = $value; $t = $tours->get_one();
                                echo '<li>'.$t['tieude'].'</li>';
                            }
                            echo '</ul>';
                        }
                        echo '</td>';
                        echo '<td class="text-center" style="vertical-align:middle;"><a href="themlichkhoihanh.html?id='.$ds['_id'].'&act=del" onclick="return confirm(\'Chắc chắn muốn xóa?\')"><i class="fa fa-trash"></i></a></td>';
                        echo '<td class="text-center" style="vertical-align:middle;"><a href="themlichkhoihanh.html?id='.$ds['_id'].'&act=edit"><i class="fa fa-pencil"></i></a></td>';
                        echo '</tr>';$i++;
                    }
                }
                ?>
                </tbody>
            </table>
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