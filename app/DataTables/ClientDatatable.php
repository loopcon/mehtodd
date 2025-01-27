<?php

namespace App\DataTables;

use App\Models\Client;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class ClientDatatable extends DataTable
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
            ->addColumn('action', function ($row) {
                return $this->checkrights($row);
            })
            ->addColumn('degination ', function ($row) {
                return $row->degination;
            })
            ->addColumn('description', function ($row) {
                $description = Client::find($row->id);
                $data = $description->description;
                // prx($data);
                $button = '<a href="#" class="btn_read_more btn_readmore-' . $row->id . '" data-toggle="modal" data-target="#myModal" data-id="' . $row->id . '" style="color: #007bff;">... Read More </a>';
                $Message = Str::limit($data, 70, $button);

                return $Message;
            })
            ->addColumn('photo', function ($row) {
                // $client = Client::find($row->id);
                // $photo = $client->photo;
                // $photo = '<img src="http://127.0.0.1:8000/uploads/logo/1704462490_2.jpg" class="rounded elevation-2 img_logo_1" alt="Image" style="max-width: 80%;">';
                $photo = '<img src="' . asset("uploads/images/" . $row->photo) . '" class="rounded elevation-2 img_logo_1" alt="Image" style="max-width: 40%;">';


                return $photo;
            })
            ->rawColumns(['action', 'degination', 'photo', 'description']);
    }

    public function checkrights($row)
    {
        $menu = '';
        $editurl = route('client.edit', ['client' => $row->id]);

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
     * @param \App\Models\Client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model)
    {
        $models = $model->select();
        if (!request()->has('order')) {
            $models->orderBy('our_clients.updated_at', 'DESC');
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
            ->setTableId('clientdatatable-table')
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
        return 'Client_' . date('YmdHis');
    }
}
