<?php
require_once('header_none.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$danhmucdiemden = new DanhMucDiemDen();
$danhmucdiemden->id = $id; $dv = $danhmucdiemden->get_one();

if($act == 'del'){
	$arr = array(
		'id' => $id,
		'act' => $act
	);
	echo json_encode($arr);
}

if($act == 'edit'){
	$hinhanh = '';
	if(isset($dv['hinhanh']) && $dv['hinhanh']){
		foreach ($dv['hinhanh'] as $h) {
			$orders = isset($h['orders']) ? $h['orders'] : 0;
	        $hinhanh .= '<div class="items form-group">';
	        $hinhanh .= '<div class="col-md-2">
	            <input type="number" class="form-control" name="hinhanh_orders[]" value="'.$orders.'" />
	          </div>';
	        $hinhanh .= '<div class="col-md-5"><input type="text" name="hinhanh_mota[]" value="'.$h['mota'].'" class="form-control" placeholder="Mô tả hình ảnh"></div>';
	        $hinhanh .= '<div class="col-md-5">';
	        $hinhanh .= '<div class="input-group">
                <input type="hidden" class="form-control" name="hinhanh_aliasname[]" value="'.$h['aliasname'].'" readonly/>
                <input type="text" class="form-control" name="hinhanh_filename[]" value="'.$h['filename'].'" readonly/>
                <span class="input-group-addon"><a href="get.xoahinhanh.html?filename='.$h['aliasname'].'" onclick="return false;" class="delete_file"><i class="fa fa-trash"></i></a></span>
            </div></div></div>';
		}
	}
	$arr = array(
		'id' => $id,
		'act' => $act,
		'ten' => $dv['ten'],
		'id_parent' => strval($dv['id_parent']),
		'mota' => $dv['mota'],
		'hinhanh' => $hinhanh
	);
	echo json_encode($arr);
}

?>