<?php

namespace App\DataTables;

use App\Models\Difficulty;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DifficultyDatatable extends DataTable
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
            ->addColumn('created_at', function ($row) {
                return  date("d-m-Y", strtotime($row->created_at));
            })
            ->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : '';
            })
            ->rawColumns(['action', 'created_at', 'category_name']);
    }

    public function checkrights($row)
    {
        $menu = '';
        $editurl = route('difficulty.edit', ['difficulty' => $row->id]);

        $menu .= ' <div class="hstack gap-2 flex-wrap">';
        if ($row->deleted_at == '') {
            $menu .= '<a href="' . $editurl . '" class="text-info fs-14 lh-1"><i
            class="fa-solid fa-pen-to-square"></i></a>';
            $menu .= '<a href="javascript:void(0);" data-id="' . $row->id . '" class="text-danger fs-14 lh-1 alert-confirm"><i
            class="fa-solid fa-trash"></i></a>';
        } else {
        }
        $menu .= '</div>';

        return $menu;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DifficultyDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Difficulty $model)
    {
        return $model->with(['category'])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('difficultydatatable-table')
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
        return 'Difficulty_' . date('YmdHis');
    }
}
