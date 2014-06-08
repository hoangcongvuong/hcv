<?php
	//$temporary_setting_parameter,$current_block_id

//h($temporary_setting_parameter)
?>

<ul class="menu_block block" id="<?php echo $current_block_id ?>"   <?php if($global_admin): ?> block_id="<?php echo $current_block_id ?>" block_name="<?php echo basename(dirname(__FILE__)); ?>" <?php endif; ?>>
    <?php
        $count = count($temporary_setting_parameter);
        //echo $count;
        foreach($temporary_setting_parameter as $k=>$v)
        {
            
            if($k < $count-1)
            {
                //echo '1<br />';
                if($temporary_setting_parameter[$k+1]['depth'] == $temporary_setting_parameter[$k]['depth'])
                {
                    ?>
                    <li><a href="<?php echo $temporary_setting_parameter[$k]['link'] ?>"><?php echo $temporary_setting_parameter[$k]['anchor'] ?></a></li>
                    <?php
                }
                
                if($temporary_setting_parameter[$k+1]['depth'] > $temporary_setting_parameter[$k]['depth'])
                {
                    ?>
                    <li>
                        <a href="<?php echo $temporary_setting_parameter[$k]['link'] ?>"><?php echo $temporary_setting_parameter[$k]['anchor'] ?></a>
                        <ul class="sub-menu">
                    <?php
                }
                
                if($temporary_setting_parameter[$k+1]['depth'] < $temporary_setting_parameter[$k]['depth'])
                {
                    $volum = $temporary_setting_parameter[$k]['depth'] - $temporary_setting_parameter[$k+1]['depth'];
                    ?>
                    <li><a href="<?php echo $temporary_setting_parameter[$k]['link'] ?>"><?php echo $temporary_setting_parameter[$k]['anchor'] ?></a></li>
                    <?php 
                        for($i=0;$i<$volum;$i++)
                        {
                            ?>
                            </ul></li>
                            <?php
                        }
                    ?>
                    <?php    
                }
            }
            
            else
            {
                ?>
                <li><a href="<?php echo $temporary_setting_parameter[$k]['link'] ?>"><?php echo $temporary_setting_parameter[$k]['anchor'] ?></a></li>
                <?php 
                for($i=0;$i<$temporary_setting_parameter[$k]['depth'];$i++)
                {
                    ?>
                    </ul></li>
                    <?php
                }
                    ?>
                <?php
            }
            ?>

            <?php
        }
    ?>
    
    
</ul>