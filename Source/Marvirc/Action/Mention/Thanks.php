<?php
namespace Marvirc\Action\Mention;

use Marvirc\Action;

class Thanks implements Action\IAction
{
    public static function getPattern()
    {
        return '#\bthank(s|\s+you)\b#i';
    }

    public static function getUsage()
    {
        return 'I am a polite bot.';
    }

    public static function compute(array $data)
    {
        static $_answers = [
            'You are welcome!',
            '\'lcome :-).',
            'My pleasure!',
            'It was a delight!',
            'It was an honour!',
            'No… you, thank you!!'
        ];

        return $_answers[mt_rand(0, count($_answers) - 1)];
    }
}
