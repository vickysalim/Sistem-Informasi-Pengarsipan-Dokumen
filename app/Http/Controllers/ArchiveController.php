<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\ArchiveCategory;
use App\Models\ArchiveCategoryForm;
use App\Models\ArchiveDescription;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 

class ArchiveController extends Controller
{
    public function index() {
        $archives = Archive::all();
        return view('archive.index')->with('archives', $archives);
    }

    public function create() {
        $archiveCategory = ArchiveCategory::all();
        $archiveCategoryForm = ArchiveCategoryForm::all();
        return view('archive.create')->with('archiveCategories', $archiveCategory)->with('archiveCategoryForms', $archiveCategoryForm);
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            'kategori'  => 'required',
            'nama' => 'required',
            'arsip' => 'required|file'
        ]);

        $ext = $request->arsip->getClientOriginalExtension();
        $random = Str::random(16);
        $nama_file_baru = "arsip-" . time() . "-" . $random . "." . $ext;
        
        $request->arsip->storeAs('public', $nama_file_baru);

        $archive = new Archive();
        $archive->name = $validateData['nama'];
        $archive->category_id = $validateData['kategori'];
        $archive->file_name = $nama_file_baru;

        $archive->save();

        $getId = $archive->id;
        
        $field = $request->input('inputDescription'.$validateData['kategori']);

        $getCategoryData = ArchiveCategoryForm::select("id")->where("category_id", $archive->category_id)->first();

        $arr = [];
        
        for($i = $getCategoryData->id; $i < $getCategoryData->id+count($field); $i++) {
            $archiveDescription = new ArchiveDescription();
            $archiveDescription->archive_id = $getId;
            $archiveDescription->archive_form_id = $i;
            $archiveDescription->description = $field[$i-$getCategoryData->id];
            $archiveDescription->save();
        }

        return redirect()->route('archive.index');
    }

    public function show() {
        return abort(404);
    }

    public function edit() {

    }

    public function update() {

    }

    public function destroy($archive_id) {
        $getFileName = Archive::select('file_name')->where('id', $archive_id)->first();
        
        if(file_exists(storage_path('app/public/'.$getFileName->file_name))) {
            File::delete(storage_path('app/public/'. $getFileName->file_name));
        }
        
        $archive = Archive::where('id', $archive_id)->delete();
        $archiveDescription = ArchiveDescription::where('archive_id', $archive_id)->delete();

        return redirect()->route('archive.index')->with('info', "Arsip berhasil dihapus");
    }

    public function download($archive_id) {
        $getFileName = Archive::select('file_name')->where('id', $archive_id)->first();

        if(file_exists(storage_path('app/public/'. $getFileName->file_name))) {
            return response()->download(storage_path('app/public/'. $getFileName->file_name));
        } else {
            return redirect('archive');
        }
    }
}
