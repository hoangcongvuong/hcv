<?php

	//$temporary_setting_parameter,$current_block_id
?>
<div id="block_<?php echo $current_block_id ?>" class="block web-type relative"  <?php if(is_admin()): ?> block_id="<?php echo $current_block_id ?>" block_name="<?php echo basename(dirname(__FILE__)); ?>" <?php endif; ?>>
    <a href="<?php echo $temporary_setting_parameter['link'] ?>"><img  class="absolute" src="<?php echo SITE_URL . '/apps/timthumb/timthumb.php?src=' ?><?php echo $temporary_setting_parameter['src'] ?>&h=162&w=238" /></a>
    
    <a class="title absolute" style="display: block;" href="<?php echo $temporary_setting_parameter['link'] ?>"><span>Web</span> <?php echo $temporary_setting_parameter['title'] ?></a>
    
    <p class="bg absolute"></p>
    <span class="conner0 absolute"></span>
    <span class="conner1 absolute"></span>

</div>
