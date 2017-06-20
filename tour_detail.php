<?php
require_once('header.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$tours = new Tours();$tours->id = $id; $t = $tours->get_one();
$danhmuctour = new DanhMucTour();
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
						<div class="tour_after_title">
							<div class="meta_date">
								<span><?php echo $t['mota']; ?></span>
							</div>
							<div class="meta_values">
								<span>Loại Tours:</span>
								<div class="value">
									<?php echo $danhmuctour->get_tours($t['id_danhmuctour']); ?>
								</div>
							</div>
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
								$file = $target_images . $r['hinhanh'][0]['aliasname'];
								$thumb = $target_images . '430x305/' . $r['hinhanh'][0]['aliasname'];
								if($r['hinhanh'][0]['aliasname']){
									if(!file_exists($thumb)){
										resize_image($file , null, 430, 305, false , $thumb , false , false ,100 );
									}
								} else {
									$thumb = 'images/tour/430x305/tour-2.jpg';
								}
								echo '<li class="item-tour col-md-4 col-sm-6 product">
									<div class="item_border item-product">
										<div class="post_images">
											<a href="tour_detail.html?id='.$r['_id'].'">
												<img width="430" height="305" src="images/tour/430x305/tour-1.jpg" alt="Discover Brazil" title="Discover Brazil">
											</a>
										</div>
										<div class="wrapper_content">
											<div class="post_title"><h4>
												<a href="tour_detail.html?id='.$r['_id'].'" rel="bookmark">'.$r['tieude'].'</a>
											</h4></div>
											<span class="post_date">'.$r['mota'].'</span>
										</div>
										<div class="read_more">
											<a rel="nofollow" href="tour_detail.html?id='.$r['_id'].'" class="button product_type_tour_phys add_to_cart_button">Xem chi tiết</a>
										</div>
									</div>
								</li>';
								}
								?>
							</ul>
						</div>
						<?php endif; ?>
					</div>
					<div class="summary entry-summary description_single">
						<div class="affix-sidebar">
							<div class="entry-content-tour">
								<p class="price">
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
											<div class="from-group">
												<div class="total_price_arrow">
													<input type="hidden" name="price_children_percent" value="70">
												</div>
											</div>
											<input class="btn-booking btn" value="Đặt Tour" type="submit">
										</form>
									</div>
								</div>
							</div>
							<div class="widget-area align-left col-sm-3">
								<aside class="widget widget_travel_tour">
									<div class="wrapper-special-tours">
										<div class="inner-special-tours">
											<a href="single-tour.html">
												<img width="430" height="305" src="images/tour/430x305/tour-1.jpg" alt="Discover Brazil" title="Discover Brazil"></a>
											<div class="item_rating">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star-o"></i>
											</div>
											<div class="post_title"><h3>
												<a href="single-tour.html" rel="bookmark">Discover Brazil</a>
											</h3></div>
										</div>
										<div class="inner-special-tours">
											<a href="single-tour.html">
												<span class="onsale">Sale!</span>
												<img width="430" height="305" src="images/tour/430x305/tour-2.jpg" alt="Discover Brazil" title="Discover Brazil"></a>
											<div class="item_rating">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star-o"></i>
												<i class="fa fa-star-o"></i>
											</div>
											<div class="post_title"><h3>
												<a href="tour_detail.html?id=<?php echo $r['_id']; ?>" rel="bookmark">Kiwiana Panorama</a>
											</h3></div>
											<div class="item_price">
									<span class="price"><del>$87.00</del>
									<ins>$82.00</ins></span>
											</div>
										</div>
										<div class="inner-special-tours">
											<a href="single-tour.html">
												<img width="430" height="305" src="images/tour/430x305/tour-3.jpg" alt="Discover Brazil" title="Discover Brazil">
											</a>
											<div class="item_rating">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star-o"></i>
												<i class="fa fa-star-o"></i>
												<i class="fa fa-star-o"></i>
											</div>
											<div class="post_title"><h3>
												<a href="single-tour.html" rel="bookmark">Anchorage to Quito</a>
											</h3></div>
											<div class="item_price">
												<span class="price">$64.00</span>
											</div>
										</div>
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