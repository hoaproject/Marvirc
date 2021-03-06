<?php
namespace Marvirc\Action\Mention;

class Board implements \Marvirc\Action\IAction
{
    public static function getPattern()
    {
        return '#\bboard\s+(?<library>\w+)#i';
    }

    public static function getUsage()
    {
        return 'Get link to a specific board. ' .
               'Use `board` followed by a library name.';
    }

    public static function compute(array $data)
    {
        $pattern = static::getPattern();
        preg_match($pattern, $data['message'], $matches);
        $library = $matches['library'];

        return 'https://waffle.io/hoaproject/' . strtolower($library);
    }
}
