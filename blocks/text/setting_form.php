<?php
$default = array(
    'title'     => '',
    'content'   => ''
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>
<form id="text_form_setting" class="block_form" block_id="0">
    <div class="form-group">
        <label class="" for="name">Tiêu đề</label>
        <br />
        <input class="form-control parameter" parameter="title" type="text" value="<?php echo $default['title'] ?>" />
    </div>
    
    <div class="form-group">
        <label class="" for="name">Nội dung</label>
        <br />
        <textarea class="form-control parameter" parameter="content"><?php echo $default['content'] ?></textarea>
    </div>
</form>
	
