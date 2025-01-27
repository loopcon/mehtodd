<?php

namespace App\DataTables;

use App\Models\User;
// use App\Models\VideoCategory;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MangeBadgeDatatable extends DataTable
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
            
            ->addColumn('status', function ($row) {
                return $this->Status($row);
            })
            ->addColumn('category_name', function ($row) {
                $category_name = $row->category_name;
                prx($category_name);
                return $category_name;  
            })
            
            ->rawColumns(['status','category_name']);
    }
    public function Status($row)
    {
        $status = '';
        $selectedValue = $row->status;
        $status =
            "
        <div class='form-group row'>
        <select class='tbl-status-drowdown change-status' data-id='" .
            $row->id .
            "'>
        <option value=''> -- Select Status -- </option>
        <option value='0' " .
            ($selectedValue == 0 ? 'selected' : '') .
            ">Rejected</option>
        <option value='1' " .
            ($selectedValue == 1 ? 'selected' : '') .
            '>Approve</option>';
        $status .= "
        </select>
        </div>
        ";
        return $status;
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MangeBadgeDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('mangebadgedatatable-table')
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
        return 'MangeBadge_' . date('YmdHis');
    }
}
