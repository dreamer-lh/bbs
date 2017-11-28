<?php

//定义文件上传函数
/**
 * @param array $file 获取相关文件
 * @param array $allow 允许上传的文件类型
 * @param int $maxsize 允许上传的文件大小限制
 * @param string $path 文件上传的路径
 * @param string $error 错误信息，引用变量
 * @param mix false|newname 文件返回值
 */
function uploadImg($file,$allow,$path,&$error,$maxsize=1048576){
	//判断系统错误
	switch ($file['error']) {
		case 1:
			$error = "上传失败，文件大小超过服务器限制！";
			return false;
		case 2:
			$error = "上传失败，文件大小超过表单限制！";
			return false;
		case 3:
			$error = "上传失败，文件上传不完整！";
			return false;
		case 4:
			$error = "上传失败，请选择需要上传的文件！";
			return false;
		case 6:
		case 7:
			$error = "上传失败，服务器错误！";
			return false;
	}
	//判断文件大小
	if ($file['size']>$maxsize) {
		$error = "上传失败，文件大小超出限制！";
		return false;
	}
	//判断文件类型
	if (!in_array($file['type'], $allow)) {
		$error = "上传失败，文件类型不符合！允许类型".implode(',', $allow);
		return false;
	}
	//产生新的文件名
	$newName = randNewName($file['name']);
	//接受文件到指定路径
	move_uploaded_file($file['tmp_name'], $path.'/'.$newName);
	return $newName;

}

//传入旧的文件名，返回新的文件名
function randNewName($oldName){
	//产生时间字符串
	$newName = date('YmdHis',time());
	//产生四位随机数
	for ($i=0; $i < 4; $i++) { 
		$newName .= mt_rand(0,9);
	}
	//加上后缀名
	$newName .= strrchr($oldName, ".");
	return $newName;
}