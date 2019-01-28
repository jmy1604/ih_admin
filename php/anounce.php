<?php
include 'http_send.php';
include 'format_gm_cmd.php';
include 'config.php';

session_start();
$login_state = $_SESSION['login_state'];
if ($login_state <= 0) {
    echo("错误信息: 没有登陆");
    header('Location: ../login.html');
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
    echo("错误信息: Http请求失败");
    return;
}

$jsd = json_decode($result->body);
if ($jsd == null) {
    echo("错误信息: 返回结果json解码失败");
    return;
}

$res = $jsd->{'Res'};
if ($res < 0) {
    echo("错误信息". $res);
    return;
}

echo("操作成功");

?>