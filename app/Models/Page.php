<?php

namespace App\Models;

use App\Services\Traits\UUID;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends BaseModel
{
    use UUID, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'url',
        'title',
        'description',
        'keywords'
    ];

    /**
     * @return HasMany
     */
    public function pageData()
    {
        return $this->hasMany(PageData::class);
    }
}
