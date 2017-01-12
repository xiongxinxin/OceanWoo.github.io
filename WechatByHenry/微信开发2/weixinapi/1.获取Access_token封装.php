<?php 
	
	class Weixin{
		private $appID = "wx92a5b5a4849ae0e6";
		private $appsecret = "63ac1800b061c53dd2b05c35ecbe02d0";

		function getAccessToken(){
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appID}&secret={$this->appsecret}";
			// return $this->httpGet($url);

			// json字符串解析
			$json = $this->httpGet($url);
			$obj = json_decode($json);
			return $obj->access_token;
		}

		function httpGet($url){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$res = curl_exec($curl);
			curl_close($curl);
			return $res;
		}

		function httpPost($url,$data){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

			$response = curl_exec($curl);
			curl_close($curl);
			return $response;
		}
	}

	$wx = new Weixin();
	echo $wx->getAccessToken();
	
	

 ?>