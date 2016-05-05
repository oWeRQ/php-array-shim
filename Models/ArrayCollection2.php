<?php

namespace Models;

class ArrayCollection2 extends \ArrayObject implements \Models\CollectionInterface
{
	public function __construct($input = [])
	{
		parent::__construct($input, \ArrayObject::ARRAY_AS_PROPS);
	}

	public static function fromArray(array $items, $itemClass)
	{
		foreach ($items as $key => $item) {
			$items[$key] = $itemClass::fromArray($item);
		}
		
		return new static($items);
	}

	public function getItems()
	{
		return $this->getArrayCopy();
	}
	
	public function setItems($items)
	{
		$this->exchangeArray($items);
	}
}