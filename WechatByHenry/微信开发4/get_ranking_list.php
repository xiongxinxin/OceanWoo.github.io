<?php 
	// 获取用户的排序列表
	$mysqli = new mysqli(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);

	if ($mysqli->connect_errno) {
		die($mysqli->connect_error);
	}
	$mysqli->query("set names utf8");

	$sql = "SELECT * FROM userInfo ORDER BY score DESC";
	$result = $mysqli->query($sql);
	$arr = array();
	if ($result->num_rows) {
		while ($u = $result->fetch_assoc()) {
			array_push($arr,$u);
		}
	}
	$mysqli->close();
	$str = json_encode($arr);
	echo $str;
 ?>