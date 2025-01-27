<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use carbon\carbon;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use App\Models\Client;
use App\DataTables\ClientDatatable;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $modual_name = '';
    public $title = '';
    public $view = '';

    public function __construct()
    {
        $this->view = '    backend.Client.';
        $this->title = 'Clients';
    }
       Public function index(ClientDatatable $datatable)
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:our_clients',
            'degination' => 'required',
            'description' => 'required',
            'photo' => 'required',

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
        
        if ($request->hasFile('photo')) {
            $filename = ImageUploadTrait::uploadImage($request->file('photo'), 'images');
            $data['photo'] = $filename;
            // prx($data['photo']);
        }

        $client = Client::create($data);

        session()->flash('success', 'Client created successfully');
        return redirect()->route('client.index');
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
        $client = Client::find($id);
        return view($this->view . 'edit', compact('site_title', 'client'));
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
            'name' => 'required|unique:our_clients,name,' . $id,
            'degination' => 'required',
            'degination' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $client = Client::find($id);
        // prx($client);
        $data = $request->all();
        unset($data['_token']);
        
        $dateTime = Carbon::now();
        $data['created_at'] = $dateTime;
        $data['updated_at'] = $dateTime;
        // prx($data);

        if ($request->hasFile('photo')) {
            // Delete the old profile video if it exists
            if ($request->has('old_photo') && Storage::disk('public')->exists('photo' . $request->old_photo)) {
                Storage::disk('public')->delete('photo' . $request->old_photo);
            }

            // prx($client->photo );

            $oldFilename = $client->photo;
            $filename = ImageUploadTrait::updateImage($oldFilename, $request->file('photo'), 'images');
            $data['photo'] = $filename;
            // prx($data['photo']);
        } else {
            unset($data['photo']);
        }

        // Update the existing record
        $client = Client::findOrFail($id);
        $client->update($data);
        // prx($client);
        session()->flash('success', 'client updated successfully');
        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return response()->json([
            'status' => 200,
            'message' => 'client deleted Successfully',
        ]);
    }



    
    public function GetClientsInformation(Request $request)
    {
        $dataId = $request->input('id');
        
        $dataId = Client::where('id',$dataId)->first();
        $description =$dataId->description;
        // prx($message);
        return response()->json(['data'=> $description ],200);    
    }
}
