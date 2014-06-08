<?php
/**
 * This File contain common functions, database connection
 */

/**
 * Database connection
 */
$global_sqli = new mysqli('localhost', 'root', 'congvuong', 'hcv');
$global_sqli->query("SET NAMES utf8");
if($global_sqli->connect_errno) die('Cannot connect Database');




/**
 * Commont Functions
 */
 
function __autoload($name)
{
    $parts = explode('_', $name);
    include dirname(__FILE__) . '/' . $parts[0] . '/' . $parts[1] . '.php';
}

function is_admin()
{
    if( !isset($_COOKIE['name']) || !isset($_COOKIE['password']) ) return false;
    else
    {
        $moment_obj = new models_DB;
        $get_user = $moment_obj->get('SELECT name, password FROM user');
        foreach($get_user as $v_get_user)
        {
            if( ($_COOKIE['name'] == $v_get_user['name']) && ($_COOKIE['password'] == $v_get_user['password']) ) return true;
            
        }
        return false;
    } 
}



/**
 * Block for Admin
 */
function block_action()
{
    if(is_admin()) 
    {
        
    }
}

$global_admin = is_admin();

function vngit_header()
{
   if(is_admin()) : 

    if(isset($_POST['close_design'])) 
    {
        setcookie('design', true, time()-60*60, '/');
        header('Location:' . get_current_url());
        exit;
    }
    
    if(isset($_POST['open_design'])) 
    {
        setcookie('design', true, time()+60*60, '/');
        header('Location:' . get_current_url());
        exit;
    }
    if(isset($_COOKIE['design']))
    {
        setcookie('design', true, time()+60*60, '/');
        ?>
        <form action="" method="post">
        <button type="submit" name="close_design" id="design-mode">Quit</button>
        </form>
        <div id="list_block">
        <link rel="stylesheet" href="tpl/css/block.css" type="text/css" />
        <script src="tpl/js/jquery-ui.js"></script>
        <script src="tpl/js/block.js"></script>
        <?php 
            foreach( scandir( PATH_ROOT . '/blocks' )  as $k=>$v ) 
            {
                if($k != '.' && $v != '..')
                {
                   ?>
                    <div block_name="<?php echo $v ?>" block_id="0" class="draggable block fl bold verdana <?php echo $v ?>"><?php echo $v; ?></div>
                    <?php 
                }
                
            }
        ?>
        <span class="clear"></span>
        </div>
        <?php
    }
    else
    {
        ?>
        <form action="" method="post">
        <button type="submit" name="open_design" id="design-mode">Design</button>
        </form>
        <?php
    }

    endif;
}

function admin_parameter()
{
    
}
 
 
/**
 * Include Other file as : smarty class,
 */
//include dirname(__FILE__) . '/apps/smarty/libs/Smarty.class.php';

 
function h($par)
{
    // pretty result in browser 
    ?>
    <pre>
        <?php print_r($par) ?>
    </pre>
    <?php
}


function random_string($lengh = 8)
{
    // Generate random string
    $charecters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($charecters), 0, $lengh);
}

function get_current_url()
{
    $result_url = 'http';
    if(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS'])) $result_url = 'https';
    $result_url .= '://';
    $result_url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $result_url;
}

function str_replace_one($search = '', $replace = '', $subject = '')
{
   return $replace . substr($subject, strlen($search));
}

$global_query_string; // Save all query string 
$global_real_current_url;
$global_current_row;

function check_upload_folder()
{
/**
 * Chua xay dung xong
 */
}

function scandir_recursive()
{
 /**
 * Chua xay dung xong
 */   
}