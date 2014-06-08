<?php
include dirname(dirname(dirname(__FILE__))) . '/config.php';
$my_secure = new secure_secure();
$my_secure->check_admin();

/**
 * Read template
 */
$tpl = new views_view();

$tpl->assign('title', 'Insert By Link');    
$tpl->assign('css', array(
    SITE_URL . '/apps/bootstrap-3.1.1-dist/css/bootstrap.min.css',
    SITE_URL . '/admin/' . 'css/admin.css',
    '../uploads.css'
));
$tpl->assign('script',array(
    SITE_URL . '/apps/js/jquery-1.9.1.min.js',
    SITE_URL . '/apps/bootstrap-3.1.1-dist/js/bootstrap.min.js',
    '../uploads.js'
));
include 'header.php';
/**
 * END Read template
 */     
?>


<div class="container">
<?php include 'sidebar.php' ?>
<h1 class="title"><?php echo $tpl->variable['title'] ?></h1>
<div class="row">
    <form class="col-xs-12" id="insert_by_link_form"  method="POST">
        <label class="" for="link_insert">Link : </label><br />
        <input class="form-control" id="link_insert" value="" type="text" name="link_insert" /><br />
        
        <label class="" for="title">Title</label><br />
        <input class="form-control title" id="title" value="" type="text" name="title" /><br />
        
        <label class="" for="alt">Alt</label><br />
        <input class="form-control alt" id="alt" value="" type="text" name="alt" /><br />
    </form>
    <div class="col-xs-12" id="display"><img src="" style="max-width: 100%;" /></div>
</div>
<div style="bottom: 0;" class="row absolute none">
    <label><input type="checkbox"   id="insert_br_tag" />Auto line break after each Image</label>
</div>
</div>
<?php include 'footer.php' ?>