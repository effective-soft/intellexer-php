<?php

namespace EffectiveSoft\Intellexer;

class LinguisticProcessor
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
     * Parse an input text stream and extract various linguistic information: detected sentences with their offsets in
     * a source text; text tokens (words of sentences) with their part of speech tags, offsets and lemmas (normal
     * forms); subject-verb-object semantic relations.
     *
     * @param string $text
     * @param bool $loadSentences
     * @param bool $loadTokens
     * @param bool $loadRelations
     *
     * @return array|null
     */
    public function analyzeText($text, $loadSentences = true, $loadTokens = true, $loadRelations = true)
    {
        return $this->client->post('analyzeText', $text, [
            'loadSentences' => $loadSentences,
            'loadTokens' => $loadTokens,
            'loadRelations' => $loadRelations,
        ]);
    }
}
