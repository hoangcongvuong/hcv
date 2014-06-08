<?php
class other_MearuseRunTime
{
    public static function start()
    {
        self::$result = microtime(TRUE);
    }
    
    
    public static function end($echo = true)
    {
        self::$result = microtime(TRUE) - self::$result;
        if($echo == true)
        {
            ?>
            <p style="z-index:999;position:fixed;top:0;right:0;background: rgba(195, 195, 195, 0.52);line-height: 20px;font-weight:bold;font-family:verdana;padding:7px">
                <span style="color: red;">In Milliseconds : <span style="color: green;"><?php echo 1000*(self::$result); ?></span></span><br />
                <span style="color: red;">In &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;seconds : <span style="color: green;"><?php echo self::$result; ?></span></span>
            </p>
            <?php
        }
        return self::$result;
    }
    public static $result = 0;
}