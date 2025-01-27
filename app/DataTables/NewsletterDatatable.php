<?php



namespace App\DataTables;



use App\Models\Newsletter;



use Yajra\DataTables\Html\Button;

use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Html\Editor\Editor;

use Yajra\DataTables\Html\Editor\Fields;

use Yajra\DataTables\Services\DataTable;



class NewsletterDatatable extends DataTable

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

            ->addColumn('select', function ($row) {
                return ' <input type="checkbox" style="width: 27px;height: 23px;" class="form-check-input text-center" name="id[]" value="' . $row->id . '">';
            })

            ->addColumn('created_at', function ($row) {

                return  date("d-m-Y", strtotime($row->created_at));
            })

            ->rawColumns(['action', 'select']);
    }

    // public function checkrights($row)

    // {

    //     $menu = '';

    //     $editurl = route('news-letter.edit', ['news_letter' => $row->id]);



    //     $menu .= ' <div class="hstack gap-2 flex-wrap">';

    //     if ($row->deleted_at == '') {

    //         $menu .= '<a href="' . $editurl . '" class="text-info fs-14 lh-1"><i

    //         class="fa-solid fa-pen-to-square"></i></a>';

    //         $menu .= '<a href="javascript:void(0);" data-id="' . $row->id . '" class="text-danger fs-14 lh-1 alert-confirm"><i

    //         class="ri-delete-bin-5-line"></i></a>';

    //     } else {

    //     }

    //     $menu .= '</div>';





    //     return $menu;

    // }

    // public function Status($row)

    // {

    //     $status = '';

    //     $selectedValue = $row->status;

    //     $status = "

    //     <div class='form-group row'>

    //         <select class='form-control change-status' data-id='" . $row->id . "'>

    //             <option value=''> -- Select Status -- </option>

    //             <option value='0' " . ($selectedValue == 0 ? "selected" : "") . ">Inactive</option>

    //             <option value='1' " . ($selectedValue == 1 ? "selected" : "") . ">Active</option>";



    //     if ($selectedValue == 2) {

    //         $status .= "<option value='2' selected>Blocked</option>";

    //     } else {

    //         $status .= "<option value='2'>Block</option>";

    //     }

    //     $status .= "

    //         </select>

    //     </div>

    //      ";

    //     return $status;

    // }



    /**

     * Get query source of dataTable.

     *

     * @param \App\Models\Newsletter $model

     * @return \Illuminate\Database\Eloquent\Builder

     */

    public function query(Newsletter $model)

    {





        $models = $model->select();

        if (!request()->has('order')) {

            $models->orderBy('newsletter.updated_at', 'DESC');
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

    protected function filename()

    {

        return 'NewsletterController' . date('Y-m-d');
    }
}
