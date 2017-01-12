<?php 

	class Person{
		public $name = "zhangsan";
		protected $sex = "男";
		private $age = 18;

		public function test(){
			// echo "test".$this->name."<hr>";
			// echo "test".$this->sex."<hr>";
			echo "test".$this->age."<hr>";
		}

		public function getAge(){
			return $this->age;
		}
	}

	class Teacher extends Person{
		public function test1(){
			$p1 = new Person();
			// echo $p1->name;
			// echo $p1->sex;
			echo $p1->getAge();
		}
	}

	class Student extends Person{
		public function test2(){
			echo "test2";
		}
	}

	/*  可见度(public)
	 *  public修饰的属性和方法,可以在任何地方访问(通过对象->属性)
	 *  public 类外部可以访问
	 *  public 类内部可以访问
	 *  public 子类内部可以访问
	 */
	$p1 = new Person();
	// echo $p1->name;
	// $p1->test();


	$t1 = new Teacher();
	// $t1->test1();

	/*  可见度(protected)
	 *  protected 修饰的属性和方法,可以本类以及子类内部访问
	 *  protected 类外部不可以访问
	 *  protected 类内部可以访问
	 *  protected 子类内部可以访问
	 */
	// echo $p1->sex;
	// $p1->test();
	// $t1->test1();

	/*  可见度(private)
	 *  private 修饰的属性和方法,只能在本类中访问,但是如果外部和子类想要访问,需要在本类中写方法.
	 *  private 类外部不可以访问
	 *  private 类内部可以访问
	 *  private 子类内部不可以访问
	 */
	// echo $p1->age;
	// $p1->test();

	// $t1->test1();

	// 外部就想私有变量
	// echo $p1->getAge();
	// echo $t1->test1();
 ?>