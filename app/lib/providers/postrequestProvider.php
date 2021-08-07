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
        return $this->request_entry($applicant,$appointer);
    }

    public function request_entry($applicant,$appointer)
    {   
        //return $applicant->gmail;
        // Log::alert($applicant->gmail);
        // exec('node tester.js "'.$applicant->gmail.'" "'.$applicant->password.'" "'.$applicant->password_bls.'" "'.$applicant->phonenum.'" "'.$applicant->center.'" "'.$applicant->members_count.'"', $output, $retval);
        // return $output;
       if($applicant->type == "Family")
       {
            $ppl = $applicant->applicants;
            foreach($ppl["companions"] as $key => $value)
            {
                if($key == 0 )
                {
                    $entry_for = $value["family_name"].",".$value["first_name"].",".$value["passport"].",".$value["born"].",".$value["passportsub"].",".$value["passportex"].",".$value["passportplace"];
                    continue;
                }
                    $entry_for .= "%".$value["family_name"].",".$value["first_name"].",".$value["passport"].",".$value["born"].",".$value["passportsub"].",".$value["passportex"].",".$value["passportplace"];
            }
            
       }elseif($applicant->type == "Individual")
       {
            
            $ppl = $applicant->applicants;
            $entry_for = $ppl["family_name"].",".$ppl["first_name"].",".$ppl["passport"].",".$ppl["born"].",".$ppl["passportsub"].",".$ppl["passportex"].",".$ppl["passportplace"];
       }
       

        if($appointer->center == "maroc")
        {
            exec('node applicant_loggermaroc.js "'.$applicant->gmail.'" "'.$applicant->password.'" "'.$applicant->password_bls.'" "'.$applicant->phonenum.'" "'.$applicant->center.'" "'.$applicant->members_count.'" "'.$entry_for.'"', $output, $retval);
        }else
        {
            exec('node applicant_logger.js "'.$applicant->gmail.'" "'.$applicant->password.'" "'.$applicant->password_bls.'" "'.$applicant->phonenum.'" "'.$applicant->center.'" "'.$applicant->members_count.'" "'.$entry_for.'"', $output, $retval);
        }
        
        // Log::alert("output");
        // Log::alert($output);
        $status = (bool)$output[0];
        if(! $status)
        {
            // Log::alert("output error");
            $applicant->isPorcessing = false;
            $applicant->save();
            return false;
        }elseif($status == true)
        {
            Log::alert($output);
            $applicant->isPorcessing = false;
            $applicant->isAppointed = true;
            $applicant->save();
            return true;
        }
              
    }
}