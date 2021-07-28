<?php 

namespace App\lib\recommendations; // use App\lib\recommendations\captchasolver;


interface captchasolver 
{
    public function setUp_config($url, $action, $captchaWebsite_key, $ImageTyperz_Key);

    public function get_access_token(int $version);
}