<?php

namespace EffectiveSoft\Intellexer;

class Clusterizer
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
     * @param string $url
     * @param int $conceptsRestriction
     * @param bool $fullTextTrees
     * @param bool $loadSentences
     * @param bool $wrapConcepts
     * @param bool $useCache
     *
     * @return array|null
     */
    public function clusterize(
        $url,
        $conceptsRestriction = 10,
        $fullTextTrees = false,
        $loadSentences = true,
        $wrapConcepts = false,
        $useCache = true
    ) {
        return $this->client->get('clusterize', [
            'url' => $url,
            'conceptsRestriction' => $conceptsRestriction,
            'fullTextTrees' => $fullTextTrees,
            'useCache' => $useCache,
            'loadSentences' => $loadSentences,
            'wrapConcepts' => $wrapConcepts,

        ]);
    }

    /**
     * @param string $text
     * @param int $conceptsRestriction
     * @param bool $fullTextTrees
     * @param bool $loadSentences
     * @param bool $wrapConcepts
     * @param bool $useCache
     *
     * @return array|null
     */
    public function clusterizeText(
        $text,
        $conceptsRestriction = 0,
        $fullTextTrees = false,
        $loadSentences = true,
        $wrapConcepts = false,
        $useCache = true
    ) {
        return $this->client->post('clusterizeText', $text, [
            'conceptsRestriction' => $conceptsRestriction,
            'fullTextTrees' => $fullTextTrees,
            'useCache' => $useCache,
            'loadSentences' => $loadSentences,
            'wrapConcepts' => $wrapConcepts,

        ]);
    }

    /**
     * @param string $fileName
     * @param int $conceptsRestriction
     * @param bool $fullTextTrees
     * @param bool $loadSentences
     * @param bool $wrapConcepts
     * @param bool $useCache
     *
     * @return array|null
     */
    public function clusterizeFileContent(
        $fileName,
        $conceptsRestriction = 10,
        $fullTextTrees = false,
        $loadSentences = true,
        $wrapConcepts = false,
        $useCache = true
    ) {

        if (!is_readable($fileName)) {
            $this->client->getLogger()->error(sprintf('Given file "%s" can not be read', $fileName));

            return null;
        }

        return $this->client->upload(
            'clusterizeFileContent',
            [
                [
                    'name' => 'fileName',
                    'contents' => fopen($fileName, 'r'),
                ],
            ],
            [
                'conceptsRestriction' => $conceptsRestriction,
                'fullTextTrees' => $fullTextTrees,
                'loadSentences' => $loadSentences,
                'wrapConcepts' => $wrapConcepts,
                'useCache' => $useCache,
            ]
        );
    }
}
