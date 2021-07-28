<?php

namespace App\Jobs; // use App\Jobs\captchaV3Job;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * @Dependencies
 */
use App\lib\blsappointer;
use App\Models\chaptchaKey;

class captchaV3Job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * captchaId_imagetyperz
     */
    public $captcha_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($captcha_id)
    {
        $this->captcha_id = $captcha_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(blsappointer $appointer, chaptchaKey $captchaKey)
    {
        $token = $appointer->retreive_captcha_token($this->captcha_id);
        $captchaKey->captcha_token = $token;
        $captchaKey->expiry = time() + 90 ;
        $captchaKey->save();
    }
}
