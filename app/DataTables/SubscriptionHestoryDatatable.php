<?php

namespace App\DataTables;

use App\Models\Subscription;
use App\Models\Video;
use App\Models\VideoAds;
use App\Models\SubscriptionHestory;
use App\Models\User;
use App\Models\UserVideoCategory;
use App\Models\VideoCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
// use Yajra\DataTables\Html\Editor\Editor;
// use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubscriptionHestoryDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            // Column for name
            ->addColumn('name', function ($row) {
                return User::where('id', $row->user_id)->value('fullname');
            })

            // Column for subscription type
            ->addColumn('subscription_type', function ($row) {
                return Subscription::where('id', $row->subsciption_id)->value('title');
            })

            // Column for mobile number
            ->addColumn('mobile_number', function ($row) {
                return User::where('id', $row->user_id)->value('mobile_number');
            })

            // Column for email
            ->addColumn('email', function ($row) {
                return User::where('id', $row->user_id)->value('email');
            })

            // Column for created_at
            ->addColumn('created_at', function ($row) {
                return User::where('id', $row->user_id)->value('created_at');
            })


            // Adding filtering for related columns
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('fullname', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('subscription_type', function ($query, $keyword) {
                $query->whereHas('subscription', function ($q) use ($keyword) {
                    $q->where('title', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('mobile_number', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('mobile_number', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('email', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('email', 'like', "%{$keyword}%");
                });
            })

            ->rawColumns(['name', 'subscription_type', 'mobile_number', 'email', 'created_at', 'amount']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SubscriptionHestory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubscriptionHestory $model)
    {
        // return $this->applyScopes($model->newQuery()->latest('updated_at'));
        return $model->newQuery()->withTrashed();

    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns([
                'id',
                'user_id',
                'video_id',
                'amount',
                'deleted_at',
                'created_at',
                'updated_at'
            ])
            ->minifiedAjax()
            ->addAction(['width' => '80px'])
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['excel', 'csv', 'pdf'],
            ]);
        // return $this->builder()->setTableId('SubscriptionHestoryDatatable-table')->columns($this->getColumns())->minifiedAjax()->dom('Bfrtip')->orderBy(1)->buttons(Button::make('create'), Button::make('export'), Button::make('print'), Button::make('reset'), Button::make('reload'));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [Column::computed('action')->exportable(false)->printable(false)->width(60)->addClass('text-center'), Column::make('id'), Column::make('add your columns'), Column::make('created_at'), Column::make('updated_at')];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SubscriptionHestory' . date('YmdHis');
    }
}
