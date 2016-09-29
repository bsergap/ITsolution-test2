<?php
// Есть лишний расход памяти из-за использования дополнительного массива.
array_walk($arr,
	function($v, $k, $t) {
		static $tmp;
		if(!$tmp[$v]) {
			$tmp[$v] = $k;
		} else {
			$t['num'] = $v;
			$t['key1'] = $k;
			$t['key2'] = $tmp[$v];
		}
	}, array(
		'num' => &$num,
		'key1' => &$key1,
		'key2' => &$key2
	));
