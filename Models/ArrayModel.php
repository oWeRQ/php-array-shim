<?php

namespace Models;

class ArrayModel extends Model implements \ArrayAccess, \JsonSerializable
{
	protected static $_keyMapCache = [];
	
	public function keyMap($key)
	{
		if (array_key_exists($key, static::$_keyMapCache)) {
			return static::$_keyMapCache[$key];
		} else {
			return static::$_keyMapCache[$key] = \Helpers\Naming::from($key)->toCamel();
		}
	}
	
	public function __get($key)
	{
		return parent::__get($this->keyMap($key));
	}
	
	public function __set($key, $value)
	{
		if (is_array($value)) {
			$value = ArrayModel::fromArray($value);
		}
		
		return parent::__set($this->keyMap($key), $value);
	}
	
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
	
	public function jsonSerialize() {
		return $this->_attributes;
	}
}