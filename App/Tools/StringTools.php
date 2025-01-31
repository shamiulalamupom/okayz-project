<?php

namespace App\Tools;

class StringTools
{
    /*
        Transfom to camelCase (or PascalCase)
    */
    public static function toCamelCase(string $value, $pascalCase = false): string
    {
        $value = ucwords(str_replace(array('-', '_'), ' ', $value));
        $value = str_replace(' ', '', $value);
        if ($pascalCase === false) {
            return lcfirst($value);
        } else {
            return $value;
        }
    }

    /*
        shortcut for methode toCamelcase($value, true)
    */
    public static function toPascalCase(string $value): string
    {
        return self::toCamelCase($value, true);
    }

    /*
        Transform a string to be valid for urls or filename
    */
    public static function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('/[^\pL\d.]+/u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('/[^-\w.]+/', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('/-+/', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
