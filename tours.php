<?php
require_once('header.php');
$danhmuctour->id = $id; $dmt = $danhmuctour->get_one();
$tours = new Tours();$lichkhoihanh = new LichKhoiHanh();
$query = array('id_danhmuctour' => $id, 'hienthi' => 1);
$diemden_list = $tours->get_diemdenmoi();
$tours_list = $tours->get_list_condition($query);
?>
<div class="site wrapper-content">
	<div class="top_site_main" style="background-image:url(images/banner/top-heading.jpg);">
		<div class="banner-wrapper container article_heading">
			<h1 class="heading_primary"><?php echo $dmt['ten']; ?></h1>
		</div>
	</div>
	<?php 
	$ngaykhoihanh = ''; $ngayketthuc = '';
	if($tours_list): ?>
	<section class="content-area">
		<div class="container">
			<div class="row">
				<div class="site-main col-sm-9 alignright">
					<ul class="tours products wrapper-tours-slider">
						<?php 
						foreach($tours_list as $tour):
							$lich = $lichkhoihanh->get_one_condition(array('id_tours' => strval($tour['_id'])));
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
										<div class="content-right">
											<ul>
												<?php if(isset($tour['giagiamtour']) && $tour['giagiamtour'] > 0) : ?>
												<li style="line-height: 15px;">
													<i class="fa fa-money"></i> Giá: <span style="font-size:18px;"><?php echo format_number($tour['giagiamtour']); ?></span>
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<span style="color:#ff0000;"><strike><?php echo format_number($tour['giatour']); ?></strike></span>
												</li>
												<?php else: ?>
												<li style="line-height: 15px;">
													<i class="fa fa-money"></i> Giá: <span style="font-size:18px;"><?php echo format_number($tour['giatour']); ?></span>
												</li>
												<?php endif; ?>
												<li style="padding-top: 10px;"><i class="fa fa-plane"></i> Khởi hành: <?php echo $ngaykhoihanh; ?></li>
												<li><i class="fa fa-reply-all"></i> Kết thúc: <?php echo $ngayketthuc; ?></li>
												<li><i class="fa fa-tags"></i> <?php echo $danhmuctour->get_tours($tour['id_danhmuctour']); ?></li>
											</ul>
											<?php if($users->isLoggedIn() && $users->is_admin()): ?>
												<a href="admin/themtours.html?id=<?php echo $tour['_id']; ?>&act=edit&url=<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-success">Edit</a> 
											<?php endif; ?>
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
								<input type="text" placeholder="Tên Tour" value="" name="tieude" id="tieude">
								<select name="id_danhmuctour" id="id_danhmuctour">
									<option value="">Chọn loại Tour</option>
									<?php
				                        if($danhmuctour_list){
				                            $list_tree = iterator_to_array($danhmuctour_list);
				                            showCategories($list_tree);
				                        }
				                    ?>
								</select>
								<select name="id_danhmucdiemden" id="danhmucdiemden"> 
									<option value="">Điểm đến</option>
									 <?php
				                        if($danhmucdiemden_list){
				                            $list_tree = iterator_to_array($danhmucdiemden_list);
				                            showCategories($list_tree);
				                        }
				                    ?>
								</select>

								<input type="text" placeholder="Ngày khởi hành" value="" class="datepicker" name="ngaykhoihanh" id="ngaykhoihanh" data-provide="datepicker" data-date-format="dd/mm/yyyy"/>
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