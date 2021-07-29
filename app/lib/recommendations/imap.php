<?php
namespace App\lib\recommendations; //use App\lib\recommendations\imap;

interface imap 
{
    public function setUp_config($ownmail);

    public function check_token();
}