<?php 
$n=2;
 function isPrimeNumber($n) {
    if ($n < 2) {
        return false;
    }
    for($i = 2; $i <= sqrt ( $n ); $i ++) {
        if ($n % $i == 0) {
            return false;
        }
    }
    return true;
}
if(isPrimeNumber($n)==true)
echo $n." IS PRIME";
else
echo $n." IS NOT PRIME";
?>