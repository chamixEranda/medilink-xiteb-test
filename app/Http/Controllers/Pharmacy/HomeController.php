<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prescription;
use App\Models\Quotation;

class HomeController extends Controller
{
    public function index()
    {
        $lims_user_count = User::count();// all users count
        $lims_prescription_count = Prescription::count(); //total prespription count
        $lims_confirm_count = Quotation::where('status', 'confirm')->count(); // total confirm quotation count
        $lims_reject_count = Quotation::where('status', 'reject')->count();// total rejected quotation count

        $latest_quotations = Quotation::orderBy('created_at', 'desc')->take(10)->get(); // latest quotations

        return view('pharmacy.dashboard',compact('lims_user_count','lims_prescription_count','lims_confirm_count','lims_reject_count','latest_quotations'));
    }
}
