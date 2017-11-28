<?php

//引入项目初始化文件
include '../init.php';

//引入数据库连接文件
include DIR_CORE.'MySQLDB.php';

//接收数据
$pub_id = $_POST['pub_id'];
//var_dump($pub_id);die;
$rep_id = $_POST['rep_id'];
$rep_num = $_POST['rep_num'];
$rep_content = addslashes(strip_tags(trim($_POST['content'])));

//验证数据
if (empty($rep_content)) {
	header("refresh:2;url=./quote.php?num=$rep_num&pub_id=$pub_id&rep_id=$rep_id");
	die("内容不能为空！");
}

//数据入库，并跳转
session_start();
$rep_user = $_SESSION['userInfo']['user_name'];
$rep_time = time();
$quote_sql = "insert into reply values(null,$pub_id,'$rep_user','$rep_content',$rep_time,$rep_num,$rep_id)";
$result = my_query($quote_sql);
if ($result) {
	header("location:./show.php?pub_id=$pub_id");
}else{
	header("refresh:2;url=./quote.php?num=$rep_num&pub_id=$pub_id&rep_id=$rep_id");
	die("发生未知错误，请稍后重试！");
}