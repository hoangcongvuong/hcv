<?php
	//$temporary_setting_parameter,$current_block_id
?>


<div id="block_<?php echo $current_block_id ?>" class="block customer fl"  <?php if($global_admin): ?> block_id="<?php echo $current_block_id ?>" block_name="<?php echo basename(dirname(__FILE__)); ?>" <?php endif; ?>>
    
    <a href="<?php echo $temporary_setting_parameter['url'] ?>" title="<?php echo $temporary_setting_parameter['title'] ?>"><img src="<?php echo SITE_URL . '/apps/timthumb/timthumb.php?src=' ?><?php echo $temporary_setting_parameter['src'] ?>&h=152&w=220" alt="<?php echo $temporary_setting_parameter['title'] ?>" /></a>
    <p class="customer-title"><?php echo $temporary_setting_parameter['title'] ?></p>
    <p class="customer-description"><?php echo $temporary_setting_parameter['description'] ?></p>

</div>


