<?php
	if(!defined('SECURE_CHECK')) die('Stop');
?>

        <div id="form_content" class="col-xs-8 col-md-10 text-left clearfix">
             
             <form  role="form"  action="" method="post">
                
                <div class="col-xs-12">
                    <?php if(isset($error_notification) && ($error_notification != '')) : ?>
                    <p style="padding: 5px 10px;margin-top:10px;" class="form-group bg-danger"><?php echo $error_notification ?></p>
                    <?php endif;  ?>
                    
                    <?php if(isset($_GET['messenger']) && ($_GET['messenger'] == '1')) : ?>
                    <p style="padding: 5px 10px;margin-top:10px;" class="form-group bg-success"><?php echo 'Block area added' ?></p>
                    <?php endif;  ?>
                    
                    <?php if(isset($_GET['messenger']) && ($_GET['messenger'] == '2')) : ?>
                    <p style="padding: 5px 10px;margin-top:10px;" class="form-group bg-success"><?php echo 'Block area updated' ?></p>
                    <?php endif;  ?>
                    
                    <p class="form-group form-box">
                    <label class="" for="name">Tiêu đề</label>
                    <br />
                    <input class="form-control the_title" id="block_area_title" value="<?php echo $tpl->variable['block_area_title'] ?>" type="text" name="block_area_title" /><br />
                    <input class="the_url fr <?php echo $tpl->variable['action'] ?>" placeholder="Url" id="block_area_name" value="<?php echo $tpl->variable['block_area_name'] ?>" type="text" name="block_area_name" />
                    <span class="clear"></span>
                    </p><br />
                    
                     
                    <p class="form-group form-box">
                        <label class="" for="block_area_description">Miêu tả</label>
                        <br />
                        <textarea class="" style="width: 98%;max-width:98%;min-height:150px" id="block_area_description" name="block_area_description"><?php echo $tpl->variable['block_area_description'] ?></textarea>
                        <noscript>Javascript is disable. Use only html mode.</noscript>
                    </p><br />
                </div>
                
                <div class="col-xs-12">
                    
                
         
                    <div class="form-box form-group ">
                       
                        <input class="btn btn-primary" name="submit_block_area" id="submit_block_area" type="submit" value="<?php echo $tpl->variable['action'] ?>" />
                    </div>
                    

                
                </div>
                <span class="clear"></span>
            </form>

        </div>
    
