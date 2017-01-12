<?php 

	// php中的继承原理和js如出一辙,都是单继承,一个父类可以拥有多个子类,但一个子类只能拥有一个父类.

	class Person{
		public $name;
		public $age;
		public $sex;

		public function description(){
			return "姓名:{$this->name},性别:{$this->sex},年龄:{$this->age}<hr>";
		}

		// 构造函数
		public function __construct($name="",$sex="",$age=""){
			$this->name = $name;
			$this->sex = $sex;
			$this->age = $age;
		}

		public function test1(){
			echo "这是方法1<hr>";
		}

		public function test2(){
			echo "这是方法2<hr>";
		}
	} 

	class Teacher extends Person{
		public $course;

		// 重写构造函数
		public function __construct($course="",$name="",$sex="",$age=""){
			// ::范围解析符第三种使用场景
			parent::__construct($name,$sex,$age);

			$this->course = $course;
		}
		// 重写description方法
		public function description(){
			return "课程:{$this->course},姓名:{$this->name},性别:{$this->sex},年龄:{$this->age}<hr>";
		}
	}

	$t1 = new Teacher("html+css","张三","男",20);
	echo $t1->description();

	// echo $t1->name."<hr>";

	// $t1->course = "html+css";
	// echo $t1->course."<hr>";
 ?>