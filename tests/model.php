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
			'TEST_1' => [
				'VALUE' => 'TEST_1',
			],
			'LIST' => [
				'VALUE' => [1],
			],
		],
	],
	[
		'ID' => 2,
		'TYPE_ID' => 2,
		'NAME' => 'Test 2',
		'SUB_NAME' => 'Sub 2',
		'PROPERTIES' => [
			'TEST_2' => [
				'VALUE' => 'TEST_2',
			],
			'LIST' => [
				'VALUE' => [1, 2],
			],
		],
	],
	[
		'ID' => 3,
		'TYPE_ID' => 3,
		'NAME' => 'Test 3',
		'SUB_NAME' => 'Sub 3',
		'PROPERTIES' => [
			'TEST_3' => [
				'VALUE' => 'TEST_3',
			],
			'LIST' => [
				'VALUE' => [1, 2, 3],
			],
		],
	],
];

$collection = ArrayCollection::fromArray($array, ArrayModel::class);

$collectionJson = json_encode($collection);
$collectionFromJson = ArrayCollection::fromArray(json_decode($collectionJson, true), ArrayModel::class);

assert(!empty($collectionJson));
assert($collection == $collectionFromJson);
assert($collectionJson === json_encode($collectionFromJson));

assert($collection[2]['TYPE_ID'] === 3);
assert($collection[2]['typeId'] === 3);
assert($collection[2]->TYPE_ID === 3);
assert($collection[2]->typeId === 3);

assert(isset($collection[2]['TYPE_ID']));
assert(isset($collection[2]['typeId']));
assert(isset($collection[2]->TYPE_ID));
assert(isset($collection[2]->typeId));

assert(!isset($collection[2]['ID_UNSET']));
assert(!isset($collection[2]['idUnset']));
assert(!isset($collection[2]->ID_UNSET));
assert(!isset($collection[2]->idUnset));

assert($collection[0]['PROPERTIES']['TEST_1']['VALUE'] === $collection[0]->properties->test1->value);
assert($collection[1]['PROPERTIES']['TEST_2']['VALUE'] === $collection[1]->properties->test2->value);
assert($collection[2]['PROPERTIES']['TEST_3']['VALUE'] === $collection[2]->properties->test3->value);

assert($collection[0]['PROPERTIES']['LIST']['VALUE'][0] === 1);
assert($collection[1]['PROPERTIES']['LIST']['VALUE'][1] === 2);
assert($collection[2]['PROPERTIES']['LIST']['VALUE'][2] === 3);