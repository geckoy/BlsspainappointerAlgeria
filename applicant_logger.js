/**
 * @Dependecies
 */
 var puppeteer = require('puppeteer');
 var fs = require('fs');
 var readline = require('readline');
 var util = require('util');
 var exec = util.promisify(require('child_process').exec);
 var userAgent = require('user-agents');
 
 // const http = require('http');
 var set_up_config = async function()
 {
  var promise = new Promise( myResolve => {
     var config = {};//"app/lib/config.txt"
     var configs = readline.createInterface({
         input: fs.createReadStream("app/lib/config.txt")
     });
     const pattern_url = /^url=/i;
     const pattern_CaptchaWebsite_Key = /^CaptchaWebsite_Key=/i;
     const pattern_action = /^action=/i;
     const pattern_center = /^center=/i;
     const pattern_captchaurl = /^captchaurl=/i;
     const pattern_loginurl = /^loginurl=/i;
     const pattern_appointurl = /^appointurl=/i;
     const pattern_action_login = /^action_login=/i;
     const pattern_host = /^host=/i;
     const pattern_user = /^user=/i;
     const pattern_password = /^password=/i;
     const pattern_database = /^database=/i;
     
     configs.on('line', function (line) {
         if(pattern_url.test(line))
         {
             config.url = line.replace(pattern_url, "");
     
         }else if(pattern_CaptchaWebsite_Key.test(line))
         {
             config.CaptchaWebsite_Key = line.replace(pattern_CaptchaWebsite_Key, "");
     
         }else if(pattern_action.test(line))
         {
             config.action = line.replace(pattern_action, "");
     
         }else if(pattern_center.test(line))
         {
             config.center = line.replace(pattern_center, "");
             
         }else if(pattern_appointurl.test(line))
         {
             config.appointurl = line.replace(pattern_appointurl, "");
 
         }else if(pattern_captchaurl.test(line))
         {
             config.captchaurl = line.replace(pattern_captchaurl, "");
 
         }else if(pattern_loginurl.test(line))
         {
             config.loginurl = line.replace(pattern_loginurl, "");
 
         }else if(pattern_host.test(line))
         {
             config.host = line.replace(pattern_host, "");
 
         }else if(pattern_user.test(line))
         {
             config.user = line.replace(pattern_user, "");
 
         }else if(pattern_password.test(line))
         {
             config.password = line.replace(pattern_password, "");
 
         }else if(pattern_database.test(line))
         {
             config.database = line.replace(pattern_database, "");
 
         }else if(pattern_action_login.test(line))
         {
             config.action_login = line.replace(pattern_action_login, "");
 
         }
         myResolve(config);
     });
  });
 
     return promise;
 };
 
 

 var get_cli_arg = async function()
 {
     var arguments =  process.argv.slice(2);
     var _arg = {};
     if(arguments.length === 0 )
     {
         console.log(0);
         console.log("empty argument applicant_logger");
         process.exit();
     }
    arguments.forEach((currentValue, index, arr) => {
    
    if(index == 0)
    {
        _arg.email = currentValue;
    }else if(index == 1)
    {
        _arg.password = currentValue;
    }else if(index == 2)
    {
        _arg.blspass = currentValue;
    }
    });

   return _arg;
 };

var otp_token_command = async function(checkermail, checkerpass) {
    const { stdout, stderr } = await exec( 'php artisan bls:requestotp '+ checkermail + " " + checkerpass);
    if(stderr) throw "error";
    return  stdout.trim();
};





function sleep(ms) 
{
    return new Promise(resolve => setTimeout(resolve, ms));
}



 (async () => {
    
     var config = await set_up_config();
     var cli = await get_cli_arg();    
     const browser = await puppeteer.launch();//{ headless: false }
     const page = await browser.newPage();
     
     
    
     
     // page.setUserAgent("userAgent");
     /*
     {
         ignoreHTTPSErrors: true,
         args: [ '--proxy-server=https://41.174.179.147:8080' ]
     }
     */
    
    await page.setUserAgent(userAgent.toString());
    var response = await page.goto(config.loginurl);
    await sleep(500);

    await page.type('input[name="user_email"]', cli.email);
    await Promise.all([
      page.click('input[name="continue"]'),
      page.waitForNavigation({ waitUntil: 'networkidle0' })
    ]);
    
   //Current session expired,Please click button again.
   var captcha_error = await page.evaluate(() => (/Current session expired,Please click button again./im).test($("body").html()) );
    if(captcha_error)
    {
        console.log( 0 );
        console.log("captcha ERROR");
        process.exit();
    }
     
   var otp_already_sent = await page.evaluate(() => (/You have already sent OTP request.Please try after 30 min./im).test($("body").html()) );
    if(otp_already_sent)
    {
        console.log( 0 );
        console.log("Otp Already sent");
        process.exit();
    } //We've sent an OTP to the Email cummer.maroc@gmail.com. Please enter it below to complete verification.
    
    var otp_sent = await page.evaluate(() => (/We've sent an OTP to the Email/im).test($("body").html()) );
    if(! otp_sent)
    {
        console.log( 0 );
        console.log("Connection refused");
        process.exit();
    }

    var token = await otp_token_command(cli.email, cli.password);

    await page.type('input[name="otp"]', token);
    await page.type('input[name="user_password"]', cli.blspass);
    await Promise.all([
      page.click('input[name="login"]'),
      page.waitForNavigation({ waitUntil: 'load' })
    ]);
    await sleep(500);

    await page.evaluate(() => { 
        $(".popup-appCloseIcon").click();
        $(".close").click();
        $(".popupCloseIcon").click();
    });

    var is_logged_to_appointment = await page.evaluate(() => (/Appointment.*for.*the.*Visa.*Application.*Centre/im).test($("body").html()) );
    if(!is_logged_to_appointment)
    {
        console.log( 0 );
        console.log("Login to appointment page failed");
        process.exit();
    }
    await sleep(500);
    var get_centre_value = async(config) => {
        return page.evaluate(async (config) => { 
                return await new Promise(resolve => { 
                    var  indexMatchingText = (ele, text) => {
                        var patt = new RegExp(text, "gi");
                        for (var i=0; i<ele.length;i++) {
                            if (patt.test(ele[i].childNodes[0].nodeValue)){
                                
                                return ele[i].value;
                                //return i;
                            }
                        }
                        return undefined;
                    };

                    var select_input = document.querySelector("select[name=centre]");
                    var center_id = indexMatchingText(select_input, config.center);
                    resolve(center_id);
                });
        }, config);
    };

    var centre_id = await get_centre_value(config);
    await page.select('select[name=centre]', centre_id);
    await sleep(500);
    await page.evaluate(() => { 
        $(".popup-appCloseIcon").click();
        $(".close").click();
        $(".popupCloseIcon").click();
    });
    
    var get_category_value = async() => {
        return page.evaluate(async () => { 
                return await new Promise(resolve => { 
                    var  indexMatchingText = (ele, text) => {
                        var patt = new RegExp(text, "gi");
                        for (var i=0; i<ele.length;i++) {
                            if (patt.test(ele[i].childNodes[0].nodeValue)){

                                return ele[i].value;
                                //return i;
                            }
                        }
                        return undefined;
                    };

                    var select_cat_input = document.querySelector("select[name=category]");
                    var id = indexMatchingText(select_cat_input, "normal");            
                    resolve(id);
                });
        });
    };
    await sleep(500);
    var category_id = await get_category_value();
    await page.select('select[name=category]', category_id);
    await sleep(500);
    await page.evaluate(() => { 
        $(".popup-appCloseIcon").click();
        $(".close").click();
        $(".popupCloseIcon").click();
    });
   
    await sleep(500);
    await page.hover('input[name=verification_code]');
    await sleep(500);
    await Promise.all([
        page.click('input[name=verification_code]'),
        page.waitForNavigation({ waitUntil: 'networkidle0' })
    ]);
    
    await sleep(500);
    var is_verification_code_sent = await page.evaluate(() => (/Verification.*code.*sent.*to.*your.*email./im).test($("body").html()) );
    if(! is_verification_code_sent)
    {
        console.log(0);
        console.log("verification code not sent");
        process.exit();
    }
    await page.evaluate(() => { 
        $(".popup-appCloseIcon").click();
        $(".close").click();
        $(".popupCloseIcon").click();
    });
    
    await sleep(500);

    var verification_token_command = async function(checkermail, checkerpass) {
        const { stdout, stderr } = await exec( 'php artisan bls:requestverfication '+ checkermail + " " + checkerpass);
        if(stderr) throw "error";
        return  stdout.trim();
    };
    
    var verification_code = await verification_token_command(cli.email, cli.password);
    await page.type('input[name="otp"]', verification_code);
    await sleep(500);
    await page.hover('input[name=save]');
    await sleep(500);
    await Promise.all([
        page.click('input[name=save]'),
        page.waitForNavigation({ waitUntil: 'load' })
    ]);
    await sleep(500);
    var is_agreement = await page.evaluate(() => (/I.*agree.*to.*provide.*my.*Consent/im).test($("body").html()) );
    if(!is_agreement)
    {
        console.log(0);
        console.log("Not Agreement page");
        process.exit();
    }
    const cookies = await page.cookies();
    
    var headers = "";
    cookies.forEach((currentValue, index, arr) => {
        if((/PHPSESSID/im).test(currentValue.name))
        {
            headers = "PHPSESSID=" + currentValue.value ;

        }
    });
    if(! (/PHPSESSID/im).test(headers) )
    {
        console.log(0);
        console.log("php session Id not found");
        process.exit();
    }
    
     console.log(1);
     console.log(headers);
     await browser.close();
     process.exit();
 })();