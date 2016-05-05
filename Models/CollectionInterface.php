<?php

namespace Models;

interface CollectionInterface
{
	public static function fromArray(array $items, $itemClass);
	public function getItems();
	public function setItems($items);
}