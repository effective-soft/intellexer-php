<?php

namespace EffectiveSoft\Intellexer;

class NamedEntityRecognizer
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
     * Load Named Entities from a document from a given URL
     *
     * @param string $url
     * @param bool $loadNamedEntities
     * @param bool $loadRelationsTree
     * @param bool $loadSentences
     *
     * @return array|null
     */
    public function recognizeNe($url, $loadNamedEntities = false, $loadRelationsTree = false, $loadSentences = false)
    {
        return $this->client->get('recognizeNe', [
            'url' => $url,
            'loadNamedEntities' => $loadNamedEntities,
            'loadRelationsTree' => $loadRelationsTree,
            'loadSentences' => $loadSentences,
        ]);
    }

    /**
     * Load Named Entities from a file.
     *
     * @param string $fileName
     * @param bool $loadNamedEntities
     * @param bool $loadRelationsTree
     * @param bool $loadSentences
     *
     * @return array|null
     */
    public function recognizeNeFileContent(
        $fileName,
        $loadNamedEntities = false,
        $loadRelationsTree = false,
        $loadSentences = false
    ) {
        if (!is_readable($fileName)) {
            $this->client->getLogger()->error(sprintf('Given file "%s" can not be read', $fileName));

            return null;
        }

        return $this->client->upload(
            'recognizeNeFileContent',
            [
                [
                    'name' => 'file',
                    'contents' => fopen($fileName, 'r'),
                ],
            ],
            [
                'loadNamedEntities' => $loadNamedEntities,
                'loadRelationsTree' => $loadRelationsTree,
                'loadSentences' => $loadSentences,
            ]
        );
    }

    /**
     * Load Named Entities from a text.
     *
     * @param string $text
     * @param bool $loadNamedEntities
     * @param bool $loadRelationsTree
     * @param bool $loadSentences
     *
     * @return array|null
     */
    public function recognizeNeText(
        $text,
        $loadNamedEntities = false,
        $loadRelationsTree = false,
        $loadSentences = false
    ) {

        return $this->client->post(
            'recognizeNeText',
            $text,
            [
                'loadNamedEntities' => $loadNamedEntities,
                'loadRelationsTree' => $loadRelationsTree,
                'loadSentences' => $loadSentences,
            ]
        );
    }
}
