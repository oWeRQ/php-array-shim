<?php

namespace Models;

interface ModelInterface
{
	public static function fromArray(array $attributes);
	public function getAttributes();
	public function setAttributes($values);
}