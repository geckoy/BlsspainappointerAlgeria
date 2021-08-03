<?php 
namespace App\lib\providers; // use App\lib\providers\webscrapeProvider;
/**
 * Dependencies 
 */
use simplehtmldom\HtmlWeb;
use App\lib\recommendations\webscrape;
use App\Models\gmailchecker;
use App\Models\gmailmarocchecker;
use Illuminate\Support\Facades\Log;

class webscrapeProvider implements webscrape
{
    /**
     * @Object responsible for reading pages 
     */
    private $dom;

    /**
     * @URL to scrape
     */
    private $url;
    
    /**
     * Ajax url
     */
    private $ajaxurl;
    /**
     * center to apply for 
     */
    private $center;

    public function __construct(HtmlWeb $HtmlWeb)
    {
        $this->dom = $HtmlWeb;
    }

    public function setUp_config($appointer)
    {
        $this->url = $appointer->url;
        $this->center = $appointer->center;
        $this->ajaxurl = $appointer->ajaxurl;
    }
    public function get_center($html)
    {
         if($html == NULL ) return false;
         $centers = $html->find("#centre option");
         $center = "";
         foreach( $centers as $value )
         {
             if( preg_match( "/$this->center/i", $value->plaintext ) )
             {
                $center  = $value->value;
             }
            
         }
         return $center;
    }
    

    public function get_availability($appointer)
    {//$appointer->loginurl
        if($appointer->center == "maroc")
        {
            $gmail_checker = gmailmarocchecker::where('isLogged', true)->WHERE("isBad",false)->WHERE("referer",null)->first();
        }else
        {
            $gmail_checker = gmailchecker::where('isLogged', true)->WHERE("isBad",false)->WHERE("referer",null)->first();
        }
        
       
        if($gmail_checker == null)
        {
            #### RETRIEVE CHECKER IF ITS TIMEOUT ENDED
            if($appointer->center == "maroc")
            {
                $gmail_checker = gmailmarocchecker::where('isLogged', false)->WHERE("isBad",true)->WHERE("timeout", "<", time())->first();
            }else
            { 
                $gmail_checker = gmailchecker::where('isLogged', false)->WHERE("isBad",true)->WHERE("timeout", "<", time())->first();
            }

            if($gmail_checker != null)
            {
                $gmail_checker->referer = null;
                $gmail_checker->isLogged = 1;
                $gmail_checker->isBad = 0;
                $gmail_checker->timeout = (time() + 2100);
                $gmail_checker->save();
                //return $gmail_checker; // test report caught
                
                $bookappointment_page = $this->LOGGER($gmail_checker,$appointer);
                
                if($bookappointment_page === true) 
                {
                    $gmail_checker->isLogged = 0;
                    $gmail_checker->isBad = 1;
                    $gmail_checker->save();
                    return true;
                }

                if($bookappointment_page === false)
                { 
                    $gmail_checker->isLogged = 0;
                    $gmail_checker->isBad = 1;
                    $gmail_checker->save();
                    return "error occured";
                }
            }else
            {
                #### RETRIEVE NEW CHECKER ELSE REPORT NEEDING CHECKERS
                if($appointer->center == "maroc")
                {
                    $gmail_checker = gmailmarocchecker::where('isLogged', false)->WHERE("isBad",false)->WHERE("referer",null)->first();
                }else
                {  
                    $gmail_checker = gmailchecker::where('isLogged', false)->WHERE("isBad",false)->WHERE("referer",null)->first();
                }

                if($gmail_checker == null) return "alert no checker available";
                $gmail_checker->isLogged = 1;
                $gmail_checker->timeout = (time() + 2100);
                $gmail_checker->save();
                
                $bookappointment_page = $this->LOGGER($gmail_checker,$appointer);
                
                if($bookappointment_page === true) 
                {
                    $gmail_checker->isLogged = 0;
                    $gmail_checker->isBad = 1;
                    $gmail_checker->save();
                    return true;
                }

                if($bookappointment_page === false)
                { 
                    $gmail_checker->isLogged = 0;
                    $gmail_checker->isBad = 1;
                    $gmail_checker->save();
                    return "error occured";
                }
            }
           
        }else
        { 
            $bookappointment_page = curl_get_headers($appointer->url, [
                "Cookie: {$gmail_checker->PHPSESSID}"
            ]);
            //log::alert("##2");
            

            parse_cookie_header( $bookappointment_page["header_response"], $gmail_checker );
            if(preg_match("/You have already sent OTP request.Please try after 30 min./mi",$bookappointment_page["html_response"]))
            {
                $gmail_checker->isLogged = 0;
                $gmail_checker->isBad = 1;
                $gmail_checker->timeout = (time() + 2100);
                $gmail_checker->save();
                return "email error already sent OTP 'logged'";
                //al_login
            }elseif(preg_match("/al_login/mi",$bookappointment_page["html_response"]))
            {
                $gmail_checker->isLogged = 0;
                $gmail_checker->isBad = 1;
                $gmail_checker->timeout = (time() + 2100);
                $gmail_checker->save();
                return "email error al_login ";

            }elseif(preg_match("/<script>document.location.href='login.php'<\/script>/mi",$bookappointment_page["html_response"]))
            {
                $gmail_checker->isLogged = 0;
                $gmail_checker->isBad = 1;
                $gmail_checker->timeout = (time() + 2100);
                $gmail_checker->save();
                return "email error location.href=login.php";
            }
        }




        require_once __DIR__."/../../../vendor/simplehtmldom/simplehtmldom/simple_html_dom.php";
        $html = str_get_html($bookappointment_page["html_response"]);
        if($html == NULL) return "submission not readed";
        
        if(preg_match("/Appointment for the Visa Application Centre/im",$bookappointment_page["html_response"]))
        {
            log::alert("When Apppointment is available");
            log::alert($bookappointment_page);
            return true;
        }else
        {
            try
            {
                $html->find(".alertBox")[0];

            }catch (\Exception $e) {
                report($e);
                log::alert($bookappointment_page);
                return false;
            }
        
            if($i = $html->find(".alertBox")[0])
            {
               if($this->checkmatch("appoint_unvailable",$i->plaintext)) 
               {
                 return 'No appointment : '.$i->plaintext;
               }else
               {
                 log::alert($bookappointment_page);
                 return false;
               }
            }else
            {
                log::alert($bookappointment_page);
                return false;
            }   
        }
    }

    public function get_hidden_inputs($html)
    {
       require_once __DIR__."/../../../vendor/simplehtmldom/simplehtmldom/simple_html_dom.php";
       $html = str_get_html($html);
       if($html == NULL) return "submission not readed";
       $names = []; 
       foreach($html->find('input[type=hidden]') as $value )
       {
          $names[$value->name] =  $value->value;
       }
       return  $names;
    }

    public function get_visible_inputs($html)
    {
       require_once __DIR__."/../../../vendor/simplehtmldom/simplehtmldom/simple_html_dom.php";
       $html = str_get_html($html);
       if($html == NULL) return "submission not readed";
       $names = []; 
       foreach($html->find('form[id!=applicantPremium] input[type!=hidden]') as $value )
       {
        if($value->type == "checkbox")
        {
            continue;
        }
          $names[$value->name] =  $value->value;
       }
       return  $names;
    }//get_select_inputs

    public function get_select_inputs($html)
    {
       require_once __DIR__."/../../../vendor/simplehtmldom/simplehtmldom/simple_html_dom.php";
       $html = str_get_html($html);
       if($html == NULL) return "submission not readed";
       $names = []; 
       foreach($html->find('form[id!=applicantPremium] select option') as $value )
       {
           if(($value->parent())->name == "app_time")
           {
            $names[($value->parent())->name][]  =  $value->value;
            continue;
           }

           $names[($value->parent())->name][$value->plaintext] =  $value->value;
       }
       return  $names;
    }

    private function checkmatch($patternName, $str)
    {
        $pattern = [
            "appoint_unvailable" => "/Appointment dates are not available/i",
        ];
        return preg_match($pattern[$patternName], $str);
    }
    public function LOGGER($gmail_checker,$appointer)
    {
        exec('node test.js '.$gmail_checker->gmail.' '.$gmail_checker->password.' "'.$gmail_checker->password_bls.'"', $output, $retval);
        $status = (bool)$output[0];
        if(! $status) return false;
        if($output[1] == "Appointment Available")
        {
            return true;
        }
        $gmail_checker->PHPSESSID = $output[1];
        $gmail_checker->save();

        $bookappointment_page = curl_get_headers($appointer->url, [
            "Cookie: {$gmail_checker->PHPSESSID}"
        ]);
        parse_cookie_header( $bookappointment_page["header_response"], $gmail_checker );
        
        return $bookappointment_page;
    }

    public function get_nodeDOM($html)
    {
        require_once __DIR__."/../../../vendor/simplehtmldom/simplehtmldom/simple_html_dom.php";
       $html = str_get_html($html);
       return $html;
    }
}