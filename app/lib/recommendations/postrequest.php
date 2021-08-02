<?php 
namespace App\lib\recommendations; // use App\lib\recommendations\postrequest;


interface postrequest
{
    public function setUp_config($url, $AppointUrl, $CaptchaUrl, $ajaxurl,$motherurl);

    public function process($appointer, $center);

    public function request_token($applicant, $appointer);

    public function request_entry($applicant,$appointer);

}