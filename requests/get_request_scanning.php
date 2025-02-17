<?php
function get_request($key){
    if(isset($_GET[$key])){
        $requested = $_GET[$key];
        $pattern = "/(UNION.*SELECT|SELECT.*FROM|DROP.*TABLE|INSERT.*INTO|--|\#|\/\*|\*\/|\bOR\b|\bAND\b|\bXOR\b|\bLIKE\b|\bBETWEEN\b)/i";
        if(preg_match($pattern, $requested)){
            die("search failed");
        }
        return $requested;
    }else{
        $requested = null;
    }
    

}