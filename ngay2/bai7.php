<?php 
$n=100;
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
for($i = 0; $i < $n; $i ++) {
    if (isPrimeNumber ( $i )) {
        echo ($i . " ");
    }
}
?>