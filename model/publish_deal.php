<?php

//引入init.php文件
include "../init.php";

//引入数据库连接文件
include DIR_CORE.'MySQLDB.php';

//接收发帖表单数据
$title = addslashes(strip_tags(trim($_POST['title'])));
$content = addslashes(strip_tags(trim($_POST['content'])));

//判断数据是否合法
if ($title==''||$content=='') {
	header("refresh:2;url=./publish.php");
	die("帖子标题和内容不能为空！");
}

//数据入库
session_start();
$owner = $_SESSION['userInfo']['user_name'];
$time = time();
$sql = "insert into publish values(null,'$title','$content','$owner',$time,default)";
$result = my_query($sql);
if ($result) {
	header("location:./list_father.php");
}else{
	header("refresh:2;url=./publish.php");
	die("发帖失败，发生未知错误！");
}