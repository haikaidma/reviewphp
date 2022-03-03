<?php 
$arr= array("Hoang"=>"31","Nam"=>"41","Minh"=>"39","Hoa"=>"40");
echo "Mảng sau ban đầu: "."<br>";  
foreach ($arr as $x=> $val)   
		{
			echo "$x=$val<br> ";
        }
asort($arr);
echo "Mảng sau khi sắp xếp: "."<br>";  
foreach ($arr as $x=> $val)
		{
			echo "$val<br> ";
        }
foreach ($arr as $x=> $val)   
		{
            if($val==max($arr))
			echo "$x<br> ";
        }
        foreach ($arr as $x=> $val)   
		{
            if($val==min($arr))
			echo "$x<br> ";
        }
?>