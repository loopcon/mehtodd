<?php

namespace App\DataTables;

use App\Models\User;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BadgeDatatable extends DataTable
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
            ->addColumn('user_category_id ', function ($row) {

                $user_name = getCategoryName($row->user_category_id);
                return $user_name;
            })


            // ->addColumn('created_at', function ($row) {
            //     prx(($row->created_at));
            //     return  date("d-m-Y", strtotime($row->created_at));
            // })
            ->addColumn('created_at', function ($row) {
                // prx('12');
                return  date("d-m-Y", strtotime($row->created_at));
            })
            ->addColumn('document_name', function ($row) {
                return '<a href="' . route('bagde.download.document', ['userId' => $row->id]) . '" class="download-document" data-document-id="' . $row->id . '" style="color: #007bff;">Download</a>';
            })




            ->rawColumns(['status', 'user_category_id', 'document_name','created_at']);
    }

    public function Status($row)
    {
        $status = '';
        $selectedValue = $row->apply_base;
        $status .= '
            <div class="form-group row">
                <select class="tbl-status-drowdown change-status" data-id="' . $row->id . '">
                    <option value="0" ' . ($selectedValue == 0 ? 'selected' : '') . '>Pending</option>
                    <option value="1" ' . ($selectedValue == 1 ? 'selected' : '') . '>Approved</option>
                    <option value="2" ' . ($selectedValue == 2 ? 'selected' : '') . '>Rejected</option>

                </select>
            </div>';
        return $status;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BadgeDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $query = $model->newQuery();
        $query = $query->where('apply_base', '!=', NULL)->latest();
        // prx($query);
        return $query;
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
