<?php

namespace Models;

class Model implements ModelInterface
{
	protected $_attributes;
	
	public static function fromArray(array $attributes)
	{
		$model = new static;
		$model->setAttributes($attributes);
		return $model;
	}

	public function getAttributes()
	{
		return $this->_attributes;
	}

	public function setAttributes($values)
	{
		if (is_array($values)) {
			foreach ($values as $name => $value) {
				$this->$name = $value;
			}
		}
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
		} else {
			$this->_attributes[$key] = $value;
		}
	}
}