<?php  
$n=7;
$total=0;
$i= 1;
while($i<=$n)
{
    $j=1;
    $multiply = 1;
    while($j<=$i)
    {
        $multiply=$multiply*$j;
    }
    $total=$total+$multiply;
}
echo $total;
?>