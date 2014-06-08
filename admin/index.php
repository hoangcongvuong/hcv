<?php
include dirname(dirname(__FILE__)).'/config.php';

$my_secure = new secure_secure();
$my_secure->check_admin();

define('SECURE_CHECK', true);

if(isset($_GET['action']))
{
    include '' . $_GET['action'] . '.php';
    include 'tpl/header.php';
    include 'tpl/sidebar.php';
    include 'tpl/' . $_GET['body'] . '.php';
    include 'tpl/footer.php';
}

else
{
    $tpl = new views_view();
    
    $tpl->assign('title', 'Admin Home');    
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
    
    include 'tpl/header.php';
    include 'tpl/sidebar.php';
    include 'tpl/footer.php';
}



?>