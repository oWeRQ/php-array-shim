<?php

namespace Models;

class ArrayModel extends Model implements \ArrayAccess
{
	public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->_attributes[] = $value;
		} else {
			$this->_attributes[$offset] = $value;
		}
	}

	public function offsetExists($offset) {
		return isset($this->_attributes[$offset]);
	}

	public function offsetUnset($offset) {
		unset($this->_attributes[$offset]);
	}

	public function offsetGet($offset) {
		return isset($this->_attributes[$offset]) ? $this->_attributes[$offset] : null;
	}
}