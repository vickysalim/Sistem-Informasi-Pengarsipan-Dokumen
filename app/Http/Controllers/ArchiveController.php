<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\ArchiveCategory;
use App\Models\ArchiveCategoryForm;
use App\Models\ArchiveDescription;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        //$id = $archive->id();

        //$archiveDescription = new ArchiveDescription();
        //$archiveDescription->archive_id = $id;
        //$archiveDescription->archive_form_id = $validateData['nama'];
        //$archiveDescription->description = $validateData['nama'];

        return redirect()->route('archive.index');
    }

    public function show() {

    }

    public function edit() {

    }

    public function update() {

    }

    public function destroy() {

    }
}
