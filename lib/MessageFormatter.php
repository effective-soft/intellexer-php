<?php

namespace EffectiveSoft\Intellexer;

use GuzzleHttp\MessageFormatter as GuzzleMessageFormatter;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class MessageFormatter extends GuzzleMessageFormatter
{
    /**
     * {@inheritDoc}
     */
    public function format(
        RequestInterface $request,
        ResponseInterface $response = null,
        \Exception $error = null
    ) {
        //Remove API key from request
        return preg_replace('/apikey\=[a-z0-9-]+/i', 'apikey={HIDDEN}', parent::format($request, $response, $error));
    }
}
