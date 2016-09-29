<?php
/**
 * @author SergA (BSergAP) @copyright 2013
 * Назначение: линейное и циклическое тестирование производительности.
 * Возможности: вложеное тестирование за счет создания нескольких экземпляров.
 * Дополнительно: заполнение заголовков влияет на память, не поддерживает наследование.
 */
final class Test {
   private $point, $title;
   static function getPoint() {
      return array('Time' => microtime(true), 'Memory' => memory_get_usage()); // memory_get_peak_usage
   }
   function __construct($title = '{START}') {
      foreach(static::getPoint() as $key => $val)
         $this->point[$key] = 0;
      $this->title = $title;
   }
   function __invoke($title = '{POINT}') {
      $str = PHP_EOL.$this->title.PHP_EOL;
      $this->title = $title;
      foreach(static::getPoint() as $key => $val) {
         $str .= "\t$key:\t".($val - $this->point[$key]).PHP_EOL;
         $this->point[$key] = $val;
      }
      return $str;
   }
}

// function my_rand($min, $max) {
// 	$rand = rand()/getrandmax();
// 	$rand = $rand*($max-$min) +$min;
// 	return round($rand);
// }
?>

<?php
echo '<pre>';
set_time_limit(900);
ini_set('memory_limit', '1024M');
$tester = new Test('== Начальные параметры ==');

//////////////////////////////////////////////////
echo $tester('----- Инициализация -----');
$eval = <<<'EVAL'

	$min = 0;
	$max = pow(2, 32);
	$cnt = $_GET['cnt'] ?:
		9999; // <b>?cnt=999999</b>
	$arr = array();

EVAL;
echo $eval;
eval($eval);

//////////////////////////////////////////////////
echo $tester('--- Заполнение данных ---');
for($i = 0; $i < $cnt; $i++) {
	$cnt2 = $cnt - count($arr);
	if(!$cnt2) break;

	for($j = 0; $j++ < $cnt2;) {
		$arr[rand($min, $max)] = true;
	}
}
$arr = array_keys($arr);
unset($cnt2, $i, $j);

$rand = rand(0, $cnt);
$key = array_rand($arr);
$val = $arr[$key];
if($rand == $cnt)
	$arr[] = $val;
else {
	shuffle($arr);
	array_splice($arr, $rand, 0, $val);
}
unset($rand, $key, $val);

//////////////////////////////////////////////////
for($i = 0; $i++ < 5;) { 
	echo $tester("--- Замеры способа №$i ---");
	include "../how/way$i.php";
	echo "<hr><b>Способ №$i:</b>".PHP_EOL;
	echo strtr(file_get_contents("../how/way$i.php"),
		array('<?php' => '', '?>' => ''));
	echo PHP_EOL.
		'<b>Число:</b> '.$num.PHP_EOL.
		'<b>Ключ 1:</b> '.$key1.PHP_EOL.
		'<b>Ключ 2:</b> '.$key2.PHP_EOL;
	unset($num, $key1, $key2);
}

//////////////////////////////////////////////////
echo $tester();
echo '</pre>';
