<?php

//配置初始化文件

//设置header头
header("content-type:text/html;charset=utf-8");
//定义网站根目录E:/bbs1，建议使用“/”，兼容两种操作系统，“\”只能在windows中使用
define("DIR_ROOT", str_replace('\\','/',__DIR__).'/');
//model目录
define("DIR_MODEL", DIR_ROOT."model/");
//view目录
define("DIR_VIEW", DIR_ROOT."view/");
//controller目录
define("DIR_CONTROLLER", DIR_ROOT."controller/");
//config目录
define("DIR_CONFIG", DIR_ROOT."config/");
//core目录
define("DIR_CORE", DIR_ROOT."core/");
//public目录,比较特殊,无法使用本地绝对路径,需要使用网络绝对路径"/"表示网站根目录
define("DIR_PUBLIC", "/public/");
//uploads/image目录
define("DIR_IMAGE", "/uploads/images/");

//echo "有毒";