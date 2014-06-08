<?php
	if(!defined('SECURE_CHECK')) die('Stop');
?>
<?php
	function display_main()
    {
        global $global_current_row;
        ?>
        <div class="title-container wrap-full">
				<div class="container_inner clearfix">
					<h1><?php echo $global_current_row['term_title'] ?></h1>
                    <span class="separator small"></span>
				</div>
			</div>
        <div class="full">
            
            
        <aside id="news-sidebar" class="fl">
            <div class="danh-muc sidebar-item">
                <h3 class="title">Danh mục</h3>
                <?php views_BlockArea::display_block(208) ?>
            </div>
        </aside>
        <div id="post-content" class="fr">
            
            
            <?php 
                $obj_query = new models_query();
                $posts =  $obj_query->query_posts(array('post_cat'=>$global_current_row['term_id']));
                //h($posts);
                foreach($posts as $v)
                {
                    ?>
                    <!--
<div  class="cat-item fl">
                        <a href="<?php echo $v['post_url'] ?>" title="<?php echo $v['post_title'] ?>">
                            <img src="<?php echo SITE_URL . '/apps/timthumb/timthumb.php?src=' ?><?php echo $v['post_image'] ?>&h=152&w=220" alt="<?php echo $v['post_title'] ?>" /></a>
                        <a href="<?php echo $v['post_url'] ?>" title="<?php echo $v['post_title'] ?>" class="post_title"><?php echo $v['post_title'] ?></a>
                        <p class="post_excerpt"><?php echo $v['post_excerpt'] ?></p>
                    </div>
-->
            <div class="cat-item_news post_text">
				<h3 class="post-title-for-cat"><a href="<?php echo $v['post_url'] ?>" title="<?php echo $v['post_title'] ?>"><?php echo $v['post_title'] ?></a></h3>
	
				<p class="excerpt"><?php echo $v['post_excerpt'] ?></p>
				<a class="qbutton_holder" href="<?php echo $v['post_url'] ?>" class="qbutton">XEM TIẾP</a>
			</div>
                    <?php
                    
                }
            ?>
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