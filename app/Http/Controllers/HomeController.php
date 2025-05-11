<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        // Query untuk mendapatkan jumlah tamu unik berdasarkan email
        $uniqueGuests = Guest::select('email')
            ->distinct()
            ->count('email');
        // query tamu kunjungan bulan ini
        $currentMonth = date('m');
        $currentYear = date('Y');
        $guestsThisMonth = Guest::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        // query tamu kunjungan hari ini
        $todayGuests = Guest::whereDate('created_at', now())->count();
        // query tamu kunjugan bulan lalu
        $lastMonthGuests = Guest::whereMonth('created_at', $currentMonth - 1)
            ->whereYear('created_at', $currentYear)
            ->count();
        return view('admin.home.index', compact('uniqueGuests', 'guestsThisMonth', 'todayGuests', 'lastMonthGuests'));
    }
}
