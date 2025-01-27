<?php

namespace App\DataTables;

use App\Models\Information;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;


class InformationDatatable extends DataTable
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
                // Add your action column logic here
            })
            ->addColumn('created_at', function ($row) {
                return  date("d-m-Y", strtotime($row->created_at));
            })

            ->addColumn('message', function ($row) {
                $information = Information::find($row->id); 
                $data = $information->message; 
                $button = '<a href="#" class="alert-confirm btn_readmore-' . $row->id . '" data-toggle="modal" data-target="#myModal" data-id="' . $row->id . '" style="color: #007bff;">... Read More </a>';
                $Message = Str::limit($data, 70, $button);
            
                return $Message;
            })
            ->rawColumns(['action', 'message','created_at']);
    }



    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Information $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Information $model)
    {

        $models = $model->select();
        if (!request()->has('order')) {
            $models->orderBy('informations.updated_at', 'DESC');
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
            ->setTableId('Newsletter-table')
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

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
}
