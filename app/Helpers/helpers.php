<?php

// formats a float (to 2 decimals) and removes unnecessary trailing zeros
// ex: 4.00 => 4 / 4.10 => 4.1 / 4.25 => 4.25
if (!function_exists('trim_float')) {
    function trim_float($value, $decimals = 2)
    {
        return rtrim(rtrim(number_format($value, $decimals, '.', ''), '0'), '.');
    }
}