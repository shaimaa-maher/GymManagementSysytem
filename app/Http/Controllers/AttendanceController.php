<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Trainer;
use Carbon\Carbon;



class AttendanceController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth');
    }
     
    public function index(Request $request )
    {
                            
        $query=Attendance::where('created_at','!=',null);
        
        //filter attendance
        if (! empty($request->start) && ! empty($request->start)  ) {
             $start=$request->start;
             $end=$request->end;

             if ($start == $end) 
             {
                $query = $query->where('created_at','=',$start)->where('created_at','=',$end);

             }elseif ($start != $end) 
             {
                $query = $query->where('created_at','>',$start)
                               ->where('created_at','<',$end);
             }

             $request->merge([
                'start'=> $start,
                'end'=> $end,
            ]);
         }
         

       //search in attendance table
        $searchTerm = $request->search;
        if (! empty($searchTerm)) {
            $members = $query->whereHas('member',function($query) use($searchTerm){
                       $query->where('name', 'LIKE', "%{$searchTerm}%")
                             ->orWhere('barcode_number', 'LIKE', "%{$searchTerm}%");
            })->paginate(5);
            $total = $query->count();
            $request->merge([
                'search'=> $searchTerm,
            ]);
         }else{
             $total = $query->count();
             $members = $query->latest()->paginate(5);
         }
        
       
        return view('admin.attendance.index', compact('members', 'total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    

 //Start and display today's registers
    public function register(Request $request)
    { 
        // dd($request->search);
        $query=Attendance::where('created_at','!=',null);

        $currentDate = Carbon::now()->toDateString();
        $query = $query->whereDate('created_at', $currentDate);


        $searchTerm = $request->search;
       // dd($searchTerm);
        if (! empty($searchTerm)) {                
            $members = $query->whereHas('member',function($query) use($searchTerm){
                       $query->where('name', 'LIKE', "%{$searchTerm}%")
                             ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                             ->orWhere('barcode_number', 'LIKE', "%{$searchTerm}%")
                             ->orWhere('phone', 'LIKE', "%{$searchTerm}%");
            })->paginate(5);
            $total = $query->count();
         }else {
            $total = $query->count();
            $members = $query->latest()->paginate(5);
         }
        
        
        return view('admin.attendance.register', compact('members','total'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');
        
        $query=Member::where('barcode_number','=', $request->barcode)->first();
        $trainer=Trainer::where('card_id','=', $request->barcode)->first();
       
        //check if this member or trainer
        if (! empty($query)) {
            //check if the member is in the system or not.
            if (! empty($query->end_subscription)) { 
                
                //check if the member subscription is expired or not.
                $currentTime = Carbon::now()->toDateString();
                $end=$query->end_subscription;
                
                        //reduce no of sessions if exist
                        
                            if($query->sessionsNumber === 0 || $end < $currentTime){
                            
                                return redirect()->back()->with('failed' , 'The sessions are expired');
                            }
                            elseif($query->sessionsNumber > 0 && $end > $currentTime){
                                Attendance::create([
                                    'member_id'=>$query->id,
                                    'trainer_id'=>null,
                                    'type'=>'member'
                                ]);
                                $query->sessionsNumber-=1;
                                $query->save();
                                return redirect()->back()->with('success','Registered Successfully');
                            }else{
                                if($end > $currentTime) {
                                    Attendance::create([
                                        'member_id'=>$query->id,
                                        'trainer_id'=>null,
                                        'type'=>'member'
                                    ]);
                                    return redirect()->back()->with('success','Registered Successfully');
                                }else{
                                    return redirect()->back()->with('failed' , 'The subscription is expired');
                                }
                            }
                }
            
            else{
                return redirect()->back()->with('failed' , 'The Member is not exist');
            }
        }elseif (!empty($trainer)) {
            Attendance::create([
                'member_id'=>null,
                'trainer_id'=>$trainer->id,
                'type'=>'trainer'
            ]);
            return redirect()->back()->with('success','Registered Successfully');
        }else{
            return redirect()->back()->with('failed' , 'Not exist');
        }
           
        
        
    }


    
}
