<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\ArchiveCategory;
use App\Models\ArchiveCategoryForm;
use App\Models\ArchiveDescription;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ArchiveCategoryController extends Controller
{
    public function index() {
        $archiveCategory = ArchiveCategory::all();
        return view('index')->with('archiveCategory', $archiveCategory);
    }

    public function create() {
        return abort(404);
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            'nama' => 'required',
            "deskripsi"    => "required|array",
            "deskripsi.*"  => "required|string|distinct",
            "keterangan" => "array",
        ]);

        $archiveCategory = new ArchiveCategory();
        $archiveCategory->name = $validateData['nama'];
        $archiveCategory->save();

        $getId = $archiveCategory->id;

        for($i = 0; $i < count($request->deskripsi); $i++) {
            $archiveCategoryForm = new ArchiveCategoryForm();
            $archiveCategoryForm->category_id = $getId;
            $archiveCategoryForm->name = $request->deskripsi[$i];
            $archiveCategoryForm->description = $request->keterangan[$i];
            $archiveCategoryForm->save();
        }

        return redirect()->route('category.index')->with('info', "Berhasil menambah kategori");
    }

    public function show(ArchiveCategory $archiveCategory) {
        $archive = Archive::all();
        $archiveCategoryForm = ArchiveCategoryForm::all();
        $archiveDescription = ArchiveDescription::all();
        return view('category.show', ['archiveCategory' => $archiveCategory])->with('archive', $archive)->with('archiveCategoryForm', $archiveCategoryForm)->with('archiveDescription', $archiveDescription);
    }

    public function edit() {
        return abort(404);
    }

    public function update() {
        return abort(404);
    }

    public function destroy($category_id) {
        $archiveCategory = ArchiveCategory::where('id', $category_id)->delete();
        $archiveCategoryForm = ArchiveCategoryForm::where('category_id', $category_id)->delete();

        $raw = Archive::where('category_id', $category_id)->get();

        for ($i=0; $i < count($raw); $i++) { 
            $getFileName = $raw[$i]->file_name;
            $getArchiveId = $raw[$i]->id;

           if(file_exists(storage_path('app/public/'.$getFileName))) {
               File::delete(storage_path('app/public/'.$getFileName));
            }

            $archiveDescription = ArchiveDescription::where('archive_id', $getArchiveId)->delete();

        }

       $archive = Archive::destroy($raw->pluck('id')->toArray());

       return redirect()->route('category.index')->with('info', "Kategori berhasil dihapus");
    }

    public function admin_index() {
        $archiveCategories = ArchiveCategory::all();
        $archives = Archive::all();
        return view('category.index')->with('archiveCategories', $archiveCategories)->with('archives', $archives);
    }

    public function admin_show(ArchiveCategory $archiveCategory) {
        $archiveCategoryForm = ArchiveCategoryForm::all();
        return view('category.detail', ['archiveCategory' => $archiveCategory])->with('archiveCategoryForm', $archiveCategoryForm);
    }

    public function admin_create() {
        $archiveCategory = ArchiveCategory::all();
        $archiveCategoryForm = ArchiveCategoryForm::all();
        return view('category.create')->with('archiveCategories', $archiveCategory)->with('archiveCategoryForms', $archiveCategoryForm);
    }

}
