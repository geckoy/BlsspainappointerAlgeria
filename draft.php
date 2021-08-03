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




    //$imap->setUp_config("younesheissenmann.test@gmail.com", "nedjadi1998")->check_activity();        
    // $con = imap_open("{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX", "younesheissenmann.test@gmail.com", "nedjadi1998");
    // $con = imap_open("{vps81152.serveur-vps.net:993/imap/ssl/novalidate-cert}Junk", "admin@mailerman.site", '!Bjjdm$bETCkg');
    // $mbox = $con;
    //         $MC = imap_check($mbox);
    //         $result = array_reverse(imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0));
    //         foreach ($result as $overview) 
    //         {
    //             $from = utf8_decode(imap_utf8($overview->from));
    //                 $body = imap_fetchbody($mbox, $overview->msgno,'1'); 
    //                 $date = date("d", strtotime($overview->date));
                    
    //                 echo "MESSAGE <br />";
    //                 echo "=============================== <br />";
    //                 echo  $from." ".$date."<br />";
    //                 echo $body;
    //                 echo "<br />";
    //         }
    //         imap_close($mbox);

    // dd('wooty');

    //$server = '{imap.gmail.com:993/imap/ssl/novalidate-cert}';
//     $server = '{vps81152.serveur-vps.net:993/imap/ssl/novalidate-cert}';
    
//    // $connection = imap_open($server, "younesheissenmann.test@gmail.com", "nedjadi1998");

//      $connection = imap_open($server, "admin@mailerman.site", '!Bjjdm$bETCkg');

//     $mailboxes = imap_list($connection, $server, '*');
//     imap_close($connection);

//     dd($mailboxes);

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




#############################################################################
#############################################################################
#############################################################################
###                                                                       ###
###     PostrequestProvider                                               ###
###                                                                       ###
#############################################################################
#############################################################################
#############################################################################

// public function post_request_bookappointment($appointer, $gmail_checker)
    // {
    //     $request_login = curl_post($appointer->loginurl,  [
    //         "user_email"           => $gmail_checker->gmail,
    //         "g-recaptcha-response" => recaptchav3_login(),
    //         "continue"             => "Continue"
    //     ]);
        
    //     if( preg_match("/We've sent an OTP to the Email/i", $request_login["html_response"]) )
    //     {
            
    //         parse_cookie_header( $request_login["header_response"], $gmail_checker );
            
    //         $code = $appointer->check_otp($gmail_checker);

    //         if($code == false) return false;
    //         $before_bookappointment_page = curl_post_headers($appointer->loginurl, [
    //             "otp"=> $code,
    //             "user_password" => $gmail_checker->password_bls,
    //             "g-recaptcha-response" => recaptchav3_login(),
    //             "login" => "Login"
    //         ],[
    //             "Cookie: {$gmail_checker->PHPSESSID}"
    //         ]);
            
            
            
    //         if( preg_match("/<script>document.location.href='book_appointment.php'<\/script>/i", $before_bookappointment_page["html_response"]) )
    //         {
    //             parse_cookie_header( $before_bookappointment_page["header_response"], $gmail_checker );
    //             Log::alert("before_bookappointment_page");
    //             Log::alert($before_bookappointment_page);

    //             $bookappointment_page = curl_get_headers($appointer->url, [
    //                 "Cookie: {$gmail_checker->PHPSESSID}"
    //             ]);
    //             //log::alert("##2");
    //             //log::alert($bookappointment_page);
    //             parse_cookie_header( $bookappointment_page["header_response"], $gmail_checker );
                
    //             if(! preg_match("/PHPSESSID/im", $bookappointment_page["header_response"]))
    //             {
    //                 //$this->ajaxurl gofor=getAppServiceDetail&cid=
                    
    //                 $center_id = (explode("#",$gmail_checker->center))[1];
    //                 Log::alert("center2ID");
    //                 Log::alert($center_id);
    //                 Log::alert("Cookie: {$gmail_checker->PHPSESSID}");
    //                 $ajax_page = curl_post_headers($this->ajaxurl, [
    //                         "gofor" => "getAppServiceDetail",
    //                         "cid"   => $center_id
    //                 ],[
    //                         "Cookie: {$gmail_checker->PHPSESSID}",
    //                         "content-type: application/x-www-form-urlencoded; charset=UTF-8",
    //                         "origin: https://morocco.blsspainvisa.com",
    //                         "referer: https://morocco.blsspainvisa.com/english/book_appointment.php"
    //                 ]);
    //                 Log::alert("AJAX2PAGE");
    //                 Log::alert($ajax_page);
    //                 parse_cookie_header( $ajax_page["header_response"], $gmail_checker );
    //             }
    //         }else
    //         {
    //             $gmail_checker->isPorcessing = false;
    //             $gmail_checker->save();
    //             return false;
    //         }
            

    //     }elseif( preg_match("/You have already sent OTP request./mi", $request_login["html_response"]) )
    //     {
    //         $gmail_checker->isPorcessing = false;
    //         $gmail_checker->save();
    //         return false;
    //         # set timeout

    //     }elseif(preg_match("/al_login/mi",$request_login["html_response"]))
    //     {
    //         $gmail_checker->isPorcessing = false;
    //         $gmail_checker->save();
    //         return false;
    //     }elseif(preg_match("/<script>document.location.href='login.php'<\/script>/mi",$request_login["html_response"]))
    //     {
    //         $gmail_checker->isPorcessing = false;
    //         $gmail_checker->save();
    //         return false;
    //     }

    //     return $bookappointment_page;
    // }

    // public function request_token($applicant, $appointer)
    // {
        

        // Log::alert("request token method call");
        
        // $bookappointment_page = $this->post_request_bookappointment($appointer, $applicant);
        
        // if($bookappointment_page == false) return "##error 52132144";
        // Log::alert($bookappointment_page);

        // $first_page_token_request_hin = $appointer->retrieve_hidden_inputs($bookappointment_page["html_response"]);
        // $first_page_token_request_vin = $appointer->retrieve_visible_inputs($bookappointment_page["html_response"]);
        // $first_page_token_request_sel = $appointer->retrieve_select_inputs($bookappointment_page["html_response"]);

        // // if($applicant->type == "Individual")
        // // {
        //     $first_page_token_request_vin["app_type"] = "Individual";
        //     unset($first_page_token_request_vin['save']);
        //     $first_page_token_request_hin["g-recaptcha-response"] = recaptchav3_entry(); 
        //     $first_page_token_request_sel["member"] = "2";
        //     $first_page_token_request_sel["centre"] = $applicant->center;
        //     $first_page_token_request_sel["previous_visa_yes_no"] = $first_page_token_request_sel["previous_visa_yes_no"]["Select"];
        //     $first_page_token_request_sel["category"] = "Normal";

        //     $first_page_token_request_complete = array_merge($first_page_token_request_sel,$first_page_token_request_vin,$first_page_token_request_hin);
            
        //     $request_verfication_code = curl_post_headers($this->url, $first_page_token_request_complete , [
        //         "Cookie: {$applicant->PHPSESSID}",
        //         "Content-Type: application/x-www-form-urlencoded",
        //         "origin: https://morocco.blsspainvisa.com",
        //         "referer: https://morocco.blsspainvisa.com/english/book_appointment.php"
        //     ]);
            

        //    // $response = Http::asForm()->post($this->url, );
        // // }elseif($applicant->type == "Family")
        // // {   
        // //     $first_page_token_request_vin["app_type"] = "Family";
        // //     unset($first_page_token_request_vin['save']);
        // //     $first_page_token_request_hin["g-recaptcha-response"] = recaptchav3_entry(); 
        // //     $first_page_token_request_sel["member"] = $applicant->members_count;
        // //     $first_page_token_request_sel["centre"] = $applicant->center;
        // //     $first_page_token_request_sel["previous_visa_yes_no"] = $first_page_token_request_sel["previous_visa_yes_no"]["Select"];
        // //     $first_page_token_request_sel["category"] = "Normal";

        // //     $first_page_token_request_complete = array_merge($first_page_token_request_sel,$first_page_token_request_vin,$first_page_token_request_hin);
        // //     $request_verfication_code = curl_post_headers($this->url, $first_page_token_request_complete , [
        // //         "Cookie: {$applicant->PHPSESSID}; {$applicant->awsalb}; {$applicant->awsalbcors}",
        // //         "content-type: application/x-www-form-urlencoded"
        // //     ]);
            
        // // }
        // if( preg_match("/Verification.*code.*sent.*to.*your.*email/im", $request_verfication_code["html_response"] ) )
        // {
        //     Log::alert("first request token");
        //     Log::alert($request_verfication_code);
        //     parse_cookie_header( $request_verfication_code["header_response"],$applicant);
        //     $applicant->isMailrequested = true;
        //     $applicant->save();
        //     $this->check_mailable( $applicant, $appointer);
        // }else
        // {
        //     Log::alert("first request token error");
        //     Log::alert($this->url);
        //     Log::alert($request_verfication_code);
        //     Log::alert($first_page_token_request_complete);
        //     Log::alert("=======================younes========================");
        //     Log::alert($first_page_token_request_hin);
        //     Log::alert($first_page_token_request_vin);
        //     Log::alert($first_page_token_request_sel);
        //     Log::alert("=======================aplicante========================");
        //     Log::alert($applicant);
        //     $applicant->isPorcessing = false;
        //     $applicant->save();
        //     return false;
        // }
        
        // Log::notice($response->headers());

        // $first_page_entry_request_hin = $appointer->retrieve_hidden_inputs($bookappointment_page["html_response"]);
        // $first_page_entry_request_vin = $appointer->retrieve_visible_inputs($bookappointment_page["html_response"]);
        // $first_page_entry_request_sel = $appointer->retrieve_select_inputs($bookappointment_page["html_response"]);

        // if($applicant->type == "Individual")
        // {
        //     $first_page_entry_request_vin["app_type"] = "Individual";
        //     $first_page_entry_request_vin["otp"] = $code;
        //     unset($first_page_entry_request_vin['verification_code']);
        //     $first_page_entry_request_hin["g-recaptcha-response"] = recaptchav3_entry(); 
        //     $first_page_entry_request_sel["member"] = "2";
        //     $first_page_entry_request_sel["centre"] = $applicant->center;
        //     $first_page_entry_request_sel["previous_visa_yes_no"] = $first_page_entry_request_sel["previous_visa_yes_no"]["Select"];
        //     $first_page_entry_request_sel["category"] = "Normal";

        //     $first_page_entry_request_complete = array_merge($first_page_entry_request_sel,$first_page_entry_request_vin,$first_page_entry_request_hin);
        //     $response = curl_post_headers($this->url, $first_page_entry_request_complete , [
        //         "Cookie: {$applicant->PHPSESSID}"
        //     ]);
        // }elseif($applicant->type == "Family")
        // {
        //     $first_page_entry_request_vin["app_type"] = "Family";
        //     $first_page_entry_request_vin["otp"] = $code;
        //     unset($first_page_entry_request_vin['verification_code']);
        //     $first_page_entry_request_hin["g-recaptcha-response"] = recaptchav3_entry(); 
        //     $first_page_entry_request_sel["member"] = $applicant->members_count;
        //     $first_page_entry_request_sel["centre"] = $applicant->center;
        //     $first_page_entry_request_sel["previous_visa_yes_no"] = $first_page_entry_request_sel["previous_visa_yes_no"]["Select"];
        //     $first_page_entry_request_sel["category"] = "Normal";

        //     $first_page_entry_request_complete = array_merge($first_page_entry_request_sel,$first_page_entry_request_vin,$first_page_entry_request_hin);
        //     $response = curl_post_headers($this->url, $first_page_entry_request_complete , [
        //         "Cookie: {$applicant->PHPSESSID}"
        //     ]);
        // }
        // if(! preg_match("/I.*agree.*to.*provide.*my.*Consent/im", $response["html_response"] ))
        // {
        //     $applicant->isMailprocessing = false;
        //     $applicant->isMailrequested = false;
        //     $applicant->isPorcessing = false;
        //     $applicant->save();
        //     return false;
        // }
        // Log::alert("second request token");
        // Log::alert($response);
        // parse_cookie_header( $response["header_response"],$applicant);
        // //Log::notice($applicant->PHPSESSID);
    // }

    // public function check_mailable( $applicant, $appointer )
    // {
    //     $applicant->isMailprocessing = true;
    //     $applicant->save();
        
    //     do
    //     {
    //         $code = $appointer->imap->setUp_mailaccount($applicant->gmail,$applicant->password)->check_token();
    //     }while( $code === false );
        
    //     $this->request_entry($applicant, $code, $appointer);
    // }





#############################################################################
#############################################################################
#############################################################################
###                                                                       ###
###     webscrape  Provider                                               ###
###                                                                       ###
#############################################################################
#############################################################################
#############################################################################

// public function check_availability()
    // {
    //     $html = $this->dom->load($this->url);
    //     if($html == NULL ) return "Website Not readed";
    //     $center = $this->get_center();
    //     if($center === false) return "Center Not Readed";

    //         try
    //         {
    //             $html->find(".alertBox")[0];

    //         }catch (\Exception $e) {
    //             report($e);
    //             return [true,$center];
    //         }
        
    //         if($i = $html->find(".alertBox")[0])
    //         {
    //            if($this->checkmatch("appoint_unvailable",$i->plaintext)) 
    //            {
    //              return 'No appointment : '.$i->plaintext;
    //            }else
    //            {
    //              return [true,$center];
    //            }
    //         }else
    //         {
    //             return [true,$center];
    //         }
    // }











    // public function post_request_bookappointment($appointer, $gmail_checker)
    // {
    //     $request_login = curl_post($appointer->loginurl,  [
    //         "user_email"           => $gmail_checker->gmail,
    //         "g-recaptcha-response" => recaptchav3_login(),
    //         "continue"             => "Continue"
    //     ]);
        
    //     if( preg_match("/We've sent an OTP to the Email/i", $request_login["html_response"]) )
    //     {
            
    //         parse_cookie_header( $request_login["header_response"], $gmail_checker );
            
    //         $code = $appointer->check_otp($gmail_checker);

    //         if($code == false) return false;
    //         $before_bookappointment_page = curl_post_headers($appointer->loginurl, [
    //             "otp"=> $code,
    //             "user_password" => $gmail_checker->password_bls,
    //             "g-recaptcha-response" => recaptchav3_login(),
    //             "login" => "Login"
    //         ],[
    //             "Cookie: {$gmail_checker->PHPSESSID}"
    //         ]);
            
            
            
    //         if( preg_match("/<script>document.location.href='book_appointment.php'<\/script>/i", $before_bookappointment_page["html_response"]) )
    //         {
    //             parse_cookie_header( $before_bookappointment_page["header_response"], $gmail_checker );
    //             $bookappointment_page = curl_get_headers($appointer->url, [
    //                 "Cookie: {$gmail_checker->PHPSESSID}"
    //             ]);
    //             //log::alert("##2");
    //             //log::alert($bookappointment_page);
    //             parse_cookie_header( $bookappointment_page["header_response"], $gmail_checker );
    //             if(! preg_match("/PHPSESSID/im", $bookappointment_page["header_response"]))
    //             {
    //                 //$this->ajaxurl gofor=getAppServiceDetail&cid=
    //                 require_once __DIR__."/../../../vendor/simplehtmldom/simplehtmldom/simple_html_dom.php";
    //                 $html = str_get_html($bookappointment_page["html_response"]);

    //                 $center_id = (explode("#",$this->get_center($html)))[1];
    //                 $ajax_page = curl_post_headers($this->ajaxurl, [
    //                         "gofor" => "getAppServiceDetail",
    //                         "cid"   => $center_id
    //                 ],[
    //                         "Cookie: {$gmail_checker->PHPSESSID}"
    //                 ]);
                    
    //                 parse_cookie_header( $ajax_page["header_response"], $gmail_checker );
    //             }
    //         }else
    //         {
    //             $gmail_checker->isLogged = 0;
    //             $gmail_checker->isBad = 1;
    //             $gmail_checker->timeout = (time() + 2100);
    //             $gmail_checker->save();
    //             //log::alert("##48441");
    //             //log::alert($before_bookappointment_page);
    //             //log::alert($code);
    //             return false;
    //         }
            

    //     }elseif( preg_match("/You have already sent OTP request./mi", $request_login["html_response"]) )
    //     {
    //         $gmail_checker->isLogged = 0;
    //         $gmail_checker->isBad = 1;
    //         $gmail_checker->timeout = (time() + 2100);
    //         $gmail_checker->save();
    //         return false;
    //         # set timeout

    //     }elseif(preg_match("/al_login/mi",$request_login["html_response"]))
    //     {
    //         $gmail_checker->isLogged = 0;
    //         $gmail_checker->isBad = 1;
    //         $gmail_checker->timeout = (time() + 2100);
    //         $gmail_checker->save();
    //         return false;
    //     }elseif(preg_match("/<script>document.location.href='login.php'<\/script>/mi",$request_login["html_response"]))
    //     {
    //         $gmail_checker->isLogged = 0;
    //         $gmail_checker->isBad = 1;
    //         $gmail_checker->timeout = (time() + 2100);
    //         $gmail_checker->save();
    //         return false;
    //     }

    //     return $bookappointment_page;
    // }

#############################################################################
#############################################################################
#############################################################################
###                                                                       ###
###     Appointer                                                         ###
###                                                                       ###
#############################################################################
#############################################################################
#############################################################################
// public function check_mailable()
    // {
    //     $applicant = applicant::WHERE("isMailrequested",true)->WHERE("isMailprocessing",false)->WHERE("isAppointed",false)->orderBy('updated_at', 'asc')->first();
    //     if($applicant == null) return "nothing to process";
    //     $applicant->isMailprocessing = true;
    //     $applicant->save();
    //     $code = $this->imap->setUp_mailaccount($applicant->gmail,$applicant->password)->check_token();
    //     if( $code == false )
    //     {
    //         $applicant->isMailprocessing = false;
    //         $applicant->save();
    //         return false;
    //     }
    //     $this->request->request_entry($applicant, $code, $this);
    //     return $code;
    // }