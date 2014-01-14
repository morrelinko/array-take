<?php

namespace Morrelinko;

function array_take(array $from, $keys, $includeEmpty = true)
{
    // Checks if the array is a list
    if (array_values($from) === $from) {
        return array_map(function ($item) use ($keys, $includeEmpty) {
            return array_take($item, $keys, $includeEmpty);
        }, $from);
    }

    $retrieved = array();

    array_walk($keys,
        function (&$value, $index, $retrieved) use ($from, $includeEmpty) {
            if (is_int($index) && !($value instanceof \Closure)) $index = $value;
            if (array_key_exists($index, $from) &&
                ($includeEmpty || ($includeEmpty == false &&
                        !empty($from[$index])))
            ) {
                if ($value instanceof \Closure) {
                    $retrieved[0][$index] = call_user_func($value, $from[$index]);
                } else {
                    $retrieved[0][$value] = $from[$index];
                }
            }
        }, array(&$retrieved));

    return $retrieved;
}
