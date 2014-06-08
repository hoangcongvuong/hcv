<?php
	//$temporary_setting_parameter,$current_block_id
?>
<div id="block_<?php echo $current_block_id ?>" class="block news_cat_sidebar sidebar-item"  <?php if($global_admin): ?> block_id="<?php echo $current_block_id ?>" block_name="<?php echo basename(dirname(__FILE__)); ?>" <?php endif; ?>>
    <h4 class="title"><?php echo $temporary_setting_parameter['title'] ?></h4>
                
<ul>
    <?php 
        $obj_query = new models_query;
        $posts = $obj_query->query_posts(array('post_cat'=>$temporary_setting_parameter['cat']));
        foreach($posts as $v)
        {
            ?>
            <li><a href="<?php echo $v['post_url'] ?>" title="<?php echo $v['post_title'] ?>"><?php echo $v['post_title'] ?></a></li>
            <?php
        }
    ?>
</ul>            

</div>

