<?php

use Illuminate\Support\HtmlString;

/**
 * If the value is too long, we display a toggle button in addition to the value
 *
 * @param string $value
 * @param int    $limit
 *
 * @return HtmlString
 */
function print_variable_value ($value, int $limit = 100): HtmlString
{
    if (is_array($value)) {
        $jsonEncode = json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        $string = strlen($jsonEncode) >= $limit ?
            '<button class="btn btn-secondary btn-sm js-toggle-button float-right">Display</button><pre class="text-white d-none">' . $jsonEncode . '</pre>' :
            '<pre class="text-white">' . $jsonEncode . '</pre>';

        return new HtmlString($string);
    }

    return new HtmlString($value);
}