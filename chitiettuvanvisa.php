<?php
require_once('header.php');
$tuvanvisa = new TuVanViSa();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$tuvanvisa->id = $id; $tv = $tuvanvisa->get_one();
?>
<div class="site wrapper-content">
	<div class="top_site_main" style="background-image:url(images/banner/top-heading.jpg);">
		<div class="banner-wrapper container article_heading">
			<h1 class="heading_primary">Chi tiết tư vấn VISA</h1>
		</div>
	</div>
	<section class="content-area">
		<div class="container">
			<div class="row">
				<div class="site-main col-md-12 col-sm-12 alignleft">
					<article class="post_list_content_unit type-post">
						<div class="post-list-content">
							<div class="post_list_inner_content_unit">
								<h1 class="post_list_title"><?php echo $tv['tieude']; ?></h1>
								<div class="post_list_item_excerpt"><?php echo $tv['noidung']; ?></div>
							</div>
						</div>
					</article>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<?php if($tv['hinhanh']): ?>
					<div id="slider" class="flexslider">
						<ul class="slides">
						<?php
						foreach($tv['hinhanh'] as $h){
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
						foreach($tv['hinhanh'] as $h){
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
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</section>
</div>

<?php require_once('footer.php'); ?>