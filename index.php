<?php

//项目入口文件
include 'init.php';

session_start();
if (isset($_COOKIE['user_id'])&&!isset($_SESSION['userInfo'])) {
	include DIR_CORE.'MySQLDB.php';
	$user_sql = "select * from user where user_id={$_COOKIE['user_id']}";
	$user_res = my_query($user_sql);
	$user_row = mysql_fetch_assoc($user_res);
	$_SESSION['userInfo'] = $user_row;
}

//加载index.html文件
include DIR_VIEW.'index.html';