<?php
require_once('header_none.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$booking = new Booking(); $booking->id = $id;
if($act == 'del' && $id){
	if($booking->delete()) transfers_to('booking.html?msg=Xóa thành công!');
	else transfers_to('booking.html?msg=Không thể xóa, ràng buộc tin tức');	
}


?>