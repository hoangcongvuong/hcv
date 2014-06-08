<?php
	//$temporary_setting_parameter,, $current_block_id
?>
<div id="<?php echo $current_block_id ?>"  class="block_text block"  <?php if($global_admin): ?> block_id="<?php echo $current_block_id ?>" block_name="<?php echo basename(dirname(__FILE__)); ?>" <?php endif; ?>>
    <?php if(!empty($temporary_setting_parameter['title'])) : ?>
    <h3><?php echo $temporary_setting_parameter['title'] ?></h3>
    <?php endif; ?>
    <p>
    <?php 
        echo $temporary_setting_parameter['content']
    ?>
    </p>
    
</div>
