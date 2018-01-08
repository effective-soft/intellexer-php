<?php

namespace EffectiveSoft\Intellexer;

class LanguageRecognizer
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
     * Recognize language and encoding of an input text stream.
     *
     * @param string $text
     *
     * @return array|null
     */
    public function recognizeLanguage($text)
    {
        return $this->client->post('recognizeLanguage', $text);
    }
}
