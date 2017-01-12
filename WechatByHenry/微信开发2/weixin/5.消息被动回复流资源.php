<?php 
	
	// 最简单的验证方式
	// echo $_GET["echostr"];  

	// 验证是否是来自于微信
	function checkWeixin(){
		// 微信会发送四个参数到我们的服务器后台 签名 时间戳 随机字符串 随机数
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
		$echostr = $_GET["echostr"];
		$token = "wuhaiyang";
		
		// 1）将token、timestamp、nonce三个参数进行字典序排序
		$tmpArr = array($nonce,$token,$timestamp);
		sort($tmpArr,SORT_STRING);

		// 2）将三个参数字符串拼接成一个字符串进行sha1加密
		$str = implode($tmpArr);
		$sign = sha1($str);

		// 3）开发者获得加密后的字符串可与signature对比，标识该请求来源于微信
		if ($sign == $signature) {
			echo $echostr;
		}
	}

	// checkWeixin();

	// 服务器处理微信转发过来的数据

	// 1.获取xml数据(微信用户发过来的消息或者事件)
	$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
	// 判断postStr是否为空
	if (empty($postStr) == false) {
		// 如果不为空,引入xml解析库
		libxml_disable_entity_loader(true);
        // 将$postStr进行解析      	
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);	

        // 获取消息的类型
        $MsgType = $postObj->MsgType;

        switch ($MsgType) {
        	case 'text':
        		echo handleText($postObj);
        		break;

        	case 'image':
        		echo handleImage($postObj);
        		break;

        	case 'event':
        		echo handleEvent($postObj);
        		break;
        	
        	default:
        		echo "";
        		break;
        }
	}

	function handleText($postObj){
		// 获取公众号的ID
		$ToUserName = $postObj->ToUserName;

		// 粉丝的ID
		$FromUserName = $postObj->FromUserName;

		// 拿到用户发的信息
		$Content = $postObj->Content;

		$sendText = "收到".$Content;

		$time = time(); // 获取当前的时间

		$echostr = <<<TTTTT
			<xml>
			<ToUserName><![CDATA[{$FromUserName}]]></ToUserName>
			<FromUserName><![CDATA[{$ToUserName}]]></FromUserName>
			<CreateTime>{$time}</CreateTime>
			<MsgType><![CDATA[text]]></MsgType>
			<Content><![CDATA[{$sendText}]]></Content>
			</xml>
TTTTT;
		return $echostr;
	}

	function handleImage($postObj){
		// 获取公众号的ID
		$ToUserName = $postObj->ToUserName;

		// 粉丝的ID
		$FromUserName = $postObj->FromUserName;

		// 拿到用户发的图片
		$PicUrl = $postObj->PicUrl;

		$MediaId = $postObj->MediaId;

		// $sendText = "收到".$Content;

		$time = time(); // 获取当前的时间

		$echostr = <<<TTTTT
			<xml>
			<ToUserName><![CDATA[{$FromUserName}]]></ToUserName>
			<FromUserName><![CDATA[{$ToUserName}]]></FromUserName>
			<CreateTime>{$time}</CreateTime>
			<MsgType><![CDATA[image]]></MsgType>
			<Image>
			<MediaId><![CDATA[{$MediaId}]]></MediaId>
			</Image>
			</xml>
TTTTT;
		return $echostr;
	}

/*
<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[FromUser]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[CLICK]]></Event>
<EventKey><![CDATA[EVENTKEY]]></EventKey>
</xml>
 */
	function handleEvent($postObj){
		$ToUserName = $postObj->ToUserName;
		$FromUserName = $postObj->FromUserName;
		$Event = $postObj->Event;

		switch ($Event) {
			case 'CLICK':
				// 获取二级菜单中的CLICKKEY
				$EventKey = $postObj->EventKey;
				if ($EventKey == "sendText") {
					$sendText = "发送文字测试";
					$time = time();
					$echostr = <<<TTTTT
					<xml>
					<ToUserName><![CDATA[{$FromUserName}]]></ToUserName>
					<FromUserName><![CDATA[{$ToUserName}]]></FromUserName>
					<CreateTime>{$time}</CreateTime>
					<MsgType><![CDATA[text]]></MsgType>
					<Content><![CDATA[{$sendText}]]></Content>
					</xml>
TTTTT;
					return $echostr;
				}elseif ($EventKey == "sendImage") {
					$time = time();
					$MediaId = "vyMm17onV0ZWzoPMMLQsKrxrvDmk0AFceMqbcPht-BiTvRgdywkfvyZhmx76iO9t";
					$echostr = <<<TTTTT
					<xml>
					<ToUserName><![CDATA[{$FromUserName}]]></ToUserName>
					<FromUserName><![CDATA[{$ToUserName}]]></FromUserName>
					<CreateTime>{$time}</CreateTime>
					<MsgType><![CDATA[image]]></MsgType>
					<Image> 
					<MediaId><![CDATA[{$MediaId}]]></MediaId>
					</Image>
					</xml>
TTTTT;
					return $echostr;
				}elseif ($EventKey == "sendVideo") {
					$time = time();
					$MediaId = "vyMm17onV0ZWzoPMMLQsKrxrvDmk0AFceMqbcPht-BiTvRgdywkfvyZhmx76iO9t";
					$echostr = <<<TTTTT
					<xml>
					<ToUserName><![CDATA[{$FromUserName}]]></ToUserName>
					<FromUserName><![CDATA[{$ToUserName}]]></FromUserName>
					<CreateTime>{$time}</CreateTime>
					<MsgType><![CDATA[video]]></MsgType>
					<Video>
					<MediaId><![CDATA[{$MediaId}]]></MediaId>
					<Title><![CDATA[title]]></Title>
					<Description><![CDATA[description]]></Description>
					</Video> 
					</xml>
TTTTT;
					return $echostr;
				}
				break;
			
			default:
				echo "";
				break;
		}
	}
	
 ?>