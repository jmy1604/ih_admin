<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>欢迎登录界面</title>
</head>
<body>
 
<?php
session_start ();
//判断code存不存在，如果不存在，说明异常登录
if (isset ( $_SESSION ["code"] )) {
?>
欢迎登录
<?php
    //显示登录用户名
	echo "${_SESSION["username"]}";
?><br>
您的ip：
<?php
    //显示ip
	echo "${_SERVER['REMOTE_ADDR']}";
?>
<br>
您的语言：
<?php
    //使用的语言
	echo "${_SERVER['HTTP_ACCEPT_LANGUAGE']}";
?>
<br>
浏览器版本：
<?php
    //浏览器版本信息
	echo "${_SERVER['HTTP_USER_AGENT']}";
?>
<a href="exit.php">退出登录</a>
<?php
} else {
    //code不存在，调用exit.php 退出登录
?>
<script type="text/javascript">
	alert("退出登录");
	window.location.href="exit.php";
</script>
<?php
}
?>
<br>
	<a href="alter_password.html">修改密码</a>
</body>
</html>
