<?php


namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Sport;
use carbon\carbon;
use App\DataTables\SportsDatatable;
use App\Http\Controllers\FrontendController;
use App\Models\Category;
use Illuminate\Validation\Rule;

class SportsController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.Sports.';
        $this->title = 'Sports';
    }

    public function index(SportsDatatable $datatable)
    {
        $return_data = [];
        $return_data['site_title'] = trans($this->title);
        return $datatable->render($this->view . 'index', array_merge($return_data));
    }

    public function create()
    {
        $categories = Category::where('category_id', null)->pluck('name', 'id');
        return view($this->view . 'create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tag,name,NULL,id,category_id,' . $request->input('category_id'),
            'category_id' => 'required',


        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();
        unset($data['_token']);

        $dateTime = Carbon::now();
        $data['created_at'] = $dateTime;
        $data['updated_at'] = $dateTime;
        $sport = Sport::create($data);
        // prx($sport);
        session()->flash('success', 'Sport created successfully');
        return redirect()->route('sports.index');
    }


    public function edit($id)
    {
        $return_data = [];
        $site_title = trans($this->title);
        $sport = Sport::find($id);
        $categories = Category::where('category_id', null)->pluck('name', 'id');
        return view($this->view . 'edit', compact('site_title', 'sport', 'categories'));
    }


    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('tag')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->input('category_id'));
                })->ignore($id, 'id'),
            ],
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $sport = Sport::find($id);
        $data = $request->all();
        // prx($data);
        unset($data['_token']);
        $dateTime = Carbon::now();
        $data['created_at'] = $dateTime;
        $data['updated_at'] = $dateTime;
        $sport->update($data);
        // prx($tag);
        session()->flash('success', 'Sport created successfully');
        return redirect()->route('sports.index');
    }


    public function destroy(Sport $sport)
    {
        $sport->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Sports deleted successfully',
        ]);
    }
}
