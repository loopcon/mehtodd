<?php


namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Difficulty;
use App\Models\Category;
use carbon\carbon;
use App\DataTables\DifficultyDatatable;
use Illuminate\Validation\Rule;


class DifficultyController extends Controller
{

    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.Difficulty.';
        $this->title = 'Difficulty';
    }



    public function index(DifficultyDatatable $datatable)
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
            'name' => 'required|unique:difficulties',
            // 'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();
        // prx($data);
        unset($data['_token']);

        $dateTime = Carbon::now();
        $data['created_at'] = $dateTime;
        $data['updated_at'] = $dateTime;


        $difficulty = Difficulty::create($data);
        // prx($difficulty);
        session()->flash('success', 'Difficulty created successfully');
        return redirect()->route('difficulty.index');
    }


    public function edit($id)
    {
        $return_data = [];
        $site_title = trans($this->title);
        $difficulty = Difficulty::find($id);
        $categories = Category::where('category_id', null)->pluck('name', 'id');
        return view($this->view . 'edit', compact('site_title', 'difficulty', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('difficulties')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->input('category_id'));
                })->ignore($id, 'id'),
            ],
            // 'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $difficulty = Difficulty::find($id);
        $data = $request->all();
        unset($data['_token']);

        $dateTime = Carbon::now();
        $data['created_at'] = $dateTime;
        $data['updated_at'] = $dateTime;

        $difficulty->update($data);
        // prx($difficulty);
        session()->flash('success', 'Difficulty Update successfully');
        return redirect()->route('difficulty.index');
    }

    public function destroy(Difficulty $difficulty)
    {
        $difficulty->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Difficulty deleted successfully',
        ]);
    }
}
