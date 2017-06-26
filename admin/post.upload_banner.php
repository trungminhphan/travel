<?php
require_once('header_none.php');
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_FILES['banner_files']['name']) && $_FILES['banner_files']['name']){
		// Loop $_FILES to exeicute all files
		foreach ($_FILES['banner_files']['name'] as $f => $name) {   
		    if ($_FILES['banner_files']['error'][$f] == 4) {
		        echo 'Failed';
		        continue; // Skip file if any error found
		    } 
		    if ($_FILES['banner_files']['error'][$f] == 0) {	           
		        if ($_FILES['banner_files']['size'][$f] > $max_file_size) {
		        	echo '<div class="note note-success"> <h4>'.$nam.' quá lớn</h4></div>';
		            continue; // Skip large files
		        } elseif(!in_array(strtolower(pathinfo($name, PATHINFO_EXTENSION)), $images_extension) ){
		        	echo '<div class="note note-success"> <h4>'.$name.' Không được phép</h4></div>';
					continue; // Skip invalid file formats
				} else{ // No error found! Move uploaded files 
					$extension = pathinfo($name, PATHINFO_EXTENSION);
					$alias = md5($name);
					$alias_name =  $alias . '_'. date("Ymdhms") . '.' . $extension;
		            if(move_uploaded_file($_FILES["banner_files"]["tmp_name"][$f], $target_banner_home.$alias_name))
		            echo '<div class="items form-group">';
		        	echo '<div class="col-md-1">
		        			<input type="number" class="form-control" name="banner_orders[]" value="0" />
		        		  </div>';
		        	echo '<div class="col-md-4"><input type="text" name="banner_mota[]" class="form-control" placeholder="Mô tả"></div>';
		        	echo '<div class="col-md-4"><input type="text" name="banner_link[]" class="form-control" placeholder="Liên kết"></div>';
		        	echo '<div class="col-md-3">';
		            echo '<div class="input-group">
                            <input type="hidden" class="form-control" name="banner_aliasname[]" value="'.$alias_name.'" readonly/>
                        	<input type="text" class="form-control" name="banner_filename[]" value="'.$name.'" readonly/>
                            <span class="input-group-addon"><a href="get.xoabanner.html?filename='.$alias_name.'" onclick="return false;" class="delete_file"><i class="fa fa-trash"></i></a></span>
                        </div></div></div>';
		        }
		    }
		}
	} else {
		echo '<div class="alert alert-danger fade in m-b-15">
			<strong>Lỗi xảy ra!</strong>
			Không đủ bộ nhớ để upload, vui lòng chọn lại ít tập tin hơn
			<span class="close" data-dismiss="alert">&times;</span>
		</div>';
	}
}
?>