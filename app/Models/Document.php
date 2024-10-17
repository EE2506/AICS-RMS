<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;
    use HasFactory;

    // Only include fields that are being used in the new upload functionality
    protected $fillable = ['path', 'document', 'filetype'];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Removed listener since it's not defined or used in this context
    // protected $listeners = ['openViewModal'];
}
