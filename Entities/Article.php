<?php

namespace Modules\Cms\Entities;

use App\Models\Model;
use App\Traits\DataStatus;
use App\Traits\HasClicks;
use App\Traits\HasCovers;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Cms\Entities\Traits\BelongsToCategory;

class Article extends Model
{
    use HasCovers, BelongsToCategory, HasClicks, DataStatus, SoftDeletes;

    protected $casts = [
        'pictures' => 'array',
    ];
}
