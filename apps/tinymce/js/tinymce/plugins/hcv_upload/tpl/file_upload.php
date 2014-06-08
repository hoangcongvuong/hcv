<?php
include dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))))) . '/config.php';
    
/**
 * Read template
 */
$tpl = new tpl_render();

$tpl->assign('title', 'Login');    
$tpl->assign('css', array(
    SITE_URL . '/apps/bootstrap-3.1.1-dist/css/bootstrap.min.css',
    SITE_URL . '/admin/' . 'css/admin.css',
    '../uploads.css'
));
$tpl->assign('script',array(
    SITE_URL . '/apps/js/jquery-1.9.1.min.js',
    SITE_URL . '/apps/bootstrap-3.1.1-dist/js/bootstrap.min.js',
    '../uploads.js'
));
include 'header.php';
/**
 * END Read template
 */     
?>


<div class="container">
<?php include 'sidebar.php' ?>
<h1 class="title"><?php echo $tpl->variable['title'] ?></h1>
<div class="row">
    
        
    
    <form class="col-xs-12 uploadform" enctype="multipart/form-data" action="upload_multi_handle.php" method="POST">
        <!-- MAX_FILE_SIZE must precede the file input field -->
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000"  />
        <!-- Name of input element determines name in $_FILES array -->
        <div class="col-xs-6">
            <input class="none" id="hcv_upload_button" name="userfile[]"  type="file" multiple="multiple"  />
            <input class="btn btn-info" type="button" value="Select Files" id="virtual_select_file" />
        </div>
        
        
        
        <div class="col-xs-6">
            <input  id="upload_instant" class="btn btn-info none" type="submit" value="Upload" />
        </div>
    
    </form>
</div>
<div style="bottom: 0;" class="row absolute none">
    <label><input type="checkbox"   id="insert_br_tag" />Auto line break after each Image</label>
</div>
</div>
<?php include 'footer.php' ?>