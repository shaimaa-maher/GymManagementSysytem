<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Kreait\Firebase\ServiceAccount;
use Kreait\Laravel\Firebase\Facades\Firebase;

class SerialNumberController extends Controller
{

    public function index()
    {  
        // $firebase = (new Factory)->withServiceAccount(__DIR__.'/gymserials-firebase-adminsdk-xslxx-13907f0c57.json')
        //                          ->withDatabaseUri('https://gymserials-default-rtdb.firebaseio.com');
        
        // $database = $firebase->createDatabase();
        // $serialNumbers=$database->getReference('serialNumbers');
        // $AllValues=$serialNumbers->getValue();
        // // dd($AllValues);

        // $currentSerial=env('SERIAL_NUMBER');
        // // $currentSerial='589674ASDR54966466';
        // // dd($currentSerial);

        // if ($AllValues && in_array($currentSerial, $AllValues)) {

        //     return redirect()->route('home');
        // }
        // else{

            $id=Auth::user()->id;
            $user=User::findOrFail($id);
            $user->is_super_admin=0;
            $user->save();
            return redirect()->route('expired');
        // }
    }
 

    public function expired(){
        return view('serial');
    }
}
