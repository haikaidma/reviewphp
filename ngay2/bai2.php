<?php
$n=3;
$total=0;
for($x=1;$x<=$n;$x++)
{
    $multy=1;
    for($y=1;$y<=$x;$y++)
    {
        $multy=$multy*$y;
    }
    $total=$total+$multy;
}   
echo $total;
?>