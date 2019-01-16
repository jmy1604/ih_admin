<?php
include 'http_send.php';
include 'format_gm_cmd.php';
include 'config.php';
include 'utils.php';

$content=$_POST["Content"];
$duration=$_POST["Duration"];

$cmd = array('Content'=>base64_encode($content), 'RemainSeconds'=>intval($duration));
$jd = json_encode($cmd);
$bd = base64_encode($jd);
echo PHP_EOL;
$data = format_gmcmd(1, $bd, "anounce");
$result = RequestsPost(get_gm_url(), $data);
if ($result->status_code != 200) {
    echo "http请求失败";
    return;
}
header("Location: ../anounce.html");

?>