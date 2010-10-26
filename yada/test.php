<?php

$arr = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
foreach ($arr as $m =>$x) {
    if($m == 3){
        $arr[$m] = 12;
    }
}

print_r($arr);
?>
