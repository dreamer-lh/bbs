<?php

//引入项目初始化文件
include "../init.php";

//验证是否已登陆
session_start();
if (isset($_SESSION['userInfo'])) {
	header("location:../index.php");
}

//加载视图文件
include DIR_VIEW."register.html";