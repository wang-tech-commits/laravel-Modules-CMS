<?php

namespace Modules\Cms\Entities\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Cms\Entities\Category;

trait BelongsToCategory
{

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
