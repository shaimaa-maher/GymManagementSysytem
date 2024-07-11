<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Safaricom\Mpesa\Mpesa;
use Illuminate\Support\Facades\DB;
use App\Models\Attendance;
use Carbon\Carbon;
use App\Models\Finance;



use Safaricom\Mpesa\Facade\Mpesa as FacadeMpesa;

class MembersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    

    public function index(Request $request) {

        $query = Member::orderBy('id','desc'); 

       
        $searchTerm = $request->search;
        
        if (! empty($searchTerm)) {
            $query = $query->where('name', 'LIKE', "%{$searchTerm}%")
                           ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                           ->orWhere('barcode_number', 'LIKE', "%{$searchTerm}%")
                           ->orWhere('phone', 'LIKE', "%{$searchTerm}%");    
         }

         $total = $query->count();
         $members = $query->latest()->paginate(10);
         return view('admin.members', compact('members', 'total'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function join_us()
    {
        return view('pages.join_us');
    }

    //ADD MEMBER
    public function addMember(Request $request) {

        $request->only(['id','name', 'email', 'phone', 'payment', 'membership_cost','membership_period','barcode','start_subscription','end_subscription','sessionsNumber']);

        //dd($request);

        $request->validate([
            'name' => 'required', 
            'email' => 'required',
            'phone' => 'required',
            'payment' => 'required',
            'membership_cost'=>'required',
            'start_subscription'=>'required',
            'end_subscription'=>'required',
 
        ]);

        Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'payment' => $request->payment,
            'membership_cost'=>$request->membership_cost,
            'membership_period'=>$request->membership_period?$request->membership_period:'none',
            'barcode_number'=>$request->barcode?$request->barcode:null,
            'start_subscription'=>$request->start_subscription,
            'end_subscription'=>$request->end_subscription,
            'sessionsNumber'=>$request->sessionsNumber?$request->sessionsNumber:NULL
        ]);


        //getting memeber id after adding.
        $member=Member::where('barcode_number',$request->barcode)->orWhere('phone',$request->phone)->first();
        
        if($request->sessionsNumber){
            Finance::create([
                'member_id'=> $member->id,
                'amount'=>$member->membership_cost,
                'sub_type'=>'sessions',
                ]); 
        }else{
            Finance::create([
                    'member_id'=> $member->id,
                    'amount'=>$member->membership_cost,
                    'sub_type'=>'member_subscription',
                    ]); 
        }
        

        return redirect()->back()->with('success', 'Member Added Successfully');

    }

    //DELETE MEMBER 
    public function deleteMember(Request $request) {
        
        $id = $request->id;
        $member=Member::findOrFail($id);
        $member->delete();
    
        return redirect()->back()->with('success', 'Member Deleted Successfully');
    }

    //UPDATE MEMBER
    public function editMember(Request $request){

        $request->only(['id','name', 'email', 'phone', 'payment', 'membership_cost','membership_period','barcode','start_subscription','end_subscription','sessionsNumber']);

        $member = Member::findOrFail($request->id);

        $member->name=$request->name;
        $member->email=$request->email;
        $member->phone=$request->phone;
        $member->payment=$request->payment;
        $member->membership_cost=$request->membership_cost;
        $member->membership_period = $request->membership_period?$request->membership_period:'none';
        $member->barcode_number=$request->barcode;
        $member->start_subscription=$request->start_subscription;
        $member->end_subscription=$request->end_subscription;
        $member->sessionsNumber=$request->sessionsNumber;
        $member->save();

        //edit the membership cost of this member
        $finance= Finance::where('member_id','=',$request->id)->first();

        $finance->amount = $request->membership_cost;
        if($request->sessionsNumber > 0){
            $finance->sub_type= 'sessions';
        }
        $finance->save();
 
        return redirect()->back()->with('success', 'Member updated Successfully');
    } 

    //SHOW PROFILE
    public function show($id){
        $member = Member::where('id','=',$id)->first();

        $startSub=$member->start_subscription;
        $endSub=$member->end_subscription;
        $currentDate=Carbon::now()->toDateString();

        $output = [
            'id'=>$member->id,
            'name' => $member->name,
            'email' => $member->email,
            'phone' => $member->phone,
            'barcode_number' => $member->barcode_number,
            'membership_period' => $member->membership_period,
            'payment' => $member->payment,
            'membership_cost' => $member->membership_cost,
            'start_subscription'=>$member->start_subscription,
            'end_subscription' =>$member->end_subscription,
            'sessionsNumber'=>$member->sessionsNumber,
        ];

     
        //All member's Attendance:
        $attendance = Attendance::where('member_id','=',$id);

        $total   = $attendance->count();
        $members = $attendance->latest()->paginate(5);
        
        return view('admin.show',compact('output','members','total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    //Add subscription
    public function AddSubscription(Request $request){

        $request->validate([
            'subscription_cost'=>'required',
            'start_subscription'=>'required',
            'end_subscription'=>'required',
        ]);

        //update the subscription dates
        $id=$request->id;
        $member=Member::findOrFail($id);
        $member->start_subscription = $request->start_subscription;
        $member->end_subscription = $request->end_subscription;
        $member->sessionsNumber=$request->sessionsNumber?$request->sessionsNumber:null;
        $member->save();

        //add new subscription amount 
        if($member->sessionsNumber > 0 ){
            Finance::create([
                'member_id'=>$request->id,
                'amount'=>$request->subscription_cost,
                'sub_type'=>'sessions',
                ]); 
        }else{
            Finance::create([
                'member_id'=>$request->id,
                'amount'=>$request->subscription_cost,
                'sub_type'=>'member_subscription',
                ]); 
        }

        return redirect()->back()->with('success', 'Subscription Added Successfully');
    }
}
