<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\UserDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use carbon\carbon;
use Illuminate\Http\Request;
use App\DataTables\BadgeDatatable;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class BadgeController extends Controller
{
    public $modual_name = "";
    public $title = "";
    public $view = "";

    public function __construct()
    {
        $this->view = 'backend.Badge.';
        $this->title = ' Badge ';
    }


    public function index(BadgeDatatable $datatable)
    {
        $return_data = [];
        $return_data['site_title'] = trans($this->title);
        return $datatable->render($this->view . 'index', array_merge($return_data));
    }


    public function ChangeStatusBadge(Request $request)
    {
        $user = User::where('id', $request->row_id)->update(['apply_base' => $request->value]);

        if ($user) {
            session()->flash('success', 'Status updated successfully');
        } else {
            session()->flash('error', 'There is something wrong. Please try again later.');
        }

        return redirect()->route('badge.index');
    }





    public function DownloadDocument(Request $request)
    {
        $userId = $request->input('userId');
        $files = UserDocument::where('user_id', $userId)->get();

        if (count($files) > 0) {
            $zipname = 'file.zip';
            $zipFilePath = sys_get_temp_dir() . '/' . $zipname; // Create ZIP file in temporary directory
            $zip = new ZipArchive;
            $zip->open($zipFilePath, ZipArchive::CREATE);

            foreach ($files as $document) {
                $documentPath = public_path('uploads/userdocuments/' . $document->document_name);
                if (file_exists($documentPath)) {
                    $zip->addFile($documentPath, $document->document_name);
                } else {
                    // Handle the case where the document file does not exist
                    info('Document file not found: ' . $documentPath);
                }
            }
            $zip->close();

            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return redirect()->back()->with('error', 'No documents available.');
        }
    }

}
