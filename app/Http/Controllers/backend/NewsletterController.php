<?php



namespace App\Http\Controllers\backend;



use App\Http\Controllers\Controller;



use Illuminate\Http\Request;

use App\Models\Newsletter;

use App\DataTables\NewsletterDatatable;



class NewsletterController extends Controller

{

    public $modual_name = "";

    public $title = "";

    public $view = "";



    public function __construct()

    {

        $this->view = 'backend.NewsLetter.';

        $this->title = 'News Letter';
    }





    public function index(NewsletterDatatable $datatable)

    {

        $return_data = [];

        $return_data['site_title'] = trans($this->title);

        return $datatable->render($this->view . 'index', array_merge($return_data));
    }

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        //

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        //

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        //

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        //

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {
    }

    public function Delete(Request $request)
    {
        try {
            $ids = $request->ids;
            $type = $request->type;

            if ($type == 1) {
                foreach ($ids as $id) {
                    $record = Newsletter::find($id);
                    if ($record) {
                        $record->delete();
                    }
                }
            } else {
                Newsletter::truncate(); // This deletes all records from the table
            }

            return response()->json(['message' => 'data deleted successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); // Handle and return error message
        }
    }
}
