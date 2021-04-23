<?php

namespace App\Repositories;

use App\Interfaces\IPageDataRepository;
use App\Models\PageData;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PageDataRepository implements IPageDataRepository
{
    /**
     * @param array $attributes
     * @return PageData
     * @throws Exception
     */
    public function savePageData(array $attributes): PageData
    {
        return $this->saveOrUpdatePageData($attributes);
    }

    /**
     * @param array $attributes
     * @return PageData
     * @throws Exception
     */
    protected function saveOrUpdatePageData(array $attributes): PageData
    {
        DB::beginTransaction();
        try {
            $model = PageData::withTrashed()->updateOrCreate(
                [
                    'uuid' => Arr::get($attributes, 'uuid')
                ],
                [
                    'data' => $attributes['data'],
                    'page_id' => $attributes['page_id'],
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
}
