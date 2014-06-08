<?php
include dirname(dirname(__FILE__)).'/config.php';
if(isset($_POST['submit']))
{
    secure_secure::check_login($_POST['name'], $_POST['password']);    
}
define('SECURE_CHECK', true);
?>
<?php
/**
 * Read template
 */
$tpl = new views_view();

$tpl->assign('title', 'Login');    
$tpl->assign('css', array(
    SITE_URL . '/apps/bootstrap-3.1.1-dist/css/bootstrap.min.css',
    SITE_URL . '/admin/' . 'css/reset.css',
    SITE_URL . '/admin/' . 'css/admin.css'
));
$tpl->assign('script',array(
    SITE_URL . '/apps/js/jquery-1.9.1.min.js',
    SITE_URL . '/apps/bootstrap-3.1.1-dist/js/bootstrap.min.js'
));


include 'tpl/header.php';
include 'tpl/login_body.php';
include 'tpl/footer.php';
//$tpl->display('header.php');
/**
 * END Read template
 */
 
//$smarty = new Smarty();
//$smarty->setTemplateDir('tpl');
//$smarty->setCompileDir('c_tpl');
//$smarty->assign('title', 'Login');
//$smarty->assign('script', array(
//    SITE_URL . '/apps/js/jquery-1.9.1.min.js',
//    SITE_URL . '/apps/bootstrap-3.1.1-dist/js/bootstrap.min.js'
//));
//$smarty->assign('css', array(
//    SITE_URL . '/apps/bootstrap-3.1.1-dist/css/bootstrap.min.css',
//    SITE_URL . '/admin/' . 'css/admin.css'
//));
//$smarty->display('header.tpl')
?>