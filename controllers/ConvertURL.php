<?php
class controllers_ConvertURL
{
    public function __construct()
    {
        $request_uri = explode('/', $_SERVER['REQUEST_URI']);
        
        $this->url =  str_replace_one(SITE_URL . '/', '', get_current_url());
        
        $temporary = explode('?', $this->url);
        
        $real_url = explode('/', $temporary[0]);
        
        $this->real_url = $real_url[0];


        //echo $this->real_url, '<br />', $this->url;
    }
    public static $real_url;
    public static $url;
}