<?php

//加载init.php
include '../init.php';

//删除cookie
if (isset($_COOKIE['user_id'])) {
	setcookie('user_id','',time()-1,'/','bbs2.cn');
}
//删除session
session_start();
if (isset($_SESSION['userInfo'])) {
	unset($_SESSION['userInfo']);
}
//var_dump($_SESSION['userInfo']);

header("location:../index.php");
