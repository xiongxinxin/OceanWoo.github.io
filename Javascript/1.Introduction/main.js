
var btn1 = document.getElementById("btn1");
var btn2 = document.getElementById("btn2");


var temp = 0;
btn1.onclick = function(){
	temp++;
	alert("点击第" + temp + "次!");
}

btn2.onclick = function(){
	var personname = document.getElementById("textfile").value;
	if (personname) {
		alert(personname + " is a good name!");
	} else{
		alert("姓名不能为空!");
	}
	
}