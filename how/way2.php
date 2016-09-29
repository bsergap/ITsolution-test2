<?php
// Большая длительность из-за использования функции array_keys.
foreach($arr as $val) {
	$tmp = array_keys($arr, $val);
	if(count($tmp) > 1) {
		$num = $val;
		list($key1, $key2) = $tmp;
		// break;
	}
}
