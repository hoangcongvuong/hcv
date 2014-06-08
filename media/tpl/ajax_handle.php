<?php
include dirname(dirname(dirname(__FILE__))) . '/config.php';

$my_secure = new secure_secure();
$my_secure->check_admin();
$obj_BD = new models_DB;

if((isset($_POST['type'])) && ($_POST['type'] == 'update_attribute'))
{
    $attributes = serialize(array('title'=>$_POST['new_title'], 'alt'=>$_POST['new_alt']));
    $moment = 'UPDATE attachment SET attributes=\''. $attributes .'\' WHERE url = \'' . $_POST['attachment_url'] .'\'';
        
    if( $obj_BD->query_string($moment) ) echo '1'; else echo $obj_BD->last_result_status;
}

if((isset($_POST['type'])) && ($_POST['type'] == 'delete_attachment'))
{
    
    $moment = 'SELECT * FROM attachment WHERE url =\'' . $_POST['attachment_url'] . '\'';
    $attachments = $obj_BD->get($moment);
    $url = $attachments[0]['url'];
    $file = str_replace_one( SITE_URL, PATH_ROOT, $url );

    if( @unlink( $file ) || !file_exists($file) )
    {
        $moment = 'DELETE FROM attachment WHERE url = \'' . $_POST['attachment_url'] . '\'';
        if( $obj_BD->query_string($moment) ) echo '1'; else echo $obj_BD->last_result_status;
    }
    else echo 'Can\'t delete file';
}

if((isset($_POST['type'])) && ($_POST['type'] == 'load_more_gallery'))
{
    $start = $_POST['start'];
    $end = $start + 20;
    $moment = 'SELECT * FROM attachment LIMIT '. $start . ',' .$end ;
    $attachments = $obj_BD->get($moment);
    foreach($attachments as $v_attachments)
    {
        $attributes = unserialize($v_attachments['attributes']);
    ?>
        <div stt="<?php echo $v_attachments['url'] ?>" class="box relative" style="">
            <img  class="pointer" src="<?php echo $v_attachments['url'] ?>" /><br />
            <span class="absolute pointer handle setting_attribute glyphicon glyphicon-wrench setting_icon"></span>
            <span class="absolute pointer handle delete glyphicon glyphicon-remove"></span>
            <form  action="" method="POST" class="attribute absolute">
                    <label> Title : </label>
                    <input class="attribute_input title form-control"  value="<?php echo $attributes['title'] ?>" /><br /><br />
                    
                    <label> Alt : </label>
                    <input class="attribute_input alt form-control"  value="<?php echo $attributes['alt'] ?>" />
                    
                    
                    <input type="submit" class="btn btn-primary fl action submit" value="Save" />
                    <span class="noti relative bold"></span>
                    <input type="button" class="btn btn-default fr action close_attribute_form" value="Close" />
            </form>
            
        </div>
    <?php
    } 
}
