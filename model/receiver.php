<?php

//引入项目初始化文件
include "../init.php";

//引入数据库文件
include DIR_CORE."MySQLDB.php";

//接收表单文件
$username = addslashes(strip_tags(trim($_POST['username'])));
$password1 = addslashes(strip_tags(trim($_POST['password1'])));
$password2 = addslashes(strip_tags(trim($_POST['password2'])));
$vcode = strtolower($_POST['vcode']);
//var_dump($_POST);

//判断验证码
session_start();
if ($vcode!=$_SESSION['vcode']) {
	header("refresh:2;url=./register.php");
	die("验证码错误!");
}

//判断用户名和密码是否为空
if ($username==''||$password1==''||$password2=='') {
	header("refresh:2;url=./register.php");
	die("用户名和密码不能为空!");
}

//判断两个密码是否相同
if ($password1!=$password2) {
	header("refresh:2;url=./register.php");
	die("密码错误！请重新输入！");
}

//判断用户名是否已存在
$sql = "select * from user where user_name='$username'";
$result = my_query($sql);
//$row = mysql_fetch_assoc($result);
$num = mysql_num_rows($result);
//var_dump($num);
if ($num) {
	header("refresh:2;url=./register.php");
	die("您输入的用户名已存在！请重新输入！");
}

//用户信息入库
$password = md5($password1);
$sql = "insert into user values(null,'$username','$password')";
$result = my_query($sql);
if ($result) {
	header("refresh:2;url=./login.php");
	die("注册成功！");
}else{
	header("refresh:2;url=./register.php");
	die("注册失败！发生未知错误！");
}

