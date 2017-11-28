<?php

//加载项目初始化文件
include '../init.php';

//加载文件上传函数
include DIR_CORE.'upload.php';

//加载数据库连接文件
include DIR_CORE.'MySQLDB.php';

//设置文件上传函数参数并调用函数
$allow = array('image/jpeg','image/jpg','image/png','image/gif');
$maxsize = 1048576;
$path = "E:/practice/bbs2/uploads/images";
$result = uploadImg($_FILES['img'],$allow,$path,$error,$maxsize);
if ($result) {
	//上传成功,并删除以前的头像,新头像信息入库
	session_start();
	$user_id = $_SESSION['userInfo']['user_id'];
	$oldsql = "select user_image from user where user_id=$user_id";
	$oldres = my_query($oldsql);
	$oldname = mysql_fetch_assoc($oldres);
	$oldpath = $path.'/'.$oldname['user_image'];
	if ($oldname['user_image']!='default.jpg'&&file_exists($oldpath)) {
		unlink($oldpath);
	}
	$newsql = "update user set user_image='$result' where user_id=$user_id";
	$newres = my_query($newsql);
	if ($newres) {
		header("refresh:2;url=../index.php");
		die("上传成功！新文件名为:$result");
	}else{
		header("refresh:2;url=./uploadimg.php");
		die("上传失败，发生未知错误！");
	}
}else{
	header("refresh:2;url=./uploadimg.php");
	die($error);
}
