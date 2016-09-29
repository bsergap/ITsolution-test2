<?php
// Без специальных функций для работы с массивами.
$diff = $tmp = array();
foreach($arr as $k => $v) {
	if($tmp[$v])
		$diff[$v] = &$tmp[$v];
	$tmp[$v][] = $k;
}

$num = key($diff);
list($key1, $key2) = reset($diff);
unset($tmp, $k, $v);
