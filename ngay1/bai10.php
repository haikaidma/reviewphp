<?php
$arr=array("0","1","2","3","4");
//đếm độ dài trong mảng
echo "Độ dài mảng:".count($arr)."<br>"  ;
//xoá phần tử đầu tiên và thứ 3
unset($arr[0]);
unset($arr[3]);
// chèn "số3" vào mảng
echo "Mảng sau khi xoá: "."<br>";  
		foreach ($arr as $x)   
		{
			echo "$x ";
        }
    $pt_insert="số 3";
array_splice( $arr, 3, 0, $pt_insert );   
echo "<br>"."Mảng sau khi chèn phần tử: "."<br>";  
		foreach ($arr as $x)   
		{
			echo "$x ";
		}  
		echo "<br>";
?>