<?php
include 'http_send.php';
include 'format_gm_cmd.php';
include 'config.php';
include 'act.php';

session_start();
$login_state = $_SESSION['login_state'];
if ($login_state <= 0) {
    echo("错误结果: 没有登陆");
    header('Location: ../login.html');
    return;
}

$permission = $_SESSION['permission'];
if ($permission < 1) {
    echo("权限不够");
    return;
}

$player_id=$_POST["player_id"];
$bundle_id=$_POST["bundle_id"];
$cmd = array('PlayerId'=>intval($player_id), 'BundleId'=>$bundle_id);
$jd = json_encode($cmd);
$bd = base64_encode($jd);
$data = format_gmcmd(6, $bd, "month_card_send");
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
} else {
    echo("请求成功");
}

save_act("history", ACT_MONTH_CARD_SEND, "month_card_send", $res, $_SESSION["user_name"], "player_id($player_id) bundle_id($bundle_id)");

?>