<?php

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

assert(count($collection) === 3);
assert(count($collection[2]) === 5);
assert(count($collection[2]['PROPERTIES']) === 2);
assert(count($collection[2]['PROPERTIES']['LIST']) === 1);
assert(count($collection[2]['PROPERTIES']['LIST']['VALUE']) === 3);