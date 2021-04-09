<?php

namespace Modules\Cms\Entities;

use App\Models\Model;
use App\Traits\DataStatus;
use App\Traits\HasCovers;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Cms\Entities\Traits\AutoAlpha;

class Category extends Model
{
    use AdminBuilder, AutoAlpha, HasCovers, ModelTree, SoftDeletes, DataStatus;

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
