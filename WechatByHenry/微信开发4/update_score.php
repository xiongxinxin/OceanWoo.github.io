<?php 

// 分数更新,要知道更新谁,所有需要openid,然后得到用户的分数
function updateScore($openid,$newScore){
	$mysqli = new mysqli(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);

	if ($mysqli->connect_errno) {
		die($mysqli->connect_error);
	}
	$mysqli->query("set names utf8");
	$sql = "UPDATE userInfo SET score = $newScore WHERE openid = '$openid'";
	$result = $mysqli->query($sql);
	$mysqli->close();
}
$openid = $_GET["openid"];  // openid没法拿到
$newScore = $_GET["score"];
updateScore($openid,$newScore);

function getScore($openid){
	$mysqli = new mysqli(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);

	if ($mysqli->connect_errno) {
		die($mysqli->connect_error);
	}

	$mysqli->query("set names utf8");
	$sql = "SELECT * FROM userInfo WHERE openid = '$openid'";
	$result = $mysqli->query($sql);
	$score = 0;
	if ($result->num_rows) {
		$user = $result->fetch_assoc();
		$score = $user["score"];
	}

	$mysqli->close();
	return $score;
}

$openid = $_GET["openid"];
$newScore = $_GET["score"];
$score = getScore($openid);
if ($newScore > $score) {
	updateScore($openid,$newScore);
	echo $newScore;
}else{
	echo $score;
}






 ?>