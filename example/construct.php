<?php
class Person {
    var $name;
    var $age;
    var $a;
	var $b;
	var $c;
    //定义一个构造方法初始化赋值
    function __construct($name, $sex, $age) {
        $this->name=$name;
        $this->age=$sex;
    }

    function say() {
        echo "我的名字叫：".$this->name."<br />";
	echo "我的年龄是：".$this->age;
    }
	function test($a,$b){
		echo $this->a=$a;
		echo $this->b=$b;
	}
}

$p1=new Person("张三", 20);
//$p1->say();
$p1->test('a');
?>