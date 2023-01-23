<?php

namespace Tejuino\Sdk\Console;

class Console
{
    private static $colors = [
        'blue' => "\033[0;34m",
        'w' => "\033[0;37m",
        'g' => "\033[0;92m",
        'c' => "\033[0;96m",
        'r' => "\033[0;91m",
        'y' => "\033[0;93m",
        'gray' => "\e[0;30m",
        'n' => "\e[0;32m"
    ];

    public static function log($text, $nl = true)
    {
        foreach(self::$colors as $color => $char)
        {
            $text = str_replace('[' . $color . ']', $char, $text);
        }

        shell_exec('/bin/echo -n "' . ($nl ? PHP_EOL : '') . self::$colors['w'] . $text . self::$colors['w'] . ' ' . '" 1>&2');

        return new static;
    }

    public static function nl()
    {
        return self::log('', true);
    }

    public static function tab($text = '')
    {
        return self::log('[w]   ' . $text . ' ', false);
        return new static;
    }

    public static function ok($text, $nl = false)
    {
        return self::log('[g]' . $text . ' ', $nl);
    }

    public static function warning($text, $nl = false)
    {
        return self::log('[y]' . $text . ' ', $nl);
    }

    public static function info($text, $nl = false)
    {
        return self::log($text . ' ', $nl);
    }

    public static function error($text, $nl = false)
    {
        return self::log('[r]' . $text . ' ', $nl);
    }

}
