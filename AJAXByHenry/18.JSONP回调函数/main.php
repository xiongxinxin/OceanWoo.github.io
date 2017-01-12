<?php 
	
	header("Content-Type:text/json");
	// cb
	$callback = $_GET["callback"];

	$arr = [
		["name"=>"Henry","sex"=>"男","age"=>28],
		["name"=>"Bucky","sex"=>"男","age"=>28],
		["name"=>"Elise","sex"=>"女","age"=>18]
	];

	echo $callback."(".json_encode($arr).")";

 ?>