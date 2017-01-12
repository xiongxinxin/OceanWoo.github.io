
// 1.创建xmlHttpRequest对象
var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject(){
	
	var xmlHttp; 
	// 处理兼容
	if (window.ActiveXObject) {
		// 如果条件成立,代表当前浏览器是IE
		try{
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e){
			alert(e);
			xmlHttp = false;
		}
	} else {
		// 否则是其他浏览器
		try{
			xmlHttp = new XMLHttpRequest();
		}catch(e){
			alert(e);
			xmlHttp = false;
		}
	}

	// 异常判断
	if (!xmlHttp) {
		alert("不能创建这个对象");
	} else {
		return xmlHttp;
	}
}

// 2.与服务器建立通讯
function process(){
	if (xmlHttp.readyState == 0 || xmlHttp.readyState == 4) {
		// 拿到用户输入的内容
		var foodValue = document.getElementById("userinput").value;

		// 2.1配置xmlHttp对象
		xmlHttp.open("GET","foodstore.php?food="+foodValue,true);
		// 2.2发送请求
		xmlHttp.send(null);
		// 2.3监听状态码
		xmlHttp.onreadystatechange = handleServerResponse;
	} else {
		// 如果链接失败,1秒重试
		setTimout("process()",1000);
	}
}

// 3.处理响应
function handleServerResponse(){
	// 如果状态码等等于4,说明与服务器建立链接了,并且服务器尝试返回对应的数据
	if (xmlHttp.readyState == 4) {
		// 判断网络传输的状态码
		if(xmlHttp.status == 200){
			// 将返回的数据展示到页面中
			var xmlResponse = xmlHttp.responseXML;
			// 解析xml数据
			var xmlDocumentElement = xmlResponse.documentElement;
			// 拿到xml中的数据
			var message = xmlDocumentElement.firstChild.data;

			// 展示到前台页面
			document.getElementById("underinput").innerHTML = 
			"<span style='color:blue'>" + message + "</sapn>";

			// 重试
			setTimeout("process()",1000);
		}
	} else {
		// ("something went wrong...");
	}
}





















