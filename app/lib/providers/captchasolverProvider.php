<?php
namespace App\lib\providers; // use App\lib\providers\captchasolverProvider;

/**
 * Dependencies 
 */
use ImagetyperzAPI;
use App\lib\recommendations\captchasolver;
use Illuminate\Support\Facades\App;

class captchasolverProvider implements captchasolver
{
    /**
     * Set up captcha object 
     */
    public $captcha;

    /**
     * website captcha key
     */
    public $website= [];

    public function setUp_config($url, $action, $captchaWebsite_key, $ImageTyperz_Key)
    {
        $this->website["captcha_key"] = $captchaWebsite_key;
        $this->website["url"] = $url;
        $this->website["action"] = $action;

        require_once base_path("vendor/imagetyperzapi/imagetyperzapi/lib/imagetyperzapi.php");
        $access_token = $ImageTyperz_Key;
        $this->captcha = new ImagetyperzAPI($access_token);
    }
    public function get_balance()
    {
        return $this->captcha->account_balance();
    }
    public function get_access_token(int $version, $name = NULL)
    {
        if($version == 3)
        {
            $params = [];
            $params['page_url'] = $this->website["url"];
            $params['sitekey'] = $this->website["captcha_key"];
            $params['type'] = 3;    // optional
            //$params['v3_min_score'] = 1;          // min score to target when solving v3 - optional
            $params['v3_action'] = $this->website["action"];      // action to use when solving v3 - optional
            
            // $params = [];
            // $params['page_url'] = "https://civ.blsspainvisa.com/book_appointment.php";
            // $params['sitekey'] = '6LcLZaAUAAAAAArQGCwKgkh8SQ9_fcCjSpiUFqxZ';
            // $params['type'] = 3;    // optional
            // // $params['v3_min_score'] = 0.5;          // min score to target when solving v3 - optional
            // $params['v3_action'] = 'CivFirst';      // action to use when solving v3 - optional
     
            $captcha_id = $this->captcha->submit_recaptcha($params);
            
            return  $captcha_id;
        }elseif($version == 0)
        {
            $optional_parameters = array();
            // $optional_parameters['iscase'] = 'true';            // case sensitive captcha
            // $optional_parameters['ismath'] = 'true';            // instructs worker that a math captcha has to be solved
            // $optional_parameters['isphrase'] = 'true';          // text contains at least one space (phrase)
            // $optional_parameters['alphanumeric'] = '1';         // 1 - digits only, 2 - letters only
            // $optional_parameters['minlength'] = '3';            // captcha text length (minimum)
            // $optional_parameters['maxlength'] = '8';            // captcha text length (maximum)
            
            if(App::environment("local"))
            {
                $text = $this->captcha->solve_captcha(__DIR__."/../../../storage/app/public/".$name.".png", $optional_parameters);
            }elseif(App::environment("production"))
            {
                $text = $this->captcha->solve_captcha(__DIR__."/".$name.".png", $optional_parameters);
            } 
            
            return  $text;
        }
        
    }
    public function retreive_code($captcha_id)
    {
        $response = null;
        try
        {
            $response = $this->captcha->retrieve_recaptcha($captcha_id);
            return  $response;

        }catch(\Exception $e)
        {   
            //report($e);
            // return $this->captcha->in_progress($captcha_id);
            return false;
        }
    }
}