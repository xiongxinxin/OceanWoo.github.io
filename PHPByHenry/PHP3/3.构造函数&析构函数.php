<?php 
	
	class Person{
		public $name;
		public $age;
		public $sex;

		public function description(){
			return "姓名:{$this->name},性别:{$this->sex},年龄:{$this->age}<hr>";
		}

		// 构造函数
		public function __construct($name="",$sex="",$age=""){
			echo "这是一个构造函数,无需调用自动执行<hr>";
			$this->name = $name;
			$this->sex = $sex;
			$this->age = $age;
		}

		// 析构函数
		public function __destruct(){
			echo "这是析构函数,对象销毁前,自动执行此函数<hr>";
		}
	}

	$p1 = new Person("张三","男",20);
	echo $p1->description()."<hr>";
	$p2 = new Person("李四","男",18);
	echo $p2->description()."<hr>";

	$p3 = new Person();
	echo $p3->description();
 ?>
