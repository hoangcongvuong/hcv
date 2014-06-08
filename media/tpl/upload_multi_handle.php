<?php
include dirname(dirname(dirname(__FILE__))) . '/config.php';

$my_secure = new secure_secure();
$my_secure->check_admin();

/**
 * Read template
 */
$tpl = new views_view();

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
<?php include PATH_ROOT . '/media/tpl/sidebar.php' ?>
<h1 class="title"><?php echo $tpl->variable['title'] ?></h1>
<div class="row">
 
 <div class="col-xs-12">
 
<?php  
/**
 * Configuration
 */
$uploaddir_relative = 'uploads';
$uploaddir = PATH_ROOT . '/uploads';
$obj_BD = new models_DB;
$current_upload_folder = $obj_BD->get('SELECT value FROM config WHERE name = \'current_upload_folder\'');
$current_upload_folder = $current_upload_folder[0]['value'];
if(!file_exists("$uploaddir/$current_upload_folder")) mkdir("$uploaddir/$current_upload_folder");
/**
 * END Configuration
 */

$valid_file_type = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/pjpeg', 'image/x-png');
$i = 1;
$j = 1;

/**
 * Loop through all files
 */
foreach($_FILES['userfile']['error'] as $k=>$v)
{
    if(in_array($_FILES['userfile']['type'][$k], $valid_file_type))
    {
        /**
         * Count element in current upload folder 
         */
        if( (count(scandir($uploaddir . '/' . $current_upload_folder)) - 2) >= MAX_ATTACHMENT_PER_FOLDER )
        {
            $current_upload_folder++;
            $obj_BD->query_string('UPDATE config SET value=\''. $current_upload_folder .'\' WHERE name=\'current_upload_folder\'');
            if(!file_exists("$uploaddir/$current_upload_folder")) mkdir("$uploaddir/$current_upload_folder");
        }
        
        
        /**
         * Check exists name of file uploading. if exist, rename it before save to folder.
         */
        $duplicate_file = 1;
        if(file_exists( PATH_ROOT . '/uploads' .'/'. $current_upload_folder . '/' . $_FILES['userfile']['name'][$k] )) 
        {
            $path_file =  pathinfo($_FILES['userfile']['name'][$k]);
            //$path_file['filename'] .= '-' . $duplicate_file;
             
            while(file_exists( PATH_ROOT . '/uploads' .'/'. $current_upload_folder . '/' . $path_file['filename'] . '-' . $duplicate_file . '.' . $path_file['extension'] ))
            {
                $duplicate_file++;
            }
            $_FILES['userfile']['name'][$k] = $path_file['filename'] . '-' . $duplicate_file . '.' . $path_file['extension'];
        }

        
        /**
         * Save file to folder
         */
        $uploadfile = $uploaddir . '/' . $current_upload_folder . '/' . basename($_FILES['userfile']['name'][$k]);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'][$k], $uploadfile)) 
        {
            $moment = pathinfo($_FILES['userfile']['name'][$k]);
            $original_alt_title =  $moment['filename'];        
            $moment = array(
                'url'           => SITE_URL . '/uploads' .'/'. $current_upload_folder . '/' . $_FILES['userfile']['name'][$k],
                'attributes'    => serialize(array(
                    'title'         => $original_alt_title,
                    'alt'           => $original_alt_title
                ))
            );
            $obj_BD->insert( $moment, 'attachment' );
            ?>

            
            <!-- Display file uploaded -->
            <div stt="<?php echo $moment['url']; ?>" class="box relative active" style="">
                <img  class="active pointer" src="<?php echo $moment['url']; ?>" /><br />
                <span class="absolute pointer handle setting_attribute glyphicon glyphicon-wrench setting_icon"></span>
                <span class="absolute pointer handle delete glyphicon glyphicon-remove"></span>
                <form  action="" method="POST" class="attribute absolute">
                    <label> Title : </label>
                    <input class="attribute_input title form-control"  value="<?php echo $original_alt_title ?>" /><br />
                    
                    <label> Alt : </label>
                    <input class="attribute_input alt form-control"  value="<?php echo $original_alt_title ?>" />
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
            $i++;
            $j++;

        } 
        else 
        {
            echo "Failed : ", $_FILES['userfile']['name'][$k], " upload attack!\n";
        }
        
    }
    else 
    {
    ?>
    <div  class="box relative active" style="font-size:11px">
        <?php echo 'Invalid File Type : <br />' , $_FILES['userfile']['name'][$k]; ?>
    </div>
    
    <?php
    }
    
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