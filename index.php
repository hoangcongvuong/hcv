<?php
include dirname(__FILE__) . '/config.php';
define('SECURE_CHECK', true);

$obj_url = new controllers_ConvertURL;

$obj_query = new models_query;

//echo $obj_url->real_url;
$global_real_current_url = $obj_url->real_url;



if($obj_url->real_url == '' || $obj_url->real_url == 'index.php')
{
    $global_url_type = 'home';
    include 'tpl/home.php';
    exit;
}

$terms = $obj_query->query_terms(array('term_url'=>$obj_url->real_url));

if(!empty($terms)) 
{
    $global_url_type = 'term';
    $global_current_row = $terms[0];
    include 'tpl/term.php';
    exit;
}


$posts = $obj_query->query_posts(array('post_url'=>$obj_url->real_url));

if(!empty($posts))
{
    $global_url_type = 'post';
    $global_current_row = $posts[0];
    //h($global_current_row);
    include 'tpl/post.php';
    exit;
}



include 'tpl/404.php';
