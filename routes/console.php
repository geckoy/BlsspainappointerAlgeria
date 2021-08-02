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

Artisan::command('bls:requestotp {checkermail} {checkerpass}', function (blsappointer $appointer, $checkermail, $checkerpass) {

   
    $code = $appointer->check_otp($checkermail, $checkerpass);
    $this->comment($code);
})->purpose('retreive otp code of the gmail');

Artisan::command('bls:requestverfication {checkermail} {checkerpass}', function (blsappointer $appointer, $checkermail, $checkerpass) {

   
    $code = $appointer->check_mail($checkermail, $checkerpass);
    $this->comment($code);
})->purpose('retreive verification code of the gmail');