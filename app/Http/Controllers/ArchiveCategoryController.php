<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\ArchiveCategory;
use App\Models\ArchiveCategoryForm;
use App\Models\ArchiveDescription;
use App\Models\UserPrivilege;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ArchiveCategoryController extends Controller
{
    public function index() {
        $archiveCategory = ArchiveCategory::all();
        $userPrivilege = UserPrivilege::all();
        $archive = Archive::all();
        return view('index')->with('archiveCategory', $archiveCategory)->with('archive', $archive)->with('userPrivilege', $userPrivilege);
    }

    public function create() {
        return abort(404);
    }

    public function store(Request $request) {
        if(Auth::user()->superadmin == 1) {
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
        } else {
            return abort(403);
        }
    }

    public function show(ArchiveCategory $archiveCategory) {
        $archive = Archive::all();
        $archiveCategoryForm = ArchiveCategoryForm::all();
        $archiveDescription = ArchiveDescription::all();

        $userPrivilege = UserPrivilege::where('user_id', Auth::user()->id)->where('category_id', $archiveCategory->id)->where('read', 1)->first();

        if($userPrivilege != null || Auth::user()->superadmin == 1) {
            return view('category.show', ['archiveCategory' => $archiveCategory])->with('archive', $archive)->with('archiveCategoryForm', $archiveCategoryForm)->with('archiveDescription', $archiveDescription)->with('userPrivilege', $userPrivilege);
        } else {
            return abort(403);
        }
    }

    public function edit() {
        return abort(404);
    }

    public function update() {
        return abort(404);
    }

    public function destroy($category_id) {
        if(Auth::user()->superadmin == 1) {
            $archiveCategory = ArchiveCategory::where('id', $category_id)->delete();
            $archiveCategoryForm = ArchiveCategoryForm::where('category_id', $category_id)->delete();
            $userPrivilege = UserPrivilege::where('category_id', $category_id)->delete();

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
        } else {
            return abort(403);
        }
    }

    public function admin_index() {
        if(Auth::user()->superadmin == 1) {
            $archiveCategories = ArchiveCategory::all();
            $archives = Archive::all();
            return view('category.index')->with('archiveCategories', $archiveCategories)->with('archives', $archives);
        } else {
            return abort(403);
        }
    }

    public function admin_show(ArchiveCategory $archiveCategory) {
        if(Auth::user()->superadmin == 1) {
            $archiveCategoryForm = ArchiveCategoryForm::all();
            return view('category.detail', ['archiveCategory' => $archiveCategory])->with('archiveCategoryForm', $archiveCategoryForm);
        } else {
            return abort(403);
        }
    }

    public function admin_create() {
        if(Auth::user()->superadmin == 1) {
            $archiveCategory = ArchiveCategory::all();
            $archiveCategoryForm = ArchiveCategoryForm::all();
            return view('category.create')->with('archiveCategories', $archiveCategory)->with('archiveCategoryForms', $archiveCategoryForm);
        } else {
            return abort(403);
        }
    }

}
