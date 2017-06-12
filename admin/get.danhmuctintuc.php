<?php
require_once('header_none.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$danhmuctintuc = new DanhMucTinTuc();$tintuc = new TinTuc();
if($act == 'del' && $id){
	$danhmuctintuc->id = $id; $dm = $danhmuctintuc->get_one();
	if($tintuc->check_dmtintuc($id)){
		transfers_to('danhmuctintuc.html?msg=Không thể xoá, ràng buộc trường dữ liệu các thông tin Tin tức!');
	} else {
		if($danhmuctintuc->delete()) transfers_to('danhmuctintuc.html?msg=Xóa thành công!');
		else transfers_to('danhmuctintuc.html?msg=Không thể xóa, ràng buộc tin tức');
	}	
}

if($act == 'edit'){
	$danhmuctintuc->id = $id; $dm = $danhmuctintuc->get_one();
	$arr = array(
		'id' => $id,
		'act' => $act,
		'ten' => $dm['ten'],
		'orders' => isset($dm['orders']) ? $dm['orders'] : 0
	);
	echo json_encode($arr);
}
?>