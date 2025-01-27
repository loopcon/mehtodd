<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\UserSlider;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDatatable extends DataTable
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
            ->addColumn('categoryid', function ($row) {
                $category_id = $row->user_category_id;


                if ($category_id === 1) {
                    $category_id = 'sports';
                } elseif ($category_id === 2) {
                    $category_id = 'Kinésithérapie';
                } else {
                    $category_id = '-';
                }


                return $category_id;
            })
            ->addColumn('action', function ($row) {
                return $this->checkrights($row);
            })
            ->addColumn('mobile_number ', function ($row) {
                return $row->mobile_number;
            })
            ->addColumn('is_top', function ($row) {
                $is_top = $row->is_top;

                if ($is_top == 1) {
                    $is_top = 'yes';
                } else {
                    $is_top = '-';
                }
                return $is_top;
            })

            ->addColumn('profile_video', function ($row) {
                $count = $row->userSlider()->count();
                if ($count != 0) {

                    return '<a href="#" class="alert-modal btn_readmore-' . $row->id . '" data-toggle="modal" data-target="#myModal" data-src="' . asset('uploads/profilemedia/' . $row->profile_video) . '" data-id="' .  $row->id . '" style="color: #007bff;">View Video</a>';
                }
            })

            ->addColumn('status', function ($row) {
                return $this->Status($row);
            })
            // ->addColumn('professionalname', function ($row) {
            //     $name = '';
            //     if ($row->first_name && $row->last_name) {
            //         $name = $row->first_name . ' ' . $row->last_name;
            //     } else {
            //         $name = '-';
            //     }
            //     return $name;
            // })

            ->rawColumns(['categoryId', 'action', 'status', 'usertype', 'profile_video', 'professionalname']);
    }
    public function checkrights($row)
    {
        $menu = '';
        $editurl = route('user.edit', ['user' => $row->id]);

        $menu .= ' <div class="hstack gap-2 flex-wrap">';
        if ($row->deleted_at == '') {
            $menu .= '<a href="' . $editurl . '" class="text-info fs-14 lh-1"><i
            class="ri-edit-line"></i></a>';
            $menu .= '<a href="javascript:void(0);" data-id="' . $row->id . '" class="text-danger fs-14 lh-1 alert-confirm"><i
            class="ri-delete-bin-5-line"></i></a>';
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
        <option value='0' " . ($selectedValue == 0 ? "selected" : "") . ">Active</option>
        <option value='1' " . ($selectedValue == 1 ? "selected" : "") . ">Inactive</option>";
        $status .= "
        </select>
        </div>
        ";
        return $status;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ManageUser $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    // public function query(User $model)
    // {
    //     $models = User::select();
    //     if (!request()->has('order')) {
    //         $models->orderBy('users.updated_at', 'DESC');
    //     }

    //     return $this->applyScopes($models);
    // }
    public function query(User $model)
    {
        $role_id = $this->additionalData['role_id'] ?? 2;
        $models = User::select();
        $models->where('role_id', $role_id);
        if (!request()->has('order')) {
            $models->orderBy('users.updated_at', 'DESC');
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
            ->setTableId('Manageuserdatatable-table')
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
        return 'ManageUser_' . date('YmdHis');
    }
}
