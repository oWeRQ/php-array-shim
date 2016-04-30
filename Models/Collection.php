<?php

namespace Models;

class Collection implements CollectionInterface
{
	public $_items = [];
	
	public static function fromArray(array $items, $itemClass = 'Model')
	{
		foreach ($items as $key => $item) {
			$items[$key] = $itemClass::fromArray($item);
		}
		
		$collection = new static;
		$collection->items = $items;
		return $collection;
	}
	
	public function getItems()
	{
		return $this->_items;
	}

	public function setItems($items)
	{
		$this->_items = $items;
	}
}