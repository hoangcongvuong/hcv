<?php
class views_BlockArea
{
    public static function display_area($block_area_name)
    {
        global $global_admin;
        ?>
        <div class="block_area  area_<?php echo $block_area_name ?><?php if(is_admin()) echo ' sortable' ?>" block_area_name="<?php echo $block_area_name ?>">
            <?php
            $obj_DB= new models_DB;
            $block_area_content = $obj_DB->get('SELECT * FROM block_area WHERE block_area_name=\'' . $block_area_name . '\'');
            //h($block_area_content);
            if(!empty($block_area_content[0]['block_area_content']))
            {
                $block_area_content = explode(',', $block_area_content[0]['block_area_content']);
                if(!empty($block_area_content))
                {
                    foreach($block_area_content as $v)
                    {
                        $block_content = $obj_DB->get('SELECT * FROM block WHERE block_id = ' . $v);
                        $block_content = $block_content[0];
                        $temporary_setting_parameter = unserialize($block_content['block_parameter']);
                        $current_block_id = $v;
                        include PATH_ROOT . '/blocks/' . $block_content['block_name'] . '/display.php';
                    } 
                }               
            }	
            ?>
        </div>    
        <?php
    }
    
    public static function display_block($block_id)
    {
        global $global_admin;
        $obj_DB= new models_DB;
        $block_content = $obj_DB->get('SELECT * FROM block WHERE block_id = ' . $block_id);
        $block_content = $block_content[0];
        $temporary_setting_parameter = unserialize($block_content['block_parameter']);
        $current_block_id = $block_id;
        include PATH_ROOT . '/blocks/' . $block_content['block_name'] . '/display.php';
    }
}