<?php

require_once 'third_party/Requests/library/Requests.php';

Requests::register_autoloader();

function RequestsPost($url, $query)
{
    $header = array('Content-type'=>'application/x-www-form-urlencoded');
    $result = Requests::post($url, $header, $query);
    return $result;
}

function RequestsGet($url, $query)
{
    $header = array('Content-type'=>'application/x-www-form-urlencoded');
    $result = Requests::get($url, $header);
    return $result;
}

?>