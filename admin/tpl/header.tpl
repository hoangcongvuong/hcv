<!DOCTYPE HTML>
<html>
<head>
    <title>{$title}</title>
	
    <meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="HCV" />
    <meta charset="utf-8" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    {foreach from $css item = $v_css)}
        <link type="text/css" rel="stylesheet" href="{$v_css}" />
    {/foreach}
    <!-- Đây là phần hỗ trợ HTML5 và Reponsive trên IE8 -->
    <!-- Chú ý: Respond.js không hoạt động đối với dạng :// chúng ta nên dùng http:// hoặc https:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    {foreach from $script item = $v_script}
        <script lang="javascript" src="<?php echo $v_script ?>"></script>
    {/foreach}
</head>
<body class="">
<div id="media-frame" class="fixed none">
<div class="fr frame-action"><span class="submit-frame btn btn-primary">Chọn</span>&nbsp;&nbsp;<span class="close-frame btn btn-default">Đóng</span></div>
</div>
<div class="opacity fixed opacity-frame">

</div>