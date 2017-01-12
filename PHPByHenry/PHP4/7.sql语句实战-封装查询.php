q<?php 

	
	function select($sql){
		$mysqli = new mysqli("localhost","root","","php0607");
		if ($mysqli->connect_errno) {
			die($mysqli->connect_error);
		}

		$mysqli->query("set names utf8");

		/********************************/
		$result = $mysqli->query($sql);
		// var_dump($result);

		if ($result->num_rows) {
			// 第一种方法 简单方法
			// $row = $result->fetch_row();
			// print_r($row);
			
			// while ($row = $result->fetch_row()) {
			// 	print_r($row);
			// }

			// 第二种方法
			// while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			// 	print_r($row);
			// 	echo "<hr>";
			// }

			// 第三种方法 (推荐)
			$row = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode($row);
			// print_r($row);
		}

		// 关闭数据库
		$mysqli->close();

	}
	$sql = "SELECT * FROM user";
	select($sql);

 ?>