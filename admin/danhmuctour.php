<?php
require_once('header.php');
check_permis($users->is_admin());
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$danhmuctour = new DanhMucTour();
$danhmuctour_list = $danhmuctour->get_all_list();
?>
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-list"></i> DANH MỤC TOURINSTYLE</h4>
            </div>
            <div class="panel-body">
                <a href="#modal-danhmuctour" data-toggle="modal" class="btn btn-primary m-10 themdanhmuctour"><i class="fa fa-plus"></i> Thêm mới</a>
                <div id="jstree-default">
                <?php
                    if($danhmuctour_list){
                        $list_tree = iterator_to_array($danhmuctour_list);
                        showCategories_Tree($list_tree, '' , 'danhmuctour');
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-danhmuctour">
<form action="post.danhmuctour.html" method="POST" class="form-horizontal" data-parsley-validate="true" name="congtyform">
    <input type="hidden" name="id" id="id" />
    <input type="hidden" name="act" id="act" />
    <input type="hidden" name="url" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">THÔNG TIN DANH MỤC TOUR</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">TÊN</label>
                    <div class="col-md-9">
                        <input type="text" name="ten" id="ten" value="" class="form-control" data-parsley-required="true"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">THUỘC TOUR</label>
                    <div class="col-md-9">
                    <select name="id_parent" id="id_parent" class="select2" style="width:100%">
                        <option value="">Chọn Tour</option>
                        <?php
                        if($danhmuctour_list){
                            $list_tree = iterator_to_array($danhmuctour_list);
                            showCategories($list_tree);
                        }
                        ?>
                    </select>                       
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">MÔ TẢ</label>
                    <div class="col-md-9">
                        <textarea name="mota" id='mota' class="form-control" placeholder="Mô tả" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-sm btn-white" data-dismiss="modal">Đóng</a>
                <button type="submit" name="submit" id="submit" class="btn btn-sm btn-primary">Lưu</button>
            </div>
        </div>
    </div>
</form>
</div>
<div class="modal fade" id="modal-deldanhmuctour">
    <form action="post.danhmuctour.html" method="POST" class="form-horizontal" data-parsley-validate="true" name="congtyform">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Chắc chắn muốn xoá?</h4>
            </div>
            <div class="modal-body">
                <h3>Nếu xoá sẽ xoá tất cả đơn vị trực thuộc?</h3>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-sm btn-white" data-dismiss="modal">Đóng</a>
                <button type="submit" name="submit" id="submit" class="btn btn-sm btn-primary">Xoá</button>
            </div>
        </div>
        <input type="hidden" name="id" id="id_del" />
        <input type="hidden" name="act" id="act_del" />
        <input type="hidden" name="url" id="url_del" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
    </form>
 </div>

<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script src="assets/js/table-manage-default.demo.min.js"></script>
<script src="assets/plugins/jstree/dist/jstree.min.js"></script>
<script src="assets/js/ui-tree.demo.min.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        $(".themdanhmuctour").click(function(){
            $("#id").val("");$("#act").val("");
        });
        
        $(".select2").select2();
        <?php if(isset($msg) && $msg): ?>
        $.gritter.add({
            title:"Thông báo !",
            text:"<?php echo $msg; ?>",
            image:"assets/img/login.png",
            sticky:false,
            time:""
        });
        <?php endif; ?>  
        App.init();TreeView.init();
        $(".suadanhmuctour").click(function(){
            var _link = $(this).attr("href");
            $.getJSON(_link, function(data){
                if(data.act == 'del'){
                  $("#id_del").val(data.id); $("#act_del").val(data.act);
                } else {
                    $("#id").val(data.id); $("#act").val(data.act);
                    $("#ten").val(data.ten);
                    $("#id_parent").val(data.id_parent);$("#id_parent").select2();
                    $("#ma").val(data.ma);
                    $("#mota").val(data.mota);
                }
            });
        });
    });
</script>