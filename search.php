<?php
require_once('header.php');
$tours = new Tours(); $banner = new Banner(); $b = $banner->get_one();
$danhmucdiemden = new DanhMucDiemDen();$danhmuctour = new DanhMucTour();
$tours_list = $tours->get_all_list();
$diemden_list = $tours->get_diemdenmoi();
$danhmucdiemden_list = $danhmucdiemden->get_all_list();
$danhmuctour_list = $danhmuctour->get_all_list();



$tieude = isset($_GET['tieude']) ? $_GET['tieude'] : '';
$id_danhmuctour = isset($_GET['id_danhmuctour']) ? $_GET['id_danhmuctour'] : '';
$id_danhmucdiemden = isset($_GET['id_danhmucdiemden']) ? $_GET['id_danhmucdiemden'] : '';
$ngaykhoihanh = isset($_GET['ngaykhoihanh']) ? $_GET['ngaykhoihanh'] : '';
$query = array();
if($tieude){
	array_push($query, array('tieude' => new MongoRegex('/'.$tieude.'/i')));
}
if($id_danhmuctour){
	array_push($query, array('id_danhmuctour' => $id_danhmuctour));
}
if($id_danhmucdiemden){
	array_push($query, array('id_danhmucdiemden' => $id_danhmucdiemden));
}
if($ngaykhoihanh){
	$nkh = $ngaykhoihanh  ? new MongoDate(convert_date_yyyy_mm_dd($ngaykhoihanh)) : '';
	array_push($query, array('ngaykhoihanh' => $nkh));	
}
$q = array('$or' => $query);
$tours_list = $tours->get_list_condition($q);
?>
<div class="site wrapper-content">
	<div class="top_site_main" style="background-image:url(images/banner/top-heading.jpg);">
		<div class="banner-wrapper container article_heading">
			<h1 class="heading_primary">KẾT QUẢ TÌM KIẾM</h1>
		</div>
	</div>
	<?php if($tours_list): ?>
	<section class="content-area">
		<div class="container">
			<div class="row">
				<div class="site-main col-sm-9 alignright">
					<ul class="tours products wrapper-tours-slider">
						<?php foreach($tours_list as $tour): ?>
							<?php
							if($tour['hinhanh'][0]['aliasname']){
								$file = $target_images . $tour['hinhanh'][0]['aliasname'];
								$thumb = $target_images . '430x305/' . $tour['hinhanh'][0]['aliasname'];
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
										<a href="tour_detail.html?id=<?php echo $tour['_id'];?>">
											<img width="430" height="305" src="<?php echo $thumb; ?>" alt="<?php echo $tour['tieude']; ?>" title="<?php echo $tour['tieude']; ?>">
										</a>
									</div>
									<div class="wrapper_content">
										<div class="content-left">
											<div class="post_title"><h4>
												<a href="tour_detail.html?id=<?php echo $tour['_id'];?>"><?php echo $tour['tieude']; ?></a>
											</h4></div>
											<div class="description">
												<?php echo $tour['mota']; ?>
											</div>
										</div>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
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
							<form method="GET" action="search.html">
								<input type="text" placeholder="Tên Tour" value="<?php echo isset($tieude) ? $tieude : ''; ?>" name="tieude" id="tieude">
								<select name="id_danhmuctour" id="id_danhmuctour">
									<option value="">Chọn loại Tour</option>
									<?php
				                        if($danhmuctour_list){
				                            $list_tree = iterator_to_array($danhmuctour_list);
				                            showCategories($list_tree, '', '' , array($id_danhmuctour));
				                        }
				                    ?>
								</select>
								<select name="id_danhmucdiemden" id="danhmucdiemden"> 
									<option value="">Điểm đến</option>
									 <?php
				                        if($danhmucdiemden_list){
				                            $list_tree = iterator_to_array($danhmucdiemden_list);
				                            showCategories($list_tree, '', '' , array($id_danhmucdiemden));
				                        }
				                    ?>
								</select>

								<input type="text" placeholder="Ngày khởi hành" value="<?php echo isset($ngaykhoihanh) ? $ngaykhoihanh : ''; ?>" class="datepicker" name="ngaykhoihanh" id="ngaykhoihanh" data-provide="datepicker" data-date-format="dd/mm/yyyy"/>
								<button type="submit"><i class="fa fa-search"></i> Tìm</button>
							</form>
						</div>
					</div>
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
	</section>
	<?php endif; ?>
</div>
<?php require_once('footer.php'); ?>

