<?php 

	// 类和对象

	// 创建一个类
	class Person{
		// 属性
		public $name;
		public $sex;
		public $age;

		// 方法
		public function sayHello(){
			echo "hello"."<hr>";
		}

		public function description(){
			return "姓名:{$this->name},
			性别:{$this->sex},
			年龄:{$this->age}";
		}

		// 封装的set方法
		public function setAge($age){
			if ($age <= 0 || $age >= 200) {
				$this->age = 18;
			}else{
				$this->age = $age;
			}
		}
		// get方法
		public function getAge(){
			return $this->age;
		}

	}

	// 创建对象
	$p1 = new Person();
	$p1->name = "广军";
	echo $p1->name;
	$p1->sex = "男";
	echo $p1->sex;
	echo "<hr>";

	// 封装
	$p1->age = -1000;

	$p1->setAge(20);
	echo $p1->getAge();

	$p1->sayHello();
	echo $p1->description();
 ?>