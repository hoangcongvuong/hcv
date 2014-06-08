<?php
	if(!defined('SECURE_CHECK')) die('Stop');
?>
<?php
$moment = array(
    'order'     => 'desc'
);
$obj_query = new models_query();
?>
<div id="notification" class="col-table bg-success col-xs-7 col-md-9 text-left"></div>
<div class="all fl col-xs-12 col-md-9">

    <header>
        
        <div class="stt  fl">STT</div>
        <div class="id  fl">ID</div>
        <div class="post_title fl">Title</div>


        <div class="image  fl">Image</div>
        <div class="action fl">Action</div>
        <span class="clear"></span>
    </header>
    
    <section class="body">

<?php
foreach($obj_query->query_terms($moment) as $k_terms=>$v_terms)
{
    $k_terms++;
    ?>
    
    <div class="body-item" particular="<?php echo $v_terms['term_id'] ?>">
        <div class="stt  fl"><?php echo $k_terms; ?></div>
        <div class="id  fl"><?php echo $v_terms['term_id'] ?></div>
        <div class="post_title fl"><?php echo $v_terms['term_title'] ?></div>


        <div class="image text-center fl"><img style="max-height: 50px;max-width:50px;"  src="<?php echo $v_terms['term_image'] ?>"/></div>
        <div class="action fl">
            <a class="fl" href="?action=edit_category&category_id=<?php echo $v_terms['term_id'] ?>&body=category_form">Edit</a>
            <a class="fl" href="<?php echo SITE_URL . '/' . $v_terms['term_url'] ?>">View</a>
            <span class="delete_category delete fr">Delete</span> 
        </div>
        <span class="clear"></span>
    </div>    
    
    <?php
}

?>
    </section>
</div>