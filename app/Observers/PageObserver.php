<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Page;

class PageObserver
{
    /**
     * Handle the Page "creating" event.
     *
     * @param Page $model
     * @return void
     */
    public function creating(Page $model)
    {
        $model->uuid = (string)Str::uuid();
    }
}
