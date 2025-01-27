<?php

namespace App\DataTables;

use App\Models\Category;
use App\Models\Video;
use App\Models\User;
use App\Models\UserVideoCategory;
use App\Models\VideoCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VideoDatatable extends DataTable
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
            // ->addColumn('action', function ($row) {
            //     return $this->checkrights($row);
            // })
            ->addColumn('status', function ($row) {
                return $this->Status($row);
            })
            ->addColumn('fullname', function ($row) {
                return isset($row->user) ? $row->user->fullname : '-';
            })
            ->addColumn('share_home_page', function ($row) {
                return $this->shareHomePage($row);
            })
            ->addColumn('profile_video', function ($row) {
                $profileVideo = isset($row->user) ? asset($row->user->profile_video) : '';
                // prx($profileVideo);
                $category = isset($row->category) ? $row->category->name : '-';
                $category_list = UserVideoCategory::where('video_id', $row->id)->get();
                $videoCategoryIds = $category_list->pluck('category_id')->toArray();
                $categoriesNames = Category::whereIn('id', $videoCategoryIds)->pluck('name')->toArray();
                $videoCategoriesNames = VideoCategory::whereIn('id', $videoCategoryIds)->pluck('category_name')->toArray();
                $combinedCategoryNames = array_merge($categoriesNames, $videoCategoriesNames);
                $uniqueCategoryNames = array_unique($combinedCategoryNames);
                $commaSeparatedNames = implode(', ', $uniqueCategoryNames);

                $user_query = User::where('id', $row->user_id)->first();
                if ($user_query) {
                    $user_name = $user_query->displayname;
                } else {
                    $user_name = '';
                }

                // prx($combinedCategoryNames);
                // You can customize the HTML or link structure as needed
                // $button = '<a href="#" class="alert-modal btn_readmore-' . $row->id . '" data-toggle="modal" data-target="#myModal" data-id="' . $row->id . '" data-src="' . $profileVideo . '" data-category="' . $category . '" style="color: #007bff;">View Video</a>';
                $button = '<a href="#" class="alert-modal btn_readmore-' . $row->id . '" data-toggle="modal" data-target="#myModal" data-id="' . $row->id . '" data-username="' .$user_name . '"  data-src="' . asset('uploads/videos/' . $row->video) . '" data-category="' . $commaSeparatedNames . '" style="color: #007bff;">View Video</a>';
                return $button;
            })
            ->addColumn('category_name', function ($row) {
                $category = isset($row->category) ? $row->category->name : '-';
                return $category;
            })
            ->rawColumns(['status', 'profile_video', 'fullname', 'category_name', 'share_home_page']);
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

    public function shareHomePage($row)
    {
        $checked = $row->share_home_page == 1 ? 'checked' : '';

        $html =
            "<div class='form-check form-switch'>
                <input class='form-check-input is-home-switch' type='checkbox' role='switch' data-id=" .
            $row->id .
            ' ' .
            $checked .
            ">
            </div>";
        return $html;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Video $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Video $model)
    {
        $models = $model->select()->with(['user', 'category']);
        if (request()->has('category_id')) {
            $models = $models->where('category_id', request()->category_id);
        }

        if (!request()->has('order')) {
            $models->orderBy('videos.updated_at', 'DESC');
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
        return $this->builder()->setTableId('VideoDatatable-table')->columns($this->getColumns())->minifiedAjax()->dom('Bfrtip')->orderBy(1)->buttons(Button::make('create'), Button::make('export'), Button::make('print'), Button::make('reset'), Button::make('reload'));
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
        return 'Video' . date('YmdHis');
    }
}
