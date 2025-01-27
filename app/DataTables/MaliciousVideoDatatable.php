<?php

namespace App\DataTables;

use App\Models\Category;
use App\Models\Video;
use App\Models\MaliciousVideo;
use App\Models\User;
use App\Models\UserVideoCategory;
use App\Models\VideoCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;


class MaliciousVideoDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    protected $additionalData;
    public function setAdditionalData($data)
    {
        $this->additionalData = $data;
        return $this;
    }

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->addColumn('fullname', function ($row) {
                $video = Video::find($row->video_id);
                return $video ? User::find($video->user_id)->fullname ?? 'N/A' : 'N/A';
            })

            ->addColumn('report_by', function ($row) {
                $reportBy = User::find($row->report_by);
                return $reportBy ? $reportBy->fullname : 'N/A';
            })

            ->addColumn('note', function ($row) {
                $video = Video::find($row->video_id);
                if ($video && $video->note) {
                    $limitedNote = Str::limit($video->note, 5);
                    return $limitedNote . ' <a href="#" class="alert-confirm-for-video-notes btn_readmore-' . $row->id . '" data-toggle="modal" data-target="#myDetailsModal" data-id="' . $row->id . '" style="color: #007bff;">... Read More </a>';
                }
                return 'N/A';
            })

            ->addColumn('description', function ($row) {
                $desdata = MaliciousVideo::find($row->id);
                $limitedDescription = Str::limit($desdata->descriptions ?? '', 10);
                return $limitedDescription . ' <a href="#" class="alert-confirm-for-video-descriptions btn_readmore-' . $row->id . '" data-toggle="modal" data-target="#myDetailsModal" data-id="' . $row->id . '" style="color: #007bff;">... Read More </a>';
            })

            ->addColumn('video', function ($row) {
                $videolink = Video::find($row->video_id);
                if ($videolink) {
                    $videoUrl = asset('uploads/videos/' . $videolink->video);
                    return '<a href="#" class="alert-modal" data-toggle="modal" data-target="#myDetailsModal" data-video-url="' . $videoUrl . '" style="color: #007bff;">View Video</a>';
                }
                return null;
            })

            ->addColumn('title', function ($row) {
                return Video::find($row->video_id)->title ?? 'N/A';
            })

            ->addColumn('malicious_status', function ($row) {
                return $this->MaliciousVideoAction($row);
            })

            // Search functionality
            ->filterColumn('fullname', function ($query, $keyword) {
                $query->whereHas('video.user', function ($q) use ($keyword) {
                    $q->where('fullname', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('report_by', function ($query, $keyword) {
                $query->whereHas('reporter', function ($q) use ($keyword) {
                    $q->where('fullname', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('note', function ($query, $keyword) {
                $query->whereHas('video', function ($q) use ($keyword) {
                    $q->where('note', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('title', function ($query, $keyword) {
                $query->whereHas('video', function ($q) use ($keyword) {
                    $q->where('title', 'like', "%{$keyword}%");
                });
            })

            ->rawColumns(['fullname', 'title', 'video', 'report_by', 'malicious_status', 'description', 'note']);
    }
    
    public function checkrights($row)
    {
        $menu = '';
        $editurl = route('videos.edit', ['video' => $row->id]);

        $menu .= ' <div class="hstack gap-2 flex-wrap">';
        if ($row->deleted_at == '') {
            $menu .=
                '<a href="' .
                $editurl .
                '" class="text-info fs-14 lh-1"><i
            class="fa-solid fa-pen-to-square"></i></a>';
            $menu .=
                '<a href="javascript:void(0);" data-id="' .
                $row->id .
                '" class="text-danger fs-14 lh-1 alert-confirm"><i
            class="fa-solid fa-trash"></i></a>';
        } else {
        }
        $menu .= '</div>';

        return $menu;
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

    public function MaliciousVideoAction($row)
    {
        // dd($row);
        $videoQuery = Video::find($row->video_id);
        if ($videoQuery) {
            $videoStatus = $videoQuery->status;
            if ($videoStatus === '0') {
                $isChecked = 'checked';
            } else {
                $isChecked = '';
            }
        }

        // Build the HTML for the checkbox
        $html =
            "<div class='form-check form-switch'>
                <input class='form-check-input malicious-video' type='checkbox' role='switch' data-id='" .
            $row->video_id .
            "' " .
            $isChecked .
            ">
            </div>";

        return $html;
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MaliciousVideo $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MaliciousVideo $model)
    {
        return $this->applyScopes($model->newQuery()->latest('updated_at'));
    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()->setTableId('MaliciousVideoDatatable-table')->columns($this->getColumns())->minifiedAjax()->dom('Bfrtip')->orderBy(1)->buttons(Button::make('create'), Button::make('export'), Button::make('print'), Button::make('reset'), Button::make('reload'));
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
        return 'MaliciousVideo' . date('YmdHis');
    }
}
