<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\ArchiveCategory;
use App\Models\ArchiveCategoryForm;
use App\Models\ArchiveDescription;

use Illuminate\Http\Request;

class ArchiveCategoryController extends Controller
{
    public function index() {
        $archiveCategory = ArchiveCategory::all();
        return view('archive.index')->with('archive_categories', $archiveCategory);
    }

    public function create() {

    }

    public function store() {

    }

    public function show(ArchiveCategory $archiveCategory) {
        $archive = Archive::all();
        $archiveCategoryForm = ArchiveCategoryForm::all();
        $archiveDescription = ArchiveDescription::all();
        return view('category.show', ['archiveCategory' => $archiveCategory])->with('archive', $archive)->with('archiveCategoryForm', $archiveCategoryForm)->with('archiveDescription', $archiveDescription);
    }

    public function edit() {

    }

    public function update() {

    }

    public function destroy() {

    }
}
