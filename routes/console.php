<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/**
 * @Dependecies
 */
use App\lib\blsappointer;
use App\Models\gmailchecker;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('bls:requestotp {checkerid}', function (blsappointer $appointer, $checkerid) {

    $checker = gmailchecker::where('id', $checkerid)->first();
   
    if($checker == null) { 
        $this->line("false"); 
        return 0;
    }
    $code = $appointer->check_otp($checker);
    $this->comment($code);
})->purpose('retreive otp code of the gmail');

