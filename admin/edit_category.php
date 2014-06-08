<?php
if(!defined('SECURE_CHECK')) die('Stop');

if(isset($_POST['submit_category_content']))
{
    $error_notification = '<span style="color:red">Error : </span><br />';
    
    
    
 
    $category_fields = array(
        'term_title'                   => $_POST['category_title'],
        'term_url'                     => $_POST['category_url'],
        'term_description'             => $_POST['category_description'],
        'term_image'                   => $_POST['category_image'],
        'term_parent_category'         => $_POST['parent_category'],
        'term_secure_key'              => random_string()
    );
    
    if( $_POST['category_url'] == '' )
    {
        $error_notification .= '- Your url is empty<br />';
    }
    
    else
    {
        $obj_query = new models_query;
        $exist_url = $obj_query->url_exists($_POST['category_url']);
        if($exist_url && $exist_url != $_GET['category_id']) 
        {
            $error_notification .= 'Your url same as certian category or category';
        }
        else
        {
            $obj_DB = new models_DB;
            if(!$obj_DB->update($category_fields, 'term', 'WHERE term_id='. $_GET['category_id'])) $error_notification .= $obj_DB->last_result_status . '<br />';
            else ($error_notification .= 'Category updated');
        }
    }
}
/**
 * Read template
 */
 
$tpl = new views_view();

$tpl->assign('title', 'Edit Category');    
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
    'term_id'       => $_GET['category_id']
);

$temporary = new models_query();
$result = $temporary->query_terms($query_string);
if(empty($result)) die('Category not exist');

$result = $result[0];



if(isset($category_fields)) $result = $category_fields;

$obj_DB = new models_DB;
$get_the_category = $obj_DB->get('SELECT * FROM term');
foreach($get_the_category as $v_get_the_category)
{
    $category_id[] = $v_get_the_category['term_id'];
    $category_name[] = $v_get_the_category['term_title'];
}




$tpl->assign('action', 'Update');
$tpl->assign('category_id', $category_id);
$tpl->assign('category_name', $category_name);

$tpl->assign('category_title', $result['term_title']);
$tpl->assign('category_url', $result['term_url']);
$tpl->assign('parent_category', $result['term_parent_category']);
$tpl->assign('category_image', $result['term_image']);
$tpl->assign('category_description', $result['term_description']);



/**
 * END Read template
 */
