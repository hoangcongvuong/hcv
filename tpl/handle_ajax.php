<?php
include dirname(dirname(__FILE__)) . '/config.php';
$my_secure = new secure_secure();
$my_secure->check_admin();

if(isset($_POST['type']) && $_POST['type']=='load_form_setting')
{
    ?>
    <div id="dialog" title="<?php echo $_POST['block_name'] ?>">
        <?php include PATH_ROOT . '/blocks/' . $_POST['block_name'] . '/setting_form.php';  ?>
    </div>
    <?php
}

if(isset($_POST['type']) && $_POST['type']=='update_setting')
{
    $obj_DB = new models_DB;
    $current_block = $obj_DB->get('SELECT * FROM block WHERE block_id='.$_POST['block_id']);
    //h($current_block);
    $current_block_name = $current_block[0]['block_name'];
    $temporary_setting_parameter = unserialize($current_block[0]['block_parameter']);
    ?>
    <div id="dialog" title="<?php echo $current_block_name ?>">
        <?php include PATH_ROOT . '/blocks/' . $current_block_name . '/setting_form.php';  ?>
    </div>
    <?php
}

if(isset($_POST['type']) && $_POST['type']=='delete_block')
{
    $obj_DB = new models_DB;
    $current_block = $obj_DB->query_string('DELETE FROM block WHERE block_id='.$_POST['block_id']);
    //h($current_block);
    if($current_block) echo '1';
    else echo '0';
}



if(isset($_POST['type']) && $_POST['type']=='save_setting')
{

   if($_POST['form_type'] == 'array')
   {
       foreach($_POST['key'] as $k=>$v)
       {
            $temporary_setting_parameter[] = array_combine($_POST['key'][$k], $_POST['value'][$k]);
       }
   }
   
   if($_POST['form_type'] == 'form')
   {
        $temporary_setting_parameter = array_combine($_POST['key'], $_POST['value']);
   }

    //h($temporary_setting_parameter);
   
   if($_POST['block_id'] == 0)
   {
        //h($temporary_setting_parameter);
        $obj_DB = new models_DB;
        $insert_content = array(
            'block_name'        => $_POST['block_name'],
            'block_parameter'   => serialize($temporary_setting_parameter)
        );
        $obj_DB->insert($insert_content, 'block');
        $current_block = $obj_DB->get('SELECT * FROM block ORDER BY block_id  DESC LIMIT 0,1');
        $current_block_id = $current_block[0]['block_id'];
        //h($current_block);
   }
   else
   {
        $obj_DB = new models_DB;
        $new_value = array(
            'block_name'        => $_POST['block_name'],
            'block_parameter'   => serialize($temporary_setting_parameter)
        );
        $obj_DB->update($new_value, 'block', ' WHERE block_id='.$_POST['block_id']);
        $current_block_id = $_POST['block_id'];
   }

   include PATH_ROOT . '/blocks/' . $_POST['block_name'] . '/display.php';
}



if(isset($_POST['type']) && $_POST['type']=='update_area_content')
{
    $obj_DB = new models_DB;
    $new_value = array(
        'block_area_content'   => $_POST['update_block_area_content']
    );
    if($obj_DB->update($new_value, 'block_area', ' WHERE block_area_name =\''.$_POST['area_name'].'\'')) echo 'sucess roi';
    else echo 'loi roi';
}
?>