<?php

//加载项目初始化文件
include "../init.php";

//判断是否登陆
include DIR_CORE.'sess_check.php';

//var_dump($_SESSION);die;

//加载视图文件
include DIR_VIEW."publish.html";
