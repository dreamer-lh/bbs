<?php

//加载项目初始化文件
include "../init.php";

//判断是否未登陆
include DIR_CORE.'sess_check.php';

//加载数据库连接文件
include DIR_CORE.'MySQLDB.php';

//接受数据
$pub_id = $_GET['pub_id'];
//获取楼主信息
$pub_sql = "select * from publish where pub_id=$pub_id";
$result = my_query($pub_sql);
$pub_row = mysql_fetch_assoc($result);

//加载视图文件
include DIR_VIEW.'reply.html';