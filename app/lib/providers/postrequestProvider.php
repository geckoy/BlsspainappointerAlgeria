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
     * captcha Url
     */
    public $CaptchaUrl;

    public function __construct(Http $http)
    {
        $this->request = $http;
    }

    public function setUp_config($url, $AppointUrl, $CaptchaUrl)
    {
        $this->url = $url;
        $this->AppointUrl = $AppointUrl;
        $this->CaptchaUrl = $CaptchaUrl;
    }
    
    public function process($appointer, $center)
    {
        $applicant = applicant::where("isPorcessing", false)->first();
        
        if($applicant == null ) return "All processed";
        // $applicant->isPorcessing = true;
        // $applicant->center = $center;
        // $applicant->save();
        
        

       
        // do
        // {
        //     $token_limit = time();
        //     $captcha_code = chaptchaKey::where('expiry', '>=', $token_limit )->where('isUsed', '=', false)->orderBy('created_at', 'asc')->first();
        // }while($captcha_code == null);
        // $captcha_code->isUsed = true;
        // $captcha_code->save();
        

        return $this->request_token( $applicant, $appointer);
       // return $captcha_code;
        return $applicant->gmail;
    }
    public function request_token($applicant, $appointer)
    {

        $bookappointment_page = $this->post_request_bookappointment($appointer, $gmail_checker);
        if($bookappointment_page == false) return "##error 52132144";
        
        if($applicant->type == "Individual")
        {
            $request_verfication_code = curl_post_headers($this->url, [
                "app_type"              => "Individual",
                "member"                => "2",
                "centre"                => $applicant->center,
                "category"              => "Normal",
                "phone_code"            => "213",
                "phone"                 => $applicant->phonenum,
                "email"                 => $applicant->gmail,
                "verification_code"     => "Request verification code",
                "otp"                   => "",
                "g-recaptcha-response"  => $captcha_code,
                "countryID"             => ""
            ] , [
                "Cookie: {$applicant->PHPSESSID}"
            ]);

           // $response = Http::asForm()->post($this->url, );
        }elseif($applicant->type == "Family")
        {
            $request_verfication_code = curl_post_headers($this->url, [
                "app_type"              => "Family",
                "member"                => $applicant->members_count,
                "centre"                => $applicant->center,
                "category"              => "Normal",
                "phone_code"            => "213",
                "phone"                 => $applicant->phonenum,
                "email"                 => $applicant->gmail,
                "verification_code"     => "Request verification code",
                "otp"                   => "",
                "g-recaptcha-response"  => $captcha_code,
                "countryID"             => ""
            ] , [
                "Cookie: {$applicant->PHPSESSID}"
            ]);

            
        }
        if( preg_match("/Verification.*code.*sent.*to.*your.*email/im", $request_verfication_code["html_response"] ) )
        {
            parse_cookie_header( $request_verfication_code["header_response"],$applicant);
            $applicant->isMailrequested = true;
            $applicant->save();
            $this->check_mailable( $applicant, $appointer);
        }else
        {
            $applicant->isPorcessing = false;
            $applicant->save();
            return false;
        }
        
        // Log::notice($response->headers());
    }

    public function check_mailable( $applicant, $appointer )
    {
        $applicant->isMailprocessing = true;
        $applicant->save();
        
        do
        {
            $code = $appointer->imap->setUp_config($applicant->gmail,$applicant->password)->check_token();
        }while( $code === false );
        
        $this->request_entry($applicant, $code, $appointer);
    }

    public function request_entry($applicant,$code,$appointer)
    {

        do
        {
            $token_limit = time();
            $captcha_code = chaptchaKey::where('expiry', '>=', $token_limit )->where('isUsed', '=', false)->orderBy('created_at', 'asc')->first();
        }while($captcha_code == null);
        $captcha_code->isUsed = true;
        $captcha_code->save();

        if($applicant->type == "Individual")
        {
            $response = curl_post_headers($this->url, [
                "app_type" => "Individual",
                "member" => "2",
                "centre" => $applicant->center,
                "category" => "Normal",
                "phone_code" => "213",
                "phone" => $applicant->phonenum,
                "email" => $applicant->gmail,
                "otp" => $code,
                "g-recaptcha-response" => $captcha_code->captcha_token,
                "countryID" => "",
                "save" => "Continue"
            ] , [
                "Cookie: {$applicant->PHPSESSID}"
            ]);
        }elseif($applicant->type == "Family")
        {
            $response = curl_post_headers($this->url, [
                "app_type" => "Family",
                "member" => $applicant->members_count,
                "centre" => $applicant->center,
                "category" => "Normal",
                "phone_code" => "213",
                "phone" => $applicant->phonenum,
                "email" => $applicant->gmail,
                "otp" => $code,
                "g-recaptcha-response" => $captcha_code->captcha_token,
                "countryID" => "",
                "save" => "Continue"
            ] , [
                "Cookie: {$applicant->PHPSESSID}"
            ]);
        }
        if(! preg_match("/I.*agree.*to.*provide.*my.*Consent/im", $response["html_response"] ))
        {
            $applicant->isMailprocessing = false;
            $applicant->isMailrequested = false;
            $applicant->isPorcessing = false;
            $applicant->save();
            return false;
        }

        parse_cookie_header( $response["header_response"],$applicant);
        //Log::notice($applicant->PHPSESSID);

        
     #################################################################accept agreement
       
        $accept_agreement = curl_post_headers($this->url, array('agree' => 'Agree') , [
                "Cookie: {$applicant->PHPSESSID}; {$applicant->awsalb}; {$applicant->awsalbcors}"
            ]);
        
        if(! preg_match("/<script>document.location.href='appointment.php'<\/script>/im", $accept_agreement["html_response"] ))
        {
            $applicant->isMailprocessing = false;
            $applicant->isMailrequested = false;
            $applicant->isPorcessing = false;
            $applicant->save();
            return false;
        }


        parse_cookie_header($accept_agreement["header_response"],$applicant);

        
         
///////////////////////////////////////////////////////////REQUEST LAST Page 
    
        $last_page = curl_get_headers($this->AppointUrl, [
            "Cookie: {$applicant->PHPSESSID}; {$applicant->awsalb}; {$applicant->awsalbcors}"
        ]);

        //$last_page["html_response"]
        parse_cookie_header($last_page["header_response"],$applicant);

        #########################prepare for request submission
        $available_dates_pattern_js = "/var.*available_dates.*=.*];/im";
       
        if( preg_match($available_dates_pattern_js, $last_page["html_response"], $match_available_dates) )
        {
            $available_dates_pattern = '/"[0-9-]*"/im';
            preg_match_all($available_dates_pattern, $match_available_dates[0] , $match_available_date);
            $date_to_appoint = date("Y-m-d",strtotime( (str_replace('"',"", (array_reverse($match_available_date[0]))[0])) ));
            
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

            $last_page_request_captcha = curl_captcha_headers( $this->CaptchaUrl, $applicant, [
                "Cookie: {$applicant->PHPSESSID}; {$applicant->awsalb}; {$applicant->awsalbcors}"
            ] );
            
            $captcha = $appointer->get_captcha_token(0, $applicant->applicants['passport']);

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
                $retrieve_for_filling_inputs["captcha"] = $captcha;
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
                $bookappointment_page = curl_get_headers($appointer->url, [
                    "Cookie: {$gmail_checker->PHPSESSID}"
                ]);
                //log::alert("##2");
                //log::alert($bookappointment_page);
                parse_cookie_header( $bookappointment_page["header_response"], $gmail_checker );
            
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