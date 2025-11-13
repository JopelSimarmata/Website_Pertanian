<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitRequestController extends Controller
{
    //
    public function index()
    {
        return view('visit_requests.index');
    }
}
