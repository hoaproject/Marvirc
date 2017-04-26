<?php
namespace Marvirc\Action\PrivateMessage;

use Hoa\Console;
use Marvirc\Action;

class Uptime implements Action\IAction
{
    public static function getPattern()
    {
        return '#\buptime\b#i';
    }

    public static function getUsage()
    {
        return 'Get the uptime of the server.';
    }

    public static function compute(array $data)
    {
        return Console\Processus::execute('uptime');
    }
}
