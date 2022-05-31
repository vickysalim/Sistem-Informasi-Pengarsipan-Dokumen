<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveCategoryForm extends Model
{
    use HasFactory;

    public function archiveCategory(){
        return $this->belongsTo('App\Models\ArchiveCategory');
    }
}
