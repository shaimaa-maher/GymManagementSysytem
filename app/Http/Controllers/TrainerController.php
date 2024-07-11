<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Attendance;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Trainer::orderBy('id','asc'); 
        $searchTerm = $request->search;
        
        if (! empty($searchTerm)) {
            $query = $query->where('name', 'LIKE', "%{$searchTerm}%")
                           ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                           ->orWhere('card_id', 'LIKE', "%{$searchTerm}%")
                           ->orWhere('phone', 'LIKE', "%{$searchTerm}%");    
         }


       

         $total = $query->count();
         $trainers = $query->latest()->paginate(5);
         return view('admin.trainers.index', compact('trainers', 'total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->only(['id','name', 'email', 'phone', 'salary', 'card_id','address','class','working_hours']);

        //dd($request);

        $request->validate([
            'name' => 'required', 
            'email' => 'required',
            'phone' => 'required',
            'salary' => 'required',
            'card_id'=>'required',
            'address'=>'required',
            'class'=>'required',
            'working_hours'=>'required',
        ]);
      //  return $request;

        Trainer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'salary' => $request->salary,
            'card_id'=>$request->card_id,
            'address'=>$request->address,
            'class'=>$request->class,
            'working_hours'=>$request->working_hours
        ]);


        return redirect()->back()->with('success', 'Trainer Added Successfully');

    }

   
    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $trainer=Trainer::findOrFail($id);
        $query=Member::where('trainer_id',$id);
        $all=Member::where('trainer_id',null)->get();
        $total=$query->count();
        $members=$query->latest()->paginate(10);

        //All trainers's Attendance:
        $attendance = Attendance::where('trainer_id','=',$id);
        $total= $attendance->count();
        $attendances = $attendance->latest()->paginate(5);
        return view('admin.trainers.profile',compact('trainer','members','attendances','all','total'))->with('i', (request()->input('page', 1) - 1) * 10);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->only(['id','name', 'email', 'phone', 'salary', 'card_id','address','class','working_hours']);

        //dd($request);

        $request->validate([
            'name' => 'required', 
            'email' => 'required',
            'phone' => 'required',
            'salary' => 'required',
            'address'=>'required',
            'class'=>'required',
            'working_hours'=>'required',
            'card_id'=>'required',
        ]);

        $trainer=Trainer::findOrFail($request->id);
        $trainer->name = $request->name;
        $trainer->email = $request->email;
        $trainer->phone = $request->phone;
        $trainer->salary = $request->salary;
        $trainer->address = $request->address;
        $trainer->class= $request->class;
        $trainer->working_hours= $request->working_hours;
        $trainer->card_id= $request->card_id;
        $trainer->save();
        
        return redirect()->back()->with('success', 'Trainer Updated Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $trainer=Trainer::findOrFail($id);
        $trainer->delete();
    
        return redirect()->back()->with('success', 'Trainer Deleted Successfully');
    }


    public function addAssignment(Request $request){
        $trainer=$request->id;
        $member=$request->member;
        $assignment=Member::findOrFail($member);
        $assignment->trainer_id=$trainer;
        $assignment->save();
        return redirect()->back()->with('success', 'Member Assigned Successfully');
    }


    public function deleteAssignment(Request $request){ 
        $member=$request->id;
        $deleteAssignment=Member::findOrFail($member);
        $deleteAssignment->trainer_id=null;
        $deleteAssignment->save();
        return redirect()->back()->with('success', 'Assignment Deleted Successfully');
    }


}
