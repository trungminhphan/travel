<?php 
require_once('header.php');
$banner = new Banner();$b = $banner->get_one();
?>
<div class="site wrapper-content">
	<div class="top_site_main" style="background-image:url(images/banner/top-heading.jpg);">
		<div class="banner-wrapper container article_heading">
			<h1 class="heading_primary">Liên hệ</h1>
		</div>
	</div>
	<section class="content-area">
		<div class="container">
			<div class="row">
				<div class="site-main col-sm-9 alignleft">
					<div class="video-container">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d979.8572038186165!2d106.68770082659252!3d10.778432262104166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3aacf95023%3A0xe3d378a76d33bf51!2zMTA3RyBUcsawxqFuZyDEkOG7i25oLCBwaMaw4budbmcgNiwgUXXhuq1uIDMsIEjhu5MgQ2jDrSBNaW5oLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1498401375468" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
					<div class="pages_content padding-top-4x">
						<h4>TourinStyle Travel Service Limited Company</h4>
						<div class="contact_infor">
							<ul>
								<li><label><i class="fa fa-map-marker"></i>ĐỊA CHỈ</label>
									<div class="des">107G, Trương Định, Phường 6, Quận 3, TPHCM</div>
								</li>
								<li><label><i class="fa fa-phone"></i>ĐIỆN THOẠI</label>
									<div class="des">+84 8 222 90000</div>
								</li>
								<li><label><i class="fa fa-envelope"></i>EMAIL</label>
									<div class="des">trang.nguyen@tourinstyle.vn</div>
								</li>
								<li>
									<label><i class="fa fa-clock-o"></i>GIỜ LÀM VIỆC</label>
									<div class="des">Thứ hai – Thứ sáu 9:00 am – 5:30 pm, Thú bảy 9:00 am – 1:00 pm
										<br>
										Chủ nhật nghỉ
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="wpb_wrapper pages_content">
						<h4>Gởi câu hỏi?</h4>
						<div role="form" class="wpcf7">
							<div class="screen-reader-response"></div>
							<form action="#" method="post" class="wpcf7-form" novalidate="novalidate">
								<div class="form-contact">
									<div class="row-1x">
										<div class="col-sm-6">
												<span class="wpcf7-form-control-wrap your-name">
													<input type="text" name="your-name" value="" size="40" class="wpcf7-form-control" placeholder="Họ tên*">
												</span>
										</div>
										<div class="col-sm-6">
												<span class="wpcf7-form-control-wrap your-email">
													<input type="email" name="your-email" value="" size="40" class="wpcf7-form-control" placeholder="Email*">
												</span>
										</div>
									</div>
									<div class="form-contact-fields">
											<span class="wpcf7-form-control-wrap your-subject">
												<input type="text" name="your-subject" value="" size="40" class="wpcf7-form-control" placeholder="Tiêu đề">
											</span>
									</div>
									<div class="form-contact-fields">
										<span class="wpcf7-form-control-wrap your-message">
											<textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" placeholder="Nội dung"></textarea>
											 </span><br>
										<input type="submit" value="Gởi" class="wpcf7-form-control wpcf7-submit">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="widget-area col-sm-3 align-left">
				<?php if(isset($b['banner_right'])) : ?>
				<?php foreach($b['banner_right'] as $r) : ?>
					<aside class="widget widget_text">
						<?php echo $r['link'] ? '<a href="'.$r['link'].'">' : ''; ?>
							<img src="<?php echo $target_banner . $r['aliasname']; ?>" alt="<?php echo $r['mota']; ?>" title="<?php echo $r['mota']; ?>">
						<?php echo $r['link'] ? '</a>' : ''; ?>
					</aside>
				<?php endforeach; ?>
				<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
</div>

<?php require_once('footer.php'); ?>