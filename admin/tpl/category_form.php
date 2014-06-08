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
                    <p style="padding: 5px 10px;margin-top:10px;" class="form-group bg-success"><?php echo 'Category added' ?></p>
                    <?php endif;  ?>
                    
                    <?php if(isset($_GET['messenger']) && ($_GET['messenger'] == '2')) : ?>
                    <p style="padding: 5px 10px;margin-top:10px;" class="form-group bg-success"><?php echo 'Category updated' ?></p>
                    <?php endif;  ?>
                    
                    <p class="form-group form-box">
                    <label class="" for="name">Tiêu đề</label>
                    <br />
                    <input class="form-control the_title" id="category_title" value="<?php echo $tpl->variable['category_title'] ?>" type="text" name="category_title" /><br />
                    <input class="the_url fr <?php echo $tpl->variable['action'] ?>" placeholder="Url" id="category_url" value="<?php echo $tpl->variable['category_url'] ?>" type="text" name="category_url" />
                    <span class="clear"></span>
                    </p><br />
                    
                     
                    <p class="form-group form-box">
                        <label class="" for="category_description">Miêu tả</label>
                        <br />
                        <textarea class="main-content" style="width: 98%;max-width:98%;min-height:350px" id="category_description" name="category_description"><?php echo $tpl->variable['category_description'] ?></textarea>
                        <noscript>Javascript is disable. Use only html mode.</noscript>
                    </p><br />
                </div>
                
                <div class="col-xs-12">
                    
                
                    <p class="form-group form-box">
                        <label class="category_feature_image" for="category_image">Ảnh đại diện</label>
                        <br />
                        <span class="show-media-frame btn btn-info" particular="category_image">Chọn ảnh</span><br /><br />
                        <input type="hidden" value="<?php echo $tpl->variable['category_image'] ?>" id="category_image" name="category_image" />
                        <img id="category_image_display" style="max-width: 100%;" src="<?php echo $tpl->variable['category_image'] ?>" />
                    </p><br />
                    
                    
                    <div class="form-group form-box">
                        <label class="categories" for="categories">Chuyên mục cha</label>
                        
                        <select class="form-control" name="parent_category">
                            <option <?php if($tpl->variable['parent_category'] == '' ) echo 'selected' ?> value="">None</option>
                        <?php
                            foreach($tpl->variable['category_id'] as $v_key => $v_value)
                            {
                                ?>
                                    
                                <option <?php if($tpl->variable['parent_category'] == $v_value ) echo 'selected' ?> value="<?php echo $v_value ?>"><?php echo $tpl->variable['category_name'][$v_key] ?></option>
                        
                        
                                <?php
                            }
                        ?>
                        </select>
                        <span class="clear"></span>
                    </div><br />
                    
         
                    <div class="form-box form-group ">
                       
                        <input class="btn btn-primary" name="submit_category_content" id="submit_category_content" type="submit" value="<?php echo $tpl->variable['action'] ?>" />
                    </div>
                    

                
                </div>
                <span class="clear"></span>
            </form>

        </div>
    
