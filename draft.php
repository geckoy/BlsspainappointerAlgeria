<?php
#############################################################################
#############################################################################
#############################################################################
###                                                                       ###
###     IMAP TESTING                                                      ###
###                                                                       ###
#############################################################################
#############################################################################
#############################################################################
 // $server = '{imap.gmail.com:993/ssl}';
    // $connection = imap_open($server, "younesheissenmann.test@gmail.com", "nedjadi1998");
    // $mailboxes = imap_list($connection, $server, '*');
    // dd($mailboxes);

//{imap.gmail.com:993/ssl}[Gmail]/Spam
    // $server = '{imap.gmail.com:993/ssl}INBOX';
    // $mbox = imap_open($server, "younesheissenmann.test@gmail.com", "nedjadi1998");
    // $MC = imap_check($mbox);
    // $result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
    // foreach ($result as $overview) {
    //      /**
    //          * test
    //          */
            
    //          echo "#{$overview->msgno} ({$overview->date}) - From: ".utf8_decode(imap_utf8($overview->from))." subject:
    //             ".utf8_decode(imap_utf8($overview->subject))." body : ".base64_decode(imap_fetchbody($mbox, $overview->msgno,'1'))."<br/>";
    // }
    // dd($mbox);

#############################################################################
#############################################################################
#############################################################################
###                                                                       ###
###     Captcha TESTING                                                   ###
###                                                                       ###
#############################################################################
#############################################################################
#############################################################################
    // $captcha->get_access_token(3)
    //274743617
    
    // $captcha->setUp_config("https://civ.blsspainvisa.com/book_appointment.php", "CivFirst", "6LcLZaAUAAAAAArQGCwKgkh8SQ9_fcCjSpiUFqxZ", "57C162237424468DA5E85898D0A7CB55");
    
    
    // // dd($captcha->get_balance());
    // $captcha_id = $captcha->get_access_token(3);
    //     // dd($captcha_id);
    //     // sleep(10);
    //     // dd($captcha->retreive_code("274752338"));
    // do
    // {
    //     sleep(10);
    //     $captcha_code = $captcha->retreive_code($captcha_id);
    // }while($captcha_code === false);
    // dd( $captcha_code );


#############################################################################
#############################################################################
#############################################################################
###                                                                       ###
###     movinghelpers                                                     ###
###                                                                       ###
#############################################################################
#############################################################################
#############################################################################


    // public function set_headers($applicant, $headers)
    // {
    //     foreach($headers as $header)
    //     {   //[^A-Za-z].*[^;]
    //         $patternAWSALB = "/^AWSALB=[a-zA-Z0-9=+\/*-.&\\_<>:!()\@§£$?\[\]{}]*;/i";
    //         $patternAWSALBCORS = "/^AWSALBCORS=[a-zA-Z0-9=+\/*-.&\\_<>:!()\@§£$?\[\]{}]*;/i";
    //         $patternPHP = "/^PHPSESSID[a-zA-Z0-9=+\/*-.&\\_<>:!()\@§£$?\[\]{}]*;/i";
            
    //         if( preg_match($patternAWSALB, $header, $match_AWSALB) )
    //         {
    //             preg_match("/.*[^;]/i", $match_AWSALB[0], $AWSALB);
    //             $applicant->awsalb = $AWSALB[0];
    //         }elseif( preg_match($patternAWSALBCORS, $header, $match_AWSALBCORS) )
    //         {
    //             preg_match("/.*[^;]/i", $match_AWSALBCORS[0], $AWSALBCORS);
    //             $applicant->awsalbcors = $AWSALBCORS[0];
    //         }elseif( preg_match($patternPHP, $header, $matchphp_first) )
    //         {   
    //             preg_match("/.*[^;]/i", $matchphp_first[0], $PHPSESSID);
    //             $applicant->PHPSESSID =  $PHPSESSID[0];
    //         }
    //     }
    //     $applicant->save();
    //     return true;
    // }
    // public function parse_cookie_header( $header, $applicant )
    // {
    //     $pattern = "/set-cookie: [a-zA-Z0-9=+\/*-.&\\_<>:!()\@§£$?\[\]{}]*;/im";
    //     preg_match_all($pattern, $header, $match);
        
    //     $headers = [];
    //     foreach($match[0] as $cookie)
    //     {
    //         $headers[] = str_replace("set-cookie: ","", $cookie);
    //     }
    //     $this->set_headers( $applicant, $headers);
    // }




