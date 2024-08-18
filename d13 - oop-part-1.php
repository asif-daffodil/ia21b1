<?php  
    namespace student1;
    class studentInfo {
        public $name1 = "Shamima Afroz";
        protected $name2 = "Nil Kumar";
        private $name3 = "Sazzad Khan";

        public function student1 () 
        {
            return "This is ".$this->name1.". And I am a classmate of ".$this->name2." and I am also a friend of ".$this->name3;
        }

        public function __construct($msg)
        {
            echo $msg."<br>";
        }

        public function __destruct()
        {
            echo "<br>This is the end of the class";
        }
    }

    $student = new studentInfo("Hello World");
    echo $student->name1;
    echo "<br>";
    echo $student->student1();
    // echo $student->name2;
    echo "<br>";

    $studentDouble = new studentInfo("Hello Bangladesh");

    class otherStudent extends studentInfo {
        public function student2 ()
        {
            return "This is ".$this->name2.". I am a classmate of ".$this->name1;
        }
    }

    $student2 = new otherStudent("Hello Universe");
    echo "<br>";
    echo $student2->student2();
    echo "<br>";


    class sadik 
    {
        public static $name = "Sadik Hossain";
        public const name = "Sadik Hossain";

        private function __construct()
        {
            return "Naima Akter";
        }
    }

    // $sadikInstance = new sadik();

    sadik::$name = "Sadik Karmakar";
    echo "<br>";
    echo sadik::name;
?>