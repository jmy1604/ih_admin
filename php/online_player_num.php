<?php
include 'http_send.php';
include 'format_gm_cmd.php';
include 'config.php';
include 'utils.php';

session_start();
$login_state = $_SESSION['login_state'];
if ($login_state <= 0) {
    echo("错误结果: 没有登陆");
    return;
}

$player_id=$_POST["server_id"];
$cmd = array('Id'=>intval($server_id));
$jd = json_encode($cmd);
$bd = base64_encode($jd);
$data = format_gmcmd(5, $bd, "online_player_num");
$result = RequestsPost(get_gm_url(), $data);
if ($result->status_code != 200) {
    echo("错误结果: Http请求失败");
    return;
}

$jsd = json_decode($result->body);
if ($jsd == null) {
    echo("错误结果: 返回结果json解码失败");
    return;
}

$res = $jsd->{'Res'};
if ($res < 0) {
    echo("错误码: " . $res);
    return;
}

$player_info = base64_decode($jsd->{'Data'});
echo $player_info;

?>