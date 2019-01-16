<?php

include "template.php";

function done_html($open_html, $return_html) {
    if (!file_exists("../generate_html")) {
        mkdir("../generate_html", 0777, true);
    }
    check_and_generate_result_html(array("{return_url}"), array($return_html), "../template/done.html", $open_html);
    header("Location: ".$open_html);
}

function failed_html($open_html, $return_html, $err_code, $err_str) {
    if (!file_exists("../generate_html")) {
        mkdir("../generate_html", 0777, true);
    }
    mkdir("../generate_html");
    check_and_generate_result_html(array("{return_url}", "{err_code}", "{err_str}"), array($return_html, strval($err_code), $err_str), "../template/failed.html", $open_html);
    header("Location: ".$open_html);
}

?>