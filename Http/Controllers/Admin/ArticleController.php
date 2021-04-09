<?php

namespace Modules\Cms\Http\Controllers\Admin;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Modules\Cms\Entities\Article;
use Modules\Cms\Entities\Category;

class ArticleController extends AdminController
{
    protected $title = '文章管理';

    public function grid(): Grid
    {
        $grid = new Grid(new Article);

        $grid->filter(function (Grid\Filter $filter) {
            $filter->column(1 / 3, function (Grid\Filter $filter) {
                $filter->like('title', '资讯标题');
            });
            $filter->column(1 / 3, function (Grid\Filter $filter) {
                $filter->like('category.title', '所属分类');
            });
            $filter->column(1 / 3, function (Grid\Filter $filter) {
                $filter->equal('status', '状态')->radio([
                    0 => '禁用',
                    1 => '正常',
                ]);
            });
        });
        $grid->id('#ID#');

        $grid->column('cover', '封面图片')->image('', 100, 100);
        $grid->column('category.title', '所属分类');
        $grid->column('title', '文章标题');
        $grid->column('clicks', '浏览量')->sortable();
        $grid->column('status', '状态')->bool();
        $grid->column('order', '排序');
        $grid->column('created_at', '创建时间');

        return $grid;
    }

    public function form(): Form
    {
        $form = new Form(new Article);

        $form->text('title', '文章标题')
            ->required();

        $form->select('category_id', '所属分类')
            ->options(Category::shown()->pluck('title', 'id'))
            ->required();
        $form->textarea('description', '文章简介')->required();
        $form->image('cover', '封面上传')
            ->move('images/' . date('Y/m/d'))
            ->removable()
            ->uniqueName()
            ->creationRules('required');
        $form->multipleImage('pictures', '多图上传')
            ->move('images/' . date('Y/m/d'))
            ->removable()
            ->uniqueName();
        $form->number('order', '排序')->default(0);
        $form->switch('status', '显示')->default(1);
        $form->ueditor('content', '文章详情')->required();

        return $form;
    }
}
