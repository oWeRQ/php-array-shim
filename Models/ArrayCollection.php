<?php

namespace Models;

class ArrayCollection extends Collection implements \ArrayAccess, \Countable, \IteratorAggregate, \JsonSerializable
{
	public function count()
	{
		return count($this->_items);
	}
	
	public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->_items[] = $value;
		} else {
			$this->_items[$offset] = $value;
		}
	}

	public function offsetExists($offset) {
		return isset($this->_items[$offset]);
	}

	public function offsetUnset($offset) {
		unset($this->_items[$offset]);
	}

	public function offsetGet($offset) {
		return isset($this->_items[$offset]) ? $this->_items[$offset] : null;
	}
	
	public function getIterator() {
		return new \ArrayIterator($this->_items);
	}
	
	public function jsonSerialize() {
		return $this->_items;
	}
}