/**
 * @Dependecies
 */
 var puppeteer = require('puppeteer');
 var fs = require('fs');
 var http = require('http');
 var util = require('util');
 var readline = require('readline');
 var mysql = require('mysql');
 var exec = util.promisify(require('child_process').exec);


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

        }
        
        myResolve(config);
    });
 });
    return promise;
}

/* Create mysql Db connection */
var set_up_db = async function()
{
    var config = await set_up_config();
    var args = {
        host: config.host,//Db.Host
        user: config.user,//Db.Username
        password: config.password,//Db.Password
        database: config.database//Db.Name
      };
    var con = mysql.createConnection(args);
    return con;
}



var get_checker = async function() {
    var con = await set_up_db();
    var checker = {};  
   
    var query_checker = new Promise( myResolve => {
        con.query("SELECT * FROM gmailcheckers WHERE isLogged = 0 AND isBad = 0;", function (err, result) {
            if (err) throw err;
            if(result[0] == undefined) {
                myResolve(false);
                return;
            }

            var d = new Date();
            var current_Time = d.getFullYear() + "-"+ (((d.getMonth() + 1)< 10)? "0"+(d.getMonth() + 1) : (d.getMonth() + 1) ) + "-"+d.getDate() + " " + d.getHours() + ":" + ((d.getMinutes() < 10) ?("0"+d.getMinutes()) : d.getMinutes()) + ":" + ((d.getSeconds() < 10 )? ("0" + d.getSeconds()) : d.getSeconds());
            var timestamp = Math.floor(new Date().getTime() / 1000);
            con.query("UPDATE gmailcheckers SET isLogged = 1, isBad = 1, updated_at = '" + current_Time + "',referer = 'headless', timeout = '" + ( timestamp + 2100 )+ "' WHERE gmail = '" + (result[0]).gmail + "';", function (err, result) {
                if (err) throw err;
            });
            myResolve(result[0]);
        });
    });
   
    
    checker_obj = await query_checker;
    
    if( checker_obj === false )
    {
        checker_obj = new Promise( myResolve => {
            var timestamp = Math.floor(new Date().getTime() / 1000);
            con.query("SELECT * FROM gmailcheckers WHERE isLogged = 0 AND isBad = 1 AND timeout < '" + timestamp + "';", function (err, result) {
                if (err) throw err;
                if(result[0] == undefined) {
                   console.log( "no checker available" );
                   process.abort();
                }
                var d = new Date();
                var current_Time = d.getFullYear() + "-"+ (((d.getMonth() + 1)< 10)? "0"+(d.getMonth() + 1) : (d.getMonth() + 1) ) + "-"+d.getDate() + " " + d.getHours() + ":" + ((d.getMinutes() < 10) ?("0"+d.getMinutes()) : d.getMinutes()) + ":" + ((d.getSeconds() < 10 )? ("0" + d.getSeconds()) : d.getSeconds());
                var timestamp = Math.floor(new Date().getTime() / 1000);
                con.query("UPDATE gmailcheckers SET isLogged = 1, isBad = 1, updated_at = '" + current_Time + "',referer = 'headless', timeout = '" + ( timestamp + 2100 )+ "' WHERE gmail = '" + (result[0]).gmail + "';", function (err, result) {
                    if (err) throw err;
                });
                
                myResolve(result[0]);
            });
        });
    }


    checker_obj = await checker_obj;


    var set_up_checker_data = new Promise( myResolve => {
        checker.id = checker_obj.id;
        checker.gmail = checker_obj.gmail;
        checker.password = checker_obj.password;
        checker.password_bls = checker_obj.password_bls;
        myResolve(checker);
    });

    return set_up_checker_data;
};


// get_checker().then(
//     val => { console.log( val ) }
// );





var otp_token_command = async function(checkerid) {
    const { stdout, stderr } = await exec( 'php artisan bls:requestotp '+ checkerid );
    if(stderr) throw "error";
    return  stdout.trim();
};

 
  
//  get_otp_token(7).then(
//     function(value) { console.log( value ); }
//   );

 
 
 (async () => {

     var config = await set_up_config();
     var con = await set_up_db();
     var checker = await get_checker();
     const browser = await puppeteer.launch(); //{ headless: false }
     const page = await browser.newPage(); 



    await page.goto(config.loginurl, {
        waitUntil: 'load',
      });
    await page.type('input[name="user_email"]', checker.gmail);
    await Promise.all([
      page.click('input[name="continue"]'),
      page.waitForNavigation({ waitUntil: 'networkidle0' })
    ]);
    
   //Current session expired,Please click button again.
   var captcha_error = await page.evaluate(() => (/Current session expired,Please click button again./im).test($("body").html()) );
    if(captcha_error)
    {
        console.log("captcha ERROR");
        process.abort();
    }
     
   var otp_already_sent = await page.evaluate(() => (/You have already sent OTP request.Please try after 30 min./im).test($("body").html()) );
    if(otp_already_sent)
    {
        var d = new Date();
        var current_Time = d.getFullYear() + "-"+ (((d.getMonth() + 1)< 10)? "0"+(d.getMonth() + 1) : (d.getMonth() + 1) ) + "-"+d.getDate() + " " + d.getHours() + ":" + ((d.getMinutes() < 10) ?("0"+d.getMinutes()) : d.getMinutes()) + ":" + ((d.getSeconds() < 10 )? ("0" + d.getSeconds()) : d.getSeconds());
        var timestamp = Math.floor(new Date().getTime() / 1000);
        con.query("UPDATE gmailcheckers SET isLogged = 0, isBad = 1, updated_at = '" + current_Time + "',referer = NULL, timeout = '" + ( timestamp + 2100 )+ "' WHERE gmail = '" + checker.gmail + "';", function (err, result) {
            if (err) throw err;
        });
        process.abort();
    }
    
    var token = await otp_token_command(checker.id);
    

    await page.type('input[name="otp"]', token);
    await page.type('input[name="user_password"]', checker.password_bls);
    await Promise.all([
      page.click('input[name="login"]'),
      page.waitForNavigation({ waitUntil: 'networkidle0' })
    ]);

    

     var sender = function(token) {
         if(token == "" || token == undefined || token == null)
         {
            var d = new Date();
            var current_Time = d.getFullYear() + "-"+ (((d.getMonth() + 1)< 10)? "0"+(d.getMonth() + 1) : (d.getMonth() + 1) ) + "-"+d.getDate() + " " + d.getHours() + ":" + ((d.getMinutes() < 10) ?("0"+d.getMinutes()) : d.getMinutes()) + ":" + ((d.getSeconds() < 10 )? ("0" + d.getSeconds()) : d.getSeconds());
            var timestamp = Math.floor(new Date().getTime() / 1000);
            con.query("UPDATE gmailcheckers SET isLogged = 0, isBad = 1, updated_at = '" + current_Time + "',referer = NULL, timeout = '" + ( timestamp + 2100 )+ "' WHERE gmail = '" + checker.gmail + "';", function (err, result) {
                if (err) throw err;
            });
            process.abort();
         }
         var d = new Date();
         var current_Time = d.getFullYear() + "-"+ (((d.getMonth() + 1)< 10)? "0"+(d.getMonth() + 1) : (d.getMonth() + 1) ) + "-"+d.getDate() + " " + d.getHours() + ":" + ((d.getMinutes() < 10) ?("0"+d.getMinutes()) : d.getMinutes()) + ":" + ((d.getSeconds() < 10 )? ("0" + d.getSeconds()) : d.getSeconds());
         var timestamp = Math.floor(new Date().getTime() / 1000);
         
             var sql = "INSERT INTO chaptcha_keys (captcha_token, expiry,created_at,updated_at) VALUES ('" + token + "', '"+ ( timestamp + 90) + "', '"+ current_Time +"', '"+ current_Time +"')";
             con.query(sql, function (err, result) {
                 if (err) throw err;
             });

         fs.appendFile('bookappointment_key.txt', (current_Time + " "+ timestamp + " " + token +"\n"), function (err) { if (err) throw err;});
     };
 
    await page.exposeFunction("sender", sender);
     
    await page.evaluate( (config) => {       setInterval(() => { grecaptcha.ready(function() { grecaptcha.execute(config.CaptchaWebsite_Key, {action: config.action}).then(function(token) {  sender(token);  });})},1000)                       }, config);
    
 
    // console.log("end");
     //process.abort();
     //await browser.close();
 })();
 
 