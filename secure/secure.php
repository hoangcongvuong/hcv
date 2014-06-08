<?php
class secure_secure
{
    public static function check_login($name, $password)
    {
        $moment_obj = new models_DB;
        $get_user = $moment_obj->get('SELECT name, password FROM user');
        foreach($get_user as $v_get_user)
        {
            if( ($_POST['name'] == $v_get_user['name']) && (md5($_POST['password']) == $v_get_user['password']) ) 
            {
                setcookie('name',$_POST['name'], time() +  60*60*24*30, '/');
                setcookie('password',md5($_POST['password']), time() + 60*60*24*30, '/');
                //if(isset($_GET['continue']))  header('Location: ' .$_GET['continue']) ;
                //else 
                header('Location: index.php');
            }
        }
    }
    
    public static function check_admin()
    {
        if( !isset($_COOKIE['name']) || !isset($_COOKIE['password']) ) die('You must <a href="' .SITE_URL. '/admin/login.php?continue=' . get_current_url() . '">login</a> to continue');
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
    
    public static function generator_random_secure_key()
    {
        models_DB::query_string('UPDATE TABLE config SET secure_key = \'' .random_string(). '\'');
    }
    
    
}