<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $fillable = [
        'location',
        'file',
        'administrative',
        'doc',
    ];
}
