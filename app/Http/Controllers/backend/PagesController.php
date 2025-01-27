<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use carbon\carbon;
use App\DataTables\PagesDatatable;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.page.';
        $this->title = 'Pages';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PagesDatatable $datatable)
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
        $return_data = [];
        $site_title = trans($this->title);
        return view($this->view . 'create', compact('site_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // prx($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:pages,title',
            // 'slug' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $slug_data = ['title' => $request->title];
        $fullSlug = GetSlugData($slug_data);

        // $data = $request->all();
        $data = [
            'title' => request()->title,
            'slug' => $fullSlug,
            'description' => request()->description,
        ];
        // prx($data);
        unset($data['_token']);

        $dateTime = Carbon::now();
        $data['created_at'] = $dateTime;
        $data['updated_at'] = $dateTime;

        $page = Page::create($data);
        // prx($page);
        session()->flash('success', 'Pages  created successfully');
        return redirect()->route('page.index');
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
        $return_data = [];
        $site_title = trans($this->title);
        $page = Page::find($id);

        // prx($page);
        return view($this->view . 'edit', compact('site_title', 'page'));
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
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                // 'slug' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $page = Page::find($id);
// prx($page);
            $slug_data = ['title' => $request->title];

            $data = [
                'title' => request()->title,
                'description' => request()->description,
            ];
// prx($data);
            // if ($request->title != $page->title) {
            //     $data['slug']   = GetSlugData($slug_data);
            // }
            // prx($data);
            unset($data['_token']);

            $dateTime = Carbon::now();

            $data['updated_at'] = $dateTime;

            $page->update($data);
            // prx($page);
            session()->flash('success', 'Page Update successfully');
            return redirect()->route('page.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $page = Page::find($id);
    $page->delete();
    return response()->json([
        'status' => 200,
        'message' => 'pages  Deleted Successfully',
    ]);
}
}




