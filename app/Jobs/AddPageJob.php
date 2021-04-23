<?php

namespace App\Jobs;

use App\Interfaces\IPageDataRepository;
use App\Interfaces\IPageRepository;
use App\Models\Page;
use App\Models\PageData;
use App\Repositories\PageDataRepository;
use App\Repositories\PageRepository;
use App\Services\Crawler\PageCrawler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AddPageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var PageCrawler
     */
    protected PageCrawler $pageCrawler;

    /**
     * @var PageRepository
     */
    protected IPageRepository $pageRepo;

    /**
     * @var Page
     */
    protected Page $pageModel;

    /**
     * @var PageDataRepository
     */
    protected IPageDataRepository $pageDataRepo;

    /**
     * @var array
     */
    protected array $urls;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $urls)
    {
        $this->urls = $urls;
        $this->pageRepo = app(IPageRepository::class);
        $this->pageDataRepo = app(IPageDataRepository::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        foreach ($this->urls as $url) {
            try {
                if ($this->validURL($url) === false) {
                    throw new \Exception("Invalid URL : $url");
                }
                $this->pageCrawler = new PageCrawler($url);
                $this->pageModel = $this->addPage();
                if (empty($this->pageModel)) {
                    throw new \Exception("Model not Created");
                }
                $this->addPageData();
                unset($this->pageCrawler, $this->pageModel);
            } catch (\Exception $ex) {
                Log::error(
                    'Failed to parse URL',
                    [
                        'url' => $url,
                        'error_message' => $ex->getMessage()
                    ]
                );
            }
        }
    }

    protected function validURL($url) :bool
    {
        if(!filter_var($url, FILTER_VALIDATE_URL))
        {
            return false;
        }
        $curlInit = curl_init($url);
        curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($curlInit,CURLOPT_HEADER,true);
        curl_setopt($curlInit,CURLOPT_NOBODY,true);
        curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($curlInit);
        curl_close($curlInit);
        return $response ? true : false;
    }

    /**
     * @return Page
     * @throws \Exception
     */
    protected function addPage(): Page
    {
        $data = [
            'uuid' => $this->pageUrlUUID(),
            'url' => $this->pageCrawler->getURL(),
            'title' => $this->pageCrawler->getPageTitleValue(),
            'description' => $this->pageCrawler->getMetaDescriptionValue(),
            'keywords' => $this->pageCrawler->getMetaKeywordsValue()
        ];
        return $this->pageRepo->savePage($data);
    }

    /**
     * @return string|null
     */
    protected function pageUrlUUID(): ?string
    {
        try {
            $model = Page::where('url', $this->pageCrawler->getURL())->first();
            return empty($model) ? null : $model->uuid;
        } catch (\Exception $ex) {
            return null;
        }
    }

    /**
     * @return $this
     */
    protected function addPageData()
    {
        PageData::where('page_id', $this->pageModel->id)->delete();
        foreach ($this->pageCrawler->getParagraphData() as $pData) {
            $text = trim(str_replace(array("\n", "\r"), '', $pData));
            $data = [
                'uuid' => $this->pageDataUUID($text),
                'page_id' => $this->pageModel->id,
                'data' => $text,
            ];
            $this->pageDataRepo->savePageData($data);
        }
        return $this;
    }

    /**
     * @return string|null
     */
    protected function pageDataUUID(string $data): ?string
    {
        try {
            $model = PageData::withTrashed()->where('page_id', $this->pageModel->id)->where('data', $data)->firstOrFail();
            return empty($model) ? null : $model->uuid;
        } catch (\Exception $ex) {
            return null;
        }
    }
}
