<?php
function json_en($arr)
{
    return json_encode($arr,JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES);
    //    JSON_UNESCAPED_UNICODE（中文不转为unicode ，对应的数字 256）
    //    JSON_UNESCAPED_SLASHES （不转义反斜杠，对应的数字 64）
    //    JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES = 320
}

function json_de($arr)
{
    return json_decode($arr,true);
    //    JSON_UNESCAPED_UNICODE（中文不转为unicode ，对应的数字 256）
    //    JSON_UNESCAPED_SLASHES （不转义反斜杠，对应的数字 64）
    //    JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES = 320
}


function trim_json($str){
    $str = str_replace("\"","\\\"",$str);
    $str = str_replace("\n","\\n",$str);
    $str = str_replace("'","\\'",$str);
    return $str;
}