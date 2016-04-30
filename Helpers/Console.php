<?php

namespace Helpers;

class Console
{
	public static $maxPathLength = 60;

	public static function log()
	{
		return static::dump(func_get_args(), 'log');
	}

	public static function info()
	{
		return static::dump(func_get_args(), 'info');
	}

	public static function warn()
	{
		return static::dump(func_get_args(), 'warn');
	}

	public static function error()
	{
		return static::dump(func_get_args(), 'error');
	}

	public static function table()
	{
		echo '<script>';
		echo static::jsFunc('console.group', array(static::getCall())).';';
		echo static::jsFunc('console.table', func_get_args()).';';
		echo static::jsFunc('console.groupEnd').';';
		echo '</script>';
	}

	protected static function dump($args, $func = 'log')
	{
		if (PHP_SAPI !== 'cli') {
			echo '<script>'.static::jsFunc('console.'.$func, array_merge((array)static::getCall(), $args)).'</script>';
		} else {
			echo "\n".static::getCall()."\n";
			var_dump($args);
		}
		
		return true;
	}

	protected static function jsFunc($func, $args = array())
	{
		return $func.'('.implode(',', array_map('json_encode', $args)).')';
	}

	protected static function getCall($maxPathLength = null)
	{
		$backTrace = debug_backtrace();

		foreach ($backTrace as $fileTrace) {
			if ($fileTrace['file'] !== __FILE__)
				break;
		}

		$funcTrace = $fileTrace['class'].$fileTrace['type'].$fileTrace['function'];
		$funcLine = static::fileLine($fileTrace['file'], $fileTrace['line']);
		preg_match('/'.$funcTrace.'\s*\((.*)\)/i', $funcLine, $fileLineMatch);
		$funcArgs = $fileLineMatch[1];
		
		return static::shortPath($fileTrace['file']).':'.$fileTrace['line'].' ('.$funcArgs.') =>';
	}

	protected static function fileLine($filePath, $line)
	{
		$fileLines = file($filePath, FILE_IGNORE_NEW_LINES);
		return $fileLines[$line - 1];
	}

	protected static function shortPath($filePath)
	{
		$offset = strlen($filePath) - static::$maxPathLength;
		if ($offset > 0 && ($pos = strpos($filePath, '/', $offset)) !== false)
			return '...'.substr($filePath, $pos);

		return $filePath;
	}
}