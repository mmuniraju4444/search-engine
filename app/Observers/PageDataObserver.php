<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\PageData;

class PageDataObserver
{
    /**
     * Handle the PageData "creating" event.
     *
     * @param PageData $model
     * @return void
     */
    public function creating(PageData $model)
    {
        $model->uuid = (string)Str::uuid();
    }
}
