<?php

include "config.php";

session_start();
$login_state = $_SESSION['login_state'];
if ($login_state <= 0) {
    echo("错误信息: 没有登陆");
    header('Location: ../login.html');
    return;
}

$permission = $_SESSION['permission'];
if ($permission < 2) {
    echo("权限不够");
    return;
}

$account=$_POST["account"];
$page;
if (!isset($_POST["page"])) {
    $page = 0;
} else {
    $page = $_POST["page"];
}

$c = get_config();
if ($c == null) {
	die("配置找不到");
}
$dbc = new mysqli($c->DBIP, $c->DBUser, $c->DBPassword, $c->DBName);
if(!$dbc)  {
  	die("数据库链接错误". mysqli_error($dbc));
}

$tab_headers = array(1=>'Account', 2=>'Id', 3=>'ActId', 4=>'ActName', 5=>'ActResult', 6=>'ActTime', 7=>'Detail');

echo '<table border="1"><tr>' ;
foreach ($tab_headers as $k=>$v) {
    echo '<th>'. $v . '</th>';
}
echo '</tr>';

$offset = $page * 30;
$result;
if ($account == '') {
    $result = mysqli_query($dbc, "select * from history order by act_time desc limit $offset, 30;");
} else {
    $result = mysqli_query($dbc, "select * from history where act_account='$account' order by act_time desc limit $offset, 30;");
}
while ($row = mysqli_fetch_array($result)) {
    $act_account = $row["act_account"];
    $id = $row["id"];
    $act_id = $row["act_id"];
    $act_name = $row["act_name"];
    $act_result = $row["act_result"];
    $act_time = $row["act_time"];
    $detail = $row["detail"];
    echo '<tr><td>' . $act_account . '</td><td>' . $id . '</td><td>' . $act_id . '</td><td>' . $act_name . '</td><td>' . $act_result . '</td><td>' . $act_time . '</td><td>' . $detail . '</td></tr>';
}

?>