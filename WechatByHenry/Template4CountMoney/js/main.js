var openid; 
requestByGET("http://wuhaiyang.applinzi.com/shuqian/php/get_openid.php",function(res){
	openid = res;
});


//通过id获取元素
function getElementByID(ID){
	return document.getElementById(ID);
}

//录入用户信息 界面
var user_data_div = getElementByID("user_data");


//获取开始挑战按钮，添加点击事件。点击之后，显示 录入用户信息 界面
var beigin_challenge_btn = getElementByID("start_btn");
beigin_challenge_btn.onclick = function(){
	user_data_div.style.display = "block";
}


//关闭 录入用户信息 界面
var close_user_data_btn = document.getElementsByClassName("close")[0];
close_user_data_btn.onclick = function(){
	user_data_div.style.display = "none";
}


function show_rule_div(){
	//活动规则界面
	var activity_rule_div = getElementByID("activity_rule");
	activity_rule_div.style.display = "block";
}

function hidden_rule_div(){
	//活动规则界面
	var activity_rule_div = getElementByID("activity_rule");
	activity_rule_div.style.display = "none";
}

//显示活动规则界面
var activity_rule_btn = document.getElementsByClassName("activity_rule")[0];
activity_rule_btn.onclick = show_rule_div;

var activity_rule_btn2 = document.getElementsByClassName("activity_rule")[1];
activity_rule_btn2.onclick = show_rule_div;

//关闭活动规则界面
var close_activity_rule_btn = document.getElementsByClassName("close")[1];
close_activity_rule_btn.onclick = hidden_rule_div;



function show_prize_div(){
	//活动奖品界面
	var prize_div = getElementByID("prize");
	prize_div.style.display = "block";
}

function hidden_prize_div(){
	//活动奖品界面
	var prize_div = getElementByID("prize");
	prize_div.style.display = "none";
}


//显示活动奖品界面
var prize_div_btn = document.getElementsByClassName("prize")[0];
prize_div_btn.onclick = show_prize_div;

var prize_div_btn2 = document.getElementsByClassName("prize")[1];
prize_div_btn2.onclick = show_prize_div;

//关闭活动奖品界面
var close_prize_btn = document.getElementsByClassName("close")[2];
close_prize_btn.onclick = hidden_prize_div;



function show_shiyong_div(){
	//使用说明界面
	var shiyong_div = getElementByID("shiyong");
	shiyong_div.style.display = "block";
}

function hidden_shiyong_div(){
	//活动奖品界面
	var shiyong_div = getElementByID("shiyong");
	shiyong_div.style.display = "none";
}


//显示使用说明界面
var shiyong_btn = document.getElementsByClassName("shiyong")[0];
shiyong_btn.onclick = show_shiyong_div;

var shiyong_btn2 = document.getElementsByClassName("shiyong")[1];
shiyong_btn2.onclick = show_shiyong_div;

//关闭使用说明界面
var close_shiyong_btn = document.getElementsByClassName("close")[3];
close_shiyong_btn.onclick = hidden_shiyong_div;


function show_ranking_div(){
	//数钱榜界面
	var ranking_div = getElementByID("ranking");
	ranking_div.style.display = "block";

	$url = "http://wuhaiyang.applinzi.com/shuqian/php/get_ranking_list.php";
	requestByGET($url,successCallback);
	function successCallback(res){
		var arrays = JSON.parse(res);
		var ul = getElementByID("ranking_ul");
        ul.innerHTML = "";

        for(var i = 0; i < arrays.length; i++){
            var li = document.createElement("li");
            if(i < 3){
                var str = '<span class="rank"></span><span class="username">'+arrays[i].nickname+'</span><span class="point">'+arrays[i].score+'分</span>';
                li.innerHTML = str;				
            }else{
                var str = '<span class="rank">'+(i+1)+'</span><span class="username">'+arrays[i].nickname+'</span><span class="point">'+arrays[i].score+'分</span>';
                li.innerHTML = str;
            }
            ul.appendChild(li);
        }
	}
}

function hidden_ranking_div(){
	//数钱榜界面
	var ranking_div = getElementByID("ranking");
	ranking_div.style.display = "none";
}


//显示使用说明界面
var ranking_btn = document.getElementsByClassName("ranking")[0];
ranking_btn.onclick = show_ranking_div;

var ranking_btn2 = document.getElementsByClassName("ranking")[1];
ranking_btn2.onclick = show_ranking_div;

//关闭排行榜界面
var close_ranking_btn = document.getElementsByClassName("close")[4];
close_ranking_btn.onclick = hidden_ranking_div;



//获取 用户信息 页面的 开始游戏按钮，点击之后，进入游戏主界面。并隐藏当前界面
var start_game_btn = getElementByID("start_game");
start_game_btn.onclick = function(){
	// //获取用户姓名
	// var user_name_input = getElementByID("user_name");
	// var user_name = user_name_input.value;
	// //获取用户手机号
	// var user_tel_input = getElementByID("user_tel");
	// var user_tel = user_tel_input.value;

	// if (checkUserName(user_name) == false || checkTelephone(user_tel) == false) {
	// 	return;
	// }

	user_data_div.style.display = "none";
	var p1_div = getElementByID("p1");
	p1_div.style.display = "none";
	var p2_div = getElementByID("p2");
	p2_div.style.display = "block";

		//框中的文字
	var p2_txt = getElementByID("p2_txt");
	var flag = 0;
	var changeTextTimer = setInterval(function(){
		var n = flag%3 + 1;
		p2_txt.src = "images/p2_txt"+n+".png";
		flag++;
	},2000);


	//记录成绩的变量
	var number = 0;
	//倒计时的变量
	var countNumber = 10;
	//时候开始倒计时的变量，开始数钱的时候（向上扫动的时候，变为true）
	var beginCount = false;
	var countNumberTimer = setInterval(function(){
		if (beginCount) {
			if(countNumber > 0){
				countNumber--;
				var clock = document.getElementsByClassName("clock")[0];
				clock.innerHTML = countNumber;
			}else{
				clearInterval(countNumberTimer);
				clearInterval(changeTextTimer);

				p2_div.style.display = "none";
				var p3_div = document.getElementById("p3");
				p3_div.style.display = "block";

				var result_num = getElementByID("result_num");
				result_num.innerHTML = "￥"+number;

				requestByGET("http://wuhaiyang.applinzi.com/shuqian/php/update_score.php?openid="+openid+"&score="+number ,function(score){
                	var high_score_span = getElementByID("highScore");
                    high_score_span.innerHTML = score;

                    requestByGET("http://wuhaiyang.applinzi.com/shuqian/php/get_ranking.php?score="+score ,function(res){
                		var result_rank_span = getElementByID("result_rank");
                    	result_rank_span.innerHTML = res;
               		 });
                    
                });

				//重新开始
				var  p3_again_btn = getElementByID("p3_again");
				p3_again_btn.onclick = function(){
					p1_div.style.display = "block";
					p3_div.style.display = "none";
					//重置一些数据
					var nums = document.getElementsByClassName("number");
					nums[0].innerHTML = 0;
					nums[1].innerHTML = 0;
					nums[2].innerHTML = 0;
					var clock = document.getElementsByClassName("clock")[0];
					clock.innerHTML = 5;
				}
			}
		}
	},1000);



	//添加触摸事件，触摸上去之后，取消默认事件
	touch.on(".qian_wrap","touchstart",function(e){
		e.preventDefault();
	});

	//向上扫动的事件
	touch.on(".qian_wrap","swipeup",function(e){

		//开始扫动之后，让手隐藏
		var p2_shou = getElementByID("p2_shou");
		p2_shou.style.display = "none";


		//开始计时
		beginCount = true;

		//创建一张钱币，并设置动画效果
		var moved_money = document.createElement("img");
		moved_money.src = "images/p2_qian.jpg";
		moved_money.className = "p2_qian_moved";

		//创建的钱币加到父节点上。
		var qian_wrap = document.getElementById("qian_wrap");
		qian_wrap.appendChild(moved_money);		


		//动画完毕之后，移除创建的钱币
		var timer = setTimeout(function(){
			qian_wrap.removeChild(moved_money);
		},1000);


		//成绩增1. 并提取出3位数字。
		number++;
		var numberStr = (number/100).toString();

		var num1 = numberStr.substr(0,1);
		var num2 = numberStr.substr(2,1);
		var num3 = numberStr.substr(3,1);
		if(!num3){
			num3 = 0;
		}
		if (!num2) {
			num2 = 0;
		}
		//3位数字分别设置给3个span标签
		var nums = document.getElementsByClassName("number");
		nums[0].innerHTML = num1;
		nums[1].innerHTML = num2;
		nums[2].innerHTML = num3;

	});
}


// function checkUserName(username){
// 	if (username.length < 5 || username.length > 16) {
// 		alert("用户名长度不对，应该在5到16个字符。");
// 		return false;
// 	}else{
// 		var regStr = /^[a-zA-Z][a-zA-Z0-9_]+$/;
// 		var reg = new RegExp(regStr);
// 		if (reg.test(username)) {
// 			return true;
// 		}else{
// 			alert("用户名不规范，应包括数字、字母、下划线，以字母开头。");
// 			return false;
// 		}
// 	}
// }

// function checkTelephone(tel){
// 	var regStr = /^1[3578][0-9]{9}$/;
// 	var reg = new RegExp(regStr);
// 	if (reg.test(tel)) {
// 		return true;
// 	}else{
// 		alert("手机号不正确，请输入正确的手机号");
// 		return false;
// 	}
// }
