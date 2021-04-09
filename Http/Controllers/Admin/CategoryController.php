<?php

namespace Modules\Cms\Http\Controllers\Admin;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Row;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form as WidgetsForm;
use Modules\Cms\Entities\Category;

class CategoryController extends AdminController
{
    protected $title = '分类管理';

    public function grid()
    {
        return function (Row $row) {
            $row->column(6, $this->treeView());

            $row->column(6, function (Column $column) {
                $form = new WidgetsForm();
                $form->select('parent_id', '上级分类')
                    ->options(Category::selectOptions(function ($model) {
                        return $model->where('status', 1);
                    }, '一级分类'));

                $form->text('title', '分类名称')
                    ->rules('required');

                $form->textarea('description', '分类简介')
                    ->rules('nullable');

                $form->image('cover', 'LOGO')
                    ->move('images/' . date('Y/m/d'))
                    ->removable()
                    ->uniqueName();

                $form->number('order', '排序')->default(0);
                $form->text('template', '展示模板');

                $form->switch('status', '状态')->default(1);

                $form->action(admin_url('cms/categories'));

                $column->append((new Box('新增分类', $form))->style('success'));
            });
        };
    }

    protected function treeView()
    {
        return Category::tree(function (Tree $tree) {
            $tree->disableCreate();
            $tree->branch(function ($branch) {
                $category = Category::find($branch['id']);
                if ($branch['status'] == 1) {
                    $payload = "<i class='fa fa-eye text-primary'></i> ";
                } else {
                    $payload = "<i class='fa fa-eye text-gray'></i> ";
                }

                if ($branch['cover']) {
                    $payload .= " <i class='fa fa-picture-o text-success'></i>";
                } else {
                    $payload .= " <i class='fa fa-picture-o text-gray'></i>";
                }

                $industry_title = $category->industry ? $category->industry->title : '';

                $payload .= " [ID:{$branch['id']}] - ";
                $payload .= " <strong>{$branch['title']}</strong> ";
                $payload .= " <small style='color:#999'>{$branch['description']}</small>";
                $payload .= " <small style='color:#999'>TPL:{$branch['template']}</small>";

                return $payload;
            });
        });
    }

    protected function form()
    {
        $form = new Form(new Category);

        $form->select('parent_id', '上级分类')
            ->options(Category::selectOptions(function ($model) {
                return $model->where('status', 1);
            }, '一级分类'));

        $form->text('title', '分类名称')->rules('required');

        $form->textarea('description', '分类简介')->rules('nullable');

        $form->image('cover', 'LOGO')
            ->move('images/' . date('Y/m/d'))
            ->removable()
            ->uniqueName();

        $form->number('order', '排序')->default(0);
        $form->text('template', '展示模板');
        $form->switch('status', '显示')->default(1);

        return $form;
    }

}
