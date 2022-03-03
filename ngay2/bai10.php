<?php 
$n=5;
$tong=0;
if($n<=1&&$n>0){
$tong= $n*15000;
}
else{
    if($n>1&&$n<=5)
    {
        $tong= $n*12000;
    }
    else
        if($n>=6)
        {
            $tong= $n*9000;
        }
        else
            if($n>=140)
            {
                $tong=$n*9000-($n*9000*0.12);
            }
}
echo "Số tiền cần thanh toán:".$tong;
    ?>
    