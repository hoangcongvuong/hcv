<?php
	if(!defined('SECURE_CHECK')) die('Stop');
?>

        <div id="form_content" class="col-xs-8 col-md-10 text-left clearfix">
             
             <form  role="form"  action="" method="POST">
                
                <div class="col-xs-12">
                    <?php if(isset($error_notification) && ($error_notification != '')) : ?>
                    <p style="padding: 5px 10px;margin-top:10px;" class="form-group bg-danger"><?php echo $error_notification ?></p>
                    <?php endif;  ?>
                    
                    <p class="form-group form-box">
                    <label class="" for="name">Tiêu đề bài viết</label>
                    <br />
                    <input class="the_title form-control" id="post_title" value="<?php echo $tpl->variable['post_title'] ?>" type="text" name="post_title" /><br />
                    <input class="the_url fr <?php echo $tpl->variable['action'] ?>" placeholder="Url" id="post_url" value="<?php echo $tpl->variable['post_url'] ?>" type="text" name="post_url" />
                    <span class="clear"></span>
                    </p><br />
                    
                     
                    <p class="form-group form-box">
                        <label class="" for="post_content">Nội dung</label>
                        <br />
                        <textarea class="main-content"  style="width: 98%;max-width:98%;min-height:350px" id="post_content" name="post_content"><?php echo $tpl->variable['post_content'] ?></textarea>
                        <noscript>Javascript is disable. Use only html mode.</noscript>
                    </p><br />
                </div>
                
                <div class="col-xs-12">
                    
                
                    <p class="form-group form-box">
                        <label class="post_feature_image" for="post_image">Ảnh đại diện</label>
                        <br />
                        <span class="show-media-frame btn btn-info" particular="post_image">Chọn ảnh</span><br /><br />
                        <input type="hidden" value="<?php echo $tpl->variable['post_image'] ?>" id="post_image" name="post_image" />
                        <img id="post_image_display" style="max-width: 100%;" src="<?php echo $tpl->variable['post_image'] ?>" />
                    </p><br />
                    
                    
                    <div class="form-group form-box">
                        <label class="categories" for="categories">Chuyên mục</label>
                        
                        
                        <?php
                            foreach($tpl->variable['post_cat_id'] as $v_key => $v_value)
                            {
                                ?>
                        <div  class="checkbox">
                            <label><input type="checkbox" <?php if(in_array($v_value, explode(',',$tpl->variable['selected_post_cat_id']))) echo 'checked' ?>  name="post_cat[]" value="<?php echo $tpl->variable['post_cat_id'][$v_key] ?>" /> <?php echo $tpl->variable['post_cat_name'][$v_key] ?></label>
                        </div>
                        
                                <?php
                            }
                        ?>
                        <span class="clear"></span>
                    </div><br />
                    
                    <p class="form-group form-box">
                        <label class="excerpt" for="excerpt">Excerpt</label>
                        <br />
                        <textarea name="post_excerpt" class="form-control"><?php echo $tpl->variable['post_excerpt'] ?></textarea>
                    </p><br />
                    
                    
                    <?php
                       $active_datetime = explode(' ', $tpl->variable['post_datetime']);
                       $active_date = explode('-', $active_datetime[0]);
                       $active_time = explode(':', $active_datetime[1]);
                    ?>
                    <div class="form-group form-box datetime">
                        <label class="excerpt" for="excerpt">Cài đặt thời gian</label><br />
                        <input type="number" class="time my-form-control" maxlength="2" name="post_time[hour]" value="<?php echo $active_time[0] ?>" /> : 
                        <input class="time my-form-control" maxlength="2" name="post_time[minute]" value="<?php echo $active_time[1] ?>" />
                        @
                        <select class="date my-form-control" name="post_date[day]">
                            <?php 
                                for($i=1;$i<=31;$i++) 
                                {
                                    ?>
                                    <option <?php if($active_date[2]==$i) echo 'selected' ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <select class="date my-form-control" name="post_date[month]">
                            <?php 
                                for($i=1;$i<=12;$i++) 
                                {
                                    ?>
                                    <option  <?php if($active_date[1]==$i) echo 'selected' ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <select class="date my-form-control" style="max-width: 80px;" name="post_date[year]">
                            <?php 
                                for($i=2014;$i<=2015;$i++) 
                                {
                                    ?>
                                    <option <?php if($active_date[0]==$i) echo 'selected' ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                            ?>
                        </select><br /><br />
                        
                        
                            
                        
                    </div>
                    
                    <div class="form-box form-group ">
                        <label class="post_status" for="post_status">Đánh dấu</label><br />
                            <select class="post_status my-form-control" style="max-width: 120px;" name="post_status" id="post_status">
                                <option <?php if($tpl->variable['post_status'] == 'published') echo 'selected'; ?> value="published">Published</option>
                                <option <?php if($tpl->variable['post_status'] == 'pedding') echo 'selected'; ?> value="pedding">Pedding</option>
                                <option <?php if($tpl->variable['post_status'] == 'draft') echo 'selected'; ?> value="draft">Draft</option>
                                <option <?php if($tpl->variable['post_status'] == 'trash') echo 'selected'; ?> value="trash">Trash</option>
                            </select>
                        <br /><br />
                        <input class="btn btn-primary" name="submit_post_content" id="submit_post_content" type="submit" value="<?php echo $tpl->variable['action'] ?>" />
                    </div>
                
                </div>
                <span class="clear"></span>
            </form>

        </div>
    
