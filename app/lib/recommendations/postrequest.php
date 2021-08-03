<?php 
namespace App\lib\recommendations; // use App\lib\recommendations\postrequest;


interface postrequest
{
    public function setUp_config($appointer);

    public function process($appointer);

    public function request_entry($applicant,$appointer);

}