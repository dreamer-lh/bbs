<?php

//引入init.php
include "../init.php";

//加载数据库连接文件
include DIR_CORE.'MySQLDB.php';

//接受数据
$pub_id = $_GET['pub_id'];

//判断点击量是否加一，感觉受限与cookie数量
session_start();
//$logName = $_SESSION['userInfo']['user_name'];
if (!isset($_SESSION["hit"."$pub_id"])) {
	$hits_sql = "update publish set pub_hits=pub_hits+1 where pub_id=$pub_id";
	my_query($hits_sql);
	$_SESSION["hit"."$pub_id"] = 1;
}
//var_dump($_SESSION);die;

//从数据库查询楼主数据
$pub_sql = "select * from publish left join user on pub_owner=user_name where pub_id=$pub_id";
$result = my_query($pub_sql);
$pub_row = mysql_fetch_assoc($result);


#分页开始
//echo "$rep_sql";die;
//读取数据总条数
$count_sql = "select * from reply where rep_pub_id=$pub_id";
$count_result = my_query($count_sql);
//回复总数
$repCount = mysql_num_rows($count_result);

//接收页数
$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
//定义每页回贴条数
$pageRepNum = 5;
//定义总页数
$pageCount = ceil($repCount/$pageRepNum);

//定义分页字符串
$pageStr = '';
//拼接首页
$pageStr .= "<a href='./show.php?pub_id=$pub_id&pageNum=1'>首页</a>";
//拼接上一页
//上一页
$prePage = $pageNum - 1 > 0 ? $pageNum - 1 : 1;
$pageStr .= "<a href='./show.php?pub_id=$pub_id&pageNum=$prePage'><<上一页</a>";
//拼接中间页
//定义循环开始页和结束页,判断首页范围
if ($pageNum < 3) {
	$pageStart = 1;
}else{
	$pageStart = $pageNum - 2;
}
if ($pageStart > $pageCount - 4) {
	$pageStart = $pageCount - 4;
}
if ($pageStart < 1) {
	$pageStart = 1;
}
//判断尾页范围
$pageLast = $pageStart + 4;
if ($pageLast > $pageCount) {
	$pageLast = $pageCount;
}

for ($i=$pageStart; $i <= $pageLast; $i++) { 
	if ($i==$pageNum) {
		$pageStr .= "<span>$i</span>";
	}else{
		$pageStr .= "<a href='./show.php?pub_id=$pub_id&pageNum=$i'>$i</a>";
	}
}
//拼接下一页
//下一页
$nextPage = $pageNum + 1 < $pageCount ? $pageNum + 1 : $pageCount;
$pageStr .= "<a href='./show.php?pub_id=$pub_id&pageNum=$nextPage'>下一页>></a>";
//拼接尾页
$pageStr .= "<a href='./show.php?pub_id=$pub_id&pageNum=$pageCount'>尾页</a>";

//统计查询帖子表
$start = $pageRepNum*($pageNum-1);
$offset = $pageRepNum;
$page_sql = "select * from reply left join user on rep_user=user_name where rep_pub_id=$pub_id order by rep_time limit $start,$offset";
$rep_res = my_query($page_sql);
#分页结束


//引入视图文件
include DIR_VIEW.'show.html';