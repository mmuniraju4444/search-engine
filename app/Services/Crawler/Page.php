<?php


namespace App\Services\Crawler;


use DOMDocument;
use DOMNodeList;

class Page
{

    /**
     * @var array|string[]
     */
    protected array $metaData = ['description' => '', 'keywords' => ''];

    /**
     * @var string
     */
    protected string $title;

    /**
     * @var string
     */
    protected string $url;

    /**
     * @var DOMDocument
     */
    protected DOMDocument $domDoc;

    /**
     * PageCrawler constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
        $this->processURL();
    }

    protected function processURL()
    {
        $this->domDoc = new DomDocument();
        // Load URL
        @$this->domDoc->loadHTML(file_get_contents($this->url, false));
        // Get Title
        $this->title = $this->domDoc->getElementsByTagName('title')->item(0)->nodeValue;
        // Get Meta Tag Value for 'description'  and 'keywords'
        foreach ($this->domDoc->getElementsByTagName('meta') as $metaTag) {
            if (strtolower($metaTag->getAttribute('name')) === "description") {
                $this->metaData['description'] = $metaTag->getAttribute('content');
            }
            if (strtolower($metaTag->getAttribute('name')) === "keywords") {
                $this->metaData['keywords'] = $metaTag->getAttribute('content');
            }
        }
        return $this;
    }

    /**
     * @return DOMNodeList
     */
    public function getMetaTags(): DOMNodeList
    {
        return $this->domDoc->getElementsByTagName('meta');
    }

    /**
     * @return mixed
     */
    public function getURLData(): ?array
    {
        return parse_url($this->url);
    }

    /**
     * @return DOMNodeList
     */
    public function getParagraphTags(): DOMNodeList
    {
        return $this->domDoc->getElementsByTagName('p');
    }
}
