function httpPost(url,postBody,completeCallback,errorCallback){
	var xmlHttp;

	// 处理兼容
	if (window.XMLHttpRequest) {
		xmlHttp = new XMLHttpRequest();
	} else {
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	// 配置信息
	xmlHttp.open("POST",url,true);

	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	// 发送请求
	xmlHttp.send(postBody);

	// 监听状态
	xmlHttp.onreadystatechange = function(){
		if (xmlHttp.readyState == 4) {
			if (xmlHttp.status == 200) {
				if (completeCallback) {
					completeCallback(xmlHttp.responseText);
				}
			}
		}else{
			if (errorCallback) {
				errorCallback(xmlHttp.status);
			}
		}
	}
}

var btn = document.getElementById("btn");
var p = document.getElementById("p");

btn.onclick = function(){
	var url = "foodstore.php";
	var postBody = "username=henry&password=123456";

	httpPost(url,postBody,successCallback,errorCallback);

	function successCallback(responseText){
		p.innerHTML = responseText;
	}

	function errorCallback(statusText){
		p.innerHTML = statusText;
	}
}




