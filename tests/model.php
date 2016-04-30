<?php

require '../autoload.php';

use Models\ArrayModel;
use Models\ArrayCollection;

$array = [
	[
		'ID' => 1,
		'TYPE_ID' => 1,
		'NAME' => 'Test 1',
		'SUB_NAME' => 'Sub 1',
		'PROPERTIES' => [
			'TEST_1' => true,
			'LIST' => [1],
		],
	],
	[
		'ID' => 2,
		'TYPE_ID' => 2,
		'NAME' => 'Test 2',
		'SUB_NAME' => 'Sub 2',
		'PROPERTIES' => [
			'TEST_2' => true,
			'LIST' => [1, 2],
		],
	],
	[
		'ID' => 3,
		'TYPE_ID' => 3,
		'NAME' => 'Test 3',
		'SUB_NAME' => 'Sub 3',
		'PROPERTIES' => [
			'TEST_3' => true,
			'LIST' => [1, 2, 3],
		],
	],
];

$collection = ArrayCollection::fromArray($array, ArrayModel::class);

var_dump($collection);