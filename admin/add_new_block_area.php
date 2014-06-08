<?php
if(!defined('SECURE_CHECK')) die('Stop');


if(isset($_POST['submit_block_area']))
{
    /**
     * Error notification and all mysql statement
     */
    $error_notification = '<span style="color:red">Error : </span><br />';
    $hcv_sql_statement = '';
    $sql_statement = '';
    
    $obj_DB = new models_DB;
    

   
    
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
        if($obj_query->row_exists('block_area_name', $_POST['block_area_name'], 'block_area')) $error_notification .= 'Your url already exists';
       
        else
        {
            if(!$obj_DB->insert($block_area_fields, 'block_area')) 
            {
                $error_notification .= $obj_DB->last_result_status;
            }    
            else
            {   
                $current_area = $obj_DB->get("SELECT * FROM block_area WHERE block_area_name='" . $_POST['block_area_name'] . '\'');
                header('Location: index.php?action=edit_block_area&body=block_area_form&block_area_id='. $current_area[0]['block_area_id'] . '&messenger=1');
            }
        }
        
        
    }
}

/**
 * Read template
 */
$tpl = new views_view();

$tpl->assign('title', 'Add new Block Area');    
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
    //SITE_URL . '/apps/tinymce3/tinymce/jscripts/tiny_mce/tiny_mce.js'
));






$tpl->assign('action', 'Add');

if(isset($block_area_fields['block_area_title'])) $tpl->assign('block_area_title', $block_area_fields['block_area_title']);
else $tpl->assign('block_area_title', '');

if(isset($block_area_fields['block_area_name'])) $tpl->assign('block_area_name', $block_area_fields['block_area_name']);
else $tpl->assign('block_area_name', '');

if(isset($block_area_fields['block_area_description'])) $tpl->assign('block_area_description', $block_area_fields['block_area_description']);
else $tpl->assign('block_area_description', '');




/**
 * END Read template
 */