<?php
class test
{
    public $onCallBackFunction = null;
    public function fun($o, $t)
    {
        call_user_func($this->onCallBackFunction, $o, $t);
    }
}

$test = new test();
$test->onCallBackFunction = function ($o, $t) {
    echo '$paramOne' . $o . "<br>";
    echo '$paramTow' . $t . "<br>";
};
$test->fun("123", "987");


interface Interfaces
{
    public function callBack($param1, $param2);
    public function anonymous($param1, $param2);
}

class Cls implements Interfaces
{
    public function callBack($param1, $param2)
    {
        echo 'Cls $param1' . $param1 . "\n";
        echo 'Cls $param2' . $param2 . "\n";
        $this->anonymous($param1, $param2);
    }

    public $anonymousCallBack;

    public function anonymous($param1, $param2)
    {
        //闭包了，无法通过 $this->anonymousCallBack($param1, $param2); 来触发回调，只能通过以下方式来实现
        call_user_func($this->anonymousCallBack, $param1, $param2);
    }
}

$cls = new Cls();
//匿名函数接收回调F
$cls->anonymousCallBack = function ($param1, $param2) {
    echo '匿名函数接收回调 $param1' . $param1 . "\n";
    echo '匿名函数接收回调 $param2' . $param2 . "\n";
};
//触发回调
$cls->callBack("你好", "World");
