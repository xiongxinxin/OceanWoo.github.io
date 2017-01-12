var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject() {
	var xmlHttp;

	// 处理兼容
	if (window.ActiveXObject) {
		try{
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e){
			xmlHttp = false;
		}
	}else{
		try{
			xmlHttp = new XMLHttpRequest();
		}catch(e){
			xmlHttp = false;
		}
	}

	if (!xmlHttp) {
		alert("不能创建这个对象");
	}else{
		return xmlHttp;
	}
}

function process(){
	if (xmlHttp.readyState == 0 || xmlHttp.readyState == 4) {
		food = encodeURIComponent(document.getElementById("userinput").value);

		// 配置xmlHttp对象
		xmlHttp.open("GET","foodstore.php?food"+food,true);
		xmlHttp.onreadystatechange = handleServerResponse;
		xmlHttp.send(null);
	} else {
		// 如果链接失败,那么1秒后重试
		setTimeout('process()',1000);
	}
}

// 处理响应
function handleServerResponse(){
	if (xmlHttp.readyState == 4) {
		if (xmlHttp.status == 200) {
			xmlResponse = xmlHttp.responseXML;
			xmlDocumentElement = xmlResponse.xmlDocumentElement;
			// 展示在页面的massage
			message = xmlDocumentElement.firstChild.data;

            // 创建内容到div中
			document.getElementById('underinput').innerHTML = 
			"<span style='color:blue'>" + message + "</span>";

			// 重试
			setTimeout('process()',1000);
		}    
	} else{
		alert("something went wrong!");
	}
}

