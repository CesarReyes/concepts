#!/usr/bin/env php
<?php
class n_right_ceros{
	
	static function calculate($n){
		
		$count = 0;
		for($i = 1; $i <= $n; $i++){
			$count += self::count_5s($i);
		}
		
		return $count;
	}
	
	static function fact($n){
		$fact = gmp_fact($n);
		return gmp_strval($fact);
	}
	static function count_5s($n){
		$count = 0;
		
		while(!$mod = $n % 5){
			$count++;
			$n = $n / 5;
		}
		return $count;
	}
}


if(!isset($argv[1]))die("Hey! I need the number to get this calculations done\n");

$n = $argv[1];
$fact = n_right_ceros::fact($n);
$right_ceros = n_right_ceros::calculate($n);
echo "The factorial number is: $fact\n";
echo "and its count of ceros at right is: $right_ceros\n";
