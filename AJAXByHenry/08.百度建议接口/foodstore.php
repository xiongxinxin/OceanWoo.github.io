<?php 
	
	// 准备数据
	$array = 
	array("饭梦洁","王岩","石福利","石闯","张传明","张蕾");


	$name = $_GET["name"];

	$temp = "";
	if(strlen($name) > 0){
		for($i = 0; $i < count($array);$i++){
			// 判断用户输入的和数组的内容是否有匹配
			if($name == substr($array[$i],0,strlen($name))){
				$temp = $array[$i];


				if($temp == ""){
					$response = "没有匹配的内容!";
				}else{
					$response = $temp;
				}

				echo $response;
			}
		}
	}

	
 ?>