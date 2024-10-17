<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_office',
        'entered_by',
        'client_no',
        'date_accomplished',
        'region',
        'province',
        'city_municipality',
        'barangay',
        'district',
        'last_name',
        'first_name',
        'middle_name',
        'extra_name',
        'sex',
        'civil_status',
        'dob',
        'age',
        'mode_of_admission',
        'type_of_assistance1',
        'amount1',
        'source_of_fund1',
        'type_of_assistance2',
        'amount2',
        'source_of_fund2',
        'type_of_assistance3',
        'amount3',
        'source_of_fund3',
        'type_of_assistance4',
        'amount4',
        'source_of_fund4',
        'client_category',
        'subcategory',
        'through',
    ];

    protected $dates = ['dob', 'date_accomplished'];
}
