<?php

namespace App\Http\Controllers; // use App\Http\Controllers\IndexController;

/**
 * @Dependencies
 */
use Illuminate\Http\Request;

use App\lib\providers\captchasolverProvider;

use App\lib\blsappointer;

use App\lib\providers\imapProvider;
use App\Models\applicant;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\gmailchecker;
// use App\lib\providers\webscrapeProvider;

class IndexController extends Controller
{
    public function FrontPage(Request $request, imapProvider $imap, blsappointer $appointer, captchasolverProvider $captcha)
    {


        
    //    echo "<pre>";// blsappointer $appointer, ,captchasolverProvider $captcha
    //     print_r($appointer);
    //     echo "</pre>";
    // dd("test");
    //$appointer->check_availability()
    //$appointer->captcha_balance()
    //$appointer->check_mail("younesheissenmann.test@gmail.com", "nedjadi1998")
        //$appointer->check_mailable()


    //$dom->setUp_config("https://civ.blsspainvisa.com/book_appointment.php");
    // $ch = curl_init('https://www.google.com/');
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $response = curl_exec($ch);
    // curl_close($ch);
    // $captcha_code = "HFZ3c1dA4UDh9mQEcASV0RSBN1BBVEUw1kPik6ABQ-CyFiFi5DJV1FEzQjSC0VIQldIwQjAwRGTkIAZQNBZSVMRjlvGUgLPUk_bFssQCJvcwl0Lx0mGVJcDyRRAHVRFAQCXEQQFgUIT3wQVRYuWngMREM_T1UJbEdWJD1KZH8";
    // $response = Http::asForm()->post("https://civ.blsspainvisa.com/book_appointment.php", [
    //     "app_type"              => "Individual",
    //     "member"                => "2",
    //     "centre"                => "44#44",
    //     "category"              => "Normal",
    //     "phone_code"            => "213",
    //     "phone"                 => "7575454544",
    //     "email"                 => "younesheissenmann.test@gmail.com",
    //     "verification_code"     => "Request verification code",
    //     "otp"                   => "",
    //     "g-recaptcha-response"  => $captcha_code,
    //     "countryID"             => ""
    // ]);

    // Log::notice($response);

    // dd($response); storage\app\captcha.png
    //dd(scandir());
    //__DIR__."/../../../storage/app/captcha.png"
    //$captcha->retreive_code("");

//      dd($appointer);

    // $captcha->setUp_config("https://civ.blsspainvisa.com/book_appointment.php","CivFirst","6LcLZaAUAAAAAArQGCwKgkh8SQ9_fcCjSpiUFqxZ","57C162237424468DA5E85898D0A7CB55");
    
    // dd($captcha->get_access_token(0, "captcha2"));
//     echo  "<img src='".Storage::url('captcha.png')."' >";
// //echo  "<img src='data:image/png;base64, ".base64_encode( Storage::get('captcha.png'))."' >";
// dd("end");

        
        ####################### FOR DOWNLOADING CAPTCHA 
            // $fh = fopen(__DIR__."/../../../storage/app/younes.png", "w+");
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, "https://civ.blsspainvisa.com/captcha/captcha.php");
            // curl_setopt($ch, CURLOPT_FILE, $fh);
            // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            // curl_exec($ch);
            // curl_close($ch);
            // fclose($fh);
            // dd("end");
        ####################### FOR reading page
        /* retrieve inputs */
            //$appointer->retrieve_hidden_inputs($html);
            //$appointer->retrieve_visible_inputs($html);
            // $select = $appointer->retrieve_select_inputs($html);
            // foreach($select as $key => $value)
            // {
            //     if($key == "app_time")
            //     {
            //         $select[$key] = array_reverse( $value )[0];
            //     }elseif($key == "VisaTypeId")
            //     {
            //         $select[$key] = $value["Tourism"];
            //     }elseif($key == "nationalityId")
            //     {
            //         $select[$key] = $value["Algeria"];
            //     }elseif($key == "passportType")
            //     {
            //         $select[$key] = $value["Ordinary passport"];
            //     }
            // }
            // dd($appointer->retrieve_visible_inputs($html));

        /* retrieve select */
        //$appointer->retrieve_select_inputs($html)
        //$applicant = applicant::WHERE("isPorcessing", false)->first();
//$applicant->applicants

// return response(Storage::get('1454DE48pd.php'))
//             ->header('Content-Type', "image/jpeg");
// echo  Storage::get('1454DE48pd.php') ;
//$checker = gmailchecker::where('isLogged', false)->WHERE("isBad",false)->first();
//$imap->setUp_config("younesheissenmann.test@gmail.com", "nedjadi1998")->check_activity();        
$con = imap_open("{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX", "younesheissenmann.test@gmail.com", "nedjadi1998");
$mbox = $con;
        $MC = imap_check($mbox);
        $result = array_reverse(imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0));
        foreach ($result as $overview) 
        {
            $from = utf8_decode(imap_utf8($overview->from));
                $body = imap_fetchbody($mbox, $overview->msgno,'1'); 
                $date = date("d", strtotime($overview->date));
                
                echo "MESSAGE <br />";
                echo "=============================== <br />";
                echo  $from." ".$date."<br />";
                echo $body;
                echo "<br />";
        }
        imap_close($mbox);
        dd("wooty");
        //$appointer->get_availability()









        


        // dd($appointer->get_availability());

    dd($appointer->check_mailable());
    
    
    
    
    // dd("end");



   //dd($appointer->check_availability());
        









        dd("end");
        return redirect()->away('https://www.youtube.com/watch?v=1k8craCGpgs');;
        //return view("welcome");
    }
}
