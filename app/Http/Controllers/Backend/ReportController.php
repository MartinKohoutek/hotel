<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function BookingReport() {
        return view('backend.report.booking_report');
    }

    public function SearchByDate() {
        
    }
}
