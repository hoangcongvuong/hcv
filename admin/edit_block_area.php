<?php
if(!defined('SECURE_CHECK')) die('Stop');

if(isset($_POST['submit_block_area']))
{
    $error_notification = '<span style="color:red">Error : </span><br />';
    
    
    
 
    $block_area_fields = array(
        'block_area_name'                => $_POST['block_area_name'],
        'block_area_title'               => $_POST['block_area_title'],
        'block_area_description'         => $_POST['block_area_description'],
        //'block_area_content'             => $_POST['block_area_content'],
        'block_area_secure_key'          => random_string()
    );
    
    if( $_POST['block_area_name'] == '' )
    {
        $error_notification .= '- Name (slug) cannot empty<br />';
    }
    else
    {
        $obj_query = new models_query;
        $query_terms = array();
        ///echo $obj_query->url_exists($_POST['category_url']);
        $exist_area = $obj_query->row_exists('block_area_name', $_POST['block_area_name'], 'block_area');
        if($exist_area && $exist_area != $_GET['block_area_id']) $error_notification .= 'Your url already exists';
       
        else
        {
            $obj_DB = new models_DB;
            if(!$obj_DB->update($block_area_fields, 'block_area', 'WHERE block_area_id='. $_GET['block_area_id'])) $error_notification .= $obj_DB->last_result_status . '<br />';
            else ($error_notification .= 'Block Area updated');
        }
        
        
    }
}
/**
 * Read template
 */
 
$tpl = new views_view();

$tpl->assign('title', 'Edit Block Area');    
$tpl->assign('css', array(
    SITE_URL . '/apps/bootstrap-3.1.1-dist/css/bootstrap.min.css',
    SITE_URL . '/admin/' . 'css/reset.css',
    SITE_URL . '/admin/' . 'css/admin.css'
));
$tpl->assign('script',array(
    SITE_URL . '/apps/js/jquery-1.9.1.min.js',
    SITE_URL . '/apps/bootstrap-3.1.1-dist/js/bootstrap.min.js',
    SITE_URL . '/admin/js/admin.js',
    SITE_URL . '/apps/tinymce/js/tinymce/jquery.tinymce.min.js',
    SITE_URL . '/apps/tinymce/js/tinymce/tinymce.min.js'
));




$temporary = new models_DB();
$result = $temporary->get('SELECT * FROM block_area WHERE block_area_id = '.$_GET['block_area_id']);
if(empty($result)) die('Block area not exist');

$result = $result[0];



if(isset($block_area_fields)) $result = $block_area_fields;







$tpl->assign('action', 'Update');

$tpl->assign('block_area_title', $result['block_area_title']);
$tpl->assign('block_area_name', $result['block_area_name']);
$tpl->assign('block_area_description', $result['block_area_description']);


/**
 * END Read template
 */
