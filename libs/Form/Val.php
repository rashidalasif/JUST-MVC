<?php
class Val{
    function __construct(){

    }
    public function minlength($data,$arg){
        if(strlen($data)<$arg){
            return "String can only $arg long";
        }
    }
    public function maxlength($data,$arg){
        if(strlen($data)>$arg){
            return "String can only $arg long";
        }
    }
    public function __call($name,$arguments){
        throw new Exception("$name does not exit inside of :". __CLASS__);

    }
    public function digit($data)
    {
        if (ctype_digit($data) == false) {
            return "Your string must be a digit";
        }
    }

}