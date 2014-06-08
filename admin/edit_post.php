<?php
if(!defined('SECURE_CHECK')) die('Stop');

if(isset($_POST['submit_post_content']))
{
    $error_notification = '<span style="color:red">Error : </span><br />';
    $selected_post_cat_id = '';
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
        $exist_url = $obj_query->url_exists($_POST['post_url']);
        if($exist_url && $exist_url != $_GET['post_id']) 
        {
            $error_notification .= 'Your url same as certian post or category';
        }
        else
        {
            $obj_DB = new models_DB;
            if(!$obj_DB->update($post_fields, 'post', 'WHERE post_id='. $_GET['post_id'])) $error_notification .= $obj_DB->last_result_status . '<br />';
            else unset($error_notification);
        }
    }
    
    
    
    
}
/**
 * Read template
 */
 
$tpl = new views_view();

$tpl->assign('title', 'Edit post');    
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


$query_string = array(
    'post_id'       => $_GET['post_id']
);

$temporary = new models_query();
$result = $temporary->query_posts($query_string);
if(empty($result)) die('Post not exist');

$result = $result[0];



if(isset($post_fields)) $result = $post_fields;

$obj_DB = new models_DB;
$get_the_category = $obj_DB->get('SELECT * FROM term');
foreach($get_the_category as $v_get_the_category)
{
    $category_id[] = $v_get_the_category['term_id'];
    $category_name[] = $v_get_the_category['term_title'];
}




$tpl->assign('action', 'Update');
$tpl->assign('post_cat_id', $category_id);
$tpl->assign('post_cat_name', $category_name);

$tpl->assign('post_title', $result['post_title']);
$tpl->assign('post_url', $result['post_url']);
$tpl->assign('selected_post_cat_id', $result['post_cat']);
$tpl->assign('post_image', $result['post_image']);
$tpl->assign('post_content', $result['post_content']);
$tpl->assign('post_title', $result['post_title']);
$tpl->assign('post_excerpt', $result['post_excerpt']);
$tpl->assign('post_datetime', $result['post_datetime']);
$tpl->assign('post_status', $result['post_status']);



/**
 * END Read template
 */
