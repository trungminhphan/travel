<?php
require_once('header_none.php');
$booking = new Booking();
$hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$dienthoai = isset($_POST['dienthoai']) ? $_POST['dienthoai'] : '';
$sove = isset($_POST['sove']) ? $_POST['sove'] : '';
$ghichu = isset($_POST['ghichu']) ? $_POST['ghichu'] : '';
$id_tour = isset($_POST['id_tour']) ? $_POST['id_tour'] : '';

$booking->hoten = $hoten;
$booking->email = $email;
$booking->dienthoai = $dienthoai;
$booking->sove = $sove;
$booking->ghichu = $ghichu;
$booking->id_tour = $id_tour;

if($booking->insert()){
	transfers_to('tour_detail.php?id='.$id_tour.'&book=ok');
} else {
	echo 'Không thể đặt Tour. <a href="tour_detail.html?id='.$id_tour.'">Trở về</a>';
}
?>
