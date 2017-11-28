<?php

//创建画板
$img = imagecreatetruecolor(170, 40);

//添加背景色
$bgColor = imagecolorallocate($img, mt_rand(180,255), mt_rand(180,255), mt_rand(180,255));
imagefill($img, 0, 0, $bgColor);

//生成随机字符串
$arr = array_merge(range('a', 'z'),range('A', 'Z'),range(0, 9));
$length = count($arr);
$str = '';
for ($i=0; $i < 4; $i++) { 
	$str .= $arr[mt_rand(0,$length-1)];
}
session_start();
$_SESSION['vcode'] = strtolower($str);

//添加字符串
$span = 170/5;
for ($i=0; $i < 4; $i++) { 
	$strColor = imagecolorallocate($img, mt_rand(0,100), mt_rand(0,100), mt_rand(0,100));
	imagestring($img, 5, ($i+1)*$span-5, 10, $str[$i], $strColor);
}

//添加干扰线
for ($i=0; $i < 6; $i++) { 
	$lineColor = imagecolorallocate($img, mt_rand(100,180), mt_rand(100,180), mt_rand(100,180));
	imageline($img, mt_rand(0,169), mt_rand(0,39), mt_rand(0,169), mt_rand(0,39), $lineColor);
}

//添加噪点(干扰点)
for ($i=0; $i < 170*40*0.05; $i++) { 
	$pixelColor = imagecolorallocate($img, mt_rand(100,180), mt_rand(100,180), mt_rand(100,180));
	imagesetpixel($img, mt_rand(0,169), mt_rand(0,39), $pixelColor);
}


//输出图片
//设置响应头
header("content-type:image/jpeg");
ob_clean();
imagejpeg($img);
