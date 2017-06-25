<?php
function __autoload($class_name) {
    require_once('admin/cls/class.' . strtolower($class_name) . '.php');
}
require_once('admin/inc/functions.inc.php');
require_once('admin/inc/config.inc.php');
$danhmuctour = new DanhMucTour();
$danhmuctour_list = $danhmuctour->get_list_condition(array('id_parent' => ''));
$url = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : 'index.html'; $a = explode("/", $url); $l = end($a);
$id = isset($_GET['id']) ? $_GET['id'] : '';
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="xmlrpc.php">
	<title>TourInStyle</title>
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="assets/css/flaticon.css" type="text/css" media="all">
	<link rel="stylesheet" href="assets/css/font-linearicons.css" type="text/css" media="all">
	<link rel="stylesheet" href="style.css" type="text/css" media="all">
	<link rel="stylesheet" href="assets/css/travel-setting.css" type="text/css" media="all">
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body class="archive travel_tour travel_tour-page">
<div class="wrapper-container">
	<header id="masthead" class="site-header sticky_header affix-top">
		<div class="header_top_bar">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<aside id="text-15" class="widget_text">
							<div class="textwidget">
								<ul class="top_bar_info clearfix">
									<li><i class="fa fa-clock-o"></i> Thứ 2 - Thứ 7 8.00 - 18.00.</li>
								</ul>
							</div>
						</aside>
					</div>
					<div class="col-sm-8 topbar-right">
						<aside id="text-7" class="widget widget_text">
							<div class="textwidget">
								<ul class="top_bar_info clearfix">
									<li><i class="fa fa-phone"></i>+84 8 222 90000</li>
									<li class="hidden-info">
										<i class="fa fa-map-marker"></i> 107G, Trương Định, Phường 6, Quận 3, TPHCM
									</li>
								</ul>
							</div>
						</aside>
						<aside id="travel_login_register_from-2" class="widget widget_login_form">
							<span class="show_from login"><i class="fa fa-user"></i>Đăng nhập</span>

							<div class="form_popup from_login" tabindex="-1">
								<div class="inner-form">
									<div class="closeicon"></div>
									<h3>Đăng nhập</h3>
									<form name="loginform" id="loginform" action="#" method="post">
										<p class="login-username">
											<label for="user_login">Email Address</label>
											<input type="email" name="email" id="email" class="input" value="" size="20">
										</p>
										<p class="login-password">
											<label for="user_pass">Password</label>
											<input type="password" name="password" id="password" class="input" value="" size="20">
										</p>
										<p class="login-remember">
											
										</p>
										<p class="login-submit">
											<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Log In">
											<input type="hidden" name="redirect_to" value="">
										</p>
									</form>
									<a href="#" title="Lost your password?" class="lost-pass">Lost your password?</a>
								</div>
							</div>
							<span class="register_btn">Đăng ký</span>
							<div class="form_popup from_register" tabindex="-1">
								<div class="inner-form">
									<div class="closeicon"></div>
									<h3>Điền thông tin đăng ký</h3>
									<form method="post" class="register">
										<p class="form-row">
											<label for="reg_email">Email address <span class="required">*</span></label>
											<input type="email" class="input" name="email" id="reg_email" value="">
										</p>
										<p class="form-row">
											<label for="reg_password">Password <span class="required">*</span></label>
											<input type="password" class="input" name="password" id="reg_password">
										</p>
										<div style="left: -999em; position: absolute;">
											<label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off">
										</div>
										<p class="form-row">
											<input type="submit" class="button" name="register" value="Register">
										</p>
									</form>
								</div>
							</div>
							<div class="background-overlay"></div>
						</aside>
					</div>
				</div>
			</div>
		</div>
		<div class="navigation-menu">
			<div class="container">
				<div class="menu-mobile-effect navbar-toggle button-collapse" data-activates="mobile-demo">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</div>
				<div class="width-logo sm-logo">
					<a href="index.html" title="Travel" rel="home">
						<img src="images/logo_sticky_1.png" alt="Logo" width="474" height="130" class="logo_transparent_static">
						<img src="images/logo_sticky_1.png" alt="Sticky logo" width="474" height="130" class="logo_sticky">
					</a>
				</div>
				<nav class="width-navigation">
					<ul class="nav navbar-nav menu-main-menu side-nav" id="mobile-demo">
						<li class="<?php echo $l == 'index.html' ? 'current-menu-ancestor' : ''; ?>">
							<a href="index.html">Trang chủ</a>
						</li>
						<?php 
						if($danhmuctour_list){
							foreach($danhmuctour_list as $t){
								echo '<li class="'.($l=='tours.html' && $id==$t['_id'] ? 'current-menu-ancestor' :'').'">
									<a href="tours.html?id='.$t['_id'].'">'.$t['ten'].'</a>
								</li>';
							}
						}
						?>
						<li class="<?php echo $l == 'lienhe.html' ? 'current-menu-ancestor' : ''; ?>"><a href="lienhe.html">Liên hệ</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</header>