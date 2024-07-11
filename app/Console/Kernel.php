<?php

namespace App\Console;
use App\Models\User;
use Kreait\Firebase\Factory;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     * 
     */


     protected $commands = [
        Commands\MyScheduledTask::class
    ];


    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $env = config('app.env');

    //    if($env == 'production')
    //    {
            // $schedule->call(function () {
            //     $firebase = (new Factory)->withServiceAccount(__DIR__.'/gymserials-firebase-adminsdk-xslxx-13907f0c57.json')
            //                              ->withDatabaseUri('https://gymserials-default-rtdb.firebaseio.com');
        
            //     $database = $firebase->createDatabase();
            //     $serialNumbers=$database->getReference('serialNumbers');
            //     $AllValues=$serialNumbers->getValue();

            //     dd($AllValues);

            //     $currentSerial=env('SERIAL_NUMBER');
            //    // $currentSerial='589674ASDR54966466';
            //     dd($currentSerial);

            //     if ($AllValues && in_array($currentSerial, $AllValues)) {

            //         return redirect()->route('login');
            //     }
            //     else{

            //        $user= User::findOrFail(1);
            //        $user->is_super_admin = 0;
            //        $user->save();

            //        return view('serial');
            //     }
                
            // })->everyMinute();

            $schedule->command('my:scheduled-task')->everyMinute()
            ->onSuccess(function (Stringable $output) {
                
            })
            ->onFailure(function (Stringable $output) {
                log::info('fail -_-');
            });;

    //    }

    }

    /**
     * Register the commands for the application.
     */

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
