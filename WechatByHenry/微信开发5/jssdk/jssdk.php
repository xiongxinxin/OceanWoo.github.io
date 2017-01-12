<?php 

//微信JSSDK是微信提供的开发工具包，通过JSSDK，网页开发者可以借助微信高效地使用拍照、选图、语音、位置等手机系统的能力。同时可以直接使用微信分享、扫一扫、卡券、支付等微信特有的能力。
//使用JSSDK步骤：
//1、在微信公众平台网站绑定域名
//2、在需要的html的文件中引入微信的js文件。
//3、配置需要使用的接口
//4、使用对应的接口

//后台需要做一些微信对接的相关工作。
//1、存储access_token，因为access_token只有7200s的有效期
//2、存储jsapi_ticket，因为jsapi_ticket只有7200s的有效期
//3、生成jssdk权限验证的签名。对noncestr、jsapi_ticket、timestamp,url进行排序（参数按照字典序排列，key1=value1&key2=value2...拼成字符串，并对这个字符串进行sha1加密。）
//前端wx.config中的noncestr和timestamp必须与后台签名用的noncestr和timestamp一样。（后台写一个接口返回这些内容即可）

//处于安全考虑，签名的逻辑应该在服务器完成，所以服务器需要获取access_token和jsapi_ticket。
//jsapi_ticket是公众号用于调用微信JS接口的临时票据。正常情况下，jsapi_ticket的有效期为7200秒，通过access_token来获取。由于获取jsapi_ticket的api调用次数非常有限，频繁刷新jsapi_ticket会导致api调用受限，影响自身业务，开发者必须在自己的服务全局缓存jsapi_ticket 。

define('APPID','wx92a5b5a4849ae0e6');
define('APPSECRET','63ac1800b061c53dd2b05c35ecbe02d0');

function getAccessToken(){

	$accessInfo = getAccessInfo();
	if ($accessInfo == false) {
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;
		$res = httpGet($url);
		$obj = json_decode($res);
		$access_token = $obj->access_token;
		$expires_in = $obj->expires_in;
		$expires_time = time() + $expires_in - 100;
		$savedObj = (object)array();
		$savedObj->access_token = $access_token;
		$savedObj->expires_time = $expires_time;
		$jsonStr = json_encode($savedObj);
		saveAccessInfo($jsonStr);
		return $access_token;
	}else{
		$obj = json_decode($accessInfo);
		$expires_time = $obj->expires_time;
		$current_time = time();
		if($current_time < $expires_time){//access_token没过期
			return $obj->access_token;
		}else{//access_token过期了
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;
			$res = httpGet($url);
			$obj = json_decode($res);
			$access_token = $obj->access_token;
			$expires_in = $obj->expires_in;
			$expires_time = time() + $expires_in - 100;
			$savedObj = (object)array();
			$savedObj->access_token = $access_token;
			$savedObj->expires_time = $expires_time;
			$jsonStr = json_encode($savedObj);
			saveAccessInfo($jsonStr);
			return $access_token;
		}
	}
}

function getTicket(){
	$ticketInfo = getTicketInfo();
	if ($ticketInfo == false) {
		$access_token = getAccessToken();
		$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$access_token}&type=jsapi";
		$res = httpGet($url);
		$obj = json_decode($res);
		$ticket = $obj->ticket;
		$expires_in = $obj->expires_in;
		$expires_time = time() + $expires_in - 100;
		$savedObj = (object)array();
		$savedObj->ticket = $ticket;
		$savedObj->expires_time = $expires_time;
		$jsonStr = json_encode($savedObj);
		saveTicketInfo($jsonStr);
		return $ticket;
	}else{
		$obj = json_decode($ticketInfo);
		$expires_time = $obj->expires_time;
		$current_time = time();
		if($current_time < $expires_time){//ticket没过期
			return $obj->ticket;
		}else{//ticket过期了
			$access_token = getAccessToken();
			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$access_token}&type=jsapi";
			$res = httpGet($url);
			$obj = json_decode($res);
			$ticket = $obj->ticket;
			$expires_in = $obj->expires_in;
			$expires_time = time() + $expires_in - 100;
			$savedObj = (object)array();
			$savedObj->ticket = $ticket;
			$savedObj->expires_time = $expires_time;
			$jsonStr = json_encode($savedObj);
			saveTicketInfo($jsonStr);
			return $ticket;
		}
	}
}

function createNonceStr($length = 16){
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
}

function getSignPackageInfo(){
	$jsapiTicket = getTicket();
	// 注意 URL 一定要动态获取，不能 hardcode.
    //$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    //$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url = $_GET["url"];
    $timestamp = time();
    $nonceStr = createNonceStr();
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
    
    $signature = sha1($string);
    $signPackage = array(
      "ticket"    => $jsapiTicket,
      "appId"     => APPID,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return json_encode($signPackage);
}

echo getSignPackageInfo();


use sinacloud\sae\Storage as Storage;

function saveAccessInfo($accessInfo){
	$s = new Storage();
	//先看看是否有一个叫做jssdk的bucket
	$hasBucket = @$s->getBucket("jssdk");
	//如果没有叫做jssdk的bucket，创建一个bucket，取名叫jssdk
	if($hasBucket == false){
		$s->putBucket("jssdk",'.r:*');
	}

	//把access_token相关的信息存入jssdk下名为access_token.txt的文件中
	$s->putObject($accessInfo, "jssdk", "access_token.txt", array(), array('Content-Type' => 'text/plain;charset=utf-8'));
}

function getAccessInfo(){
	$s = new Storage();
	$hasBucket = @$s->getBucket("jssdk");
	if($hasBucket == false){
		return false;
	}else{
		$data = $s->getObject("jssdk", "access_token.txt");
		return $data->body;
	}
}

function saveTicketInfo($ticketInfo){
	$s = new Storage();
	//先看看是否有一个叫做jssdk的bucket
	$hasBucket = @$s->getBucket("jssdk");
	//如果没有叫做jssdk的bucket，创建一个bucket，取名叫jssdk
	if($hasBucket == false){
		$s->putBucket("jssdk",'.r:*');
	}

	//把access_token相关的信息存入jssdk下名为access_token.txt的文件中
	$s->putObject($ticketInfo, "jssdk", "ticket.txt", array(), array('Content-Type' => 'text/plain;charset=utf-8'));
}

function getTicketInfo(){
	$s = new Storage();
	$hasBucket = @$s->getBucket("jssdk");
	if($hasBucket == false){
		return false;
	}else{
		$data = $s->getObject("jssdk", "ticket.txt");
		return $data->body;
	}
}



//get请求，需要一个url作为参数
function httpGet($url){
	//使用cURL进行网络请求。cURL是一套函数，包含若干个函数。
	//创建一个用于网络请求的变量（可以简单想象为对象）。
	$cURL = curl_init();

	//做一些网络相关的设置。
	curl_setopt($cURL, CURLOPT_URL, $url);//设置需要访问的url
	curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);//本设置作用于curl_exec函数。curl_exec函数 默认返回一个表示请求成功与否的bool值，并且函数内部自带echo语句，echo请求到的数据内容。但很多情况下，我们不希望这个结果被打印出来，而是希望用一个变量去接收（保存）请求到的数据，便于以后使用。CURLOPT_RETURNTRANSFER设置为true，会让curl_exec函数返回请求到的数据（不在返回bool值），并且curl_exec不会再自动打印请求的数据。

	//执行网络请求，并接收请求的数据。
	$response = curl_exec($cURL);

	//关闭请求，并释放请求过程中占用的资源
	curl_close($cURL);

	return $response;
}

//post请求，需要2个参数，请求的url以及需要post的内容。
function httpPost($url, $postdata){
	//使用cURL进行网络请求。cURL是一套函数，包含若干个函数。
	//创建一个用于网络请求的变量（可以简单想象为对象）。
	$cURL = curl_init();

	//做一些网络相关的设置。
	curl_setopt($cURL, CURLOPT_URL, $url);//设置需要访问的url
	curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);//本设置作用于curl_exec函数。curl_exec函数 默认返回一个表示请求成功与否的bool值，并且函数内部自带echo语句，echo请求到的数据内容。但很多情况下，我们不希望这个结果被打印出来，而是希望用一个变量去接收（保存）请求到的数据，便于以后使用。CURLOPT_RETURNTRANSFER设置为true，会让curl_exec函数返回请求到的数据（不在返回bool值），并且curl_exec不会再自动打印请求的数据。
	curl_setopt($cURL, CURLOPT_POST, true);//设置请求方式是post
	curl_setopt($cURL, CURLOPT_POSTFIELDS, $postdata);//设置需要post的内容

	//执行网络请求，并接收请求的数据。
	$response = curl_exec($cURL);

	//关闭请求，并释放请求过程中占用的资源
	curl_close($cURL);

	return $response;
}



 ?>