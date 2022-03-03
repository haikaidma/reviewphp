<?php
$n=10;
$total=0;
for($i=0;$i<=$n;$i++)
{
    if($i%2==1)
        $total=$total+$i;
}
echo $total;
?>