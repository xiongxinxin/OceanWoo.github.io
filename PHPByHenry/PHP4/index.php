<?php 
	
	// var_dump($_POST);
	// var_dump($_FILES);
	
	$tupian = $_FILES["tupian"];
	// 获取文件名字
	$name = $tupian["name"];
	// 获取文件类型
	$type = $tupian["type"];
	// 获取临时路径
	$tmp_name = $tupian["tmp_name"];
	// 获取错误信息
	/*
	 * 0: 上传成功
	 * 1: 文件超出
	 * 2: POST超出
	 * 3: 断网
	 * 4: 未上传文件
	 */
	$error = $tupian["error"];
	// 获取文件大小
	$size = $tupian["size"];

	$isSuccess = move_uploaded_file($tmp_name, "5.png");
	if ($isSuccess) {
		echo "上传成功";
	}else{
		echo "上传失败";
	}

	move_uploaded_file($_FILES["yinpin"]["tmp_name"], $_FILES["yinpin"]["name"]);

 ?>