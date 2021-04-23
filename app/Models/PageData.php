<?php

namespace App\Models;

use App\Services\Traits\UUID;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageData extends BaseModel
{
    use UUID, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'page_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'page_id',
        'data'
    ];


    /**
     * @return BelongsTo|null
     */
    public function page(): ?BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
