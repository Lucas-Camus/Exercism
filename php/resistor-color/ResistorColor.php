<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's $result = type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

const COLORS = [
	"black",
	"brown",
	"red",
	"orange",
	"yellow",
	"green",
	"blue",
	"violet",
	"grey",
	"white"
];
/**
 * J'aurai pu faire un tableau avec un array_search().
 * @param string $color
 * @return int|string[]
 */
function colorCode(string $color)
{
	$result = COLORS;

	switch ($color) {
		case $color === "black":
			$result = 0;
			break;
		case $color === "brown":
			$result = 1;
			break;
		case $color === "red":
			$result = 2;
			break;
		case $color === "orange":
			$result = 3;
			break;
		case $color === "yellow":
			$result = 4;
			break;
		case $color === "green":
			$result = 5;
			break;
		case $color === "blue":
			$result = 6;
			break;
		case $color === "violet":
			$result = 7;
			break;
		case $color === "grey":
			$result = 8;
			break;
		case $color === "white":
			$result = 9;
			break;
		default:
			break;
	}
	return $result;
}
