<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cls_Autoloader
 *
 * @author gramppko
 */
class cls_Autoloader
{
    protected static $autoloader = null;
    
    public static function register()
    {
        if (cls_Autoloader::$autoloader == null)
        {
            cls_Autoloader::$autoloader = new cls_Autoloader();
        }
    }
    
    protected function __construct()
    {
        spl_autoload_register (array($this, 'load_class'));
    }
    
    
    public function load_class($classname)
    {
               // echo __DIR__ . $classname;
                $path = __DIR__ . "/" . $classname . ".php";
                include_once ($path);        
    }
}
// geht nicht: $a = new cls_Autoloader();

cls_Autoloader::register();
