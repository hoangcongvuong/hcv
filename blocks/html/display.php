<?php
	//$temporary_setting_parameter,, $current_block_id
?>
<link rel="stylesheet" type="text/css" href="http://www.bizweb.vn/Themes/Portal/Default/Styles/main.css?4.0.29" />
<div id="<?php echo $current_block_id ?>"  class="block_text block"  <?php if(is_admin()): ?> block_id="<?php echo $current_block_id ?>" block_name="<?php echo basename(dirname(__FILE__)); ?>" <?php endif; ?>>
    
    <div>
    <?php 
        echo $temporary_setting_parameter['content']
    ?>
    </div>
    
    <?php block_action() ?>
</div>
