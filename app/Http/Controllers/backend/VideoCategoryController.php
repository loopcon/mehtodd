<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{VideoCategory, Category};
use Illuminate\Support\Facades\Validator;
use carbon\carbon;
use App\DataTables\VideoCategoryDataTable;
use Illuminate\Support\Facades\View;


class VideoCategoryController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.VideoCategory.';
        $this->title = 'Video Category';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VideoCategoryDataTable $datatable)
    {
        $return_data = [];
        $return_data['site_title'] = trans($this->title);

        $datatableInstance = $datatable;
        $additionalData = [request()->all()];
        $datatableInstance->setAdditionalData($additionalData);
        $return_data['category_list'] = Category::get();
        $return_data['category_id'] = request()->category_id;
        $sub_category_3_list = [];
        $sub_category_4_list = [];
        $return_data['sub_category_1'] = request()->sub_category_1;
        $return_data['sub_category_1_list'] = Category::where('category_id', request()->category_id)->whereNotNull('category_id')->get();
        $return_data['sub_category_2'] = request()->sub_category_2;
        $return_data['sub_category_2_list'] = VideoCategory::where('sub_category_1', request()->sub_category_1)->whereNull('sub_category_2')->get();

        $return_data['sub_category_3'] = request()->sub_category_3;
        if (request()->sub_category_2 != null) {
            $sub_category_3_list = VideoCategory::where('sub_category_2', request()->sub_category_2)->whereNull('sub_category_3')->whereNull('sub_category_4')->get();
        }
        $return_data['sub_category_3_list'] = $sub_category_3_list;



        // prx(  $return_data['sub_category_4_list']);

        return $datatable->render($this->view . 'index', $return_data);
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

        $categories = Category::where('category_id', null)->get()->pluck('name', 'id');

        return view($this->view . 'create', compact('categories', 'site_title'));
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
        $rules = [
            'category_name'  => 'required',
            'category_id'    => 'required',
            'sub_category_1' => 'required',
        ];

        // Check for uniqueness based on selected categories
        $uniqueRule = \Illuminate\Validation\Rule::unique('video_category')
            ->where('category_id', $request->input('category_id'))
            ->where('sub_category_1', $request->input('sub_category_1'));

        if ($request->filled('sub_category_2')) {
            $uniqueRule->where('sub_category_2', $request->input('sub_category_2'));
        }

        if ($request->filled('sub_category_3')) {
            $uniqueRule->where('sub_category_3', $request->input('sub_category_3'));
        }

        if ($request->filled('sub_category_4')) {
            $uniqueRule->where('sub_category_4', $request->input('sub_category_4'));
        }

        $rules['category_name'] .= '|' . $uniqueRule;

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $data = [];
        $data = $request->all();
        $dateTime = Carbon::now();
        $data['created_at'] = $dateTime;
        $data['updated_at'] = $dateTime;
        $videoCategory = VideoCategory::create($data);
        session()->flash('success', 'Video category created successfully');
        return redirect()->route('video-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resourcesub_category_1
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $return_data['site_title'] = trans($this->title);
        $return_data['videoCategoryData'] = $video = VideoCategory::find($id);
        $categories = Category::where('category_id', null)->get();
        $return_data['pluckedCategories'] = $categories->pluck('name', 'id');
        $return_data['subCategories1'] =  Category::where('id', $video->sub_category_1)->get()->pluck('name', 'id');
        $return_data['subCategories2'] =  VideoCategory::where('id', $video->sub_category_2)->get()->pluck('category_name', 'id');
        $return_data['subCategories3'] =  VideoCategory::where('id', $video->sub_category_3)->get()->pluck('category_name', 'id');
        $return_data['subCategories4'] =  VideoCategory::where('id', $video->sub_category_4)->get()->pluck('category_name', 'id');

        if (!$return_data['videoCategoryData']) {
            session()->flash('error', 'Video Category not found.');
            return redirect()->route('video-category.index');
        }

        return view($this->view . 'edit', array_merge($return_data));
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
            'category_name' => 'required|unique:video_category,category_name,' . $request->id,
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = [];
        $data = $request->all();
        $videoCategory = VideoCategory::find($id);
        unset($data['_token']);
        $dateTime = Carbon::now();
        $data['updated_at'] = $dateTime;
        $videoCategory->update($data);
        session()->flash('success', 'Video category updated successfully');
        return redirect()->route('video-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = VideoCategory::find($id);
        $category->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Video category deleted Successfully',
        ]);
    }

    public function GetSubCategoryList(Request $request)
    {
        if ($request->categoryType == 'category') {
            $id = request()->get('category_id');
            $categories = Category::where('category_id', $request->category_id)->get()->pluck('name', 'id');
        } elseif ($request->categoryType == 'sub_category') {
            $id = request()->get('category_id');
            $categories = VideoCategory::where('sub_category_1', $request->category_id)
                ->whereNotNull('category_id')
                ->whereNotNull('sub_category_1')
                ->where('sub_category_2', null)
                ->where('sub_category_3', null)
                ->where('sub_category_4', null)
                ->get()->pluck('category_name', 'id');
        } elseif ($request->categoryType == 'sub_category_2') {
            $id = request()->get('category_id');
            $categories = VideoCategory::where('sub_category_2', $request->category_id)
                ->whereNotNull('category_id')
                ->whereNotNull('sub_category_1')
                ->whereNotNull('sub_category_2')
                ->where('sub_category_3', null)
                ->where('sub_category_4', null)
                ->get()->pluck('category_name', 'id');
        } elseif ($request->categoryType == 'sub_category_3') {
            $id = request()->get('category_id');
            $categories = VideoCategory::where('sub_category_3', $request->category_id)
                ->whereNotNull('category_id')
                ->whereNotNull('sub_category_1')
                ->whereNotNull('sub_category_2')
                ->whereNotNull('sub_category_3')
                ->where('sub_category_4', null)
                ->get()->pluck('category_name', 'id');
        }
        $categoryHtml =  View::make($this->view . 'get-category', compact('categories'))->render();

        return response()->json([
            'status' => 200,
            'category_type' => $request->categoryType,
            'data' => $categoryHtml,
        ]);
    }

    public function ChangeStatusVideoCategory(Request $request)
    {
        $categoryData = VideoCategory::where('id', $request->row_id)->update(['status' => $request->value]);
        if ($categoryData) {
            session()->flash('success', 'Status updated successfully');
        } else {
            session()->flash('error', "There is some thing went, Please try after some time.");
        }
        return redirect()->route('video-category.index');
    }

    public function GetCategoryList(Request $request)
    {
        // prx($request->all());
        $container_id = $request->data_level;
        $container_net_level = $request->data_level + 1;
        $categories = VideoCategory::all();

        if ($request->data_level == 0) {
            $categories = [];
            if ($request->category_id != '') {
                $categories = Category::where('category_id', $request->category_id)->pluck('name', 'id')->all();
            }
        } else {
            $categories = $categories->where('sub_category_' . $request->data_level, $request->category_id);
            if ($request->data_level == 1) {
                $categories = $categories->whereNull('sub_category_2')->whereNull('sub_category_3')->whereNull('sub_category_4');
            } elseif ($request->data_level == 2) {
                // prx(2);
                $categories = $categories->whereNull('sub_category_3')->whereNull('sub_category_4');
            } elseif ($request->data_level == 3) {
                // prx(3);
                $categories = $categories->whereNull('sub_category_4');
            }
            // prx($request->data_level);
            $categories = $categories->pluck('category_name', 'id')->all();
        }
        // if ($request->data_level == 1) {
        //     prx([$categories]);
        // }
        $name = 'sub_category_' . $container_net_level;
        $label = 'Sub Category ' . $container_net_level;

        $html_data = View::make('backend.GetCategoryDropDown.CategoryData', compact('name', 'categories', 'label'))->render();

        return response()->json([
            'html_data' => $html_data,
        ], 200);
    }
}
