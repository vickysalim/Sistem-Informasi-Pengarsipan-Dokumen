<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    function getFile($filename){
        if(file_exists(storage_path('app/public/'. $filename))) {
            return response()->download(storage_path('app/public/'. $filename));
        } else {
            return redirect('archive');
        }
        
    }
}
