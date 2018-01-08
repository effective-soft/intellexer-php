<?php

namespace EffectiveSoft\Intellexer;

class Comparator
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
     * @param string $text1
     * @param string $text2
     *
     * @return array|null
     */
    public function compareText($text1, $text2)
    {
        return $this->client->post('compareText', \GuzzleHttp\json_encode(['text1' => $text1, 'text2' => $text2,]));
    }

    /**
     * @param string $url1
     * @param string $url2
     * @param bool $useCache
     *
     * @return array|null
     */
    public function compareUrls($url1, $url2, $useCache = true)
    {
        return $this->client->get('compareUrls', ['url1' => $url1, 'url2' => $url2, 'useCache' => $useCache,]);
    }

    /**
     * @param string $url
     * @param string $fileName
     * @param bool $useCache
     *
     * @return array|null
     */
    public function compareUrlWithFile($url, $fileName, $useCache = true)
    {
        if (!is_readable($fileName)) {
            $this->client->getLogger()->error(sprintf('Given file "%s" can not be read', $fileName));

            return null;
        }

        return $this->client->upload(
            'compareUrlwithFile',
            [
                [
                    'name' => 'fileName',
                    'contents' => fopen($fileName, 'r'),
                ],
            ],
            [
                'url' => $url,
                'useCache' => $useCache,
            ]
        );
    }

    /**
     * @param $fileName1
     * @param $fileName2
     *
     * @return array|null
     */
    public function compareFiles($fileName1, $fileName2)
    {
        foreach ([$fileName1, $fileName2] as $fileName) {
            if (!is_readable($fileName)) {
                $this->client->getLogger()->error(sprintf('Given file "%s" can not be read', $fileName));

                return null;
            }
        }

        return $this->client->upload(
            'compareFiles',
            [
                [
                    'name' => 'fileName1',
                    'contents' => fopen($fileName1, 'r'),
                ],
                [
                    'name' => 'fileName2',
                    'contents' => fopen($fileName2, 'r'),
                ],
            ]
        );
    }
}
