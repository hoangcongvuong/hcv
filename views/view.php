<?php
class views_view
{
    public  function display($file_path)
    {
        //include $this->template_dir . '/' . $file_path;
        //echo $this->variable['title'];
        //echo file_get_contents($this->template_dir . '/' . $file_path);
    } 

    public function assign($variable_name, $value)
    {
        $this->variable[$variable_name] = $value;
    }
    
    public $variable = array();
    public $template_dir = 'tpl';
}