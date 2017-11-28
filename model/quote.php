<?php

//加载init.php
include '../init.php';

//加载数据库连接文件
include DIR_CORE.'MySQLDB.php';

//验证登陆
include DIR_CORE.'sess_check.php';

//接收数据
$num = $_GET['num'];
$pub_id = $_GET['pub_id'];
$rep_id = $_GET['rep_id'];

//查询楼主发帖相应信息
$pub_sql = "select * from publish where pub_id=$pub_id";
$pub_res = my_query($pub_sql);
$pub_row = mysql_fetch_assoc($pub_res);
//var_dump($pub_row);die;

//查询相应回帖信息
$rep_sql = "select * from reply where rep_id=$rep_id";
$rep_res = my_query($rep_sql);
$rep_row = mysql_fetch_assoc($rep_res);
//var_dump($pub_row);die;

//加载视图文件
include DIR_VIEW.'quote.html';