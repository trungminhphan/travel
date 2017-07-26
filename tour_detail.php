<?php
require_once('header.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$book = isset($_GET['book']) ? $_GET['book'] : '';
$tours = new Tours();$tours->id = $id; $t = $tours->get_one();
$danhmuctour = new DanhMucTour();$lichkhoihanh = new LichKhoiHanh();
$diemden_list = $tours->get_tour_stick();
?>
<script type="text/javascript" src="assets/js/html5.messages.js"></script>
<div class="site wrapper-content">
	<div class="top_site_main" style="background-image:url(images/banner/top-heading.jpg);">
		<div class="banner-wrapper container article_heading">
			<h2 class="heading_primary">Thông tin chi tiết Tour</h2>
		</div>
	</div>
	<section class="content-area single-woo-tour">
		<div class="container">
			<div class="tb_single_tour product">
				<div class="top_content_single row">
					<div class="images images_single_left">
					<?php if($book && $book == 'ok'): ?>
						<div class="alert alert-danger" role="alert">
							<p><b>Quí khách đã đặt Tour thành công!</b></p>
							<p>
								Cám ơn quí khách đã đặt Tour trực tuyến, chúng tôi sẽ liên hệ với quí khách.
							</p>
						</div>
					<?php endif; ?>
						<div class="title-single">
							<div class="title">
								<h1><?php echo $t['tieude']; ?></h1>
							</div>
						</div>
						<div class="tour_after_title" style="text-align:justify;">
							<?php if($users->isLoggedIn() && $users->is_admin()): ?>
								<div style="clear:both; text-align:right;">
									<a href="admin/themtours.html?id=<?php echo $t['_id']; ?>&act=edit&url=<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-success">Edit</a> 
								</div>
							<?php endif; ?>
							<?php echo $t['mota']; ?>
							<p style="margin-top:20px;">
								<?php if(isset($t['giagiamtour']) && $t['giagiamtour'] > 0) : ?>
									<b>Giá Tour:</b> <span style="color:#ff0000;font-size:18px;font-weight:bold;"><?php echo format_number($t['giagiamtour']); ?> VNĐ</span>&nbsp;&nbsp;&nbsp;<span><strike><?php echo format_number($t['giatour']); ?> VNĐ</strike></span>
								<?php else: ?>
									<b>Giá Tour:</b> <span style="color:#ff0000;font-size:18px;font-weight:bold;"><?php echo format_number($t['giatour']); ?> VNĐ</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
								<?php endif; ?>
								<?php
								$ngaykhoihanh = ''; $ngayketthuc='';
								$lich = $lichkhoihanh->get_one_condition(array('id_tours' => strval($t['_id'])));
								if($lich['ngaykhoihanh'] && is_array($lich['ngaykhoihanh'])){
									foreach($lich['ngaykhoihanh'] as $key => $value){
										if(date("Y-m-d", $value->sec) >= date("Y-m-d")){
											$ngaykhoihanh = date("d/m/Y", $value->sec);
											$ngayketthuc = date("d/m/Y", $lich['ngayketthuc'][$key]->sec);
											break;
										}
									}
								} else {
									$ngaykhoihanh = date("d/m/Y");
									$ngayketthuc = date("d/m/Y");
								}
								?>
							</p>
							<p style="margin-top:20px;">
								<b>Ngày khởi hành:</b> <span style="color:#652f8f;font-size:18px;font-weight: bold;"><?php echo $ngaykhoihanh; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<b>Ngày kết thúc:</b> <span style="color:#89c53f;font-size:18px;font-weight: bold;"><?php echo $ngayketthuc; ?></span>
							<p style="margin-top:20px;">
								<b>Loại Tour:</b> <?php echo $danhmuctour->get_tours($t['id_danhmuctour']); ?>
							</p>
						</div>
						<?php if($t['hinhanh']): ?>
						<div id="slider" class="flexslider">
							<ul class="slides">
							<?php
							foreach($t['hinhanh'] as $h){
								echo '<li>
									<a href="'.$target_images.$h['aliasname'].'" class="swipebox" title=""><img width="950" height="700" src="'.$target_images.$h['aliasname'].'" class="attachment-shop_single size-shop_single wp-post-image" alt="" title="" draggable="false"></a>
								</li>';
							}
							?>
							</ul>
						</div>
						<div id="carousel" class="flexslider thumbnail_product">
							<ul class="slides">
							<?php
							foreach($t['hinhanh'] as $h){
								$file = $target_images . $h['aliasname'];
								$thumbs = $target_images . 'thumbs/' . $h['aliasname'];
								if(!file_exists($thumbs)){
									resize_image($file , null, 150 , 100 , false , $thumbs , false , false ,100 );
								}
								echo '<li>
									<img width="150" height="100" src="'.$thumbs.'" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="" title="" draggable="false">
								</li>';
							}
							?>
							</ul>
						</div>
						<?php endif; ?>
						<div class="clear"></div>
						<div class="single-tour-tabs wc-tabs-wrapper">
							<ul class="tabs wc-tabs" role="tablist">
								<li class="description_tab active" role="presentation">
									<a href="#tab-description" role="tab" data-toggle="tab">Chi tiết Tour</a>
								</li>
								<li class="itinerary_tab_tab" role="presentation">
									<a href="#tab-itinerary_tab" role="tab" data-toggle="tab">Hành trình</a>
								</li>
								<li class="itinerary_tab_tab" role="presentation">
									<a href="#tab-calendar_tab" role="tab" data-toggle="tab">Lịch khởi hành</a>
								</li>
							</ul>
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane single-tour-tabs-panel single-tour-tabs-panel--description panel entry-content wc-tab active" id="tab-description">
									<h2>Thông tin chi tiết Tours</h2>
									<?php echo $t['giave']; ?>
								</div>
								<div role="tabpanel" class="tab-pane single-tour-tabs-panel single-tour-tabs-panel--itinerary_tab panel entry-content wc-tab" id="tab-itinerary_tab">
									<div class="item_content">
										<?php echo $t['noidung']; ?>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane single-tour-tabs-panel single-tour-tabs-panel--itinerary_tab panel entry-content wc-tab" id="tab-calendar_tab">
									<div class="item_content">
										<table>
											<thead>
											<tr>
												<th>STT</th>
												<th>Ngày khởi hành</th>
												<th>Ngày kết thúc</th>
											</tr>
											</thead>
											<tbody>
											<?php
											if(is_array($lich['ngaykhoihanh']) && is_array($lich['ngayketthuc'])){
												$i = 1;
												foreach($lich['ngaykhoihanh'] as $key => $value){
													echo '
														<tr>
															<td align="center">'.$i.'</td>
															<td align="center">'.date("d/m/Y", $value->sec).'</td>
															<td align="center">'.date("d/m/Y", $lich['ngayketthuc'][$key]->sec).'</td>
														</tr>
													';$i++;
												}
											} else {
												echo '
													<tr>
														<td align="center">1</td>
														<td align="center">'.date("d/m/Y").'</td>
														<td align="center">'.date("d/m/Y").'</td>
													</tr>
												';
											}
											?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<?php
						$relates = $tours->get_tourmoi();
						?>
						<?php if($relates) : ?>
						<div class="related tours">
							<h2>Tours liên quan</h2>
							<ul class="tours products wrapper-tours-slider">
							<?php
							foreach ($relates as $r) {
								$rlich = $lichkhoihanh->get_one_condition(array('id_tours' => strval($r['_id'])));
								if($rlich['ngaykhoihanh'] && is_array($rlich['ngaykhoihanh'])){
									foreach($rlich['ngaykhoihanh'] as $key => $value){
										if(date("Y-m-d", $value->sec) >= date("Y-m-d")){
											$ngaykhoihanh = date("d/m/Y", $value->sec);
											$ngayketthuc = date("d/m/Y", $rlich['ngayketthuc'][$key]->sec);
											break;
										}
									}
								} else {
									$ngaykhoihanh = date("d/m/Y");
									$ngayketthuc = date("d/m/Y");
								}
								if($r['hinhanh'][0]['aliasname']){
									$file = $target_images . $r['hinhanh'][0]['aliasname'];
									$thumb = $target_images . '430x305/' . $r['hinhanh'][0]['aliasname'];
									if(!file_exists($thumb)){
										resize_image($file , null, 430, 305, false , $thumb , false , false ,100 );
									}
								} else {
									$thumb = 'images/tour/430x305/tour-2.jpg';
								}
							?>
							<li class="item-list-tour col-md-12 product">
								<div class="content-list-tour">
									<div class="post_images">
										<a href="tour_detail.html?id=<?php echo $r['_id'];?>">
											<img width="430" height="305" src="<?php echo $thumb; ?>" alt="<?php echo $r['tieude']; ?>" title="<?php echo $r['tieude']; ?>">
										</a>
									</div>
									<div class="wrapper_content">
										<div class="content-left">
											<div class="post_title"><h4>
												<a href="tour_detail.html?id=<?php echo $r['_id'];?>"><?php echo $r['tieude']; ?></a>
											</h4></div>
											<div class="description">
												<?php echo $r['mota']; ?>
											</div>
										</div>
										<div class="content-right">
											<ul>
												<?php if(isset($r['giagiamtour']) && $r['giagiamtour'] > 0) : ?>
												<li style="line-height: 15px;">
													<i class="fa fa-money"></i> Giá: <span style="font-size:18px;"><?php echo format_number($r['giagiamtour']); ?></span>
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<span style="color:#ff0000;"><strike><?php echo format_number($r['giatour']); ?></strike></span>
												</li>
												<?php else: ?>
												<li style="line-height: 15px;">
													<i class="fa fa-money"></i> Giá: <span style="font-size:18px;"><?php echo format_number($r['giatour']); ?></span>
												</li>
												<?php endif; ?>
												<li style="padding-top: 10px;"><i class="fa fa-plane"></i> Khởi hành: <?php echo $ngaykhoihanh; ?></li>
												<li><i class="fa fa-reply-all"></i> Kết thúc: <?php echo $ngayketthuc; ?></li>
												<li><i class="fa fa-tags"></i> <?php echo $danhmuctour->get_tours($r['id_danhmuctour']); ?></li>
											</ul>
										</div>
									</div>
								</div>
							</li>
							<?php } ?>
							</ul>
						</div>
						<?php endif; ?>
					</div>
					<div class="summary entry-summary description_single">
						<div class="affix-sidebar">
							<div class="entry-content-tour">
								<p class="price" style="background: #8bc63e;">
									<span class="travel_tour-Price-amount amount">Đặt Tours</span>
								</p>
								<div class="clear"></div>
								<div class="booking">
									<div class="">
										<form id="tourBookingForm" method="POST" action="post.booking.html">
											<input type="hidden" name="id_tour" id="id_tour" value="<?php echo $id; ?>" />
											<div class="">
												<input name="hoten" value="" placeholder="Họ tên" type="text" required oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" />
											</div>
											<div class="">
												<input name="email" value="" placeholder="Email" type="email" required oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" />
											</div>
											<div class="">
												<input name="dienthoai" value="" placeholder="Điện thoại" type="text" required oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" />
											</div>
											<div class="">
												<input type="number" name="sove" value="1" placeholder="Số vé" class="hasDatepicker" required oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" />
											</div>
											<div class="">
												<textarea name="ghichu" id="ghichu" cols="10" rows="5" placeholder="Ghi chú"></textarea>
											</div>
											<input class="btn-booking btn" value="Đặt Tour" type="submit" name="submit" id="booking_submit" />
										</form>
									</div>
								</div>
							</div>
							<div class="widget-area align-left col-sm-3">
								<aside class="widget widget_travel_tour">
									<div class="wrapper-special-tours">
										<?php if($diemden_list): ?>
										<div class="wrapper-special-tours">
										<?php
										foreach($diemden_list as $dd){
											if($dd['hinhanh'][0]['aliasname']){
												$file = $target_images . $dd['hinhanh'][0]['aliasname'];
												$thumb = $target_images . '430x305/' . $dd['hinhanh'][0]['aliasname'];
												if(!file_exists($thumb)){
													resize_image($file , null, 430, 305, false , $thumb , false , false ,100 );
												}
											} else {
												$thumb = 'images/tour/430x305/tour-2.jpg';
											}
											echo '<div class="inner-special-tours">
												<a href="single-tour.html">
													<img width="430" height="305" src="'.$thumb.'" alt="'.$dd['tieude'].'" title="'.$dd['tieude'].'"></a>
												<div class="post_title"><h3>
													<a href="tour_detail.html?id='.$dd['_id'].'" rel="bookmark">'.$dd['tieude'].'</a>
												</h3></div>
												<div class="item_price">
													<span class="price">'.format_number($dd['giatour']).' VNĐ</span>
												</div>
												</div>';
											}
										?>
										</div>
									<?php endif; ?>
									</div>
								</aside>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php require_once('footer.php'); ?>
