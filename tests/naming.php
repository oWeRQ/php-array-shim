<?php

require '../autoload.php';

use Helpers\Naming;

$tests = [
	'Title Case',
	'PascalCase',
	'camelCase',
	'dashed-case',
	'under_case',
	'UPPER_CASE',
	'add2many',
	'add2Many',
	'section_1_count',
	'section1Count',
	'PRICE_1',
	'Price1',
];

$methods = [
	'toArray',
	'toPascal',
	'toCamel',
	'toDashed',
	'toUnder',
	'toUpper',
	'toTitle',
];

foreach ($tests as $test) {
	$naming = Naming::from($test);
	echo "\n".str_pad("from:", 10).$test."\n";
	foreach ($methods as $method) {
		echo str_pad($method.":", 10).print_r($naming->$method(), true)."\n";
	}
}