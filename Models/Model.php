<?php

namespace Models;

class Model implements ModelInterface
{
	protected $_attributes;
	
	public static function fromArray(array $attributes)
	{
		$model = new static;
		$model->attributes = $attributes;
		return $model;
	}

	public function getAttributes()
	{
		return $this->_attributes;
	}

	public function setAttributes($attributes)
	{
		$this->_attributes = $attributes;
	}
	
	public function __get($key)
	{
		$getter = 'get'.ucfirst($key);
		if (method_exists($this, $getter)) {
			return $this->$getter();
		} elseif (array_key_exists($key, $this->_attributes)) {
			return $this->_attributes[$key];
		}
	}
	
	public function __set($key, $value)
	{
		$setter = 'set'.ucfirst($key);
		if (method_exists($this, $setter)) {
			return $this->$setter($value);
		} elseif (array_key_exists($key, $this->_attributes)) {
			$this->_attributes[$key] = $value;
		}
	}
}