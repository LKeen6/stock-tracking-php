<?php
//Return variable stored in POST
function getP($var){
    if(isset($_POST[$var])){
        return filter_input(INPUT_POST, $var, FILTER_SANITIZE_SPECIAL_CHARS);
    }else{
        return -1;
    }
}

//Return variable stored in GET
function getG($var){
    if(isset($_GET[$var])){
        return filter_input(INPUT_GET, $var, FILTER_SANITIZE_SPECIAL_CHARS);
    }else{
        return -1;
    }
}