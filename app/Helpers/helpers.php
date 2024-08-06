<?php

use Carbon\Carbon;

if (! function_exists('slugify')) {

    function slugify($text, string $divider = '_'): string
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

}


if (! function_exists('deSlugify')) {

    function deSlugify($text, string $divider = '_'): string
    {

        // pascal case
        $text =  str_replace('_', ' ', ucwords($text, '_'));

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

}


if (! function_exists('dateToUser')) {

    function dateToUser($date): string
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format(env('DATE_FORMAT', 'd/m/Y'));
    }

}


if (! function_exists('dateToSql')) {

    function dateToSql($date): string
    {
        return Carbon::createFromFormat(env('DATE_FORMAT', 'd/m/Y'), $date)->format('Y-m-d');
    }

}
