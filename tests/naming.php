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

foreach ($tests as $test) {
	$naming = Naming::from($test);
	var_dump($naming);
	var_dump($naming->toTitle());
	var_dump($naming->toPascal());
	var_dump($naming->toCamel());
	var_dump($naming->toDashed());
	var_dump($naming->toUnder());
	var_dump($naming->toUpper());
}