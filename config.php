<?php

function get_config() {
    $jd = file_get_contents("config.json");
    $data = json_decode($jd);
    return $data;
}

function get_gm_url() {
    global $gm_server;
    if ($gm_server == "") {
        $cfg = get_config();
        if ($cfg == null) {
            echo "not found cfg";
            return;
        }
        $gm_server = "http://" . $cfg->GMServerIP . "/gm";
    }
    return $gm_server;
}

?>