<?php
// Большой расход памяти из-за использования дополнительных массивов.
$rra2 = array_flip($arr);
$arr2 = array_flip($rra2);
$diff = array_diff_key($arr, $arr2);
$key1 = key($diff);
$num = $arr[$key1];
$key2 = $rra2[$num];
unset($rra2, $arr2);
