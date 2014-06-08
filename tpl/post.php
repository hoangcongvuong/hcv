<?php
	if(!defined('SECURE_CHECK')) die('Stop');
?>
<?php
	function display_main()
    {
        global $global_current_row;
        ?>
        <div class="full">
            
            
        <aside id="news-sidebar" class="fl">
            <div class="danh-muc sidebar-item">
                <h4 class="title">Danh mục</h4>
                <?php views_BlockArea::display_block(208) ?>
            </div>
            
               
                <?php views_BlockArea::display_area('news_cat_sidebar') ?>
            
        </aside>
        <div id="post-content" class="fr">
            <h1><?php echo $global_current_row['post_title'] ?></h1>
            <?php echo $global_current_row['post_content'] ?>
        </div>
        <span class="clear"></span>
        </div>
        <?php

    }
 ?>
 
 
<?php 
    if(isset($_POST['vngit']))
    {
        display_main();
    }
    else
    {
        include 'header.php';
        ?>
        <div id="main" class="wrap-full">
        <?php
        	display_main()
        ?>
        </div>
        <?php
        	include 'footer.php';
    }
        ?>