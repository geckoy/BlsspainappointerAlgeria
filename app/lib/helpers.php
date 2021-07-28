<?php
/**
 * Dependecies
 */
use App\Models\chaptchaKey;
use App\Models\chaptcha_keys_login;

/**
 * Save the header phpssid, awscors, awslb for the applicant
 */
function set_headers($applicant, $headers)
{
    foreach($headers as $header)
    {   //[^A-Za-z].*[^;]
        $patternAWSALB = "/^AWSALB=[a-zA-Z0-9=+\/*-.&\\_<>:!()\@§£$?\[\]{}]*;/i";
        $patternAWSALBCORS = "/^AWSALBCORS=[a-zA-Z0-9=+\/*-.&\\_<>:!()\@§£$?\[\]{}]*;/i";
        $patternPHP = "/^PHPSESSID[a-zA-Z0-9=+\/*-.&\\_<>:!()\@§£$?\[\]{}]*;/i";
        
        if( preg_match($patternAWSALB, $header, $match_AWSALB) )
        {
            preg_match("/.*[^;]/i", $match_AWSALB[0], $AWSALB);
            $applicant->awsalb = $AWSALB[0];
        }elseif( preg_match($patternAWSALBCORS, $header, $match_AWSALBCORS) )
        {
            preg_match("/.*[^;]/i", $match_AWSALBCORS[0], $AWSALBCORS);
            $applicant->awsalbcors = $AWSALBCORS[0];
        }elseif( preg_match($patternPHP, $header, $matchphp_first) )
        {   
            preg_match("/.*[^;]/i", $matchphp_first[0], $PHPSESSID);
            $applicant->PHPSESSID =  $PHPSESSID[0];
        }
    }
    $applicant->save();
    return true;
}

/**
 * Parses CURL RESPONSE HEADER AND SAVE IT FOR ITS applicant
 */
function parse_cookie_header( $header, $applicant )
{
    $pattern = "/set-cookie: [a-zA-Z0-9=+\/*-.&\\_<>:!()\@§£$?\[\]{}]*;/im";
    preg_match_all($pattern, $header, $match);
    
    $headers = [];
    foreach($match[0] as $cookie)
    {
        $headers[] = str_replace("set-cookie: ","", $cookie);
    }
    set_headers( $applicant, $headers);
}

/**
 * Curl post request with headers
 */
function curl_post_headers(string $url, array $post_fields ,array $headers)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // In real life you should use something like:
    curl_setopt($ch, CURLOPT_POSTFIELDS, 
             http_build_query($post_fields));
    
    // Receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $server_output = curl_exec($ch);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($server_output, 0, $header_size);
    curl_close ($ch);
    return [
        "header_response" => $header,
        "html_response"   => $server_output
    ];
}

/**
 * Curl post request 
 */
function curl_post(string $url, array $post_fields)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // In real life you should use something like:
    curl_setopt($ch, CURLOPT_POSTFIELDS, 
             http_build_query($post_fields));
    
    // Receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $server_output = curl_exec($ch);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($server_output, 0, $header_size);
    curl_close ($ch);
    return [
        "header_response" => $header,
        "html_response"   => $server_output
    ];
}

/**
 * Curl get request with headers
 */
function curl_get_headers(string $url, array $headers)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    // Receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $server_output = curl_exec($ch);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($server_output, 0, $header_size);
    curl_close ($ch);
    return [
        "header_response" => $header,
        "html_response"   => $server_output
    ];
}

/**
 * Curl download captcha with send headers
 */
function curl_captcha_headers( string $url, $applicant,array $headers )
{
    $fh = fopen(__DIR__."/../../storage/app/public/".$applicant->applicants['passport'].".png", "w+");
    $ch_captcha_download = curl_init();
    curl_setopt($ch_captcha_download, CURLOPT_URL, $url);
    curl_setopt($ch_captcha_download, CURLOPT_FILE, $fh);
    curl_setopt($ch_captcha_download, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch_captcha_download, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($ch_captcha_download);
    curl_close($ch_captcha_download);
    fclose($fh);
    return true;
}

/**
 * test if helpers.php exist
 */

function exist_helper_bls()
{
    return __FILE__;
}

/**
 * Get recaptcha v3 code post  
 */
function recaptchav3_entry()
{
    do
    {
        $token_limit = time();
        $captcha_code = chaptchaKey::where('expiry', '>=', $token_limit )->where('isUsed', '=', false)->orderBy('created_at', 'asc')->first();
    }while($captcha_code == null);
    $captcha_code->isUsed = true;
    $captcha_code->save();
    
    return $captcha_code->captcha_token;
}

function recaptchav3_login()
{
    do
    {
        $token_limit = time();
        $captcha_code = chaptcha_keys_login::where('expiry', '>=', $token_limit )->where('isUsed', '=', false)->orderBy('created_at', 'asc')->first();
    }while($captcha_code == null);
    $captcha_code->isUsed = true;
    $captcha_code->save();
    
    return $captcha_code->captcha_token;
}