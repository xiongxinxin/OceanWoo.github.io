<?php 
	require("sql.php");


	$code = $_GET["code"];	
	$response = httpGet("https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxf0efccaca40b4143&secret=27c7f15be3b8d344332e00f36dc35960&code={$code}&grant_type=authorization_code");

	$jsonObj = json_decode($response);
	$access_token = $jsonObj->access_token;
	$openid = $jsonObj->openid;

	// 为了获取auth中的openid,所以使用session
	session_start();
	$_SESSION['openid']=$openid;


	$response = httpGet("https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN");
	$userInfo = json_decode($response);
	// 实现数据查重
	if (isUserExists($openid) == false) {
		insertUserInfo($userInfo);
	}
	
	echo "<script>window.location.href='../index.html';</script>";



function httpGet($url){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
}


function httpPost($url,$postBody){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $postBody);
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
}

 ?>