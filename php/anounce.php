<?php
include 'http_send.php';
include 'format_gm_cmd.php';
include 'config.php';
include 'utils.php';

session_start();
$login_state = $_SESSION['login_state'];
if ($login_state <= 0) {
    failed_html("../generate_html/anounce_failed.html", "../login.html", -1, "没有登陆");
    return;
}

$content=$_POST["Content"];
$duration=$_POST["Duration"];
$cmd = array('Content'=>base64_encode($content), 'RemainSeconds'=>intval($duration));
$jd = json_encode($cmd);
$bd = base64_encode($jd);
$data = format_gmcmd(1, $bd, "anounce");
$result = RequestsPost(get_gm_url(), $data);
if ($result->status_code != 200) {
    failed_html("../generate_html/anounce_failed.html", "../anounce.html", -1, "Http请求失败");
    return;
}

$jsd = json_decode($result->body);
if ($jsd == null) {
    failed_html("../generate_html/anounce_failed.html", "../anounce.html", -1, "返回结果json解码失败");
    return;
}

$res = $jsd->{'Res'};
if ($res < 0) {
    echo("返回错误码".$res);
    failed_html("../generate_html/anounce_failed.html", "../anounce.html", $res, "返回错误码");
    return;
}

done_html("../generate_html/anounce_done.html", "../anounce.html");

?>