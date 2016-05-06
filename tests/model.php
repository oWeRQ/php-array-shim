<?php

require '../autoload.php';

$array = require 'model_fixture.php';

$collection = \Models\ArrayCollection::fromArray($array, \Models\ArrayModel::class);

$collectionJson = json_encode($collection);
$collectionFromJson = \Models\ArrayCollection::fromArray(json_decode($collectionJson, true), \Models\ArrayModel::class);

require 'model_asserts.php';

echo "model done\n";

$collection = \Models\ArrayCollection2::fromArray($array, \Models\ArrayModel2::class);

$collectionJson = json_encode($collection);
$collectionFromJson = \Models\ArrayCollection2::fromArray(json_decode($collectionJson, true), \Models\ArrayModel2::class);

require 'model_asserts.php';

echo "model2 done\n";
