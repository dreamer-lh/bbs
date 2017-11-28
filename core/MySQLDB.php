<?php

//数据库连接函数
function my_connect($db){
	$host = isset($db['host']) ? $db['host'] : "localhost";
	$port = isset($db['port']) ? $db['port'] : "3306";
	$user = isset($db['user']) ? $db['user'] : "root";
	$password = isset($db['password']) ? $db['password'] : "root";
	$link = mysql_connect("$host:$port",$user,$password);
	if (!$link) {
		echo "连接失败！","<br />";
		echo "错误编号：",mysql_errno(),"<br />";
		echo "错误信息：",mysql_error(),"<br />";
		die;
	}
}

//设置数据库操作函数
function my_query($sql){
	$result = mysql_query($sql);
	if ($result) {
		return $result;
	}else{
		echo "操作失败！","<br />";
		echo "错误编号：",mysql_errno(),"<br />";
		echo "错误信息：",mysql_error(),"<br />";
		die;
	}
}

//设置字符集函数
function charset($charType){
	$sql = "set names $charType";
	my_query($sql);
}
//进入数据库
function enterDB($dbname){
	$sql = "use $dbname";
	my_query($sql);
}

//引入配置文件
$config = include DIR_CONFIG."config.php";
$db = $config['db'];
//数据库连接
my_connect($db);
//设置字符集
charset($db['charType']);
//进入数据库
enterDB($db['dbName']);
