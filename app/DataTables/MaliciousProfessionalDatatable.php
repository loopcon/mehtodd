<?php

namespace App\DataTables;

use App\Models\Category;
use App\Models\Video;
use App\Models\MaliciousVideo;
use App\Models\MaliciousProfile;
use App\Models\User;
use App\Models\UserVideoCategory;
use App\Models\VideoCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;


class MaliciousProfessionalDatatable extends DataTable
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
                return User::find($row->user_id)->fullname;
            })

            ->addColumn('report_by', function ($row) {
                $reportBy = User::find($row->report_by);
                return $reportBy ? $reportBy->fullname : 'N/A';
            })

            ->addColumn('note', function ($row) {
                $user = User::find($row->user_id);
                if ($user && $user->note) {
                    $limitedNote = Str::limit($user->note, 10);
                    $button = ' <a href="#" class="alert-confirm-two btn_readmore-' . $row->id . '" data-toggle="modal" data-target="#myModal" data-id="' . $row->id . '" style="color: #007bff;">... Read More </a>';
                    return $limitedNote . $button;
                }
                return 'N/A';
            })

            ->addColumn('status', function ($row) {
                return $this->Status($row);
            })

            ->addColumn('descriptions', function ($row) {
                $desdata = MaliciousProfile::find($row->id);
                $data = $desdata->descriptions;
                $limitedDescription = Str::limit($data, 10);
                $button = ' <a href="#" class="alert-confirm btn_readmore-' . $row->id . '" data-toggle="modal" data-target="#myModal" data-id="' . $row->id . '" style="color: #007bff;">... Read More </a>';
                return $limitedDescription . $button;
            })

            ->filterColumn('fullname', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('fullname', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('report_by', function ($query, $keyword) {
                $query->whereHas('reporter', function ($q) use ($keyword) {
                    $q->where('fullname', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('note', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('note', 'like', "%{$keyword}%");
                });
            })

            ->rawColumns(['fullname', 'report_by', 'status', 'descriptions', 'note']);
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
        $getData = User::find($row->user_id);

        // dd($getData);
        $status = '';
        $selectedValue = $getData->status;
        $status = "
        <div class='form-group row'>
        <select class='tbl-status-drowdown change-status' data-id='" . $row->user_id . "'>
        <option value=''> -- Select Status -- </option>
        <option value='0' " . ($selectedValue == 0 ? "selected" : "") . ">Active</option>
        <option value='1' " . ($selectedValue == 1 ? "selected" : "") . ">Inactive</option>
        <option value='2' " . ($selectedValue == 2 ? "selected" : "") . ">Block</option>";
        $status .= "
        </select>
        </div>
        ";
        return $status;
    }

    public function MaliciousProfessionalAction($row)
    {
        // dd($row);
        $profileQuery = User::find($row->user_id);
        if ($profileQuery) {
            $profileStatus = $profileQuery->status;
            if ($profileStatus === '0') {
                $isChecked = 'checked';
            } else {
                $isChecked = '';
            }
        }

        // Build the HTML for the checkbox
        $html =
            "<div class='form-check form-switch'>
                <input class='form-check-input malicious-video' type='checkbox' role='switch' data-id='" .
            $row->user_id .
            "' " .
            $isChecked .
            ">
            </div>";

        return $html;
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MaliciousProfile $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MaliciousProfile $model)
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
        return $this->builder()->setTableId('MaliciousProfessionalDatatable-table')->columns($this->getColumns())->minifiedAjax()->dom('Bfrtip')->orderBy(1)->buttons(Button::make('create'), Button::make('export'), Button::make('print'), Button::make('reset'), Button::make('reload'));
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
        return 'MaliciousProfile' . date('YmdHis');
    }
}
