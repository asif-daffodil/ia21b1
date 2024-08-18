<?php  
    namespace student2;
    abstract class studentInfo {
        private $name = "Abdullah Al Noman";
        public function studentName()
        {
            return "Student Name is: ".$this->name;
        }
        abstract public function studentAddress();
    }

    interface studentInterface {
        public function studentAge();
    }

    trait studentTrait {
        public function studentRoll()
        {
            return "Student Roll is: 123456";
        }
    }

    class std extends studentInfo implements studentInterface {
        public function studentAddress()
        {
            return "Dhaka, Bangladesh";
        }

        public function studentAge()
        {
            return 25;
        }

        use studentTrait;

        public function studentBestFriend (int $age = 20): string
        {
            return "Student Best Friend's age is: $age";
        }
    }

    $student = new std;
    echo $student->studentAddress();
    echo "<br>";
    echo $student->studentName();
    echo "<br>";
    echo $student->studentAge();
    echo "<br>";
    echo $student->studentRoll();
    echo "<br>";
    echo $student->studentBestFriend(25);
?>