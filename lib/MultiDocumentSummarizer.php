<?php

namespace EffectiveSoft\Intellexer;

class MultiDocumentSummarizer
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
     * Generate summary for list of sources from a given URL
     *
     * @param array|string[] $urls
     * @param bool $loadConceptsTree
     * @param bool $loadNamedEntityTree
     * @param int $summaryRestriction
     * @param bool $usePercentRestriction
     * @param int $conceptsRestriction
     * @param string $structure
     * @param int $returnedTopicsCount
     * @param string $relatedFactsRequest
     * @param int $maxRelatedFactsConcepts
     * @param int $maxRelatedFactsSentences
     * @param bool $fullTextTrees
     *
     * @return array|null
     */
    public function multiUrlSummary(
        array $urls,
        $loadConceptsTree = true,
        $loadNamedEntityTree = true,
        $summaryRestriction = 10,
        $usePercentRestriction = true,
        $conceptsRestriction = 7,
        $structure = Summarizer::STRUCTURE_NEWS_GENERAL,
        $returnedTopicsCount = 1,
        $relatedFactsRequest = '',
        $maxRelatedFactsConcepts = 20,
        $maxRelatedFactsSentences = 5,
        $fullTextTrees = true
    ) {

        return $this->client->post('multiUrlSummary', \GuzzleHttp\json_encode($urls), [
            'summaryRestriction' => $summaryRestriction,
            'returnedTopicsCount' => $returnedTopicsCount,
            'relatedFactsRequest' => $relatedFactsRequest,
            'maxRelatedFactsConcepts' => $maxRelatedFactsConcepts,
            'maxRelatedFactsSentences' => $maxRelatedFactsSentences,
            'loadConceptsTree' => $loadConceptsTree,
            'loadNamedEntityTree' => $loadNamedEntityTree,
            'usePercentRestriction' => $usePercentRestriction,
            'conceptsRestriction' => $conceptsRestriction,
            'structure' => $structure,
            'fullTextTrees' => $fullTextTrees,
        ]);
    }
}
