/**
 * @Dependecies
 */
var puppeteer = require('puppeteer');
var fs = require('fs');
var readline = require('readline');
var mysql = require('mysql');


// const http = require('http');

var config = {};//"app/lib/config.txt"
var configs = readline.createInterface({
    input: fs.createReadStream("app/lib/config.txt")
  });
  const pattern_url = /^url=/i;
  const pattern_CaptchaWebsite_Key = /^CaptchaWebsite_Key=/i;
  const pattern_action = /^action=/i;
  const pattern_center = /^center=/i;
  
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
    }
  });


/* Create mysql Db connection */
  var con = mysql.createConnection({
    host: "127.0.0.1",//Db.Host
    user: "root",//Db.Username
    password: "mysql",//Db.Password
    database: "blsvisa"//Db.Name
  });

  
/**
 * Helpers
 */
 function time()
 {
   var d = new Date();
   var current_Time = d.getFullYear() + "-"+ (((d.getMonth() + 1)< 10)? "0"+(d.getMonth() + 1) : (d.getMonth() + 1) ) + "-"+d.getDate() + " " + d.getHours() + ":" + ((d.getMinutes() < 10) ?("0"+d.getMinutes()) : d.getMinutes()) + ":" + ((d.getSeconds() < 10 )? ("0" + d.getSeconds()) : d.getSeconds());
   return current_Time;
 }

 function unix_time() {
    var timestamp = Math.floor(new Date().getTime() / 1000);
    return timestamp;
}

(async () => {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    // page.setUserAgent("userAgent");
    /*
    {
        ignoreHTTPSErrors: true,
        args: [ '--proxy-server=https://41.174.179.147:8080' ]
    }
    */


    await page.goto("https://algeria.blsspainvisa.com/english/login.php");// 
    // function token() https://www.google.com
    // {}
    // fs.appendFile('mynewfile1.txt', ' This is my text.', function (err) { if (err) throw err;});
    

    //image = await page.screenshot({ path: 'bls.png' });
    /* token = */ 
    var sender = function(token) {
        var d = new Date();
        var current_Time = d.getFullYear() + "-"+ (((d.getMonth() + 1)< 10)? "0"+(d.getMonth() + 1) : (d.getMonth() + 1) ) + "-"+d.getDate() + " " + d.getHours() + ":" + ((d.getMinutes() < 10) ?("0"+d.getMinutes()) : d.getMinutes()) + ":" + ((d.getSeconds() < 10 )? ("0" + d.getSeconds()) : d.getSeconds());
        var timestamp = Math.floor(new Date().getTime() / 1000);
        
            var sql = "INSERT INTO chaptcha_keys_logins (captcha_token, expiry,created_at,updated_at) VALUES ('" + token + "', '"+ ( timestamp + 90) + "', '"+ current_Time +"', '"+ current_Time +"')";
            con.query(sql, function (err, result) {
                if (err) throw err;
            });
 

        fs.appendFile('mynewfile2.txt', (current_Time + " "+ timestamp + " " + token +"\n"), function (err) { if (err) throw err;});
    };

    page.exposeFunction("sender", sender)
    
    await page.evaluate( () => {       setInterval(() => { grecaptcha.ready(function() { grecaptcha.execute("6LcLZaAUAAAAAArQGCwKgkh8SQ9_fcCjSpiUFqxZ", {action: "al_login"}).then(function(token) {  sender(token);  });})},1000)                       });
    // var token = await page.evaluate( () => {  return document.getElementById('g-recaptcha-response').value; });

    console.log("end");
    //process.abort();
    //await browser.close();
})();


  

// async function run() {
//     const browser = await puppeteer.launch({
//         headless: false,
//         ignoreHTTPSErrors: true,
//         args: [ '--proxy-server=185.38.111.1:8080' ]
//       });
//     const page = await browser.newPage();
//     // page.setUserAgent("userAgent");
// /* 
// {
//     ignoreHTTPSErrors: true,
//      args: [ '--proxy-server=https://41.174.179.147:8080' ]
//   }
// */
//     // page.deleteCookie({
//     //     name : "PHPSSID",
//     //     url:"https://blsspainvisa.com/"
//     // });
//     // page.deleteCookie({
//     //     name : "AWSALB",
//     //     url:"https://blsspainvisa.com/"
//     // });
//     // page.deleteCookie({
//     //     name : "AWSALBCORS",
//     //     url:"https://blsspainvisa.com/"
//     // });
//     await page.goto('https://www.whatismyipaddress.com/');
//     //image = await page.screenshot({ path: 'bls.png' });
//     //console.log("end");
//     //await browser.close();
// }

// run();



// http.createServer(function (req, res) {
//     res.write(Db.Username); //write a response to the client
//     res.end(); //end the response
// }).listen(8080);




//   http.createServer(function (req, res) {
//     res.writeHead(200, {'Content-Type': 'text/html'});
//     res.end("test");
//   }).listen(8080);


