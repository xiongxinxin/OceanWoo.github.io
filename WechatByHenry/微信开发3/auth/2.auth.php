<?php 
	header("Content-type:text/html;charset=utf-8");

	// 获取code码,用于下一步换取access_token
	$code = $_GET["code"];

	// 第二步：通过code换取网页授权access_token
	$response = httpGet("https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx92a5b5a4849ae0e6&secret=63ac1800b061c53dd2b05c35ecbe02d0&code={$code}&grant_type=authorization_code");

	// json解析
	$jsonObj = json_decode($response);
	$access_token = $jsonObj->access_token;
	$openid = $jsonObj->openid;

	// 第四步：拉取用户信息(需scope为 snsapi_userinfo)
	$response = httpGet("https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN");

	// json解析
	$userinfo = json_decode($response);
	// 获取用户昵称
	$nickname = $userinfo->nickname;

	// 获取用户头像
	$headimgurl = $userinfo->headimgurl;
	echo "<img width=200px src='{$headimgurl}'>";

	// 跳转到一个新的页面
	echo "<script>window.location.href='http://wuhaiyang.applinzi.com/auth/yourpage.html'</script>";

	function httpGet($url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($curl);
		curl_close($curl);
		return $res;
	}
 ?>