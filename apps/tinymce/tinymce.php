<script src="<?php echo SITE_URL ?>/apps/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo SITE_URL ?>/apps/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script src="<?php echo SITE_URL ?>/apps/tinymce/js/tinymce/tinymce.min.js"></script>

<style>
    .align-center{
        display:block;
        margin:auto;
    }
    
    .align-left{
        display:block;
        float:left;
    }
    
    .align-right{
        display:block;
        float:right;
}
</style>

<script>
        tinymce.init({
            selector:'#tinymce_contents',
            image_advtab: true,
            width: '99%',
            height: '400',
            theme : 'modern',
            visual: true,
            plugins: "test, link, textcolor, table, media, charmap, code, fullscreen,",
            toolbar: "tes1t | forecolor backcolor | charmap | code | fullscreen",
            tools: "inserttable | code"
         });
</script>

<textarea style="width: 98%;max-width:98%" id="tinymce_contents" name="tinymce_contents"></textarea>
<noscript>Javascript is disable. Use only html mode.</noscript>
        
        
