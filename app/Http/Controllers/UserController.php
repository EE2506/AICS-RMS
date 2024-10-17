<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showBeneficiaryTable()
    {
        return view('beneficiary-table'); // Ensure this matches the path to your Blade view
    }
}
