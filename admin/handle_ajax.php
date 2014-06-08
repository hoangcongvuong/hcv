<?php
include dirname(dirname(__FILE__)).'/config.php';

$my_secure = new secure_secure();
$my_secure->check_admin();

if(isset($_POST['type']) && $_POST['type']=='delete_post')
{
    $obj_HandleAction = new models_HandleAction;
    $obj_query = new models_query;
    $obj_DB = new models_DB;
    
    $selected_post = $obj_query->query_posts(array('post_id'=>$_POST['post_id']));
    $selected_post = $selected_post[0];
    $trash = array();
    foreach($selected_post as $k=>$v)
    {
        $trash[$k] = $v;
    }
    
    $success = $obj_DB->insert($trash, 'trash');
    
    if(!$success) 
    {
        echo '<br />Không thể xóa<br /><br />';
        exit;
    }
    
    
    $success = $obj_HandleAction->delete_post($_POST['post_id']);
    
    if($success) echo '<br />Bài viết đã được xóa và lưu vào thùng rác<br /><br />'; else echo '0';
}

if(isset($_POST['type']) && $_POST['type']=='delete_category')
{
    $obj_HandleAction = new models_HandleAction;
      
    $success = $obj_HandleAction->delete_term($_POST['category_id']);
    
    if($success) echo '<br />Đã xóa<br /><br />'; else echo 'Không thể xóa<br /><br />';
}

if(isset($_POST['type']) && $_POST['type']=='delete_block_area')
{
    $obj_HandleAction = new models_HandleAction;
      
    $success = $obj_HandleAction->delete_block_area($_POST['block_area_id']);
    
    if($success) echo '<br />Đã xóa<br /><br />'; else echo 'Không thể xóa<br /><br />';
}