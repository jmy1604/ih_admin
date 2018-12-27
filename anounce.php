<?php
include 'http_send.php';
include 'format_gm_cmd.php';
include 'config.php';

$content=$_POST["Content"];
$duration=$_POST["Duration"];

$cmd = array('Content'=>base64_encode($content), 'RemainSeconds'=>intval($duration));
$jd = json_encode($cmd);
$bd = base64_encode($jd);
echo PHP_EOL;
$data = format_gmcmd(1, $bd, "anounce");
echo PHP_EOL;
$cfg = get_config();
if ($cfg == null) {
    echo "get cfg failed";
    return;
}

sock_post(get_gm_url(), $data);

?>