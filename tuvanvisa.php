<?php
require_once('header.php');
$tuvanvisa = new TuVanViSa();
$tuvanvisa_list = $tuvanvisa->get_all_list();
?>
<div class="site wrapper-content">
	<div class="top_site_main" style="background-image:url(images/banner/top-heading.jpg);">
		<div class="banner-wrapper container article_heading">
			<h1 class="heading_primary">Tư vấn VISA</h1>
		</div>
	</div>
	<?php if($tuvanvisa_list): ?>
	<section class="content-area">
		<div class="container">
			<div class="row">
				<div class="site-main col-md-12 col-sm-12 align-left">
					<div class="wrapper-blog-content">
					<?php
					foreach($tuvanvisa_list as $tv){
						if(isset($tv['hinhanh'][0]['aliasname']) && $tv['hinhanh'][0]['aliasname']){
								$file = $target_images . $tv['hinhanh'][0]['aliasname'];
								$thumb = $target_images . '370x260/' . $tv['hinhanh'][0]['aliasname'];
								if(!file_exists($thumb)){
									resize_image($file , null, 370, 260, false , $thumb , false , false ,100 );
								}
							} else {
								$thumb = 'images/blog/86H.jpg';
							}
						echo '<article class="type-post">
							<div class="img_post"><a href="chitiettuvanvisa.html?id='.$tv['_id'].'">
								<img width="370" height="260" src="'.$thumb.'" class="wp-post-image" alt=""></a>
							</div>
							<div class="entry-content content-thumbnail">
								<header class="entry-header">
									<h2 class="entry-title">
										<a href="chitiettuvanvisa.html?id='.$tv['_id'].'" rel="bookmark">'.$tv['tieude'].'</a>
									</h2>
									<div class="entry-meta">
										<span class="posted-on">Ngày cập nhật:
											<time class="entry-date published">'.date("d/m/Y", $tv['date_post']->sec).'</time>
										</span>
									</div>
								</header>
								<div class="entry-desc">
									'.$tv['mota'];
								if($users->isLoggedIn() && $users->is_admin()):
									echo '<br /><a href="admin/themtuvanvisa.html?id='.$tv['_id'].'&act=edit&url='.$_SERVER['REQUEST_URI'].'" class="btn btn-success">Edit</a>';
								endif;
								echo '</div>
							</div>
						</article>';
					}
					?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>
</div>

<?php require_once('footer.php'); ?>