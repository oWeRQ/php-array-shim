<?php

namespace Models;

class ArrayModel2 extends \ArrayObject implements \Models\ModelInterface
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

	public function __construct($input = [])
	{
		parent::__construct($input, \ArrayObject::ARRAY_AS_PROPS);
	}

	public function __get($key)
	{
		$key = $this->keyMap($key);
		$getter = 'get'.ucfirst($key);
		if (method_exists($this, $getter)) {
			return $this->$getter();
		} elseif (array_key_exists($key, $this->_attributes)) {
			//return $this->_attributes[$key];
			return parent::offsetGet($key);
		}
	}
	
	public function __set($key, $value)
	{
		$key = $this->keyMap($key);
		$setter = 'set'.ucfirst($key);
		if (method_exists($this, $setter)) {
			return $this->$setter($value);
		} else {
			//$this->_attributes[$key] = $value;
			parent::offsetSet($key, $value);
		}
	}

	public function __isset($key)
	{
		$key = $this->keyMap($key);
		$getter = 'get'.ucfirst($key);
		if (method_exists($this, $getter)) {
			return $this->$getter() !== null;
		} elseif (array_key_exists($key, $this->_attributes)) {
			//return isset($this->_attributes[$key]);
		}
	}

	public function offsetSet($key, $value)
	{
		return parent::offsetSet($this->keyMap($key), $value);
	}

	public function offsetGet($key)
	{
		return parent::offsetGet($this->keyMap($key));
	}

	public function offsetExists($key) {
		return parent::offsetExists($this->keyMap($key));
	}

	public function offsetUnset($key) {
		return parent::offsetUnset($this->keyMap($key));
	}

	public static function fromArray(array $attributes)
	{
		$model = new static;
		$model->setAttributes($attributes);
		return $model;
	}

	public function getAttributes()
	{
		return $this->getArrayCopy();
	}

	public function setAttributes($values)
	{
		if (is_array($values)) {
			foreach ($values as $name => $value) {
				if (is_array($value)) {
					$value = static::fromArray($value);
				}

				$this->$name = $value;
			}
		}
	}
}