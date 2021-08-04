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

    public function setUp_config($appointer)
    {
        $this->url = $appointer->url;
        $this->AppointUrl = $appointer->AppointUrl;
        $this->CaptchaUrl = $appointer->CaptchaUrl;
        $this->ajaxurl = $appointer->ajaxurl;
        $this->motherurl = $appointer->motherurl;
    }
    
    public function process($appointer)
    {
        $applicant = applicant::where("isPorcessing", false)->first();
        
        if($applicant == null ) return "All processed";
        $applicant->isPorcessing = true;
        $applicant->save();
        $this->request_entry($applicant,$appointer);
        return $applicant->gmail;
    }

    public function request_entry($applicant,$appointer)
    {
        // Log::alert($applicant->gmail);
        // exec('node tester.js "'.$applicant->gmail.'" "'.$applicant->password.'" "'.$applicant->password_bls.'" "'.$applicant->phonenum.'" "'.$applicant->center.'"', $output, $retval);
        // return $output;

        if($appointer->center == "maroc")
        {
            exec('node applicant_loggermaroc.js "'.$applicant->gmail.'" "'.$applicant->password.'" "'.$applicant->password_bls.'" "'.$applicant->phonenum.'" "'.$applicant->center.'"', $output, $retval);
        }else
        {
            exec('node applicant_logger.js "'.$applicant->gmail.'" "'.$applicant->password.'" "'.$applicant->password_bls.'" "'.$applicant->phonenum.'" "'.$applicant->center.'"', $output, $retval);
        }
        // Log::alert("output");
        // Log::alert($output);
        $status = (bool)$output[0];
        if(! $status)
        {
            Log::alert("output error");
            $applicant->isPorcessing = false;
            $applicant->save();
            return false;
        }
        // Log::alert("passed");
        //$set_cookie = str_replace(" ",";",$output[1]) ;
        $set_cookie = $output[1];
        // Log::alert("=====================set_cookie");
        // Log::alert($set_cookie);

        $applicant->PHPSESSID = $set_cookie;
        $applicant->save();

        
     #################################################################accept agreement
        //Log::alert("accepting agreement");
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
            $applicant->isMailprocessing = false;
            $applicant->isMailrequested = false;
            $applicant->isPorcessing = false;
            $applicant->save();
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
}