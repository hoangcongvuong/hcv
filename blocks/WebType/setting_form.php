<?php
$default = array(
    'src'       => '',
    'title'     => '',
    'link'      => ''
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>

<form  class="block_form" block_id="0">
    <div class="form-group">
        <label class="" for="name">Tiêu đề</label>
        <br />
        <input class="form-control parameter" parameter="title" type="text" value="<?php echo $default['title'] ?>" />
    </div>
    
    <div class="form-group">
        <label class="" for="name">Liên kết</label>
        <br />
        <input class="form-control parameter" parameter="link" type="text" value="<?php echo $default['link'] ?>" />
    </div>
    
    <input type="text" placeholder="src" class="parameter" id="select_image" parameter="src"  value="<?php echo $default['src'] ?>" />
    <input type="button" value="Chọn ảnh" class="show-media-frame btn btn-info" particular="select_image" /><br /><br />
    <img id="select_image_display" style="max-width: 100%;" src="<?php echo $default['src'] ?>" />
</form>

