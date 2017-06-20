<?php
require_once('header.php');
$danhmuctour->id = $id; $dmt = $danhmuctour->get_one();
$tours = new Tours();
$query = array('id_danhmuctour' => $id);
$tours_list = $tours->get_list_condition($query);
?>
<div class="site wrapper-content">
	<div class="top_site_main" style="background-image:url(images/banner/top-heading.jpg);">
		<div class="banner-wrapper container article_heading">
			<h1 class="heading_primary"><?php echo $dmt['ten']; ?></h1>
		</div>
	</div>
	<?php if($tours_list): ?>
	<section class="content-area">
		<div class="container">
			<div class="row">
				<div class="site-main col-sm-9 alignright">
					<ul class="tours products wrapper-tours-slider">
						<?php for($i=1; $i<=12; $i++): ?>
						<?php foreach($tours_list as $tour): ?>
						<li class="item-tour col-md-4 col-sm-6 product">
							<div class="item_border item-product">
								<div class="post_images">
									<a href="tour_detail.html?id=<?php echo $tour['_id'];?>">
									<?php if(isset($tour['hinhanh']) && $tour['hinhanh'][0]['aliasname']): ?>
										<img width="430" height="305" src="<?php echo $target_images . $tour['hinhanh'][0]['aliasname']; ?>" alt="<?php echo $tour['tieude']; ?>" title="<?php echo $tour['tieude']; ?>">
									<?php else : ?>
										<img width="430" height="305" src="images/tour/430x305/tour-1.jpg" alt="<?php echo $tour['tieude']; ?>" title="<?php echo $tour['tieude']; ?>">
									<?php endif; ?>
									</a>
								</div>
								<div class="wrapper_content">
									<div class="post_title"><h4>
										<a href="tour_detail.html?id=<?php echo $tour['_id'];?>" rel="bookmark"><?php echo $tour['tieude']; ?></a>
									</h4></div>
									<span class="post_date"><?php echo $tour['mota']; ?></span>
								</div>
								<div class="read_more">
									<a rel="nofollow" href="tour_detail.html?id=<?php echo $tour['_id'];?>" class="button product_type_tour_phys add_to_cart_button">Xem chi tiết</a>
								</div>
							</div>
						</li>
						<?php endforeach; ?>
						<?php endfor; ?>
					</ul>
					<!--<div class="navigation paging-navigation" role="navigation">
						<ul class="page-numbers">
							<li><span class="page-numbers current">1</span></li>
							<li><a class="page-numbers" href="#">2</a></li>
							<li><a class="next page-numbers" href="#"><i class="fa fa-long-arrow-right"></i></a>
							</li>
						</ul>
					</div>-->
				</div>
				<div class="widget-area align-left col-sm-3">
					<div class="search_tour">
						<div class="form-block block-after-indent">
							<h3 class="form-block_title">Tìm kiếm</h3>
							<div class="form-block__description">Tìm Tour bạn cần tìm kiếm!</div>
							<form method="get" action="#">
								<input type="hidden" name="tour_search" value="1">
								<input type="text" placeholder="Search Tour" value="" name="name_tour">
								<select name="">
									<option value="">Chọn loại Tour</option>
									<option value="escorted-tour">Tour trong nước</option>
									<option value="rail-tour">Tour ngoài nước</option>
								</select>
								<select name="">
									<option value="0">Điểm đến</option>
								</select>
								<input type="text" placeholder="Ngày khởi hành" value="" name="name_tour">
								<button type="submit"><i class="fa fa-search"></i> Tìm</button>
							</form>
						</div>
					</div>
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
								<div class="item_price">
									<span class="price">$93.00</span>
								</div>
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
									<a href="single-tour.html" rel="bookmark">Kiwiana Panorama</a>
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
	</section>
	<?php endif; ?>
</div>
<?php require_once('footer.php'); ?>