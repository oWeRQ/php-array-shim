<?php

namespace Models;

class ArrayModel extends Model implements \ArrayAccess, \Countable, \IteratorAggregate, \JsonSerializable
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
		return parent::__set($this->keyMap($key), $value);
	}

	public function __isset($key)
	{
		return parent::__isset($this->keyMap($key));
	}

	public function count()
	{
		return count($this->_attributes);
	}
	
	public function offsetSet($key, $value) {
		$key = $this->keyMap($key);
		if (is_null($key)) {
			$this->_attributes[] = $value;
		} else {
			$this->_attributes[$key] = $value;
		}
	}

	public function offsetExists($key) {
		return static::__isset($key);
	}

	public function offsetUnset($key) {
		unset($this->_attributes[$this->keyMap($key)]);
	}

	public function offsetGet($key) {
		return static::__get($key);
	}

	public function getIterator() {
		return new \ArrayIterator($this->_attributes);
	}

	public function jsonSerialize() {
		return $this->_attributes;
	}
}