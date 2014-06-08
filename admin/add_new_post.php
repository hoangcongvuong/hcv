<?php
if(!defined('SECURE_CHECK')) die('Stop');

if(isset($_POST['submit_post_content']))
{
    /**
     * Error notification and all mysql statement
     */
    $error_notification = '<span style="color:red">Error : </span><br />';
    $hcv_sql_statement = '';
    $sql_statement = '';
    
    $obj_DB = new models_DB;

    $selected_post_cat_id = '';  // Selected categories in new post form
    if(!isset($_POST['post_cat'])) $selected_post_cat_id = '1';
    else
    {
        foreach( $_POST['post_cat'] as $k=>$v)
        {
            if( $k == 0 ) $selected_post_cat_id .= $v;
            else $selected_post_cat_id .= ',' . $v;
        }
    }


    $datetime = '';
    $date = $_POST['post_date'];
    $time = $_POST['post_time'];    
    $date = $date['year'] . '-' . $date['month'] . '-' . $date['day'];
    $time = $time['hour'] . ':' . $time['minute'] . ':00';
    $datetime = $date . ' ' . $time;
    
    $post_fields = array(
        'post_title'                   => $_POST['post_title'],
        'post_url'                     => $_POST['post_url'],
        'post_content'                 => $_POST['post_content'],
        'post_image'                   => $_POST['post_image'],
        'post_cat'                     => $selected_post_cat_id,
        'post_excerpt'                 => $_POST['post_excerpt'],
        'post_secure_key'              => random_string(),
        'post_datetime'                => $datetime,
        'post_status'                  => $_POST['post_status']
    );
    
    
  
    
    if( $_POST['post_url'] == '' )
    {
        $error_notification .= '- Your url is empty<br />';
    }
    else
    {
        $obj_query = new models_query;
        $query_terms = array();
        ///echo $obj_query->url_exists($_POST['post_url']);
        if($obj_query->url_exists($_POST['post_url']) == true ) $error_notification .= 'Your url already exists';
       
        else
        {
            if(!$obj_DB->insert($post_fields, 'post')) 
            {
                $error_notification .= $obj_DB->last_result_status;
            }    
            else
            {
                $current_post = 'SELECT post_id FROM post WHERE post_url=\'' . $_POST['post_url'] . '\'';
                $post_id = $obj_DB->get($current_post);
                $post_id = $post_id[0]['post_id'];
                
                header('Location: index.php?action=edit_post&body=post_form&post_id='.$post_id);
            }
        }
        
        
    }
}

/**
 * Read template
 */
$tpl = new views_view();

$tpl->assign('title', 'Add new post');    
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


$obj_query = new models_query;
$query_terms = array();
$get_the_category = $obj_query->query_terms($query_terms);

foreach($get_the_category as $v_get_the_category)
{
    $category_id[] = $v_get_the_category['term_id'];
    $category_name[] = $v_get_the_category['term_title'];
}

$tpl->assign('action', 'Publish');

$tpl->assign('post_cat_id', $category_id);
$tpl->assign('post_cat_name', $category_name);

if(isset($post_fields['post_title'])) $tpl->assign('post_title', $post_fields['post_title']);
else $tpl->assign('post_title', '');

if(isset($post_fields['post_url'])) $tpl->assign('post_url', $post_fields['post_url']);
else $tpl->assign('post_url', '');

if(isset($post_fields['selected_post_cat_id'])) $tpl->assign('selected_post_cat_id', $selected_post_cat_id);
else $tpl->assign('selected_post_cat_id', '');

if(isset($post_fields['post_image'])) $tpl->assign('post_image', $post_fields['post_image']);
else $tpl->assign('post_image', '');

if(isset($post_fields['post_content'])) $tpl->assign('post_content', $post_fields['post_content']);
else $tpl->assign('post_content', '');

if(isset($post_fields['post_excerpt'])) $tpl->assign('post_excerpt', $post_fields['post_excerpt']);
else $tpl->assign('post_excerpt', '');

if(isset($post_fields['post_datetime'])) $tpl->assign('post_datetime', $post_fields['post_datetime']);
else $tpl->assign('post_datetime', date('Y') . '-' . date('m'). '-' . date('d') . ' ' . date('G') . ':' . date('s'));

if(isset($post_fields['post_status'])) $tpl->assign('post_status', $post_fields['post_status']);
else $tpl->assign('post_status', '');
/**
 * END Read template
 */