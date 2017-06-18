<?php
require_once('header.php');
$danhmuctour->id = $id; $dmt = $danhmuctour->get_one();
?>
<div class="site wrapper-content">
	<div class="top_site_main" style="background-image:url(images/banner/top-heading.jpg);">
		<div class="banner-wrapper container article_heading">
			<h1 class="heading_primary"><?php echo $dmt['ten']; ?></h1>
		</div>
	</div>
</div>
<?php require_once('footer.php'); ?>