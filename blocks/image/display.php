<?php
	//$temporary_setting_parameter,$current_block_id
?>
<div id="<?php echo $current_block_id ?>" class="block"  <?php if($global_admin): ?> block_id="<?php echo $current_block_id ?>" block_name="<?php echo basename(dirname(__FILE__)); ?>" <?php endif; ?>>
    <img   src="<?php echo $temporary_setting_parameter['src'] ?>" />
    

</div>
