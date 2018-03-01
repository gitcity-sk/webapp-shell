<?php

namespace Webapp\Shell\Helpers;

class Console
{
    protected const ARROW = '---->';

    public static function print($text)
    {
        $line = self::ARROW . ' ' . $text . "\n";

        echo $line;

        return;
    }
}