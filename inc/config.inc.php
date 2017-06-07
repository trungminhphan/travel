<?php
	//DEFINE QUYEN CHO TUNG NGUOI
	define("ADMIN", 1);
	define("MANAGER", 2);
	define("USERS", 4);
	//define("FARMER", 8);
	//define("PACKER", 16);

	$target_files = 'uploads/files/';
	$target_videos = 'uploads/videos/';
	$target_videos_home = '../uploads/videos/';
	$target_images = 'uploads/images/';
	$target_images_home = '../uploads/images/';
	$target_banner = 'uploads/banner/';
	$target_banner_home = '../uploads/banner/';
	$files_extension = array('pdf', 'zip', 'rar', 'doc', 'docx', 'xls', 'png', 'gif', 'jpg', 'jpeg', 'bmp', 'rtf');
	$videos_extension = array('mp4', 'ogg', 'webm');
	$images_extension = array('png', 'gif', 'jpg', 'jpeg', 'bmp');
	$valid_formats = array("jpg", "png", "gif", "zip", "bmp", "doc", "docx", "pdf", "xls", "xlsx", "ppt", "pptx", 'zip', 'rar');
	$max_file_size = 1024*1024*1024*1024; //1024MB
	
	$arr_gioitinh = array('M' => 'Nam', 'F' => 'Nữ');
	$arr_dungdenngay = array('D' => 'Ngày', 'M' => 'Tháng', 'Y' => 'Năm');

	$arr_loaidiem = array(
		1 => 'Level game Merlok 2.0',
		2 => 'Số khiên năng lượng',
		3 => 'Điểm mua hàng',
		4 => 'Điểm tham gia "Đấu trường Hiệp sĩ"',
		5 => 'Điểm tham gia "Đại hội Hiệp sĩ"'
	);

	$arr_tinhtrang = array(
		0 => 'Chưa xử lý',
		1 => 'Nhập điểm thành công',
		2 => 'Không hợp lệ'
	);

	$arr_body = array(
	    'index.html' => '<body lang="en" dir="ltr" class="nexo-explore-design-2017 homepage wu-cru-enabled">',
	    'ranking.html' => '<body lang="en" dir="ltr" class="nexo-explore-design-2017 homepage wu-cru-enabled">',
	    'videos.html' => '<body lang="en" dir="ltr" class="videos-2017 nexo-explorer nexo-explore-design-2017 wu-cru-enabled">',
	    'products.html' => '<body lang="en" dir="ltr" class="nexo-products nexo-explore-design-2017 nexo-standardpage wu-cru-enabled">',
	    'product_detail.html' => '<body lang="en" dir="ltr" class="no-screen screen-secondary-content nexo-explore-design-2017  nexo-products nexo-standardpage wu-cru-enabled">',
	    //'guides.html' => '<body lang="en" dir="ltr" class="nexo-explorer nexo-explore-design-2017 nexo-full-grid chapters-landing wu-cru-enabled">',
	    'guide-chapter-1.html' => '<body lang="en" dir="ltr" class="nexo-explorer nexo-explore-design-2017 nexo-full-grid badder-buddies wu-cru-enabled">',
	    'guide-chapter-2.html' => '<body lang="en" dir="ltr" class="nexo-explorer nexo-explore-design-2017 nexo-full-grid badder-buddies wu-cru-enabled">',
	    'guide-chapter-3.html' => '<body lang="en" dir="ltr" class="nexo-explorer nexo-explore-design-2017 nexo-full-grid badder-buddies wu-cru-enabled">',
	    'guide-chapter-4.html' => '<body lang="en" dir="ltr" class="nexo-explorer nexo-explore-design-2017 nexo-full-grid badder-buddies wu-cru-enabled">',
	    'guide-chapter-5.html' => '<body lang="en" dir="ltr" class="nexo-explorer nexo-explore-design-2017 nexo-full-grid badder-buddies wu-cru-enabled">',
	    'guide-chapter-6.html' => '<body lang="en" dir="ltr" class="nexo-explorer nexo-explore-design-2017 nexo-full-grid badder-buddies wu-cru-enabled">'
	);
?>