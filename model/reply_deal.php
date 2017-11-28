<?php

//加载项目初始化文件
include '../init.php';
//加载数据库连接文件
include DIR_CORE.'MySQLDB.php';

//接受表单数据
$rep_content = addslashes(strip_tags(trim($_POST['content'])));
$pub_id = $_POST['pub_id'];

//数据校验，不能为空
if ($rep_content=='') {
	header("refresh:2;url=./reply.php?pub_id=$pub_id");
	die("内容不能为空，请重新输入！");
}
//数据入库
session_start();
$rep_user = $_SESSION['userInfo']['user_name'];
$rep_time = time();
$rep_sql = "insert into reply values(null,$pub_id,'$rep_user','$rep_content',$rep_time,default,default)";
$result = my_query($rep_sql);
if ($result) {
	header("location:./show.php?pub_id=$pub_id");
}else{
	header("refresh:2;url=./reply.php?pub_id=$pub_id");
	die("发生未知错误，请稍后再试！");
}