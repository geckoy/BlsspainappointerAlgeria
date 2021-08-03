<?php 

namespace App\lib\recommendations; // use App\lib\recommendations\captchasolver;


interface captchasolver 
{
    public function setUp_config($appointer);

    public function get_access_token(int $version);
}