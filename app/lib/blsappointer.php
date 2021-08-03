<?php 
namespace App\lib; // use App\lib\blsappointer;
//alg_app_first form name of book_appointment.php
//al_login form name of login.php
/**
 * @Dependencies
 */
use App\lib\recommendations\captchasolver;
use App\lib\recommendations\webscrape;
use App\lib\recommendations\postrequest;
use App\lib\recommendations\imap;
use App\Models\AppointmentStatus;
use Illuminate\Support\Facades\App;
use App\Jobs\captchaV3Job;
use App\Models\applicant;
use App\Models\bls_setting;

class blsappointer
{
    /**
     * Package Path
     */
    public $package_path;

    /**
     * Url to scrape 
     */
    public $url;

    /**
     * AppointUrl
     */
    public $AppointUrl;
    /**
     * captcha url
     */
    public $CaptchaUrl;

    /**
     * login url
     */
    public $loginurl;

    /**
     * ajax url
     */
    public $ajaxurl;

    /**
     * Mother Url
     */
    public $motherurl;

    /**
     * captcha action 
     */
    public $action;
    /**
     * center to apply
     */
    public $center;

    /**
     * Own mail server
     */
    public $ownmail;
    /**
     * captcha website key
     */
    public $captchaWebsite_key;

    /**
     * ImageTyperz secret Key
     */
    public $ImageTyperz_Key;

    /**
     * captcha Provider
     */
    public $captcha;
    
    /**
     * scraper provider
     */
    private $dom;

    /**
     * request provider
     */
    private $request;

    /**
     * imap provider
     */
    private $imap;

    /**
     * appointment Checker Status Model
     */
    private $appointCheckerStatus;

    /**
     * Settings
     */
    public $settings;
    public function __construct(captchasolver $captcha, webscrape $dom, postrequest $request, AppointmentStatus $appointCheckerStatus, imap $imap, bls_setting $settings)
    {
        $this->package_path = __DIR__;
        $this->setUpprops($this->package_path);

        $captcha->setUp_config($this);
        $dom->setUp_config($this);
        $request->setUp_config($this);
        $imap->setUp_config($this->ownmail);

        $this->captcha = $captcha;
        $this->dom = $dom;
        $this->request = $request;
        $this->imap = $imap;
        $this->settings = $settings;
        $this->appointCheckerStatus = $appointCheckerStatus;
    }

    public function setUpprops( $path )
    {
        $file = fopen($path."/config.txt","r");
        while($line = fgets($file))
        {
            if(preg_match("/^url/i", $line))
            {
                $this->url = trim(str_replace("url=","",$line));
                
            }elseif(preg_match("/^CaptchaWebsite_Key/i", $line))
            {
                $this->captchaWebsite_key = trim(str_replace("CaptchaWebsite_Key=","",$line));

            }elseif(preg_match("/^action/i", $line))
            {
                $this->action = trim(str_replace("action=","",$line));

            }elseif(preg_match("/^ImageTyperz_Key/i", $line))
            {
                $this->ImageTyperz_Key = trim(str_replace("ImageTyperz_Key=","",$line));
            
            }elseif(preg_match("/^center/i", $line))
            {
                $this->center = trim(str_replace("center=","",$line));

            }elseif(preg_match("/^appointurl/i", $line))
            {
                $this->AppointUrl = trim(str_replace("appointurl=","",$line));

            }elseif(preg_match("/^captchaurl/i", $line))
            {
                $this->CaptchaUrl = trim(str_replace("captchaurl=","",$line));
            
            }elseif(preg_match("/^loginurl/i", $line))
            {
                $this->loginurl = trim(str_replace("loginurl=","",$line));
            
            }elseif(preg_match("/^ownmail/i", $line))
            {
                $this->ownmail = trim(str_replace("ownmail=","",$line));

            }elseif(preg_match("/^ajaxurl/i", $line))
            {
                $this->ajaxurl = trim(str_replace("ajaxurl=","",$line));

            }elseif(preg_match("/^motherurl/i", $line))
            {
                $this->motherurl = trim(str_replace("motherurl=","",$line));
            }
        }

        fclose($file);
    }

    

    public function get_availability()
    {   


        // $status = $this->dom->get_availability($this);
        // return $status;


        $is_appointment_available = bls_setting::where("name", "is_appointment_available")->first();
        if( $is_appointment_available == null )
        {
            $this->settings->name = "is_appointment_available";
            $this->settings->status = false;
            $this->settings->save();
            return "is available created";
        }
        if($is_appointment_available->status)
        {
            //    $processed = $this->request->process($this, "12#7");
            //    return $processed;
        }
        return "no appoint";
        // $status = $this->dom->get_availability($this);
        
        // if($status[0] === true)   
        // {
            // $this->appointCheckerStatus->status = $status[0];
            // $this->appointCheckerStatus->save();
            // $processed = $this->request->process($this, $status[1]);
            // return $processed;
        // }
        // $this->appointCheckerStatus->status = $status;
        // $this->appointCheckerStatus->save();
        // return $status;
        //  $status = $this->dom->get_availability($this);
        //  return $status;

        //    $processed = $this->request->process($this, "12#7");
        //    return $processed;
    }

    public function captcha_balance()
    {
        $balance = $this->captcha->get_balance();
        
        return $balance;
    }

    public function check_mail( $email, $password )
    {
        do
        {
            sleep(2);
            $code = $this->imap->setUp_mailaccount( $email, $password )->check_token();
        }while($code === false);
        return $code;
    }

    public function get_captcha_token($version, $name = NULL)
    {
        $captcha_id = $this->captcha->get_access_token($version, $name);

        return $captcha_id;
        
    }

    public function retreive_captcha_token($captcha_id)
    {
        //$count = 0;
        do
        {
            $captcha_code = $this->captcha->retreive_code($captcha_id);
            
            // if($count == 6) return "error";
            sleep(10);
            //$count++;
        }while($captcha_code === false);

        return $captcha_code;
        // return $captcha_id;
    }

    public function check_otp($checker_gmail, $checker_pass)
    {
        do
        {
            sleep(2);
            $code = $this->imap->setUp_mailaccount($checker_gmail,$checker_pass)->check_otp();

        }while($code === false);
        
        return $code;
    }

    public function retrieve_hidden_inputs($html)
    {
       
       return $this->dom->get_hidden_inputs($html);
    }

    public function retrieve_visible_inputs($html)
    {
       
       return $this->dom->get_visible_inputs($html);
    }

    public function retrieve_select_inputs($html)
    {
       
       return $this->dom->get_select_inputs($html);
    }

    public function check_imap_connectivity($email, $password, $mbox)
    {
        $this->imap->setUp_mailaccount($email, $password)->check_activity($mbox);
    }
    
    public function get_nodeDOM($html)
    {
        return $this->dom->get_nodeDOM($html);
    }
}