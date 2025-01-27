<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\DataTables\CategoryDatatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

// Baaki controller code


class CategoryController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.Category.';
        $this->title = 'Catagories';
    }

    public function Index(CategoryDatatable $datatable)
    {
        $return_data = [];
        $return_data['site_title'] = trans($this->title);

        return $datatable->render($this->view . 'category', array_merge($return_data));
    }

    public function Create()
    {
        $return_data = [];
        $return_data['site_title'] = trans($this->title);
        $categories = Category::where('category_id', null)->get();
        $return_data['pluckedCategories'] = $categories->pluck('name', 'id');
        return view($this->view . 'create', array_merge($return_data));
    }

    public function Store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories',
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

        $category = Category::create($data);
        session()->flash('success', 'Category created successfully');
        return redirect()->route('list.category');
    }

    public function Edit($id)
    {
        $return_data = [];
        $return_data['site_title'] = trans($this->title);
        $return_data['categoryData'] = Category::find($id);
        $categories = Category::where('category_id', null)->get();
        $return_data['pluckedCategories'] = $categories->pluck('name', 'id');
        if (!$return_data['categoryData']) {
            session()->flash('error', 'Category not found.');
            return redirect()->route('list.category');
        }

        return view($this->view . 'edit', array_merge($return_data));
    }

    public function Update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,' . $request->id,
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();
        $form = Category::find($id);
        unset($data['_token']);
        $dateTime = Carbon::now();
        $data['updated_at'] = $dateTime;

        $form->update($data);
        session()->flash('success', 'Category updated successfully');
        return redirect()->route('list.category');
    }

    public function Delete(Request $request)
    {
        $category = Category::find($request->id);
        $category->delete();
        return response()->json([
            'message' => 'Category deleted Successfully',
        ], 200);
    }

    public function ChageStatusCategory(Request $request)
    {

        $categoryData = Category::where('id', $request->row_id)->update(['status' => $request->value]);

        if ($categoryData) {
            session()->flash('success', 'Status updated successfully');
        } else {
            session()->flash('error', "There is some thing went, Please try after some time.");
        }
        return redirect()->route('list.category');
    }

}
