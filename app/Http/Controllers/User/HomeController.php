<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $timeSlots = [];

        $startTime = Carbon::createFromTime(0, 0, 0);
        $endTime = Carbon::createFromTime(23, 59, 0);
        // Loop through the time slots with 2-hour intervals
        while ($startTime < $endTime) {
            // Format the time slot range
            $slotRange = $startTime->format('h:i A') . ' - ' . $startTime->addHours(2)->format('h:i A');
            $timeSlots[] = $slotRange;
        }

        return view('user.home', compact('timeSlots'));
    }
    
}
