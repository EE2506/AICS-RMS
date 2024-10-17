<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardReportExports extends Model
{
    use HasFactory;

    protected $fillable = ['image_path', 'pdf_path', 'title'];
}
