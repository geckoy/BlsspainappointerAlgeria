<?php 
namespace App\lib\providers; // use App\lib\providers\webscrapeProvider;
/**
 * Dependencies 
 */
use simplehtmldom\HtmlWeb;
use App\lib\recommendations\webscrape;
use App\Models\gmailchecker;
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
     * center to apply for 
     */
    private $center;

    public function __construct(HtmlWeb $HtmlWeb)
    {
        $this->dom = $HtmlWeb;
    }

    public function setUp_config($url,$center)
    {
        $this->url = $url;
        $this->center = $center;
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
    public function check_availability()
    {
        $html = $this->dom->load($this->url);
        if($html == NULL ) return "Website Not readed";
        $center = $this->get_center();
        if($center === false) return "Center Not Readed";

            try
            {
                $html->find(".alertBox")[0];

            }catch (\Exception $e) {
                report($e);
                return [true,$center];
            }
        
            if($i = $html->find(".alertBox")[0])
            {
               if($this->checkmatch("appoint_unvailable",$i->plaintext)) 
               {
                 return 'No appointment : '.$i->plaintext;
               }else
               {
                 return [true,$center];
               }
            }else
            {
                return [true,$center];
            }
    }

    public function get_availability($appointer)
    {//$appointer->loginurl

        $gmail_checker = gmailchecker::where('isLogged', true)->WHERE("isBad",false)->WHERE("referer",null)->first();
       
        if($gmail_checker == null)
        {
            #### RETRIEVE CHECKER IF ITS TIMEOUT ENDED 
            $gmail_checker = gmailchecker::where('isLogged', false)->WHERE("isBad",true)->WHERE("timeout", "<", time())->first();
            
            if($gmail_checker != null)
            {
                $gmail_checker->referer = null;
                $gmail_checker->isLogged = 1;
                $gmail_checker->isBad = 0;
                $gmail_checker->timeout = (time() + 2100);
                $gmail_checker->save();
                //return $gmail_checker; // test report caught

                $bookappointment_page = $this->post_request_bookappointment($appointer, $gmail_checker);
                
                if($bookappointment_page == false) return "error #159753";
            }else
            {
                #### RETRIEVE NEW CHECKER ELSE REPORT NEEDING CHECKERS 
                $gmail_checker = gmailchecker::where('isLogged', false)->WHERE("isBad",false)->WHERE("referer",null)->first();
                
                if($gmail_checker == null) return "alert no checker available";
                $gmail_checker->isLogged = 1;
                $gmail_checker->save();
                
                $bookappointment_page = $this->post_request_bookappointment($appointer, $gmail_checker);
                
                if($bookappointment_page == false) return "error #951753";

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
        log::alert($bookappointment_page);
        if(preg_match("/Appointment for the Visa Application Centre/im",$bookappointment_page["html_response"]))
        {
            
            return [true, $this->get_center($html)];
        }else
        {
            try
            {
                $html->find(".alertBox")[0];

            }catch (\Exception $e) {
                report($e);
                return false;
            }
        
            if($i = $html->find(".alertBox")[0])
            {
               if($this->checkmatch("appoint_unvailable",$i->plaintext)) 
               {
                 return 'No appointment : '.$i->plaintext;
               }else
               {
                 return false;
               }
            }else
            {
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
                $gmail_checker->isLogged = 0;
                $gmail_checker->isBad = 1;
                $gmail_checker->timeout = (time() + 2100);
                $gmail_checker->save();
                //log::alert("##48441");
                //log::alert($before_bookappointment_page);
                //log::alert($code);
                return false;
            }
            

        }elseif( preg_match("/You have already sent OTP request./mi", $request_login["html_response"]) )
        {
            $gmail_checker->isLogged = 0;
            $gmail_checker->isBad = 1;
            $gmail_checker->timeout = (time() + 2100);
            $gmail_checker->save();
            return false;
            # set timeout

        }elseif(preg_match("/al_login/mi",$request_login["html_response"]))
        {
            $gmail_checker->isLogged = 0;
            $gmail_checker->isBad = 1;
            $gmail_checker->timeout = (time() + 2100);
            $gmail_checker->save();
            return false;
        }elseif(preg_match("/<script>document.location.href='login.php'<\/script>/mi",$request_login["html_response"]))
        {
            $gmail_checker->isLogged = 0;
            $gmail_checker->isBad = 1;
            $gmail_checker->timeout = (time() + 2100);
            $gmail_checker->save();
            return false;
        }

        return $bookappointment_page;
    }
}