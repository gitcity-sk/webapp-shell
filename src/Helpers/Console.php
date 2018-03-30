<?php

namespace Webapp\Shell\Helpers;

class Console
{
    /**
     *
     */
    protected const ARROW = '---->';

    /**
     * @param $text
     */
    public static function print($text)
    {
        $line = self::ARROW . ' ' . $text . "\n";

        echo $line;

        return;
    }
}