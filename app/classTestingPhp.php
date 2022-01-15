<?

class myClass{
    public $name;

    public function __construct($name){
        $this->name = $name;
    }

    private function myFun(){
        return $this->name;
    }

}

class myClass2 extends myClass{

    public function myFunNew(){
        return $this->myFun();
    }
    

}

// $test = new myClass2("test");

// echo $test->myFunNew();

class myStat{
    static $test ="test";
     static function myStatFun(){
        return "first stat";
    }
}

echo myStat::myStatFun();
echo myStat::$test;

