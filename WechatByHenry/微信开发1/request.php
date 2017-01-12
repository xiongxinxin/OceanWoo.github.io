<?php 


// curl请求


	// 1.初始化一个curl 2.对curl进行配置 3.执行curl 4.关闭curl
	function httpGet($url){
		$curl = curl_init();
		/* 三个参数
		 * 1.初始化的curl
		 * 2.配置的项目叫啥名字
		 * 3.项目对应的值
		 */
		curl_setopt($curl,CURLOPT_URL,$url);
		
		// CURLOPT_RETURNTRANSFER 可以让exec执行不自动打印
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		// 执行curl,但默认是一个bool值,exec本身就会自动打印,所以需要处理
		$res = curl_exec($curl);
		// 关闭curl
		curl_close($curl);
		
		return $res;
	}

	$url = "https://api.weixin.qq.com/cgi-bin/token?
	grant_type=client_credential&
	appid=wx92a5b5a4849ae0e6&
	secret=63ac1800b061c53dd2b05c35ecbe02d0";

	$response = httpGet($url);

	// 获取token
	echo $response;

	{'access_token':"asdfasfdafadsfafdasf"}

	
	function httpPost($url,$data){
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_POST,true);
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		$res = curl_exec($curl);
		curl_close($curl);
		return $res;
	}
	$url = "https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=刚刚获取的token";
	$data = {
		"openid":"ofuJjwfbaK9XZCmni-qHsLXpvaZE",
		"remark":"小吴"
	}
	httpPost($url,$data);

	// 验证 用户管理-获取用户基本信息

 ?>