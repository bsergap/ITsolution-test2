<?php
// С помощью сортировки.
// Стало интересно сколько займет ресурсов.
asort($arr); $prev = array();
foreach($arr as $key => $val) {
	if($prev && $prev['val'] == $val) {
		$num = $val; //$prev['val']
		$key1 = $key;
		$key2 = $prev['key'];
		// break;
	}
	$prev['key'] = $key;
	$prev['val'] = $val;
}
