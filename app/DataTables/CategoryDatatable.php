<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row) {
                return $this->checkrights($row);
            })
            ->editColumn('status', function ($row) {
                return $this->Status($row);
            })
            ->addColumn('category_name', function ($row) {
                $mainCategoryName = "";
                if ($row->category_id == '') {
                    $mainCategoryName = $row->name;
                } else {
                    $category = Category::where('id', $row->category_id)->first();
                    if ($category) {
                        $mainCategoryName = $category->name;
                    }
                }
                return $mainCategoryName;
            })
            ->addColumn('sub_category', function ($row) {
                $subCategory = "";
                if ($row->category_id != '') {
                    $subCategory =  $row->name;
                } else {
                    $subCategory = '-';
                }
                return $subCategory;
            })

            ->rawColumns(['action', 'category_name', 'sub_category', 'status']);
    }
    public function checkrights($row)
    {
        $menu = '';
        $editurl = route('edit.category', ['id' => $row->id]);
        // $deleteurl = route('delete.category', ['id' => $row->id]);

        $menu .= ' <div class="hstack gap-2 flex-wrap">';
        if ($row->deleted_at == '') {
            $menu .= '<a href="' . $editurl . '" class="text-info fs-14 lh-1"><i
            class="fa-solid fa-pen-to-square"></i></a>';
            $menu .= '<a href="javascript:void(0);" data-id="' . $row->id . '" class="text-danger fs-14 lh-1 alert-confirm"><i
            class="fa-solid fa-trash"></i></a>';
        } else {
        }
        $menu .= '</div>'; // Wrap the buttons in a div with the "btn-group" class


        return $menu;
    }
    public function Status($row)
    {
        $status = '';
        $selectedValue = $row->status;
        $status = "
        <div class='form-group row'>
            <select class='tbl-status-drowdown change-status' data-id='" . $row->id . "'>
                <option value=''> -- Select Status -- </option>
                <option value='0' " . ($selectedValue == 0 ? "selected" : "") . ">Inactive</option>
                <option value='1' " . ($selectedValue == 1 ? "selected" : "") . ">Active</option>";
        $status .= "
            </select>
        </div>
         ";
        return $status;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CategoryDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        // return $model->newQuery();
        $models = Category::select();

        if (!request()->has('order')) {
            $models->orderBy('categories.updated_at', 'DESC');
        }

        return $this->applyScopes($models);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {

        return $this->builder()
            ->setTableId('categorydatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {

        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),

            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }



    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Category' . date('YmdHis');
    }
}
