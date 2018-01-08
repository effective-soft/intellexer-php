<?php

namespace EffectiveSoft\Intellexer;

class NaturalLanguage
{
    /** @var IntellexerClient */
    protected $client;

    /**
     * @param IntellexerClient $client
     */
    public function __construct(IntellexerClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $text
     *
     * @return array|null
     */
    public function convertQueryToBool($text)
    {
        return $this->client->post('convertQueryToBool', $text);
    }
}
