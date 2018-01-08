<?php

namespace EffectiveSoft\Intellexer;

class Summarizer
{
    const STRUCTURE_NEWS_ARTICLE = 'News Article';
    const STRUCTURE_NEWS_GENERAL = 'General';
    const STRUCTURE_NEWS_PAPER = 'Research Paper';
    const STRUCTURE_NEWS_PATENT = 'Patent';

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
     * Return summary data for a document from a given URL
     *
     * @param string $url
     * @param bool $loadConceptsTree
     * @param bool $loadNamedEntityTree
     * @param int $summaryRestriction
     * @param bool $usePercentRestriction
     * @param int $conceptsRestriction
     * @param string $structure
     * @param int $returnedTopicsCount
     * @param bool $fullTextTrees
     * @param int $textStreamLength
     * @param bool $useCache
     * @param bool $wrapConcepts
     *
     * @return array|null
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function summarize(
        $url,
        $loadConceptsTree = false,
        $loadNamedEntityTree = false,
        $summaryRestriction = 7,
        $usePercentRestriction = true,
        $conceptsRestriction = 7,
        $structure = self::STRUCTURE_NEWS_GENERAL,
        $returnedTopicsCount = 2,
        $fullTextTrees = true,
        $textStreamLength = 1000,
        $useCache = true,
        $wrapConcepts = true
    ) {
        return $this->client->get('summarize', [
            'url' => $url,
            'summaryRestriction' => $summaryRestriction,
            'returnedTopicsCount' => $returnedTopicsCount,
            'loadConceptsTree' => $loadConceptsTree,
            'loadNamedEntityTree' => $loadNamedEntityTree,
            'usePercentRestriction' => $usePercentRestriction,
            'conceptsRestriction' => $conceptsRestriction,
            'structure' => $structure,
            'fullTextTrees' => $fullTextTrees,
            'textStreamLength' => $textStreamLength,
            'useCache' => $useCache,
            'wrapConcepts' => $wrapConcepts,
        ]);
    }

    /**
     * Returns summary data for a text.
     *
     * @param string $text
     * @param bool $loadConceptsTree
     * @param bool $loadNamedEntityTree
     * @param int $summaryRestriction
     * @param bool $usePercentRestriction
     * @param int $conceptsRestriction
     * @param string $structure
     * @param int $returnedTopicsCount
     * @param bool $fullTextTrees
     * @param int $textStreamLength
     * @param bool $useCache
     * @param bool $wrapConcepts
     *
     * @return array|null
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function summarizeText(
        $text,
        $loadConceptsTree = false,
        $loadNamedEntityTree = false,
        $summaryRestriction = 7,
        $usePercentRestriction = true,
        $conceptsRestriction = 7,
        $structure = self::STRUCTURE_NEWS_GENERAL,
        $returnedTopicsCount = 2,
        $fullTextTrees = true,
        $textStreamLength = 1000,
        $useCache = true,
        $wrapConcepts = true
    ) {

        return $this->client->post('summarizeText', $text, [
            'summaryRestriction' => $summaryRestriction,
            'returnedTopicsCount' => $returnedTopicsCount,
            'loadConceptsTree' => $loadConceptsTree,
            'loadNamedEntityTree' => $loadNamedEntityTree,
            'usePercentRestriction' => $usePercentRestriction,
            'conceptsRestriction' => $conceptsRestriction,
            'structure' => $structure,
            'fullTextTrees' => $fullTextTrees,
            'textStreamLength' => $textStreamLength,
            'useCache' => $useCache,
            'wrapConcepts' => $wrapConcepts,
        ]);
    }

    /**
     * Return summary data for a file.
     *
     * @param string $fileName
     * @param bool $loadConceptsTree
     * @param bool $loadNamedEntityTree
     * @param int $summaryRestriction
     * @param bool $usePercentRestriction
     * @param int $conceptsRestriction
     * @param string $structure
     * @param int $returnedTopicsCount
     * @param bool $fullTextTrees
     * @param int $textStreamLength
     * @param bool $useCache
     * @param bool $wrapConcepts
     *
     * @return array|null
     */
    public function summarizeFileContent(
        $fileName,
        $loadConceptsTree = false,
        $loadNamedEntityTree = false,
        $summaryRestriction = 7,
        $usePercentRestriction = true,
        $conceptsRestriction = 7,
        $structure = self::STRUCTURE_NEWS_GENERAL,
        $returnedTopicsCount = 2,
        $fullTextTrees = true,
        $textStreamLength = 1000,
        $useCache = true,
        $wrapConcepts = true
    ) {
        if (!is_readable($fileName)) {
            $this->client->getLogger()->error(sprintf('Given file "%s" can not be read', $fileName));

            return null;
        }

        return $this->client->upload(
            'summarizeFileContent',
            [
                [
                    'name' => 'fileName',
                    'contents' => fopen($fileName, 'r'),
                ],
            ],
            [
                'summaryRestriction' => $summaryRestriction,
                'returnedTopicsCount' => $returnedTopicsCount,
                'loadConceptsTree' => $loadConceptsTree,
                'loadNamedEntityTree' => $loadNamedEntityTree,
                'usePercentRestriction' => $usePercentRestriction,
                'conceptsRestriction' => $conceptsRestriction,
                'structure' => $structure,
                'fullTextTrees' => $fullTextTrees,
                'textStreamLength' => $textStreamLength,
                'useCache' => $useCache,
                'wrapConcepts' => $wrapConcepts,
            ]
        );
    }
}
