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

$player_id = $_POST["player_id"];
$ban_or_free = $_POST["ban_or_free"];
$cmd = array('PlayerId'=>intval($player_id), 'BanOrFree'=>intval($ban_or_free));
$jd = json_encode($cmd);
$bd = base64_encode($jd);
$data = format_gmcmd(7, $bd, "ban_player");
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
    echo("返回错误码: " . $res);
    return;
}

echo("请求完成");

?>