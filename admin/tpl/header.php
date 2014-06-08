<?php
	if(!defined('SECURE_CHECK')) die('Stop');
?>

<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $tpl->variable['title'] ?></title>

<meta http-equiv="content-type" content="text/html" />
<meta name="author" content="HCV" />
<meta charset="utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<?php foreach($tpl->variable['css'] as $v_css) { ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $v_css ?>" />
<?php } ?>
<!-- Đây là phần hỗ trợ HTML5 và Reponsive trên IE8 -->
<!-- Chú ý: Respond.js không hoạt động đối với dạng :// chúng ta nên dùng http:// hoặc https:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<style>
    <?php echo '.', $_GET['action'] ?>{
        padding-left: 40px!important;
        text-decoration: none!important;
        color: rgb(41, 222, 221)!important;
    }
</style>

<?php foreach($tpl->variable['script'] as $v_script) { ?>
    <script lang="javascript" src="<?php echo $v_script ?>"></script>
<?php } ?>

<script>

     
     
    tinymce.init({
    selector: ".main-content",
    skin:"custom",
    plugins: [
        "advlist autolink lists link charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu wordcount hcv_upload"
    ],
    menu : { // this is the complete default configuration
        ///file   : {title : 'File'  , items : 'newdocument'},
        //edit   : {title : 'Edit'  , items : 'undo redo | cut copy paste pastetext | selectall'},
        //insert : {title : 'Insert', items : 'link media | template hr'},
        //view   : {title : 'View'  , items : 'visualaid'},
        format : {title : 'Format', items : 'strikethrough superscript subscript | removeformat'},
        table  : {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
        tools  : {title : 'Tools' , items : 'spellchecker'}
    },
    toolbar: "undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link | hcv_upload | code"
});
</script>

</head>
<body class="">
<div id="media-frame" class="fixed none">
<div class="fr frame-action"><span class="submit-frame btn btn-primary">Chọn</span>&nbsp;&nbsp;<span class="close-frame btn btn-default">Đóng</span></div>
</div>
<div class="opacity fixed opacity-frame">

</div>
<body class="">
<div class="container-fluid text-center">
    <div class="row">