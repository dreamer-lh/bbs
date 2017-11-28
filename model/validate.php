<?php

//引入项目初始化文件
include "../init.php";

//引入数据库文件
include DIR_CORE."MySQLDB.php";

//接受表单文件
$username = addslashes(strip_tags(trim($_POST['username'])));
$password = addslashes(strip_tags(trim($_POST['password'])));

//判断是否为空
if ($username==''||$password=='') {
	header("refresh:2;url=./login.php");
	die("您的用户名和密码不能为空，请重新输入！");
}

//判断登陆信息是否正确
$sql = "select * from user where user_name='$username'";
$result = my_query($sql);
$row = mysql_fetch_assoc($result);
//$user_id = $row['user_id'];
$user_password = $row['user_password'];
//print_r($row);die;
if (md5($password)==$user_password) {
	//登录成功
	if ($_POST['check']) {
		setcookie('user_id',$row['user_id'],time()+604800,'/','bbs2.cn');
	}
	session_start();
	$_SESSION['userInfo'] = $row;
	header("location:publish.php");
}else{
	header("refresh:2;url=./login.php");
	die("发生未知错误，请稍后再试！");
}
