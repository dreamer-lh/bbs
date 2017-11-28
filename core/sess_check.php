<?php

//验证未登陆
session_start();
if (!isset($_SESSION['userInfo'])) {
	header("refresh:2;url=./login.php");
	die("您还没有登陆！");
}