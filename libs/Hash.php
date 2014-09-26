<?php
class Hash{

    public static function create($alg,$data,$salt){

        $context=hash_init($alg,HASH_HMAC,$salt);
        hash_update($context,$data);
        return hash_final($context);
    }
}