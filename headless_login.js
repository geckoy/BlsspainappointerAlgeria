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



// /* Create mysql Db connection */
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
};

(async () => {
   
    var config = await set_up_config();
    var con = await set_up_db();
        
    const browser = await puppeteer.launch();//{ headless: false }
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
    
    await page.evaluate( (config) => { setInterval(() => { grecaptcha.ready(function() { grecaptcha.execute(config.CaptchaWebsite_Key, {action: config.action_login}).then(function(token) {  sender(token);  });})},1000)  }, config);
    

    //console.log("end");
    //process.abort();
    //await browser.close();
})();