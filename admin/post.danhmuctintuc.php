<?php
require_once('header_none.php');
$danhmuctintuc = new DanhMucTinTuc();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$act = isset($_POST['act']) ? $_POST['act'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';

$ten = isset($_POST['ten']) ? $_POST['ten'] : '';
$orders = isset($_POST['orders']) ? $_POST['orders'] : 0;
$danhmuctintuc->ten = $ten;
$danhmuctintuc->orders = $orders;
if($act == 'edit'){
	$danhmuctintuc->id = $id;
	if($danhmuctintuc->edit()) {
		if($url) transfers_to($url);
		else transfers_to('danhmuctintuc.html?msg=Chỉnh sửa thành công!');
	}
} else {
	if($danhmuctintuc->insert()){
		if($url) transfers_to($url);
		else transfers_to('danhmuctintuc.html?msg=Thêm nơi thành công!');
	}
}
?>
