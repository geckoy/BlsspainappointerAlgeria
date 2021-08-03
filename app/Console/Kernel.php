<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Dependencies
 */
use Illuminate\Support\Facades\Http;
use App\lib\blsappointer;
use Illuminate\Support\Facades\Log;
use App\Models\chaptchaKey;
use App\Models\chaptcha_keys_login;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$response = Http::get('http://localhost/');
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $appointer = resolve(blsappointer::class);
            $return = $appointer->get_availability();
            Log::alert("REturned Value");
            Log::alert($return);

        })->everyMinute();

        // $schedule->call(function () {
        //    $token_limit = time();
        //     chaptchaKey::where('expiry', '<=', $token_limit )->delete();
        //     chaptcha_keys_login::where('expiry', '<=', $token_limit )->delete();
        // })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
