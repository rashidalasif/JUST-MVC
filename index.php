<?php
//config
require 'config/paths.php';
require 'config/database.php';
require 'config/constant.php';
require 'config/default.php';
require LIBS.'Form/Val.php';

// Use an spl auto load Register function.
function __autoload($class){
    $class=LIBS.$class.'.php';
   if(file_exists($class))
   {
     require $class;
   }
    else{
          //show errror that class not loaded successfully
    }
}

$bootstrap=new Bootstrap();
$bootstrap->init();