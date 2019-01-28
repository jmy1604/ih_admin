<?php
include 'http_send.php';
include 'format_gm_cmd.php';
include 'config.php';
include 'utils.php';

session_start();
$login_state = $_SESSION['login_state'];
if ($login_state <= 0) {
    echo("错误信息: 没有登陆");
    return;
}

$MailID = $_POST["MailID"];
$ItemList = $_POST["ItemList"];
$PlayerId = $_POST["PlayerId"];
$PlayerAccount = $_POST["PlayerAccount"];

$items = explode(',', $ItemList);
if ($items == null) {
    echo("错误信息: 物品数组列表为空或者格式错误");
    return;
}

$item_list = array();
$item_num = count($items);
for ($i=0; $i<$item_num; $i++) {
    $item_list[$i] = intval($items[$i]);
}
$cmd = array('PlayerAccount'=>$PlayerAccount, 'PlayerId'=>intval($PlayerId), 'MailTableID'=>intval($MailID), 'AttachItems'=>$item_list);
$jd = json_encode($cmd);
$bd = base64_encode($jd);
$data = format_gmcmd(3, $bd, "sys_mail");
$cfg = get_config();
if ($cfg == null) {
    echo("错误信息: get cfg failed");
    return;
}

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
    echo("错误信息: " . $res);
    return;
}

echo("操作成功");

?>