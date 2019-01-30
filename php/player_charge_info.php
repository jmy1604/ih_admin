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

$c = get_config();
if ($c == null) {
    echo("错误信息: 配置找不到");
    return;
}

$dbc = new mysqli($c->DBIP, $c->DBUser, $c->DBPassword, $c->DBName);
if (!$dbc)  {
    echo("错误信息: 数据库链接错误".$mysql_error());
    return;
}

define("PAY_TABLE_ORDER_ID", "订单ID");
define("PAY_TABLE_BUNDLE_ID", "BundleID");
define("PAY_TABLE_ACCOUNT", "玩家账号");
define("PAY_TABLE_PLAYER_ID", "玩家ID");
define("PAY_TABLE_TIME", "购买时间");
define("TAB_HEADERS", array(PAY_TABLE_ORDER_ID=>'OrderId', PAY_TABLE_BUNDLE_ID=>'BundleId', PAY_TABLE_ACCOUNT=>'Account', PAY_TABLE_PLAYER_ID=>'PlayerId', PAY_TABLE_TIME=>'PayTimeStr'));

echo("请求完成");

echo '<table border="1"><tr>' ;
foreach (TAB_HEADERS as $k=>$v) {
    echo '<th>'. $k . '</th>';
}
echo '</tr>';

function get_pay_list($dbc, $table_name, $player_id) {
    $result=mysqli_query($dbc, "select * from $table_name where PlayerId=".$player_id.";");
    while ($row=mysqli_fetch_array($result)) {
        $order_id = $row[TAB_HEADERS[PAY_TABLE_ORDER_ID]];
        $bundle_id = $row[TAB_HEADERS[PAY_TABLE_BUNDLE_ID]];
        $account = $row[TAB_HEADERS[PAY_TABLE_ACCOUNT]];
        $player_id = $row[TAB_HEADERS[PAY_TABLE_PLAYER_ID]];
        $start_time = $row[TAB_HEADERS[PAY_TABLE_TIME]];
        echo '<tr><td>' . $order_id . '</td><td>' . $bundle_id . '</td><td>' . $account . '</td><td>' . $player_id . '</td><td>' . $start_time . '</td></tr>';
    }
}

get_pay_list($dbc, 'ApplePays', $player_id);
get_pay_list($dbc, 'GooglePays', $player_id);
echo '</table>';

?>