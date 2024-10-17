<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recycle extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['filetype', 'path', 'document', 'deleted_at', 'created_at','updated_at',];
}


