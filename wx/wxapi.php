<?php
	
	// 优化
	/**
	* 
	*/
	class Weixin
	{
		private $appID = "wx92a5b5a4849ae0e6";
		private $appsecret = "63ac1800b061c53dd2b05c35ecbe02d0";
		// 获取access_token的方法
		function getAccessToken(){
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appID}&secret={$this->appsecret}";

			// 处理token
			$json = $this->httpGet($url);
			$obj = json_decode($json);

			return $obj->access_token;
		}

		// 删除自定义菜单
		function deleteMenu(){
			$access_token = $this->getAccessToken();
			$url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={$access_token}";

			// get请求
			return $this->httpGet($url);
		}

		// 创建自定义菜单
		function createMenu(){
			// 获取token
			$access_token = $this->getAccessToken();
			// 获取url
			$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=ACCESS_TOKEN";
			$postBody = '{
			     "button":[
			     {	
			          "name":"点击事件",
			          "sub_button":[
						{
							"name":"发送文字",
							"type":"click",
							"key":"sendText",
							"sub_button":[]
						},{
							"name":"发送图片",
							"type":"click",
							"key":"sendImage",
							"sub_button":[]
						},{
							"name":"发送语音",
							"type":"click",
							"key":"sendVoice",
							"sub_button":[]
						},{
							"name":"发送视频",
							"type":"click",
							"key":"sendVideo",
							"sub_button":[]
						}
			          ]
			      },
			      {
			           "name":"扫码相册",
			           "sub_button":[
			           {	
			               "type":"pic_sysphoto",
			               "name":"相机",
			               "key":"camera",
						   "sub_button":[]
			            },
			            {
			               "type":"pic_weixin",
			               "name":"相册",
			               "key":"album",
						   "sub_button":[]
			            },
			            {
			               "type":"pic_photo_or_album",
			               "name":"相册或相机",
			               "key":"photoOrAlbum",
						   "sub_button":[]
			            },
			            {
			               "type":"scancode_waitmsg",
			               "name":"扫码带提示",
			               "key":"scancodeText",
						   "sub_button":[]
			            },
			            {
			               "type":"scancode_push",
			               "name":"扫一扫",
			               "key":"scancode",
						   "sub_button":[]
			            },{
			            	"name":"其他事件",
			            	"sub_button":[
			            	{
			            		"name":"蓝鸥科技",
			            		"type":"view",
			            		"url":"http://www.lanou3g.com"
			            	},{
			            		"name":"发送位置",
			            		"type":"location_select",
			            		"key":"sendLocation"
			            	}]
			            }]
			       }]
			 }';
			 return $this->httpPost($url,$postBody);
		}

		// get请求封装
		function httpGet($url){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($curl);
			curl_close($curl);

			return $response;
		}
		// post请求封装
		function htppPost($url,$postBody){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $postBody);

			$response = curl_exec($curl);
			curl_close($curl);

			return $response;
		}
	}

	$wx = new Weixin();
	// echo $wx->getAccessToken();
	// echo $wx->deleteMenu();
	echo $wx->createMenu();
?>