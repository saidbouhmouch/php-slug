<?php
require __DIR__ . '/vendor/autoload.php';
use voku\helper\ASCII;

function lower($value)
{
    return mb_strtolower($value, 'UTF-8');
}

function ascii($value){
	return  ASCII::to_ascii((string) $value);
}

function slug($title, $separator = '-', $language = 'en')
{
    $title = $language ? ascii($title, $language) : $title;

    // Convert all dashes/underscores into separator
    $flip = $separator === '-' ? '_' : '-';

    $title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);

    // Replace @ with the word 'at'
    $title = str_replace('@', $separator.'at'.$separator, $title);

    // Remove all characters that are not the separator, letters, numbers, or whitespace.
    $title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', lower($title));

    // Replace all separator characters and whitespace by a single separator
    $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

    return trim($title, $separator);
}
     
    echo slug("é  è  ê  ë  à  ä  â  ô  ö  û  ü  î  ï  ç  ", '-');
