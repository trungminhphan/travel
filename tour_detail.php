<?php
require_once('header.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$tours = new Tours();$tours->id = $id; $t = $tours->get_one();
$danhmuctour = new DanhMucTour();
$diemden_list = $tours->get_diemdenmoi();
?>
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
						<div class="title-single">
							<div class="title">
								<h1><?php echo $t['tieude']; ?></h1>
							</div>
						</div>
						<div class="tour_after_title" style="text-align:justify;">
							<?php echo $t['mota']; ?>
							<p style="margin-top:20px;">
								<b>Giá Tour:</b> <?php echo format_number($t['giatour']); ?> VNĐ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<?php //if(!is_array($t['ngaykhoihanh']) && !is_array($t['ngayketthuc'])): ?>
								<!--<b>Ngày khởi hành:</b> <?php //echo date("d/m/Y", $t['ngaykhoihanh']->sec); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<b>Ngày kết thúc:</b> <?php //echo date("d/m/Y", $t['ngayketthuc']->sec); ?>-->
							</p><?php //endif; ?>
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
											if(is_array($t['ngaykhoihanh']) && is_array($t['ngayketthuc'])){
												$i = 1;
												foreach($t['ngaykhoihanh'] as $key => $value){
													echo '
														<tr>
															<td align="center">'.$i.'</td>
															<td align="center">'.date("d/m/Y", $value->sec).'</td>
															<td align="center">'.date("d/m/Y", $t['ngayketthuc'][$key]->sec).'</td>
														</tr>
													';$i++;
												}
											} else {
												echo '
													<tr>
														<td align="center">1</td>
														<td align="center">'.date("d/m/Y", $t['ngaykhoihanh']->sec).'</td>
														<td align="center">'.date("d/m/Y", $t['ngayketthuc']->sec).'</td>
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
										<form id="tourBookingForm" method="POST" action="#">
											<div class="">
												<input name="first_name" value="" placeholder="Họ tên" type="text">
											</div>
											<div class="">
												<input name="email_tour" value="" placeholder="Email" type="text">
											</div>
											<div class="">
												<input name="phone" value="" placeholder="Điện thoại" type="text">
											</div>
											<div class="">
												<input type="text" name="date_book" value="" placeholder="Ngày đặt" class="hasDatepicker">
											</div>
											<input class="btn-booking btn" value="Đặt Tour" type="submit">
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