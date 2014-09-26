<?php
class View{
    function __construct(){
        //echo "This is base view";

    }
    public function render($name){
        require 'views/'.$name.'.php';
    }
}