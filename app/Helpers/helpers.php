<?php

if (! function_exists('dde')) {
    function dde($value){
        http_response_code(500);
        dd($value);
    }
}


if (! function_exists('getDate')) {
    function getDate(){
        return date('m/d/Y H:i:s');
    }
}

