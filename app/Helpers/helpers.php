<?php

if (!function_exists('trim_float')) {
    /**
     * Format a float and remove unnecessary trailing zeros.
     *
     * Examples:
     * - 4.00 => 4
     * - 4.10 => 4.1
     * - 4.25 => 4.25
     */
    function trim_float($value, $decimals = 2)
    {
        return rtrim(rtrim(number_format($value, $decimals, '.', ''), '0'), '.');
    }
}