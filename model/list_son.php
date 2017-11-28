<?php

//引入init.php
include "../init.php";

//引入数据库连接文件
include DIR_CORE."MySQLDB.php";


//接受搜索框数据
$keyword = $_GET['keyword'];
if (empty($keyword)) {
	header("location:../index.php");
}
#分页
//读取数据总条数
$sql = "select * from publish where pub_title like '%$keyword%'";
$result = my_query($sql);
//回复总数
$pubCount = mysql_num_rows($result);
//接收页数
$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
//定义每页回贴条数
$pageRepNum = 5;
//定义总页数
$pageCount = ceil($pubCount/$pageRepNum);

//定义分页字符串
$pageStr = '';
//拼接首页
$pageStr .= "<a href='./list_son.php?pageNum=1&keyword=$keyword'>首页</a>";
//拼接上一页
//上一页
$prePage = $pageNum - 1 > 0 ? $pageNum - 1 : 1;
$pageStr .= "<a href='./list_son.php?pageNum=$prePage&keyword=$keyword'><<上一页</a>";
//拼接中间页
//定义循环开始页和结束页
/*if ($pageCount <= 5) {
	$pageStart = 1;
	$pageLast = $pageCount;
}else{
	//判断初始页是否小于3
	if ($pageNum < 3) {
		$pageStart = 1;
		$pageLast = 5;
	}else{
		$pageStart = $pageNum - 2;
		$pageLast = $pageNum + 2;
	}
	//判断结束页
	if ($pageNum > $pageCount-2) {
		$pageStart = $pageCount-4;
		$pageLast = $pageCount;
	}
}*/
//判断首页范围
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
		$pageStr .= "<a href='./list_son.php?pageNum=$i&keyword=$keyword'>$i</a>";
	}
}
//拼接下一页
//下一页
$nextPage = $pageNum + 1 < $pageCount ? $pageNum + 1 : $pageCount;
$pageStr .= "<a href='./list_son.php?pageNum=$nextPage&keyword=$keyword'>下一页>></a>";
//拼接尾页
$pageStr .= "<a href='./list_son.php?pageNum=$pageCount&keyword=$keyword'>尾页</a>";

//统计查询帖子表
$start = $pageRepNum*($pageNum-1);
$offset = $pageRepNum;
$page_sql = "select * from publish left join user on pub_owner=user_name where pub_title like '%$keyword%' order by pub_time desc limit $start,$offset";
$res = my_query($page_sql);
//$pub_num = mysql_num_rows($result);

//引入视图文件
include DIR_VIEW."list_son.html";