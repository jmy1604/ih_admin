<?php

include "template.php";

function done_html($open_html, $return_html) {
    $dir_name = "../generate_html";
    if (!file_exists($dir_name)) {
        if (!mkdir($dir_name, 0777, true)) {
            die("mkdir ".$dir_name." failed");
            return;
        }
    }
    check_and_generate_result_html(array("{return_url}"), array($return_html), "../template/done.html", $open_html);
    header("Location: ".$open_html);
}

function failed_html($open_html, $return_html, $err_code, $err_str) {
    $dir_name = "../generate_html";
    if (!file_exists($dir_name)) {
        if (!mkdir($dir_name, 0777, true)) {
            die("mkdir ".$dir_name." failed");
            return;
        }
    }
    mkdir("../generate_html");
    check_and_generate_result_html(array("{return_url}", "{err_code}", "{err_str}"), array($return_html, strval($err_code), $err_str), "../template/failed.html", $open_html);
    header("Location: ".$open_html);
}

?>