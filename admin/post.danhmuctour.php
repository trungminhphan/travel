<?php
require_once('header_none.php');
$danhmuctour = new DanhMucTour();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$act = isset($_POST['act']) ? $_POST['act'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';
$ten = isset($_POST['ten']) ? $_POST['ten'] : '';
$id_parent = isset($_POST['id_parent']) ? $_POST['id_parent'] : '';
$mota = isset($_POST['mota']) ? $_POST['mota'] : '';
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
$danhmuctour->ten = $ten;
$danhmuctour->id_parent = $id_parent;
$danhmuctour->mota = $mota;
$danhmuctour->hinhanh = $arr_hinhanh;
$l = explode("?", $url); $url = $l[0];
if($act == 'edit'){
	$danhmuctour->id = $id;
	if($danhmuctour->edit()) {
		if($url) transfers_to($url . '?msg=Chỉnh sửa thành công.');
		else transfers_to('danhmuctour.htmlmsg=Chỉnh sửa thành công!');
	}
} else if($act == 'del'){
	$danhmuctour->id = $id;
	if($danhmuctour->check_dmtour($id)){
		transfers_to('danhmuctour.html?msg=Không thể xoá, ràng buộc dữ liệu.');
	} else {
		$t = $danhmuctour->get_one();
		if(isset($t['hinhanh']) && $t['hinhanh']){
			foreach ($t['hinhanh'] as $h) {
				if(file_exists($target_images_home . $h['aliasname'])){
					@unlink($target_images_home . $h['aliasname']);
				}
			}
		}
		if($danhmuctour->delete()){
			if($url) transfers_to($url . '?msg=Xoá thành công.');
			else transfers_to('danhmuctour.html?msg=Xoá thành công!');
		}
	}
} else {
	if($danhmuctour->insert()){
		if($url) transfers_to($url . '?msg=Thêm thành công.');
		else transfers_to('danhmuctour.html?msg=Thêm mới thành công!');
	}
}
?>