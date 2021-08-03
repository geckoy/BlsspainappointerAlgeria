var util = require('util');
var exec = util.promisify(require('child_process').exec);

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

    }else if(index == 3)
    {
        _arg.phone = currentValue;

    }else if(index == 4)
    {
        _arg.center = currentValue;
    }
    });

   return _arg;
 };
 get_cli_arg().then(
     val => console.log(val)
 );
var otp_token_command = async function(checkermail, checkerpass) {
    const { stdout, stderr } = await exec( 'DIR');
    if(stderr) throw "error";
    return  stdout.trim();
};

otp_token_command().then(val => {
    console.log(val)
});