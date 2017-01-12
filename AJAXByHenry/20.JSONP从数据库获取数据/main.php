<?php 
	
	header("Content-Type:text/json");
	$callback = $_GET["callback"];

	$sql = "SELECT * FROM users";
	
	// echo json_encode(selectInfo($sql));

	echo $callback."(".json_encode(selectInfo($sql)).")";

	function selectInfo($sql){
		$mysqli = new mysqli("localhost","root","",
			"database");
		if($mysqli->connect_errno)
			die($mysqli->connect_error);

		$mysqli->query("set names utf8");

		$result = $mysqli->query($sql);

		$array = [];

		if ($result->num_rows) {
			
			while ($rows = $result->fetch_array(MYSQLI_ASSOC)) {
				array_push($array, $rows);
			}
		}
		// 关闭数据库
		$mysqli->close();

		return $array;
	}
 ?>