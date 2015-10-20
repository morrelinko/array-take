<?php

namespace Morrelinko;

function array_take(array $from, $keys, $options = [])
{
    $options = array_merge([
        'includeEmpty' => true,
        'ignoreMissingKeys' => true
    ], $options);

    // Checks if the array is a list
    if (array_values($from) === $from) {
        return array_map(function ($item) use ($keys, $options) {
            return array_take($item, $keys, $options);
        }, $from);
    }

    $retrieved = array();

    array_walk($keys,
        function (&$value, $index, $retrieved) use ($from, $options) {
            if (is_int($index) && !($value instanceof \Closure)) $index = $value;

            if (!array_key_exists($index, $from) && !$options['ignoreMissingKeys']) {
                $from[$index] = null;
            }

            if (array_key_exists($index, $from) &&
                ($options['includeEmpty'] || ($options['includeEmpty'] == false &&
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
