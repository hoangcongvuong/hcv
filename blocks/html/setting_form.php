<?php
$default = array(
    'title'     => '',
    'content'   => ''
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>

<script lang="javascript" src="http://localhost/Sites/MySites/hcv/apps/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script lang="javascript" src="http://localhost/Sites/MySites/hcv/apps/tinymce/js/tinymce/tinymce.min.js"></script>
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

<form id="text_form_setting" class="block_form" block_id="0">
    <div class="form-group">
        <label class="" for="name">Tiêu đề</label>
        <br />
        <input class="form-control parameter" parameter="title" type="text" value="<?php echo $default['title'] ?>" />
    </div>
    
    <div class="form-group">
        <label class="" for="name">Nội dung</label>
        <br />
        <textarea class="form-control parameter main-content" parameter="content"><?php echo $default['content'] ?></textarea>
    </div>
</form>
	
