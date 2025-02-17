<?php

function post_request($key){
    if(isset($_POST[$key])){
        $requested = $_POST[$key];
        $pattern = "/(UNION.*SELECT|SELECT.*FROM|DROP.*TABLE|INSERT.*INTO|--|\#|\/\*|\*\/|\bOR\b|\bAND\b|\bXOR\b|\bLIKE\b|\bBETWEEN\b)/i";
        if(preg_match($pattern, $requested)){
            die("search failed");
        }
    }else{
        $requested = null;
    }
    return $requested;
}