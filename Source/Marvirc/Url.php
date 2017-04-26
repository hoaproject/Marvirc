<?php
namespace Marvirc;

use Hoa\Http;
use Hoa\Socket;

class Url
{
    protected static $_errorMessage;

    public static function check($url)
    {
        $url    = parse_url($url);
        $client = new Socket\Client('tcp://' . $url['host'] . ':80');
        $client->connect();

        if ('https' === $url['scheme']) {
            $client->setEncryption(true, $client::ENCRYPTION_TLS);
        }

        $request = new Http\Request();
        $request->setMethod($request::METHOD_GET);
        $request->setUrl($url['path']);

        $request['Host']       = $url['host'];
        $request['Connection'] = 'close';

        $client->writeAll($request);

        $response = new Http\Response(false);
        $response->parse($client->readAll());

        $client->close();

        switch ($response['status']) {
            case $response::STATUS_OK:
            case $response::STATUS_MOVED_PERMANENTLY:

                break;

            case $response::STATUS_FORBIDDEN:
            case $response::STATUS_NOT_FOUND:
            case $response::STATUS_INTERNAL_SERVER_ERROR:
                static::$_errorMessage = $response['status'];

                break;

            default:
                static::$_errorMessage = 'Error while getting status code.';

                break;
        }

        return $response['status'];
    }

    public static function getErrorMessage()
    {
        return static::$_errorMessage;
    }
}
