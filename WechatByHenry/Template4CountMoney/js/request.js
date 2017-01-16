/*
 *url是我们网络请求的地址。
 *successCallback是请求成功的回调函数。
 *errorCallback是请求失败的回调函数。
*/
function requestByGET(url,successCallback,errorCallback){

	if(window.XMLHttpRequest){
		var request = new XMLHttpRequest();
	}else{
		var request = new ActiveXObject("Microsoft.XMLHTTP");
	}

	request.open("GET",url,true);
	request.send();
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
			//如果调用函数的时候，传入了成功的回调函数，我们调用一下这个回调函数，并把服务器返回的数据作为回调函数的参数，供外界使用。
			if(successCallback){
				successCallback(request.responseText);
			}
		}else if(request.readyState == 4 && request.status != 200){
			if(errorCallback){
				errorCallback(request.statusText);
			}
		}
	}
}


/*
 *url是我们网络请求的地址。
 *postbody这是url对应的请求参数。
 *successCallback是请求成功的回调函数。
 *errorCallback是请求失败的回调函数。
*/
function requestByPOST(url,postbody,successCallback,errorCallback){

	if (window.XMLHttpRequest) {
		var request = new XMLHttpRequest();
	}else{
		var request = new ActiveXObject("Microsoft.XMLHTTP");
	}

	request.open("POST",url,true);
	request.setRequestHeader("content-type","application/x-www-form-urlencoded");
	request.send(postbody);

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			if(successCallback){
				successCallback(request.responseText);
			}
		}else if(request.readyState == 4 && request.status != 200){
			if (errorCallback) {
				errorCallback(request.statusText);
			}
		}
	}
}


