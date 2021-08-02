var util = require('util');
var exec = util.promisify(require('child_process').exec);

var otp_token_command = async function(checkermail, checkerpass) {
    const { stdout, stderr } = await exec( 'DIR');
    if(stderr) throw "error";
    return  stdout.trim();
};

otp_token_command().then(val => {
    console.log(val)
});