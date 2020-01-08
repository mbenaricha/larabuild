<?php

use Illuminate\Support\HtmlString;

/**
 * @param mixed $value
 */
function print_variable_value ($value, int $limit = 10): HtmlString
{
    if (is_array($value)) {
        $jsonEncode = json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        $string = substr_count($jsonEncode, '\n') >= $limit ?
            'trop long' :
            '<pre class="text-white">' . $jsonEncode . '</pre>';

        return new HtmlString($string);
    }

    return new HtmlString($value);
}