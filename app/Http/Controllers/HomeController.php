<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request; 
use App\Models\Finance;
use App\Models\Expense;
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
    public function index()
    {
        $query = Member::all();
        $total = count($query);
        $totalPayment = Member::sum('payment'); 
        $totalCost=Finance::sum('amount');
        $totalExpense=Expense::sum('amount');
        

 
         //today revenue:
      $currentDate=Carbon::now()->toDateString();
      $totalToday =Finance::whereDate('created_at',$currentDate)->sum('amount');
      $dailySubToday =Finance::whereDate('created_at',$currentDate)->where('sub_type','daily_subscription')->sum('amount');
      $memberSubToday =Finance::whereDate('created_at',$currentDate)->where('sub_type','member_subscription')->sum('amount');
      $membersessionToday =Finance::whereDate('created_at',$currentDate)->where('sub_type','sessions')->sum('amount');

      //this month:   
      $totalMonth =Finance::whereMonth('created_at',Carbon::now()->month)->sum('amount');
      $dailySubMonth =Finance::whereMonth('created_at',Carbon::now()->month)->where('sub_type','daily_subscription')->sum('amount');
      $memberSubMonth =Finance::whereMonth('created_at',Carbon::now()->month)->where('sub_type','member_subscription')->sum('amount');
      $memberSessionMonth =Finance::whereMonth('created_at',Carbon::now()->month)->where('sub_type','sessions')->sum('amount');


      $data=
        [
            'totalToday'=>$totalToday,
            'dailySubToday'=>$dailySubToday,
            'memberSubToday'=>$memberSubToday,
            'sessions'=>$membersessionToday,
            'totalMonth'=>$totalMonth,
            'dailySubMonth'=>$dailySubMonth,
            'memberSubMonth'=>$memberSubMonth,
            'memberSessionMonth'=>$memberSessionMonth,
        ];

        return view('home', compact('data','total', 'totalPayment','totalCost','totalExpense'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function join_us()
    {
        return view('pages.join_us');
    }

    public function checkSerialNum(){
        
        //getting the current serial
        $serialNum=env('SUBSCRIPTION_SERIAL_NUM');
    
    }
}
