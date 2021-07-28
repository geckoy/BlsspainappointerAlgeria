<?php 

namespace App\lib\recommendations; // use App\lib\recommendations\webscrape; 

interface webscrape
{
    public function setUp_config($url,$center);
    
    public function check_availability();
} 