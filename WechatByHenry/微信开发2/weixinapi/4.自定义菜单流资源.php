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

		function createMenu(){
			$access_token = $this->getAccessToken();
			$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
			$postBody = '{
			     "button":[
			      	{
			           "name":"点击事件",
			           "sub_button":[
			           {	
			               "type":"click",
			               "name":"发送文字",
			               "key":"sendText",
			               "sub_button":[]
			            },
			            {
			               "type":"click",
			               "name":"发送图片",
			               "key":"sendImage",
			               "sub_button":[]
			            },
			            {
			               "type":"click",
			               "name":"发送语音",
			               "key":"sendVoice",
			               "sub_button":[]
			            },
			            {
			               "type":"click",
			               "name":"发送视频",
			               "key":"sendVideo",
			               "sub_button":[]
			            }]
			       },{
			       		"name":"扫码相册",
			       		"sub_button":[{
			       			"type":"pic_sysphoto",
			       			"name":"相机",
			       			"key":"camera",
			       			"sub_button":[]
			       		},,{
			               "type":"pic_weixin",
			               "name":"相册",
			               "key":"album",
						   "sub_button":[]
			            },{
			               "type":"pic_photo_or_album",
			               "name":"相册或相机",
			               "key":"photoOrAlbum",
						   "sub_button":[]
			            },{
			               "type":"scancode_waitmsg",
			               "name":"扫码带提示",
			               "key":"scancodeText",
						   "sub_button":[]
			            },{
			               "type":"scancode_push",
			               "name":"扫一扫",
			               "key":"scancode",
						   "sub_button":[]
			            }]
			       },{
		            	"name":"其他事件",
		            	"sub_button":[{
		            		"name":"课后帮",
		            		"type":"view",
		            		"url":"http://www.wuocean.com"
		            	},{
		            		"name":"发送位置",
		            		"type":"location_select",
		            		"key":"sendLocation"
		            	}]
	            }]
			 }';
			return $this->httpPost($url,$postBody);
		}

		function deleteMenu(){
			$access_token = $this->getAccessToken();
			$url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={$access_token}";
			return $this->httpGet($url);
		}

		function uploadMedia($type,$filename){
			$access_token = $this->getAccessToken();
			$url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token={$access_token}&type={$type}";
			$postBody = array("media"=>"@".realpath($filename));
			return $this->httpPost($url,$postBody);
		}
	}

	$wx = new Weixin();
	// 先上传一张图片在SAE上,然后在获取mediaId
	echo $wx->uploadMedia("image","1.png");
	
	
	

 ?>