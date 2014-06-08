<?php
$default = array(
    'title'         => '',
    'cat'            => 1,
    'number_posts'   => 5
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>

<form id="news_cat_sidebar_form_setting" class="block_form" block_id="0">
    <label>Tiêu đề</label><br />
    <input type="text"  class="parameter"  parameter="title"  value="<?php echo $default['title'] ?>" /><br />
    
    <label>Chọn chuyên mục</label><br />
    <select class="parameter"  parameter="cat">
    <?php
        $obj_query = new models_query;
        $terms = $obj_query->query_terms(array());
        foreach($terms as $v)
        {
            ?>
            <option <?php if($default['cat'] == $v['term_id']) echo 'selected' ?> value="<?php echo $v['term_id'] ?>"><?php echo $v['term_title'] ?></option>
            <?php
        }
        
    ?>
    </select>
    <label>Số bài viết</label><br />
    <input type="text"  class="parameter"  parameter="number_posts"  value="<?php echo $default['number_posts'] ?>" />
    
    
</form>

