<?php
include 'http_send.php';
include 'format_gm_cmd.php';
include 'config.php';
include 'utils.php';

session_start();
$login_state = $_SESSION["login_state"];
if ($login_state <= 0) {
    failed_html("../generate_html/test_failed.html", "../login.html", -1, "没有登陆");
    return;
}


$num=$_POST["Num"];
$string=$_POST["String"];

$cmd = array('StringValue'=>$string, 'NumValue'=>intval($num));
$jd = json_encode($cmd);
$bd = base64_encode($jd);
$data = format_gmcmd(0, $bd, "test");
$result = RequestsPost(get_gm_url(), $data);
if ($result->status_code != 200) {
    echo "http请求失败";
    return;
}

done_html("../generate_html/test_done.html", "../test.html");

?>