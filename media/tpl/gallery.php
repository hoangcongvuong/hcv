<?php
include dirname(dirname(dirname(__FILE__))) . '/config.php';

$my_secure = new secure_secure();
$my_secure->check_admin();

/**
 * Read template
 */
$tpl = new views_view();

$tpl->assign('title', 'Thư viện');    
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
<div class="row" id="gallery">
<?php include PATH_ROOT . '/media/tpl/sidebar.php' ?>
<h1 class="title"><?php echo $tpl->variable['title'] ?></h1>
<?php 
$j=1; 
$i=1;
$obj_BD = new models_DB;
$moment = 'SELECT * FROM attachment ORDER BY id DESC LIMIT 0,20';
$attachments = $obj_BD->get($moment);
foreach($attachments as $v_attachments)
{
    $attributes = unserialize($v_attachments['attributes']);
?>
    <div stt="<?php echo $v_attachments['url'] ?>" class="box relative" style="">
        <img  class="active pointer" src="<?php echo $v_attachments['url'] ?>" /><br />
        <span class="absolute pointer handle setting_attribute glyphicon glyphicon-wrench setting_icon"></span>
        <span class="absolute pointer handle delete glyphicon glyphicon-remove"></span>
        <form  action="" method="POST" class="attribute absolute">
                <label> Title : </label>
                <input class="attribute_input title form-control"  value="<?php echo $attributes['title'] ?>" /><br />
                
                <label> Alt : </label>
                <input class="attribute_input alt form-control"  value="<?php echo $attributes['alt'] ?>" />
                <br />
                <label> Align : </label>
                <select class="form-control align">
                    <option value="center">Center</option>
                    <option value="none">None</option>
                    <option value="left">Left</option>
                    <option value="right">Right</option>
                </select>
                
                <input type="submit" class="btn btn-primary fl action submit" value="Save" />
                <span class="noti relative bold"></span>
                <input type="button" class="btn btn-default fr action close_attribute_form" value="Close" />
        </form>
        
    </div>
<?php
} 
?>




</div>
<span id="load-more-point" class="fixed glyphicon glyphicon-heart" style="opacity: 0;"></span>
<span id="end-gallery" class="glyphicon glyphicon-heart"  style="opacity: 0;"></span>
<button id="button-load-more" class="btn btn-info" style="margin: auto;display:block">Load more</button>
<div style="bottom: 0;" class="row absolute none">
    <label><input type="checkbox"   id="insert_br_tag" />Auto line break after each Image</label>
</div>
</div>
<div class="clear"></div>

<?php include 'footer.php' ?>