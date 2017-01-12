<?php 



function insertUserInfo($userObj){

	$openid = $userObj->openid;
	$nickname = $userObj->nickname;
	$sexNum = $userObj->sex;
	if ($sexNum==0) {
		$sex = "未知";
	}else if($sexNum==1){
		$sex = "男";
	}else{
		$sex = "女";
	}
	$province = $userObj->province;
	$city = $userObj->city;
	$country = $userObj->country;
	$headimgurl = $userObj->headimgurl;


	$mysqli = new mysqli(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);

	if ($mysqli->connect_errno) {
		die($mysqli->connect_error);
	}

	$mysqli->query("set names utf8");

	$sql = "INSERT INTO userInfo(openid,nickname,sex,province,city,country,headimgurl) VALUES('$openid','$nickname','$sex','$province','$city','$country','$headimgurl')";

	$result = $mysqli->query($sql);
	$mysqli->close();
}

function isUserExists($openid){
	$mysqli = new mysqli(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);

	if ($mysqli->connect_errno) {
		die($mysqli->connect_error);
	}
	$mysqli->query("set names utf8");
	$sql = "SELECT * FROM userInfo WHERE openid = '$openid'";
	$result = $mysqli->query($sql);
	$isExists = false;
	if ($result->num_rows) {
		// return true;
		$isExists = true;
	}else{
		// return false;
		$isExists = false;
	}
	$mysqli->close();
	return $isExists;
}









 ?>