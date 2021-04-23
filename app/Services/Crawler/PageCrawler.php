<?php

namespace App\Services\Crawler;

use DOMDocument;
use Generator;

class PageCrawler extends Page
{

    /**
     * PageCrawler constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        parent::__construct($url);
    }

    /**
     * @return string
     */
    public function getURL(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getMetaDescriptionValue(): string
    {
        return $this->metaData['description'];
    }

    /**
     * @return string
     */
    public function getMetaKeywordsValue(): string
    {
        return $this->metaData['keywords'];
    }

    /**
     * @return string
     */
    public function getPageTitleValue(): string
    {
        return $this->title;
    }

    /**
     * @return Generator
     */
    public function getParagraphData(): Generator
    {
        @$this->domDoc->loadHTML(file_get_contents($this->url, false));
        foreach ($this->domDoc->getElementsByTagName('p') as $pTag) {
            if (empty(trim($pTag->nodeValue))) {
                continue;
            }
            yield $pTag->nodeValue;
        }
    }
}
