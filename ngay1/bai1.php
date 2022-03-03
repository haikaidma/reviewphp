<?php 
for($x=1;$x<100;$x++)
{
    
    if($x%3==0&&$x%5==0)
    {
        echo"FizzBuzz<br>";
    }
    else {
        if($x%3==0)
            echo"Fizz<br>";
        else {
            if($x%5==0)
                echo"Buzz<br>";
                else
                echo $x."<br>";
        }
    }
}
?>