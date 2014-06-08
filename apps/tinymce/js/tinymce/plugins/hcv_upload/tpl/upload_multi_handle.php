<?php
include dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))))) . '/config.php';
    
/**
 * Read template
 */
$tpl = new tpl_render();

$tpl->assign('title', 'Uploads');    
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
 
 <div class="col-xs-12">
 
<?php  
/**
 * Configuration
 */
$uploaddir_relative = 'uploads';
/**
 * END Configuration
 */

$valid_file_type = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/pjpeg', 'image/x-png');
$i = 1;
$j = 1;
foreach($_FILES['userfile']['error'] as $k=>$v)
{
    if(in_array($_FILES['userfile']['type'][$k], $valid_file_type))
    {
        $uploadfile = PATH_ROOT . '/uploads' . '/' . basename($_FILES['userfile']['name'][$k]);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'][$k], $uploadfile)) 
        {
            ?>
            <div stt="<?php echo $j; ?>" class="box active relative" style="">
                <img  class="active pointer" src="<?php echo SITE_URL . '/uploads' .'/'. $_FILES['userfile']['name'][$k] ?>" /><br />
                
                <form  action="" method="POST" class="absolute transition pointer setting_attribute glyphicon glyphicon-wrench">
                    <div <?php if($i%4 == 0) {$i = 0; echo 'style="left:-273px"'; } ?> <?php if($i%3 == 0) echo 'style="left:-100px"' ?> class="attribute absolute">
                        <label> Title : </label>
                        <input class="attribute_input title form-control"  value="<?php $moment = pathinfo($_FILES['userfile']['name'][$k]); echo $moment['filename'] ?>" /><br /><br />
                        <label> Alt : </label>
                        <input class="attribute_input alt form-control"  value="<?php $moment = pathinfo($_FILES['userfile']['name'][$k]); echo $moment['filename'] ?>" />
                        <input type="submit" class="btn btn-info fl submit" value="Save" /><span class="noti relative bold"></span>
                    </div>
                </form>
                
            </div>
            
            <?php
            $i++;$j++;

        } 
        else 
        {
            echo "Failed : ", $_FILES['userfile']['name'][$k], " upload attack!\n";
        }
        
    }
    else echo 'Invalid File Type : ' , $_FILES['userfile']['name'][$k];
}

?>
</div>
</div>
<div style="bottom: 0;" class="row absolute none">
    <label><input type="checkbox"   id="insert_br_tag" />Auto line break after each Image</label>
</div>
</div>
<div class="clear"></div>

<?php include 'footer.php' ?>