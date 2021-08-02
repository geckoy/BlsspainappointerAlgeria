<?php 
namespace App\lib\providers; // use App\lib\providers\postrequestProvider;

/**
 * Dependencies 
 */
use Illuminate\Support\Facades\Http;
use App\lib\recommendations\postrequest;
use App\Models\applicant;
use Illuminate\Support\Facades\Log;
use App\Models\chaptchaKey;

class postrequestProvider implements postrequest
{
    /**
     * Http Client
     */
    private $request;

    /**
     * Url to request
     */
    private $url;

    /**
     * AppointUrl
     */
    public $AppointUrl;
    /**
     * ajax url
     */
    public $ajaxurl;

    /**
     * captcha Url
     */
    public $CaptchaUrl;

    /**
     * Mother Url
     */
    public $motherurl;

    public function __construct(Http $http)
    {
        $this->request = $http;
    }

    public function setUp_config($url, $AppointUrl, $CaptchaUrl, $ajaxurl,$motherurl)
    {
        $this->url = $url;
        $this->AppointUrl = $AppointUrl;
        $this->CaptchaUrl = $CaptchaUrl;
        $this->ajaxurl = $ajaxurl;
        $this->motherurl = $motherurl;
    }
    
    public function process($appointer, $center)
    {
        $applicant = applicant::where("isPorcessing", false)->first();
        
        if($applicant == null ) return "All processed";
        $applicant->isPorcessing = true;
        $applicant->center = $center;
        $applicant->save();
        $this->request_entry($applicant,$appointer);
        return $applicant->gmail;
    }
    public function request_token($applicant, $appointer)
    {
        

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
    }

    public function check_mailable( $applicant, $appointer )
    {
        $applicant->isMailprocessing = true;
        $applicant->save();
        
        do
        {
            $code = $appointer->imap->setUp_mailaccount($applicant->gmail,$applicant->password)->check_token();
        }while( $code === false );
        
        $this->request_entry($applicant, $code, $appointer);
    }

    public function request_entry($applicant,$appointer)
    {
        exec('node applicant_logger.js '.$applicant->gmail.' '.$applicant->password.' "'.$applicant->password_bls.'"', $output, $retval);
        Log::alert($output);
        $status = (bool)$output[0];
        if(! $status)
        {
            $applicant->isPorcessing = false;
            $applicant->save();
            return false;
        }
        //$set_cookie = str_replace(" ",";",$output[1]) ;
        $set_cookie = $output[1];
        Log::alert("=====================set_cookie");
        Log::alert($set_cookie);

        $applicant->PHPSESSID = $set_cookie;
        $applicant->save();

        
     #################################################################accept agreement
        Log::alert("accepting agreement");
        $accept_agreement = curl_post_headers($this->url, array('agree' => 'Agree') , [
                "Cookie: {$applicant->PHPSESSID}",
                "content-type: application/x-www-form-urlencoded; charset=UTF-8",
                "origin: {$this->motherurl}",
                "referer: {$this->url}"
        ]);
            
        if(! preg_match("/<script>document.location.href='appointment.php'<\/script>/im", $accept_agreement["html_response"] ))
        {
            Log::alert("accepting agreement response ERROR :(");
            Log::alert($accept_agreement);

            $applicant->isMailprocessing = false;
            $applicant->isMailrequested = false;
            $applicant->isPorcessing = false;
            $applicant->save();
            return false;
        }

        Log::alert("accepting agreement response :)");
        Log::alert($accept_agreement);
        parse_cookie_header($accept_agreement["header_response"],$applicant);

        
        
///////////////////////////////////////////////////////////REQUEST LAST Page 
    
        $last_page = curl_get_headers($this->AppointUrl, [
            "Cookie: {$applicant->PHPSESSID}; {$applicant->awsalb}; {$applicant->awsalbcors}",
            "referer: {$this->url}"
        ]);

        Log::alert("fourth last page");
        Log::alert($last_page);
        //$last_page["html_response"]
        parse_cookie_header($last_page["header_response"],$applicant);
        return 'ended TEMP';
        
        #########################prepare for request submission
        $available_dates_pattern_js = "/var.*available_dates.*=.*];/im";
       
        if( preg_match($available_dates_pattern_js, $last_page["html_response"], $match_available_dates) )
        {
            $available_dates_pattern = '/"[0-9-]*"/im';
            if(preg_match_all($available_dates_pattern, $match_available_dates[0] , $match_available_date))
            {
                $date_to_appoint = date("Y-m-d",strtotime( (str_replace('"',"", (array_reverse($match_available_date[0]))[0])) ));
            }else
            {
                $applicant->isMailprocessing = false;
                $applicant->isMailrequested = false;
                $applicant->isPorcessing = false;
                $applicant->save();
                Log::alert("Dates aren't available");
                return false;
            }
        }else
        {
            $applicant->isMailprocessing = false;
            $applicant->isMailrequested = false;
            $applicant->isPorcessing = false;
            $applicant->save();
            return false;
        }
        $post_request_time_hidden_inputs = $appointer->retrieve_hidden_inputs($last_page["html_response"]);
        $post_request_time_visible_inputs = $appointer->retrieve_visible_inputs($last_page["html_response"]);
        $post_request_time_visible_inputs["app_date"] = $date_to_appoint;
        $post_request_time = array_merge($post_request_time_visible_inputs, $post_request_time_hidden_inputs);
        
        
        
        ###########################################request time
        $last_page_time_request = curl_post_headers($this->AppointUrl, $post_request_time ,[
            "Cookie: {$applicant->PHPSESSID}; {$applicant->awsalb}; {$applicant->awsalbcors}"
        ]);  
        //$last_page_time_request["html_response"]
        //$last_page_time_request["header_response"]
            
        if( preg_match("/Slot.*not.*availble.*for.*requested.*date/im", $last_page_time_request["html_response"] ) )
        {
            $applicant->isMailprocessing = false;
            $applicant->isMailrequested = false;
            $applicant->isPorcessing = false;
            $applicant->save();
            return false;
        }
  

        //Slot not availble for requested date
        parse_cookie_header($last_page_time_request["header_response"],$applicant);

        $retrieve_for_filling_inputs = $appointer->retrieve_visible_inputs($last_page_time_request["html_response"]);
        $retrieve_for_sending_hidden_inputs = $appointer->retrieve_hidden_inputs($last_page_time_request["html_response"]);
        $retrieve_for_select_inputs = $appointer->retrieve_select_inputs($last_page_time_request["html_response"]);
        
        foreach($retrieve_for_select_inputs as $key => $value)
            {
                if($key == "app_time")
                {
                    $retrieve_for_select_inputs[$key] = array_reverse( $value )[0];
                }elseif($key == "VisaTypeId")
                {
                    $retrieve_for_select_inputs[$key] = $value["Tourism"];
                }elseif($key == "nationalityId")
                {
                    $retrieve_for_select_inputs[$key] = $value["Algeria"];
                }elseif($key == "passportType")
                {
                    $retrieve_for_select_inputs[$key] = $value["Ordinary passport"];
                }
            }
        
        // Log::alert($last_page_time_request);
        // Log::alert($retrieve_for_filling_inputs);
        // Log::alert($retrieve_for_sending_hidden_inputs);
        // Log::alert($retrieve_for_select_inputs);
        

        ###################################solve Captcha
        $node = $appointer->get_nodeDOM($last_page_time_request["html_response"]);
        if($node == null ) 
        {
            Log::alert("Node Didn't REaded ");
            return false;
        }
        $commented_nodes = $node->find('comment');
        $is_commented_captcha = false;
        foreach($commented_nodes as $value)
        {
          if(preg_match('/name="captcha"/im',$value->outertext))
          {
            $is_commented_captcha = true;
          }
        }


       if( ! $is_commented_captcha )
       {
            $last_page_request_captcha = curl_captcha_headers( $this->CaptchaUrl, $applicant, [
                "Cookie: {$applicant->PHPSESSID}; {$applicant->awsalb}; {$applicant->awsalbcors}"
            ] );
            
            $captcha = $appointer->get_captcha_token(0, $applicant->applicants['passport']);
        }
            //Log::alert($captcha);
            

            if($applicant->type == "Individual")
            {
                $retrieve_for_filling_inputs["first_name"] = $applicant->applicants["first_name"];
                $retrieve_for_filling_inputs["last_name"] = $applicant->applicants["family_name"];
                $retrieve_for_filling_inputs["dateOfBirth"] = $applicant->applicants["born"];
                $retrieve_for_filling_inputs["passport_no"] = $applicant->applicants["passport"];
                $retrieve_for_filling_inputs["pptIssueDate"] = $applicant->applicants["passportsub"];
                $retrieve_for_filling_inputs["pptExpiryDate"] = $applicant->applicants["passportex"];
                $retrieve_for_filling_inputs["pptIssuePalace"] = $applicant->applicants["passportplace"];
                if(  ! $is_commented_captcha  )
                {
                    $retrieve_for_filling_inputs["captcha"] = $captcha;
                }
            }

            $post_submission_final = array_merge($retrieve_for_filling_inputs, $retrieve_for_sending_hidden_inputs,$retrieve_for_select_inputs);



            ###############################submit final
           $final = curl_post_headers($this->AppointUrl, $post_submission_final ,[
            "Cookie: {$applicant->PHPSESSID}; {$applicant->awsalb}; {$applicant->awsalbcors}"
           ]);
           Log::alert($final);        
    }

    public function post_request_bookappointment($appointer, $gmail_checker)
    {
        $request_login = curl_post($appointer->loginurl,  [
            "user_email"           => $gmail_checker->gmail,
            "g-recaptcha-response" => recaptchav3_login(),
            "continue"             => "Continue"
        ]);
        
        if( preg_match("/We've sent an OTP to the Email/i", $request_login["html_response"]) )
        {
            
            parse_cookie_header( $request_login["header_response"], $gmail_checker );
            
            $code = $appointer->check_otp($gmail_checker);

            if($code == false) return false;
            $before_bookappointment_page = curl_post_headers($appointer->loginurl, [
                "otp"=> $code,
                "user_password" => $gmail_checker->password_bls,
                "g-recaptcha-response" => recaptchav3_login(),
                "login" => "Login"
            ],[
                "Cookie: {$gmail_checker->PHPSESSID}"
            ]);
            
            
            
            if( preg_match("/<script>document.location.href='book_appointment.php'<\/script>/i", $before_bookappointment_page["html_response"]) )
            {
                parse_cookie_header( $before_bookappointment_page["header_response"], $gmail_checker );
                Log::alert("before_bookappointment_page");
                Log::alert($before_bookappointment_page);

                $bookappointment_page = curl_get_headers($appointer->url, [
                    "Cookie: {$gmail_checker->PHPSESSID}"
                ]);
                //log::alert("##2");
                //log::alert($bookappointment_page);
                parse_cookie_header( $bookappointment_page["header_response"], $gmail_checker );
                
                if(! preg_match("/PHPSESSID/im", $bookappointment_page["header_response"]))
                {
                    //$this->ajaxurl gofor=getAppServiceDetail&cid=
                    
                    $center_id = (explode("#",$gmail_checker->center))[1];
                    Log::alert("center2ID");
                    Log::alert($center_id);
                    Log::alert("Cookie: {$gmail_checker->PHPSESSID}");
                    $ajax_page = curl_post_headers($this->ajaxurl, [
                            "gofor" => "getAppServiceDetail",
                            "cid"   => $center_id
                    ],[
                            "Cookie: {$gmail_checker->PHPSESSID}",
                            "content-type: application/x-www-form-urlencoded; charset=UTF-8",
                            "origin: https://morocco.blsspainvisa.com",
                            "referer: https://morocco.blsspainvisa.com/english/book_appointment.php"
                    ]);
                    Log::alert("AJAX2PAGE");
                    Log::alert($ajax_page);
                    parse_cookie_header( $ajax_page["header_response"], $gmail_checker );
                }
            }else
            {
                $gmail_checker->isPorcessing = false;
                $gmail_checker->save();
                return false;
            }
            

        }elseif( preg_match("/You have already sent OTP request./mi", $request_login["html_response"]) )
        {
            $gmail_checker->isPorcessing = false;
            $gmail_checker->save();
            return false;
            # set timeout

        }elseif(preg_match("/al_login/mi",$request_login["html_response"]))
        {
            $gmail_checker->isPorcessing = false;
            $gmail_checker->save();
            return false;
        }elseif(preg_match("/<script>document.location.href='login.php'<\/script>/mi",$request_login["html_response"]))
        {
            $gmail_checker->isPorcessing = false;
            $gmail_checker->save();
            return false;
        }

        return $bookappointment_page;
    }
}


// ,
//                             "origin: https://morocco.blsspainvisa.com",
//                             "referer: https://morocco.blsspainvisa.com/english/book_appointment.php",
//                             'sec-ch-ua: "Chromium";v="92", " Not A;Brand";v="99", "Google Chrome";v="92"',
//                             "sec-fetch-dest: document",
//                             "sec-fetch-mode: navigate",
//                             "sec-fetch-site: same-origin",
//                             "sec-fetch-user: ?1",
//                             "upgrade-insecure-requests: 1",
//                             "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36",
//                             "REMOTE_ADDR: 41.97.6.31",
//                             "HTTP_X_FORWARDED_FOR: 41.97.6.31"