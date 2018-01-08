<?php

namespace EffectiveSoft\Intellexer;

class SentimentAnalyzer
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
     * Perform sentiments analysis on reviews from the list. Reviews for the analysis should be transferred as array,
     * where item is array with following items "id" - review ID and "text" - text for review
     *
     * @param array $data
     * @param $ontology
     * @param bool $loadSentences
     *
     * @return array|null
     */
    public function analyzeSentiments(array $data, $ontology, $loadSentences = false)
    {
        return $this->client->post(
            'analyzeSentiments',
            \GuzzleHttp\json_encode($data),
            [
                'ontology' => $ontology,
                'loadSentences' => $loadSentences,
            ]
        );
    }

    /**
     * Return the list of available Sentiment Analyzer ontologies.
     *
     * @param array $data
     *
     * @return array|null
     */
    public function sentimentAnalyzerOntologies(array $data)
    {
        return $this->client->post(
            'sentimentAnalyzerOntologies',
            \GuzzleHttp\json_encode($data)
        );
    }
}
