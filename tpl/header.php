<?php
	if(!defined('SECURE_CHECK')) die('Stop');
?>
<!DOCTYPE html>
<html>
<head>

<title>
<?php 
    if($global_url_type == 'home') echo 'Trang chủ';
    if($global_url_type == 'term')
    {
        echo $global_current_row['term_title'];
    }
    if($global_url_type == 'post')
    {
        echo $global_current_row['post_title'];
    }
?>
</title>

<meta charset="utf-8" />
<meta name="author" content="Vngit" />
<meta name="generator" content="Vngit" />
<meta name="application-name" content="Dịch vụ thiết kế web" />

<link rel="icon" href="tpl/images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="tpl/css/reset.css" type="text/css" />


<link rel="stylesheet" href="tpl/css/common.css" />
<link rel="stylesheet" href="tpl/css/css.css" />
<link rel="stylesheet" href="<?php echo SITE_URL . '/blocks/Customer/Customer.css' ?>" />

<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

<script src="tpl/js/jquery-1.10.2.js"></script>
<script src="tpl/js/js.js"></script>  
</head>
<body>
<div class="opacity"></div>
<div id="media-frame" class="fixed none">
<div class="fr frame-action"><span class="submit-frame btn btn-primary">Chọn</span>&nbsp;&nbsp;<span class="close-frame btn btn-default">Đóng</span></div>
</div>

<div class="full" style="margin-top: 6px;">
    <div id="logo" class="fl">
        <?php views_BlockArea::display_area('logo') ?>
    </div>
    <div id="top-menu" class="fl">
        <div class="fl hotline"><?php views_BlockArea::display_area('top-hot-line') ?></div>
        <div class="fl menu"><?php views_BlockArea::display_area('top-menu') ?></div>
        <div class="fl tryit"><?php views_BlockArea::display_area('top-try-it') ?></div>
        
    </div>
    

    <div id="main-menu">
        <?php views_BlockArea::display_area('main-menu') ?>
        <span class="clear"></span>
    </div>
        
    <div class="fixed border-top"></div>
    <span class="clear"></span>
</div>

<?php vngit_header() ?>