<?php
namespace Marvirc\Action\Mention;

use Marvirc\Action;

class HackBook implements Action\IAction
{
    public static function getPattern()
    {
        return '#\bhack\s+(book\s+)?(?<subject>\w+(?:[/\\\]\w+)?)(?:\s+(?<lang>\w{2}))?#i';
    }

    public static function getUsage()
    {
        return 'Get link to a chapter of the hack book.';
    }

    public static function compute(array $data)
    {
        $pattern = static::getPattern();
        preg_match($pattern, $data['message'], $matches);

        $subject = str_replace('\\', '/', $matches['subject']);

        if (false !== strpos($subject, '/')) {
            list(, $library) = explode('/', $subject);
        } else {
            $library = $subject;
        }

        $url  = 'http://hoa-project.net/' .
                (isset($matches['lang']) ? ucfirst(strtolower($matches['lang'])) . '/' : '') .
                'Literature/Hack/' . ucfirst(strtolower($library)) . '.html';
        $code = \Marvirc\Url::check($url);

        return ($code === \Hoa\Http\Response::STATUS_OK
                || $code === \Hoa\Http\Response::STATUS_MOVED_PERMANENTLY)
                   ? $url
                   : \Marvirc\Url::getErrorMessage();
    }
}
