<?php
$n=4;
for ($i = 1; $i <= $n; $i++) {
    for ($j = $i; $j < $n; $j++) {
        echo "0";
    }

    for ($j = 1; $j <= (2 * $i - 1); $j++) {
        echo "1";
    }

    echo "<br>";
}
?>