<?php

namespace App\Http\Controllers;

use App\Models\ArchiveCategory;

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

    public function show() {

    }

    public function edit() {

    }

    public function update() {

    }

    public function destroy() {

    }
}
