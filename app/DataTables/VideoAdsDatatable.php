<?php

namespace App\DataTables;

use App\Models\Video;
use App\Models\VideoAds;
use App\Models\User;
use App\Models\UserVideoCategory;
use App\Models\VideoCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VideoAdsDatatable extends DataTable
{
    public function dataTable($query)
{
    return datatables()
        ->eloquent($query)
        
        // Adding search functionality for 'name' column
        ->filterColumn('name', function($query, $keyword) {
            $query->whereHas('user', function($query) use ($keyword) {
                $query->where('fullname', 'like', "%{$keyword}%");
            });
        })
        ->addColumn('name', function ($row) {
            $user = User::where('id', $row->user_id)->first();
            return $user ? $user->fullname : 'N/A';
        })

        // Adding search functionality for 'mobile_number' column
        ->filterColumn('mobile_number', function($query, $keyword) {
            $query->whereHas('user', function($query) use ($keyword) {
                $query->where('mobile_number', 'like', "%{$keyword}%");
            });
        })
        ->addColumn('mobile_number', function ($row) {
            $user = User::where('id', $row->user_id)->first();
            return $user ? $user->mobile_number : 'N/A';
        })

        // Adding search functionality for 'title' column
        ->filterColumn('title', function($query, $keyword) {
            $query->whereHas('video', function($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%");
            });
        })
        ->addColumn('title', function ($row) {
            $video = Video::find($row->video_id);
            return $video ? $video->title : 'N/A';
        })

        // 'video' column doesn't need search, just display
        ->addColumn('video', function ($row) {
            $videolink = Video::find($row->video_id);
            if ($videolink) {
                $videoName = $videolink->video;
                $videoTitle = $videolink->title;
                $videoUrl = asset('uploads/videos/' . $videoName);

                return '<a href="#" class="alert-modal" data-toggle="modal" data-target="#myModal" data-video-url="' . $videoUrl . '" data-video-title="' . $videoTitle . '" style="color: #007bff;">
                            View Video
                        </a>';
            }
            return null;
        })

        // 'detail' column doesn't need search, just display
        ->addColumn('detail', function ($row) {
            $url = route('purchase.details', ['id' => $row->id]);
            return "<a href='$url' style='color:#007bff;'>View Details</a>";
        })

        ->rawColumns(['name', 'video', 'title', 'mobile_number', 'detail']);
}


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\VideoAds $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(VideoAds $model)
    {
        // return $this->applyScopes($model->newQuery()->latest('updated_at'));
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
        // return $this->builder()->setTableId('VideoAdsDatatable-table')->columns($this->getColumns())->minifiedAjax()->dom('Bfrtip')->orderBy(1)->buttons(Button::make('create'), Button::make('export'), Button::make('print'), Button::make('reset'), Button::make('reload'));
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
        return 'VideoAds' . date('YmdHis');
    }
}
