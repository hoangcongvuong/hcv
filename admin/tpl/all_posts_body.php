<?php
	if(!defined('SECURE_CHECK')) die('Stop');
?>
<?php
$temporary = array(
    'order'     => 'desc'
);
$posts = new models_query($temporary);
?>
<div id="notification" class="col-table bg-success col-xs-7 col-md-9 text-left"></div>
<div class="all fl col-xs-12 col-md-9">

    <header>
        
        <div class="stt  fl">STT</div>
        <div class="id  fl">ID</div>
        <div class="post_title fl">Title</div>
        <div class="cat fl">Categories</div>

        <div class="image  fl">Image</div>
        <div class="action fl">Action</div>
        <span class="clear"></span>
        
    </header>
    
    <section class="body">

<?php
foreach($posts->query_posts($temporary) as $k_posts=>$v_posts)
{
    $k_posts++;
    ?>

    <div class="body-item" particular="<?php echo $v_posts['post_id'] ?>" secure="<?php echo $v_posts['post_secure_key'] ?>">
        <div class="stt  fl"><?php echo $k_posts; ?></div>
        <div class="id  fl"><?php echo $v_posts['post_id'] ?></div>
        <div class="post_title fl"><?php echo $v_posts['post_title'] ?></div>
        <!--
<div class="url"><?php echo $v_posts['post_url'] ?></div>
-->
        <div class="cat fl"><?php echo $v_posts['post_cat'] ?></div>
        <div class="image text-center fl"><img style="max-height: 50px;max-width:50px;"  src="<?php echo $v_posts['post_image'] ?>"/></div>
        <div class="action fl">
            <a class="fl" href="?action=edit_post&post_id=<?php echo $v_posts['post_id'] ?>&body=post_form">Edit</a>
            <a class="fl" href="<?php echo SITE_URL . '/' . $v_posts['post_url'] ?>">View</a> 
            <span class="delete_post delete fr">Delete</span> 
        </div>
        <span class="clear"></span>
    </div>
    
    <?php
}

?>
     </section>
</div>