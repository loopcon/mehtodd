<?php

namespace App\DataTables;

use App\Models\{VideoCategory, Category};
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VideoCategoryDataTable extends DataTable
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
            ->addColumn('action', function ($row) {
                return $this->checkrights($row);
            })
            ->addColumn('status', function ($row) {
                return $this->Status($row);
            })
            ->addColumn('category', function ($row) {
                $category = '';
                // prx($row->category_id);
                $categoryData = Category::where('id', $row->category_id)->first();
                if ($row->category_id != '') {
                    if ($categoryData) {
                        $category = $categoryData->name;
                        // prx($category);
                    }
                } else {
                    $category = '-';
                }
                // prx('test');
                return $category;
            })
            ->addColumn('sub_category', function ($row) {
                $category = '';

                $categoryData = Category::where('id', $row->sub_category_1)->first();
                // prx($categoryData);
                if ($row->category_id != '') {
                    if ($categoryData) {
                        $category = $categoryData->name;
                    }
                } else {
                    $category = '-';
                }
                // prx($category);
                return $category;
            })
            ->addColumn('sub_category2', function ($row) {
                $category = '';
                $categoryData = VideoCategory::where('id', $row->sub_category_2)->first();
                if ($row->sub_category_2 != '') {
                    if ($categoryData) {
                        $category = $categoryData->category_name;
                    }
                } else {
                    $category = '-';
                }
                return $category;
            })
            ->addColumn('sub_category3', function ($row) {
                $category = '';
                $categoryData = VideoCategory::where('id', $row->sub_category_3)->first();
                if ($row->sub_category_3 != '') {
                    if ($categoryData) {
                        $category = $categoryData->category_name;
                    }
                } else {
                    $category = '-';
                }
                return $category;
            })
            ->addColumn('sub_category4', function ($row) {
                $category = '';
                $categoryData = VideoCategory::find($row->sub_category_4);
                if ($row->sub_category_4 != '' && $categoryData) {
                    if ($categoryData) {
                        $category = $categoryData->category_name;
                    }
                } else {
                    $category = '-';
                }
                return $category;
            })

            ->rawColumns(['action', 'status', 'category', 'sub_category2', 'sub_category3', 'sub_category_4']);
    }
    public function checkrights($row)
    {
        $menu = '';
        $editurl = route('video-category.edit', ['video_category' => $row->id]);

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
    public function Status($row)
    {
        $status = '';
        $selectedValue = $row->status;
        $status = "
        <div class='form-group row'>
        <select class='tbl-status-drowdown change-status' data-id='" . $row->id . "'>
        <option value=''> -- Select Status -- </option>
        <option value='0' " . ($selectedValue == 0 ? "selected" : "") . ">Inactive</option>
        <option value='1' " . ($selectedValue == 1 ? "selected" : "") . ">Active</option>";
        $status .= "
        </select>
        </div>
        ";
        return $status;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\VideoCategoryController $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(VideoCategory $model)
    {
        $query_models = VideoCategory::select();

        // prx(request()->all());
        $models = $query_models;
        if (request()->category_id != null) {
            $models = $query_models->where('category_id', request()->category_id);
        }
        if (request()->sub_category_1 != null) {
            $models = $query_models->where('category_id', request()->category_id)->where('sub_category_1', request()->sub_category_1)->whereNull('sub_category_2')->whereNull('sub_category_3');
        }
        if (request()->sub_category_2 != null) {
            $models = VideoCategory::where('category_id', request()->category_id)->where('sub_category_1', request()->sub_category_1)->where('sub_category_2', request()->sub_category_2)->whereNull('sub_category_3');
        }
        if (request()->sub_category_3 != null) {
            $models = VideoCategory::where('category_id', request()->category_id)->where('sub_category_1', request()->sub_category_1)->where('sub_category_2', request()->sub_category_2)->where('sub_category_3', request()->sub_category_3);
        }
        if (!request()->has('order')) {
            $models->orderBy('video_category.updated_at', 'DESC');
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
            ->setTableId('videocategory-table')
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
        return 'VideoCategoryController_' . date('YmdHis');
    }
}
