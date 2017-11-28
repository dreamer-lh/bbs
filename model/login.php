<?php

//加载项目初始化文件
include "../init.php";
session_start();
if (isset($_SESSION['userInfo'])) {
	header("location:./publish.php");
}

//加载视图文件
include DIR_VIEW."login.html";