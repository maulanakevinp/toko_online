<?php

if (! function_exists('phone_format')) {
    function phone_format($str)
    {
        $number = chunk_split($str,4,"-");
        $split = str_split($number);
        for($i = 0; $i < count($split)-1; $i++ ){
            $array[$i] = $split[$i];
        }
        return implode($array);
    }
}