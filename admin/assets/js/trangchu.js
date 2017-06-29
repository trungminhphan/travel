function upload_hinhanh(){
    $(".hinhanh_dinhkem").change(function() {
      var formData = new FormData($("#tintucform")[0]);
       $.ajax({
        url: "post.upload_hinhanh.php", type: "POST",
        data: formData, async: false,
        success: function(datas) {
            if(datas=='Failed'){
                $.gritter.add({
                    title:"Không thể Thêm Hình ảnh",
                    text:"Không thể Thêm Hình ảnh",
                    image:"assets/img/login.png",
                    sticky:false,
                    time:""
                });
            } else {
                $("#hinhanh_list").prepend(datas); delete_file();
            }
        },
        cache: false, contentType: false, processData: false
        }).fail(function() {
            $.gritter.add({
                title:"Không thể Upload tập tin",
                text:"Không thể Upload tập tin",
                image:"assets/img/login.png",
                sticky:false,
                time:""
            });
        });
    });
}

function upload_video(){
     $("#video_file").change(function() {
      event.preventDefault();
      var formData = new FormData($("#tintucform")[0]);
       $.ajax({
        url: "post.upload_video.php",
        type: "POST",
        cache: false, contentType: false,
        data: formData, processData:false,
        xhr: function(){
            //upload Progress
            var xhr = $.ajaxSettings.xhr();
            if(xhr.upload) {
                xhr.upload.addEventListener('progress', function(event) {
                    var percent = 0;
                    var position = event.loaded || event.position;
                    var total = event.total;
                    if (event.lengthComputable) {
                        percent = Math.ceil(position / total * 100);
                    }
                    //update progressbar
                    $(".progress .progress-bar").css("width", + percent +"%");
                    $(".progress .progress-bar").text(percent +"%");
                }, true);
            }
            return xhr;
        },
        success: function(datas) {
            if(datas=='Failed'){
                $.gritter.add({
                    title:"Không thể Thêm Video",
                    text:"Không thể Thêm Video",
                    image:"assets/img/login.png",
                    sticky:false,
                    time:""
                });
            } else {
                $("#video_list").prepend(datas); delete_file();
                //$(".progress .progress-bar").css("width", "100%");
                //$(".progress .progress-bar").text("100%");
            }
        },
        mimeType:"multipart/form-data"
        }).fail(function() {
            $.gritter.add({
                title:"Không thể Upload tập tin",
                text:"Không thể Upload tập tin",
                image:"assets/img/login.png",
                sticky:false,
                time:""
            });
        });
    });
}

function upload_banner(){
    $(".banner_dinhkem").change(function() {
      var formData = new FormData($("#bannerform")[0]);
       $.ajax({
        url: "post.upload_banner.php", type: "POST",
        data: formData, async: false,
        success: function(datas) {
            if(datas=='Failed'){
                $.gritter.add({
                    title:"Không thể Thêm Banner",
                    text:"Không thể Thêm Banner",
                    image:"assets/img/login.png",
                    sticky:false,
                    time:""
                });
            } else {
                //$(".info").remove();
                $("#banner_list").prepend(datas); delete_file();
            }
        },
        cache: false, contentType: false, processData: false
        }).fail(function() {
            $.gritter.add({
                title:"Không thể Upload tập tin",
                text:"Không thể Upload tập tin",
                image:"assets/img/login.png",
                sticky:false,
                time:""
            });
        });
    });
}

function upload_banner_right(){
    $(".banner_right_dinhkem").change(function() {
      var formData = new FormData($("#bannerform")[0]);
       $.ajax({
        url: "post.upload_banner_right.php", type: "POST",
        data: formData, async: false,
        success: function(datas) {
            if(datas=='Failed'){
                $.gritter.add({
                    title:"Không thể Thêm Banner",
                    text:"Không thể Thêm Banner",
                    image:"assets/img/login.png",
                    sticky:false,
                    time:""
                });
            } else {
                //$(".info").remove();
                $("#banner_right_list").prepend(datas); delete_file();
            }
        },
        cache: false, contentType: false, processData: false
        }).fail(function() {
            $.gritter.add({
                title:"Không thể Upload tập tin",
                text:"Không thể Upload tập tin",
                image:"assets/img/login.png",
                sticky:false,
                time:""
            });
        });
    });
}

function upload_hanghoa(){
    $(".hanghoa_dinhkem").change(function() {
      var formData = new FormData($("#thongtinhanghoaform")[0]);
       $.ajax({
        url: "post.upload_thongtinhanghoa.php", type: "POST",
        data: formData, async: false,
        success: function(datas) {
            if(datas=='Failed'){
                $.gritter.add({
                    title:"Không thể Thêm Hàng Hóa",
                    text:"<?php echo $msg; ?>",
                    image:"assets/img/login.png",
                    sticky:false,
                    time:""
                });
            } else {
                //$(".info").remove();
                $("#hanghoa_list").prepend(datas); delete_file();
            }
        },
        cache: false, contentType: false, processData: false
        }).fail(function() {
            $.gritter.add({
                title:"Không thể Upload tập tin",
                text:"Không thể Upload tập tin",
                image:"assets/img/login.png",
                sticky:false,
                time:""
            });
        });
    });
}

function delete_file(){
    var link_delete; var _this;
    $(".delete_file").click(function(){
        link_delete = $(this).attr("href"); _this = $(this);
        $.ajax({
            url: link_delete,
            type: "GET",
            success: function(datas) {
                _this.parents("div.items").fadeOut("slow", function(){
                    $(this).remove();
                });
            }
        }).fail(function() {
            $.gritter.add({
                title:"Không thể Xóa tập tin",
                text:"Không thể Xóa tập tin",
                image:"assets/img/login.png",
                sticky:false,
                time:""
            });
        });
    });
}