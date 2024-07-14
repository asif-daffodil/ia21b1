<?php 
    $x = 10;
    
    if($x > 5) {
        echo "Greater than 5<br>";
    } else {
        echo "Less than 5<br>";
    } 
   

    echo ($x > 5) ? "Greater than 5<br>" : "Less than 5<br>";
?>

<?php if($x > 50){ ?>
    <h2>This is heading 2</h2>
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro alias illum quia autem, explicabo, perferendis, non expedita ipsum laborum natus sed. Magni voluptas eligendi ducimus iusto consequatur, quo assumenda amet.
    </p>
    <button>Read more</button>
<?php } ?>

<?php  
    $y = 0;
    while($y < 10){
        echo $y."<br>";
        $y++;
    }

    echo $y."<br>";

    //  limit 1 - 5000
    // divided by 13
    // remainder is 6
    // print the numbers


    
    $a = 1;
    while($a <= 5000){
        if($a > 13 && $a % 13 == 6){
            echo $a.", ";
        }
        $a++;
    }

    echo "<br>";

    for ($i = 0; $i < 10; $i++) {
        echo $i."<br>";
    }

    $z = 20;
    do{
        echo $z."<br>";
        $z++;
    }while($z < 10)
?>