<?php

namespace Modules\Cms\Entities\Traits;

/**
 * 需要利用拼音首字母或拼音全称的数据进行添加，方便以后查询
 */
trait AutoAlpha
{

    public static function bootAutoAlpha()
    {
        self::saving(function ($model) {
            $pinyin = app('pinyin');
            if (!$model->alpha) {
                $model->alpha = strtoupper(substr($pinyin->sentence($model->title, ''), 0, 1));
            }
            if (!$model->pinyin) {
                $model->pinyin = $pinyin->sentence($model->title, '');
            }
        });
    }

}
