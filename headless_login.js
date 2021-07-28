/**
 * @Dependecies
 */
var puppeteer = require('puppeteer');
var fs = require('fs');
var readline = require('readline');
var mysql = require('mysql');


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

        }
        
        myResolve(config);
    });
 });
    return promise;
}

/* Create mysql Db connection */
  var con = mysql.createConnection({
    host: "127.0.0.1",//Db.Host
    user: "root",//Db.Username
    password: "mysql",//Db.Password
    database: "blsvisa"//Db.Name
  });


(async () => {
    var config = await set_up_config();
    const browser = await puppeteer.launch({ headless: false });
    const page = await browser.newPage();
    // page.setUserAgent("userAgent");
    /*
    {
        ignoreHTTPSErrors: true,
        args: [ '--proxy-server=https://41.174.179.147:8080' ]
    }
    */


    await page.goto(config.loginurl);
    
    var sender = function(token) {
      if(token == "" || token == undefined || token == null)
         {
            process.abort();
         }
        var d = new Date();
        var current_Time = d.getFullYear() + "-"+ (((d.getMonth() + 1)< 10)? "0"+(d.getMonth() + 1) : (d.getMonth() + 1) ) + "-"+d.getDate() + " " + d.getHours() + ":" + ((d.getMinutes() < 10) ?("0"+d.getMinutes()) : d.getMinutes()) + ":" + ((d.getSeconds() < 10 )? ("0" + d.getSeconds()) : d.getSeconds());
        var timestamp = Math.floor(new Date().getTime() / 1000);
        
            var sql = "INSERT INTO chaptcha_keys_logins (captcha_token, expiry,created_at,updated_at) VALUES ('" + token + "', '"+ ( timestamp + 90) + "', '"+ current_Time +"', '"+ current_Time +"')";
            con.query(sql, function (err, result) {
                if (err) throw err;
            });
 

        fs.appendFile('login_key.txt', (current_Time + " "+ timestamp + " " + token +"\n"), function (err) { if (err) throw err;});
    };


    await page.exposeFunction("sender", sender);
    
    await page.evaluate( () => { setInterval(() => { grecaptcha.ready(function() { grecaptcha.execute("6LcLZaAUAAAAAArQGCwKgkh8SQ9_fcCjSpiUFqxZ", {action: "al_login"}).then(function(token) {  sender(token);  });})},1000)  });
    

    //console.log("end");
    //process.abort();
    //await browser.close();
})();
