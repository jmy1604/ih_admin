<?php
include 'http_send.php';
include 'format_gm_cmd.php';
include 'config.php';
include 'act.php';

session_start();
$login_state = $_SESSION['login_state'];
if ($login_state <= 0) {
    echo("错误信息: 没有登陆");
    header('Location: ../login.html');
    return;
}

$permission = $_SESSION['permission'];
if ($permission < 1) {
    echo("权限不够");
    return;
}

$player_id = $_POST["player_id"];
$ban_or_free = $_POST["ban_or_free"];
$cmd = array('PlayerId'=>intval($player_id), 'BanOrFree'=>intval($ban_or_free));
$jd = json_encode($cmd);
$bd = base64_encode($jd);
$data = format_gmcmd(ACT_BAN_PLAYER, $bd, "ban_player");
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
} else {
    echo("请求完成");
}

save_act("history", ACT_BAN_PLAYER, "ban_player", $res, $_SESSION["user_name"], "player_id($player_id) ban_or_free($ban_or_free)");

?>