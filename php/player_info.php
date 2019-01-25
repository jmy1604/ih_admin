<?php
include 'http_send.php';
include 'format_gm_cmd.php';
include 'config.php';
include 'utils.php';

/*session_start();
$login_state = $_SESSION['login_state'];
if ($login_state <= 0) {
    failed_html("../generate_html/player_info_failed.html", "../login.html", -1, "没有登陆");
    return;
}*/

$player_id=$_POST["PlayerId"];
$cmd = array('Id'=>intval($player_id));
$jd = json_encode($cmd);
$bd = base64_encode($jd);
$data = format_gmcmd(4, $bd, "player_info");
$result = RequestsPost(get_gm_url(), $data);
if ($result->status_code != 200) {
    //failed_html("../generate_html/player_info_failed.html", "../player_info.html", -1, "Http请求失败");
    return;
}

$jsd = json_decode($result->body);
if ($jsd == null) {
    //failed_html("../generate_html/player_info_failed.html", "../player_info.html", -1, "返回结果json解码失败");
    return;
}

$res = $jsd->{'Res'};
if ($res < 0) {
    echo("返回错误码" . $res);
    failed_html("../generate_html/player_info_failed.html", "../player_info.html", $res, "返回错误码");
    return;
}

$player_info = base64_decode($jsd->{'Data'});
echo("玩家信息 " . $player_info)

//done_html("../generate_html/player_info_done.html", "../player_info.html");

?>