<?php

namespace App\Repositories;

use App\Interfaces\IPageRepository;
use App\Models\Page;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PageRepository implements IPageRepository
{
    /**
     * @param array $attributes
     * @return Page
     * @throws Exception
     */
    public function savePage(array $attributes): Page
    {
        return $this->saveOrUpdatePage($attributes);
    }

    /**
     * @param array $attributes
     * @return Page
     * @throws Exception
     */
    protected function saveOrUpdatePage(array $attributes): Page
    {
        DB::beginTransaction();
        try {
            $model = Page::withTrashed()->updateOrCreate(
                [
                    'uuid' => Arr::get($attributes, 'uuid')
                ],
                [
                    'url' => $attributes['url'],
                    'title' => $attributes['title'],
                    'description' => Arr::get($attributes, 'description', null),
                    'keywords' => Arr::get($attributes, 'keywords', null),
                ]);
            if ($model->trashed()) {
                $model->restore();
            }
            DB::commit();
            return $model;
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator|null
     */
    public function getPages(array $filters)
    {
        return $this->getSearchQueryResult($filters);
    }

    /**
     * @param $filters
     * @return LengthAwarePaginator
     */
    protected function getSearchQueryResult(array $filters): ?LengthAwarePaginator
    {
        $queryText = Arr::get($filters, 'q', null);
        return DB::table('pages')
            ->join('page_data', 'pages.id', '=', 'page_data.page_id')
            ->whereRaw("MATCH(pages.url, pages.title, pages.description, pages.keywords) AGAINST ('$queryText')")
            ->orWhereRaw("MATCH(page_data.data) AGAINST ('$queryText')",)
            ->selectRaw(
                "pages.uuid, pages.url, pages.title, page_data.data,
        MATCH(pages.url, pages.title, pages.description, pages.keywords) AGAINST('$queryText') as pScore,
        MATCH(page_data.data) AGAINST ('$queryText') as pdScore")
            ->groupBy('pages.id')
            ->orderByRaw('(pScore+pdScore)')
            ->paginate(2);
    }
}
