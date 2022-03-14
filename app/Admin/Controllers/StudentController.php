<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Student;
use App\Models\Student as StudentModel;
use App\Models\Classes as ClassesModel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class StudentController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Student(['classes']), function (Grid $grid) {
            $grid->model()->orderByDesc('created_at');

            // 默认为每页10条
            $grid->paginate(10);

            $grid->column('id')->sortable();
            $grid->column('name','姓名');
            $grid->column('gender')->using(StudentModel::GENDER);
            $grid->column('age');
            $grid->column('classes.name','所属班级');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                // 更改为 panel 布局
                $filter->panel();
                $filter->expand();
                $filter->like('name','姓名')->width(3);
                $filter->equal('gender','性别')->select(StudentModel::GENDER)->width(3);
                $filter->equal('classes_id','班级')->select(ClassesModel::all()->pluck('name','id'))->width(3);
            });

        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Student(['classes']), function (Show $show) {
            $show->field('id');
            $show->field('name','姓名');
            $show->field('gender')->using(StudentModel::GENDER);
            $show->field('age');
            $show->field('classes.name','所属班级');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Student(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();;
            $form->radio('gender')->options(StudentModel::GENDER)->default(1)->required();
            $form->text('age')->required();
            $form->select('classes_id','所属班级')->options(ClassesModel::all()->pluck('name','id'))->required();

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
