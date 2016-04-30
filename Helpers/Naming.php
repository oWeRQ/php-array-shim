<?php

namespace Helpers;

class Naming
{
	protected $words = [];

	public function __construct(array $words)
	{
		$this->words = $words;
	}

	public function from($name)
	{
		$name = preg_replace('/([a-z])([0-9]*)([A-Z]|$)/', '\1_\2_\3', $name);
		$name = strtolower($name);
		$words = preg_split('/[-_ ]+/', $name, 0, PREG_SPLIT_NO_EMPTY);
		return new self($words);
	}

	public function toTitle()
	{
		return implode(' ', array_map('ucfirst', $this->words));
	}

	public function toPascal()
	{
		return implode(array_map('ucfirst', $this->words));
	}

	public function toCamel()
	{
		return lcfirst($this->toPascal());
	}

	public function toDashed()
	{
		return implode('-', $this->words);
	}

	public function toUnder()
	{
		return implode('_', $this->words);
	}

	public function toUpper()
	{
		return strtoupper(implode('_', $this->words));
	}
}
