
function httpGet(str,completeCallback,errorCallback){
	// 1.创建xmlHttp对象
	var xmlHttp;

	// 处理兼容
	if (window.XMLHttpRequest) {
		xmlHttp = new XMLHttpRequest();
	} else {
		xmlHttp = new ActiveXObject();
	}

	// 2.配置信息
	xmlHttp.open("GET","foodstore.php?name="+str,true);

	// 3.发送请求
	xmlHttp.send(null);

	// 4.监听状态
	xmlHttp.onreadystatechange = function(){
		if (xmlHttp.readyState == 4) {
			if(xmlHttp.status == 200){
				if(completeCallback){
					completeCallback(xmlHttp.responseText);
				}
			}
		} else {
			if(errorCallback){
				errorCallback(xmlHttp.status);
			}
		}
	}
}

var username = document.getElementById("username");
var content = document.getElementById("content");

username.onkeyup = function(){
	httpGet(this.value,successCallback,errorCallback);

	function successCallback(responseText){
		content.innerHTML = responseText;
	}

	function errorCallback(statusText){
		content.innerHTML = statusText;
	}
}






