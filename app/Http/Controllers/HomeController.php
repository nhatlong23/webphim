<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

use Carbon\Carbon;


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
    public function index(Request $request)
    {
        $visitors = Visitor::all();
        //dau thang truoc
        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        //cuoi thang truoc
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        //dau thang nay
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        //1 nam
        $one_year = Carbon::now('Asia/Ho_Chi_Minh')->subDays(360)->toDateString();
        //bay gio
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();


        //total last month
        $visitor_of_last_month = Visitor::whereBetween('date_visitor', [$early_last_month, $end_of_last_month])->get();
        $visitor_last_month_count = $visitor_of_last_month->count();
        //total this month
        $visitor_of_this_month = Visitor::whereBetween('date_visitor', [$early_this_month, $now])->get();
        $visitor_this_month_count = $visitor_of_this_month->count();
        //total in one year
        $visitor_this_year = Visitor::whereBetween('date_visitor', [$one_year, $now])->get();
        $visitor_this_year_count = $visitor_this_year->count();

        $visitor_count = $visitors->count('ip_address');
        $visitor_total = $visitors->count();

        return view('layouts/home', compact(
            'visitors',
            'visitor_count',
            'visitor_total',
            'visitor_last_month_count',
            'visitor_this_month_count',
            'visitor_this_year_count'
        ));
    }
}
