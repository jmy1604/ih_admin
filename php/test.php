<?php
include 'http_send.php';
include 'format_gm_cmd.php';
include 'config.php';
include 'utils.php';

$num=$_POST["Num"];
$string=$_POST["String"];

$cmd = array('StringValue'=>$string, 'NumValue'=>intval($num));
$jd = json_encode($cmd);
$bd = base64_encode($jd);
$data = format_gmcmd(0, $bd, "test");
RequestsPost(get_gm_url(), $data);

?>