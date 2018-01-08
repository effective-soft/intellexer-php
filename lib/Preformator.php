<?php

namespace EffectiveSoft\Intellexer;

class Preformator
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
     * @return array|null
     */
    public function supportedDocumentStructures()
    {
        return $this->client->get('supportedDocumentStructures');
    }

    /**
     * @return array|null
     */
    public function supportedDocumentTopics()
    {
        return $this->client->get('supportedDocumentTopics');
    }

    /**
     * @param string $url
     * @param bool $useCache
     *
     * @return array|null
     */
    public function parse($url, $useCache = true)
    {
        return $this->client->get('parse', ['url' => $url, 'useCache' => $useCache]);
    }

    /**
     * @param string $fileName
     *
     * @return array|null
     */
    public function parseFileContent($fileName)
    {
        if (!is_readable($fileName)) {
            $this->client->getLogger()->error(sprintf('Given file "%s" can not be read', $fileName));

            return null;
        }

        return $this->client->upload('parseFileContent', [['name' => 'fileName', 'content' => fopen($fileName, 'r')],]);
    }
}
