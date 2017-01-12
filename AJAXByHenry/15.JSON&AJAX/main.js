var pageCount = 1;
var dataContainer = document.getElementById("data-info");
var btn = document.getElementById("btn");

// 添加点击事件
btn.addEventListener("click",function(){

	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("GET","https://learnwebcode.github.io/json-example/animals-" + pageCount + ".json",true);
	xmlHttp.onload = function(){
		// console.log(xmlHttp.responseText[0]);

		// json数据,要使用,先解析
		var ourData = JSON.parse(xmlHttp.responseText);

		// console.log(ourData[2].name);
		renderHTML(ourData);
	}

	xmlHttp.send(null);

	pageCount++;

	// 判断接口如果不存在,那么不让用户进行点击
	if (pageCount > 3) {
		btn.style.display = "none";
	}
},false);

// 将请求下来的数据,展示到前端页面中
function renderHTML(data){
	var htmlString = "";

	// data是一个数组,所以要循环遍历
	for(var i = 0; i < data.length; i++){
		htmlString += "<p>" + data[i].name + " is a " + data[i].species + " and likes ";

		// 深层的数据 food -> likes -> 数据
		for(var j = 0; j < data[i].foods.likes.length; j++){
			htmlString += data[i].foods.likes[j];
		}

		// 深层的数据 food -> likes -> 数据
		for(var k = 0; k < data[i].foods.dislikes.length; k++){
			htmlString += " and " + data[i].foods.dislikes[k];
		}

		htmlString += ".</p>";
	}


	// 插入json数据的方法
	dataContainer.insertAdjacentHTML("beforeEnd",htmlString);
}


