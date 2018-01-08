<?php

namespace EffectiveSoft\Intellexer;

class SpellChecker
{
    const TUNE_ERROR_REDUCE = 1;
    const TUNE_ERROR_EQUAL = 2;
    const TUNE_ERROR_RAISE = 3;

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
     * Check Perform text spell check.
     *
     * @param string $text
     * @param bool $separateLines
     * @param string $language
     * @param int $errorTune
     * @param int $errorBound
     * @param int $minProbabilityTune
     * @param int $minProbabilityWeight
     *
     * @return array|null
     */
    public function checkTextSpelling(
        $text,
        $separateLines = true,
        $language = 'en',
        $errorTune = self::TUNE_ERROR_REDUCE,
        $errorBound = 0,
        $minProbabilityTune = self::TUNE_ERROR_REDUCE,
        $minProbabilityWeight = 0
    ) {
        return $this->client->post('checkTextSpelling', $text, [
            'separateLines' => $separateLines,
            'language' => $language,
            'errorTune' => $errorTune,
            'errorBound' => $errorBound,
            'minProbabilityTune' => $minProbabilityTune,
            'minProbabilityWeight' => $minProbabilityWeight,
        ]);
    }
}
