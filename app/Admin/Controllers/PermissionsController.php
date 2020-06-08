<?php

namespace App\Admin\Controllers;

use Spatie\Permission\Models\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Spatie\Permission\Models\Role;

class PermissionsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Permission';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Permission());

        $grid->id('Id');
        $grid->name('名称');
        $grid->guard_name('Guard name');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

        $grid->actions(function ($actions) {
            $actions->disableView();
        });

        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('name', '名称');
            $filter->equal('guard_name', 'Guard Name');
            $filter->between('created_at')->datetime();

        });

        $grid->roles('角色')->pluck('name')->label();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Permission::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('guard_name', __('Guard name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Permission());

        $form->text('name', __('Name'));
        $form->text('guard_name', __('Guard name'));
        $form->listbox('roles', '角色')->options(Role::all()->pluck('name', 'id'));

        return $form;
    }
}
