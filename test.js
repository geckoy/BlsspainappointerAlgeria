const puppeteer = require('puppeteer');

(async () => {
  const browser = await puppeteer.launch({ 
    args: [ '--proxy-server=85.208.104.25:45785','--no-sandbox' ]
  });
  
  const page = await browser.newPage();
  await page.goto('https://icanhazip.com/');
  //await page.screenshot({ path: 'example.png' });
  var ip_adress = await page.evaluate(() => {
    $("body").text();
  });
  console.log(ip_adress);
  //await browser.close();
})();












// /**
//  * @Dependecies
//  */
//  var puppeteer = require('puppeteer');
//  var fs = require('fs');
//  var readline = require('readline');
//  var util = require('util');
//  var exec = util.promisify(require('child_process').exec);
//  var userAgent = require('user-agents');
 
//  // const http = require('http');
//  var set_up_config = async function()
//  {
//   var promise = new Promise( myResolve => {
//      var config = {};//"app/lib/config.txt"
//      var configs = readline.createInterface({
//          input: fs.createReadStream("app/lib/config.txt")
//      });
//      const pattern_url = /^url=/i;
//      const pattern_CaptchaWebsite_Key = /^CaptchaWebsite_Key=/i;
//      const pattern_action = /^action=/i;
//      const pattern_center = /^center=/i;
//      const pattern_captchaurl = /^captchaurl=/i;
//      const pattern_loginurl = /^loginurl=/i;
//      const pattern_appointurl = /^appointurl=/i;
//      const pattern_action_login = /^action_login=/i;
//      const pattern_host = /^host=/i;
//      const pattern_user = /^user=/i;
//      const pattern_password = /^password=/i;
//      const pattern_database = /^database=/i;
     
//      configs.on('line', function (line) {
//          if(pattern_url.test(line))
//          {
//              config.url = line.replace(pattern_url, "");
     
//          }else if(pattern_CaptchaWebsite_Key.test(line))
//          {
//              config.CaptchaWebsite_Key = line.replace(pattern_CaptchaWebsite_Key, "");
     
//          }else if(pattern_action.test(line))
//          {
//              config.action = line.replace(pattern_action, "");
     
//          }else if(pattern_center.test(line))
//          {
//              config.center = line.replace(pattern_center, "");
             
//          }else if(pattern_appointurl.test(line))
//          {
//              config.appointurl = line.replace(pattern_appointurl, "");
 
//          }else if(pattern_captchaurl.test(line))
//          {
//              config.captchaurl = line.replace(pattern_captchaurl, "");
 
//          }else if(pattern_loginurl.test(line))
//          {
//              config.loginurl = line.replace(pattern_loginurl, "");
 
//          }else if(pattern_host.test(line))
//          {
//              config.host = line.replace(pattern_host, "");
 
//          }else if(pattern_user.test(line))
//          {
//              config.user = line.replace(pattern_user, "");
 
//          }else if(pattern_password.test(line))
//          {
//              config.password = line.replace(pattern_password, "");
 
//          }else if(pattern_database.test(line))
//          {
//              config.database = line.replace(pattern_database, "");
 
//          }else if(pattern_action_login.test(line))
//          {
//              config.action_login = line.replace(pattern_action_login, "");
 
//          }
//          myResolve(config);
//      });
//   });
 
//      return promise;
//  };
 
 

//  var get_cli_arg = async function()
//  {
//      var arguments =  process.argv.slice(2);
//      var _arg = {};
//      if(arguments.length === 0 )
//      {
//          await page.close();
//          await browser.close();
//          console.log(0);
//          console.log("empty argument applicant_logger");
//          process.exit();
//      }
//     arguments.forEach((currentValue, index, arr) => {
    
//         if(index == 0)
//         {
//             _arg.email = currentValue;
    
//         }else if(index == 1)
//         {
//             _arg.password = currentValue;
    
//         }else if(index == 2)
//         {
//             _arg.blspass = currentValue;
    
//         }else if(index == 3)
//         {
//             _arg.phone = currentValue;
    
//         }else if(index == 4)
//         {
//             _arg.center = currentValue;
    
//         }else if(index == 5)
//         {
//             _arg.membercount = currentValue;

//         }else if(index == 6)
//         {
//             if((/%/im).test(currentValue))
//             {
                
//                 _arg.entryfor = [];
//                 var ppl_array = currentValue.split("%");
//                 ppl_array.forEach((currentValue_ppl, index, arr) => {
//                     var ppl_array_data = currentValue_ppl.split(",");
//                     var ppl = {};
//                     ppl_array_data.forEach((currentValue_ppldata, index, arr) => {
//                         if(index == 0)
//                         {
//                             ppl.family_name = currentValue_ppldata
//                         }else if(index == 1)
//                         {
//                             ppl.first_name = currentValue_ppldata
//                         }else if(index == 2)
//                         {
//                             ppl.passport = currentValue_ppldata
//                         }else if(index == 3)
//                         {
//                             ppl.born = currentValue_ppldata
//                         }else if(index == 4)
//                         {
//                             ppl.passportsub = currentValue_ppldata
//                         }else if(index == 5)
//                         {
//                             ppl.passportex = currentValue_ppldata
//                         }else if(index == 6)
//                         {
//                             ppl.passportplace = currentValue_ppldata
//                         }
//                     });
//                     (_arg.entryfor).push(ppl);
//                 });
//             }else{
//                 var ppl = {};
//                 _arg.entryfor = [];
//                 var ppl_array_data = currentValue.split(",");
//                 ppl_array_data.forEach((currentValue_ppldata, index, arr) => {
//                     if(index == 0)
//                     {
//                         ppl.family_name = currentValue_ppldata
//                     }else if(index == 1)
//                     {
//                         ppl.first_name = currentValue_ppldata
//                     }else if(index == 2)
//                     {
//                         ppl.passport = currentValue_ppldata
//                     }else if(index == 3)
//                     {
//                         ppl.born = currentValue_ppldata
//                     }else if(index == 4)
//                     {
//                         ppl.passportsub = currentValue_ppldata
//                     }else if(index == 5)
//                     {
//                         ppl.passportex = currentValue_ppldata
//                     }else if(index == 6)
//                     {
//                         ppl.passportplace = currentValue_ppldata
//                     }
//                 });
//                 (_arg.entryfor).push(ppl);
//             }
//         }
//     });

//    return _arg;
//  };

// var otp_token_command = async function(checkermail, checkerpass) {
//     const { stdout, stderr } = await exec( 'php artisan bls:requestotp '+ checkermail + " " + checkerpass);
//     if(stderr) throw "error";
//     return  stdout.trim();
// };

// get_cli_arg().then(
//     val => console.log(val)
// )



// function sleep(ms) 
// {
//     return new Promise(resolve => setTimeout(resolve, ms));
// }



//  (async () => {
//     // try{
//     //   var config = await set_up_config();
//     //   var cli = await get_cli_arg();    
//     //   const browser = await puppeteer.launch({ 
//     //     args: ['--no-sandbox']
//     //     });//{ headless: false }
//     //   const page = await browser.newPage();
      
      
      
      
//     //   // page.setUserAgent("userAgent");
//     //   /*
//     //   {
//     //       ignoreHTTPSErrors: true,
//     //       args: [ '--proxy-server=https://41.174.179.147:8080' ]
//     //   }
//     //   */
      
//     //   await page.setUserAgent(userAgent.toString());
//     //   var response = await page.goto(config.loginurl);//config.loginurl
//     //   await sleep(500);

//     //   await page.type('input[name="user_email"]', cli.email);
//     //   await Promise.all([
//     //     page.click('input[name="continue"]'),
//     //     page.waitForNavigation({ waitUntil: 'networkidle0' })
//     //   ]);
      
//     //   //Current session expired,Please click button again.
//     //   var captcha_error = await page.evaluate(() => (/Current session expired,Please click button again./im).test($("body").html()) );
//     //   if(captcha_error)
//     //   {
//     //       await page.close();
//     //       await browser.close();
//     //       console.log( 0 );
//     //       console.log("captcha ERROR");
//     //       process.exit();
//     //   }
      
//     //   var otp_already_sent = await page.evaluate(() => (/You have already sent OTP request.Please try after 30 min./im).test($("body").html()) );
//     //   if(otp_already_sent)
//     //   {
//     //       await page.close();
//     //       await browser.close();
//     //       console.log( 0 );
//     //       console.log("Otp Already sent");
//     //       process.exit();
//     //   } //We've sent an OTP to the Email cummer.maroc@gmail.com. Please enter it below to complete verification.
      
//     //   var otp_sent = await page.evaluate(() => (/We've sent an OTP to the Email/im).test($("body").html()) );
//     //   if(! otp_sent)
//     //   {
//     //       await page.close();
//     //       await browser.close();
//     //       console.log( 0 );
//     //       console.log("Connection refused");
//     //       process.exit();
//     //   }

//     //   var token = await otp_token_command(cli.email, cli.password);

//     //   await page.type('input[name="otp"]', token);
//     //   await page.type('input[name="user_password"]', cli.blspass);
//     //   await Promise.all([
//     //     page.click('input[name="login"]'),
//     //     page.waitForNavigation({ waitUntil: 'load' })
//     //   ]);
//     //   await sleep(500);

//     //   await page.evaluate(() => { 
//     //       $(".popup-appCloseIcon").click();
//     //       $(".close").click();
//     //       $(".popupCloseIcon").click();
//     //   });
//     //   //Appointment dates are not available.
//     //   var is_appointment_available = await page.evaluate(() => (/Appointment.*for.*the.*Visa.*Application.*Centre/im).test($("body").html()) );
//     //   var is_appointment_not_available = await page.evaluate(() => (/Appointment.*dates.*are.*not.*available./im).test($("body").html()) );
//     //   if(is_appointment_available)
//     //   {
//     //       var sender = async function(html) {
//     //           fs.appendFile('storage/logs/Html_copies.txt', html, function (err) { if (err) throw err;});
//     //           fs.appendFile('storage/logs/Html_copies.txt', "###############74154END###############", function (err) { if (err) throw err;});
//     //       };
//     //       await page.exposeFunction("sender", sender);
//     //       await page.evaluate(() => { 
//     //           function getPageHTML() {
//     //               return "<html>" + $("html").html() + "</html>";
//     //           }
//     //           sender(getPageHTML()); 
//     //       });
          
          
//     //       await page.close();
//     //       await browser.close();
//     //       console.log(1);
//     //       console.log("Appointment Available");
//     //       process.exit();

//     //   }else if(is_appointment_not_available)
//     //   {
//     //       const cookies = await page.cookies();
      
//     //       var headers = "";
//     //       cookies.forEach((currentValue, index, arr) => {
//     //           if((/PHPSESSID/im).test(currentValue.name))
//     //           {
//     //               headers = "PHPSESSID=" + currentValue.value ;

//     //           }
//     //       });
//     //       if(! (/PHPSESSID/im).test(headers) )
//     //       {
//     //           await page.close();
//     //           await browser.close();
//     //           console.log(0);
//     //           console.log("php session Id not found");
//     //           process.exit();
//     //       }
          
//     //       await page.close();
//     //       await browser.close();
//     //       console.log(1);
//     //       console.log(headers);
//     //       process.exit();

//     //   }else
//     //   {
         
//     //       await page.close();
//     //       await browser.close();
//     //       console.log(0);
//     //       console.log("Error occured");
//     //       process.exit();
//     //   }
//     // }catch(err) {
//     //   await page.close();
//     //   await browser.close();
//     //   console.log(0);
//     //   console.log(err);
//     //   process.exit();
//     // }
    
    
//  })();