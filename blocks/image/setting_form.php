<?php
$default = array(
    'src'      => ''
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>

<form id="image_form_setting" class="block_form" block_id="0">
    <input type="text" placeholder="src" class="parameter" id="select_image" parameter="src"  value="<?php echo $default['src'] ?>" />
    
    <input type="button" value="Chọn ảnh" class="show-media-frame btn btn-info" particular="select_image" /><br /><br />
    <img id="select_image_display" style="max-width: 100%;" src="<?php echo $default['src'] ?>" />
</form>

