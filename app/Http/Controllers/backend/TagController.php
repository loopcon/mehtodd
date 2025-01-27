<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Tag;
use carbon\carbon;
use App\DataTables\TagDatatable;
use App\Models\Category;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.Tag.';
        $this->title = 'Tags';
    }


    public function index(TagDatatable $datatable)
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
        $tag = Tag::create($data);
        // prx($tag);
        session()->flash('success', 'Tag created successfully');
        return redirect()->route('tag.index');
    }


    public function edit($id)
    {
        $return_data = [];
        $site_title = trans($this->title);
        $tag = Tag::find($id);
        $categories = Category::where('category_id', null)->pluck('name', 'id');
        return view($this->view . 'edit', compact('site_title', 'tag', 'categories'));
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
        $tag = Tag::find($id);
        $data = $request->all();
        unset($data['_token']);
        $dateTime = Carbon::now();
        $data['created_at'] = $dateTime;
        $data['updated_at'] = $dateTime;
        $tag->update($data);
        // prx($tag);
        session()->flash('success', 'Tag created successfully');
        return redirect()->route('tag.index');
    }


    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Tag deleted successfully',
        ]);
    }
}
