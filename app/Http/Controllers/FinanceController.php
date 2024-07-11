<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use App\Models\Finance;
use Carbon\Carbon;


class FinanceController extends Controller
{
    public function index(){

      //today revenue:
      $currentDate=Carbon::now()->toDateString();
      $totalToday =Finance::whereDate('created_at',$currentDate)->sum('amount');
      $dailySubToday =Finance::whereDate('created_at',$currentDate)->where('sub_type','daily_subscription')->sum('amount');
      $memberSubToday =Finance::whereDate('created_at',$currentDate)->where('sub_type','member_subscription')->sum('amount');
      $memberSessionToday =Finance::whereDate('created_at',$currentDate)->where('sub_type','sessions')->sum('amount');
      
      //this week revenue:
      $totalWeek =Finance::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SATURDAY)->format("Y-m-d H:i:s"), Carbon::now()->week()])->sum('amount');
      $dailySubWeek =Finance::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SATURDAY)->format("Y-m-d H:i:s"), Carbon::now()])->where('sub_type','daily_subscription')->sum('amount');
      $memberSubWeek =Finance::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SATURDAY)->format("Y-m-d H:i:s"), Carbon::now()])->where('sub_type','member_subscription')->sum('amount');
      $memberSessionWeek =Finance::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SATURDAY)->format("Y-m-d H:i:s"), Carbon::now()])->where('sub_type','sessions')->sum('amount');


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
            'memberSessionToday'=>$memberSessionToday,//new
            'totalWeek'=>$totalWeek,
            'dailySubWeek'=>$dailySubWeek,
            'memberSubWeek'=>$memberSubWeek,
            'memberSessionWeek'=>$memberSessionWeek,//new
            'totalMonth'=>$totalMonth,
            'dailySubMonth'=>$dailySubMonth,
            'memberSubMonth'=>$memberSubMonth,
            'memberSessionMonth'=>$memberSessionMonth//new
        ];


        return view('admin.finance.index',compact('data'));
    }

  
    public function create(Request $request){
        $amount=$request->amount;
       
        if (! empty($amount)) {

            $request->validate([
                'amount'=>'required',
            ]);

            Finance::create([
                'amount'=>$amount,
                'sub_type'=>'daily_subscription',
                ]);  
        }

        return redirect()->back()->with('success', 'Subscription Added Successfully');
    }
}
