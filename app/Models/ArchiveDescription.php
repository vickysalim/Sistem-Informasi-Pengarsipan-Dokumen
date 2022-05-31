<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveDescription extends Model
{
    use HasFactory;

    public function archive(){
        return $this->belongsTo('App\Models\Archive');
    }
}
