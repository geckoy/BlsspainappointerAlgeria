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
      return redirect()->away('https://www.xvideos2.com');
        $html = '
        <html><head>



</head><body onload="getRows();" style="">&#xFEFF;<meta charset="UTF-8">
<meta name="description" content="morocco.blsspainvisa.com">
<meta name="keywords" content="morocco.blsspainvisa.com">
<meta name="google-site-verification" content="k-AjmBS5LOIvMtHlcUJCjPj8TDwGUTjaE_2pL76ZrCs">
<title>morocco.blsspainvisa.com</title>
<link rel="shortcut icon" href="images/favicon.ico">

<link href="css/style.css?v1330386707" type="text/css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="css/mobile-responsive.css?v112287773">

<script type="text/javascript" async="" src="https://www.gstatic.com/recaptcha/releases/ecapuzyywmdXQ5gJHS3JQiXe/recaptcha__en.js" crossorigin="anonymous" integrity="sha384-5dRM1m7eE6AZoDz0NjK5VHNVPCC+oM2lfoqs/UmLHmgRBeoZvH2dwAP837BPJXaQ"></script><script async="" src="https://www.google-analytics.com/analytics.js"></script><script src="js/jquery-1.11.0.min.js?v11738152713"></script>

<script src="js/bootstrap-datepicker.js?v11168608134"></script>

<script>

$(document).ready(function() {

$(".menuIcon").click(function(){
$(".navigationPanel").slideToggle();

});
$( document ).on( "focus", ":input", function(){
        $( this ).attr( "autocomplete", "off" );
});
});	

</script>



<link rel="stylesheet" type="text/css" href="css/flexdropdown.css?v11399038301">

<script src="js/jquery-1.11.0.min.js?v11381626661"></script>

<script src="js/flexdropdown.js?v1820140973">

/***********************************************

* Flex Level Drop Down Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)

* This notice MUST stay intact for legal use

* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more

***********************************************/

</script>

<script>
  (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,"script","https://www.google-analytics.com/analytics.js","ga");

  ga("create", "UA-89671196-1", "auto");
  ga("send", "pageview");

</script>
<link rel="stylesheet" type="text/css" href="css/calendar.css?v=1810665778">

<style>

span{ float:none;}

.popupPanel{background:rgba(255,255,255,0.8); width:100%; height:100%; position:fixed; left:0px; right:0px; bottom:0px; top:0px; z-index:10000;}

.imageDiv{width:32px; height:32px; position:fixed; left:0px; right:0px; bottom:0px; top:0px; margin:auto;}

tr.hid_tr{ display:none; }

</style>

<script>

var flagCounter = 1;

function ValidateEmail(email) {

var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

return expr.test(email);

}



function removeError(id)

{

  $("#"+id).removeClass("error");

  $("#"+id).removeClass("placeholderColor");

}





function validatePassport(){

	

	var passpostNos = Array();

	var count = 0;

	var alertMsg = "<span class="pass-info" style="position:absolute; bottom: -5px; left: 5px; color:yellow; font-size:11px;">Passport No. Already Entered</span>";

	

	$.each($("input[name="passport_number[]"]"), function(i, e){

		var passport = $(e).val();

		$("input[name="passport_number[]"]:eq("+i+")").removeClass("error");

		$("input[name="passport_number[]"]:eq("+i+")").parent("td").find("span.pass-info").remove();

		

		if($.inArray(passport,passpostNos) == -1){

			passpostNos.push(passport);

		}else{

			count++;

			$("input[name="passport_number[]"]:eq("+i+")").addClass("error");

			$("input[name="passport_number[]"]:eq("+i+")").parent("td").append(alertMsg);	

		}

	});

	

	if(count > 0){

		return false;	

	}

	

	return true;

	

	

}





function validateTimeSlot(evt){

	

	$("input[name="save"]").removeAttr("disabled");

	$("select[name="app_time[]"]").removeClass("error");

	$("select[name="app_time[]"]").parent("td").find("span.time-info").remove();

	

	var appDate = $("#app_date").val() || 0;

	var appTime = $(evt).val() || 0;

	var centerId = "" || 0;

	var visa = "" || "";

	var timeSlots = Array();

	var count = 0;

	var alertMsg = "<span class="time-info" style="position:absolute; bottom: 44px; right: 4px; color:yellow; font-size:11px;">" +  appTime +" [Time Slot Full]</span>";

	var $that = $(evt)

	

	/*$.each($("select[name="app_time[]"]"), function(i, e){

		var timeSlot = $(e).val();

		$("select[name="app_time[]"]:eq("+i+")").removeClass("error");

		$("select[name="app_time[]"]:eq("+i+")").parent("td").find("span.time-info").remove();

		

		if($.inArray(timeSlot,timeSlots) == -1){

			timeSlots.push(timeSlot);

		}else{

			count++;

			$("select[name="app_time[]"]:eq("+i+")").addClass("error");

			$("select[name="app_time[]"]:eq("+i+")").parent("td").append(alertMsg);	

		}

	});

		

	if(count > 0){

		return false;	

	}

	

	return true;*/

	

	/*$.each($("select[name="app_time[]"]"), function(i, e){

		var timeSlot = $(e).val();

		if($.inArray(timeSlot,timeSlots) == -1){

			timeSlots.push(timeSlot);

		}

	});*/

	

	$.ajax({

		url: "ajax.php",

		type: "POST",

		async: false,

		data: {"gofor" : "checkTimeSlot", "appDate" : appDate, "appTime" : appTime, "centerId" : centerId },

		beforeSend: function(){

			$("#overlay").show({

			}, 1500);

			$("select[name="app_time[]"]").removeClass("error");

			$("select[name="app_time[]"]").parent("td").find("span.time-info").remove();

			$("input[name="save"]").attr("disabled", "disabled");

		},

		success: function(data){

			$("input[name="save"]").removeAttr("disabled");

			var resp = JSON.parse(data);

			var searchCount = 1;

			var arrayFilter = Array();

			flagCounter = parseInt(resp.booking_details.total_booked);	

					 

			var find_slot_capacity = resp.slot_details.slot_capacity; 

			var currentTime = $that.val();

			

			if(visa.trim() != ""){

				find_slot_capacity =  parseInt(resp.slot_details.slot_capacity) + parseInt(resp.slot_details.slot_capacity_extra);

			}

			

			$.each($("select[name="app_time[]"]"), function(index, element){	

				if($(element).val() == resp.booking_details.appTime && find_slot_capacity >= resp.booking_details.total_booked){

					flagCounter++;

				}

			});

														

			if( flagCounter > find_slot_capacity ){

				count++;

				$that.addClass("error");

				$that.parent("td").append(alertMsg);	

				$that.val("");

				flagCounter--;

			}else{

				$that.removeClass("error");

				$that.parent("td").find("span.time-info").remove();

			}

			$("#overlay").hide(1500);

		}

		

	});

		

	if(count > 0){

		return false;	

	}

	

	return true;

	

}

	  

function validateFrm(){

var flags=0;

    $.each($(".validate"), function(index, element){

	if($(element).val()!=""){

		$(element).removeClass("error");	

	  }else{

		flags=1;

		$(element).addClass("error");

	  }

	});

	/*if ($("#terms").is(":checked")) {

		$("#termsborder").removeClass("error");

		$("#aterms").css("color","white");

	}

	else {

		flags=1;

		$("#termsborder").addClass("error");

		$("#aterms").css("color","red");

	}*/

	

	

	if(flags==1){

	  return false;

	}else{	

		return confirm("Please confirm all the information and VAS for your application.");	

	}

	

	var a = validatePassport();

	var b = true; //validateTimeSlot();

	

	if(a === true && b === true){

		return true;	

	}

	

	return false;

	

}



function showLoader()

{

    $("#overlay").show({

			}, 1500);

}

function getRows(){

	      var slot = "";

          var nationality = "<option value=2 >Afghanistan</option><option value=6 >Albania</option><option value=62 >Algeria</option><option value=12 >American Samoa</option><option value=7 >Andorra</option><option value=3 >Angola</option><option value=4 >Anguilla</option><option value=13 >Antartica</option><option value=15 >Antigua And Barbuda</option><option value=10 >Argentina</option><option value=11 >Armenia</option><option value=1 >Aruba</option><option value=16 >Australia</option><option value=17 >Austria</option><option value=18 >Azerbaijan</option><option value=26 >Bahamas</option><option value=25 >Bahrain</option><option value=23 >Bangladesh</option><option value=33 >Barbados</option><option value=28 >Belarus</option><option value=20 >Belgium</option><option value=29 >Belize</option><option value=21 >Benin</option><option value=30 >Bermuda</option><option value=35 >Bhutan</option><option value=31 >Bolivia</option><option value=27 >Bosnia and Herzegovina</option><option value=37 >Botswana</option><option value=32 >Brazil</option><option value=251 >British Virgin Islands</option><option value=34 >Brunei</option><option value=24 >Bulgaria</option><option value=22 >Burkina Faso</option><option value=19 >Burundi</option><option value=115 >Cambodia</option><option value=45 >Cameroon</option><option value=39 >Canada</option><option value=50 >Cape Verde Islands</option><option value=54 >Cayman Islands</option><option value=38 >Central African Republic</option><option value=212 >Chad</option><option value=42 >Chile</option><option value=43 >China</option><option value=48 >Colombia</option><option value=49 >Comoros</option><option value=47 >Cook Islands</option><option value=51 >Costa Rica</option><option value=97 >Croatia</option><option value=52 >Cuba</option><option value=55 >Cyprus</option><option value=56 >Czech Republic</option><option value=248 >Democretic Republic Of Congo</option><option value=60 >Denmark</option><option value=58 >Djibouti</option><option value=59 >Dominica</option><option value=61 >Dominican Republic</option><option value=218 >East Timor</option><option value=63 >Ecuador</option><option value=64 >Egypt</option><option value=196 >El Salvador</option><option value=86 >Equatorial Guinea</option><option value=65 >Eritrea</option><option value=68 >Estonia</option><option value=207 >Eswatini</option><option value=69 >Ethiopia</option><option value=71 >Fiji</option><option value=70 >Finland</option><option value=73 >France</option><option value=91 >French Guiana</option><option value=181 >French Polynesia</option><option value=14 >French Southern Territories</option><option value=77 >Gabon</option><option value=84 >Gambia</option><option value=79 >Georgia</option><option value=57 >Germany</option><option value=80 >Ghana</option><option value=81 >Gibraltar</option><option value=87 >Greece</option><option value=89 >Greenland</option><option value=88 >Grenada</option><option value=83 >Guadeloupe</option><option value=90 >Guatemala</option><option value=82 >Guinea</option><option value=85 >Guinea Bissau</option><option value=93 >Guyana</option><option value=98 >Haiti</option><option value=96 >Honduras</option><option value=249 >Hong Kong</option><option value=99 >Hungary</option><option value=106 >Iceland</option><option value=101 >India</option><option value=100 >Indonesia</option><option value=104 >Iran</option><option value=105 >Iraq</option><option value=103 >Ireland</option><option value=107 >Israel</option><option value=108 >Italy</option><option value=44 >Ivory Coast</option><option value=109 >Jamaica</option><option value=111 >Japan</option><option value=110 >Jordan</option><option value=112 >Kazakhstan</option><option value=113 >Kenya</option><option value=116 >Kiribati</option><option value=253 >Kosovo</option><option value=119 >Kuwait</option><option value=114 >Kyrgyzstan</option><option value=120 >Laos</option><option value=130 >Latvia</option><option value=121 >Lebanon</option><option value=127 >Lesotho</option><option value=122 >Liberia</option><option value=123 >Libya</option><option value=125 >Liechtenstein</option><option value=128 >Lithuania</option><option value=129 >Luxembourg</option><option value=250 >Macau</option><option value=135 >Madagascar</option><option value=151 >Malawi</option><option value=152 >Malaysia</option><option value=136 >Maldives</option><option value=140 >Mali</option><option value=141 >Malta</option><option value=138 >Marshall Islands</option><option value=149 >Martinique</option><option value=147 >Mauritania</option><option value=150 >Mauritius</option><option value=153 >Mayotte</option><option value=137 >Mexico</option><option value=75 >Micronesia (Federated States Of)</option><option value=134 >Moldova</option><option value=133 >Monaco</option><option value=144 >Mongolia</option><option value=143 >Montenegro</option><option value=148 >Montserrat</option><option value=132 selected>Morocco</option><option value=146 >Mozambique</option><option value=142 >Myanmar</option><option value=154 >Namibia</option><option value=164 >Nauru</option><option value=163 >Nepal</option><option value=161 >Netherlands</option><option value=8 >Netherlands Antilles</option><option value=166 >New Zealand</option><option value=159 >Nicaragua</option><option value=156 >Niger</option><option value=158 >Nigeria</option><option value=177 >North Korea</option><option value=139 >North Macedonia</option><option value=162 >Norway</option><option value=167 >Oman</option><option value=168 >Pakistan</option><option value=173 >Palau</option><option value=180 >Palestine</option><option value=169 >Panama</option><option value=174 >Papua New Guinea</option><option value=179 >Paraguay</option><option value=171 >Peru</option><option value=172 >Philippines</option><option value=175 >Poland</option><option value=178 >Portugal</option><option value=176 >Puerto Rico</option><option value=182 >Qatar</option><option value=46 >Republic Of Congo</option><option value=183 >Reunion Islands</option><option value=184 >Romania</option><option value=185 >Russian Federation</option><option value=186 >Rwanda</option><option value=192 >Saint Helena</option><option value=117 >Saint Kitts And Nevis</option><option value=124 >Saint Lucia</option><option value=234 >Saint Vincent And The Grenadines</option><option value=241 >Samoa</option><option value=197 >San Marino</option><option value=202 >Sao Tome And Principe</option><option value=187 >Saudi Arabia</option><option value=252 >Scotland</option><option value=189 >Senegal</option><option value=200 >Serbia</option><option value=208 >Seychelles</option><option value=195 >Sierra Leone</option><option value=190 >Singapore</option><option value=204 >Slovakia</option><option value=205 >Slovenia</option><option value=194 >Solomon Islands</option><option value=198 >Somalia</option><option value=245 >South Africa</option><option value=191 >South Georgia And The South Sandwich Islands</option><option value=118 >South Korea</option><option value=201 >South Sudan</option><option value=67 >Spain</option><option value=126 >Sri Lanka</option><option value=188 >Sudan</option><option value=203 >Suriname</option><option value=193 >Svalbard And Jan Mayen Islands</option><option value=206 >Sweden</option><option value=41 >Switzerland</option><option value=209 >Syria</option><option value=224 >Taiwan</option><option value=215 >Tajikistan</option><option value=225 >Tanzania</option><option value=214 >Thailand</option><option value=213 >Togo</option><option value=219 >Tonga</option><option value=220 >Trinidad And Tobago </option><option value=221 >Tunisia</option><option value=222 >Turkey</option><option value=217 >Turkmenistan</option><option value=211 >Turks And Caicos Islands</option><option value=223 >Tuvalu</option><option value=226 >Uganda</option><option value=227 >Ukraine</option><option value=9 >United Arab Emirates</option><option value=78 >United Kingdom</option><option value=231 >United States Of America</option><option value=230 >Uruguay</option><option value=232 >Uzbekistan</option><option value=239 >Vanuatu</option><option value=233 >Vatican City - Holy See</option><option value=235 >Venezuela</option><option value=238 >Vietnam</option><option value=66 >Western Sahara</option><option value=243 >Yemen</option><option value=246 >Zambia</option><option value=247 >Zimbabwe</option>";

		  var visa = "<option value=26>Schengen</option>";

		  var passport = "<option value="02" >Collective passport</option><option value="13" >D. Viaje Apatridas C. New York</option><option value="04" >Diplomatic passport</option><option value="06" >Government official on duty</option><option value="10" >National laissez-passer</option><option value="14" >Official passport</option><option value="01" selected>Ordinary passport</option><option value="08" >Passport of foreigners</option><option value="03" >Protection passport</option><option value="12" >Refugee Travel Document (Geneva Convention)</option><option value="16" >Seaman&rsquo;s book</option><option value="05" >Service passport</option><option value="07" >Special passport</option><option value="11" >UN laissez-passer</option>";

		  var juri = ""

          var max_application_number = 4;

          var count = $("#mainDiv .childDiv").size();

          if(document.getElementById("number_of_application").value==""){

              document.getElementById("number_of_application").value=1;

          }

          var requested = parseInt(document.getElementById("number_of_application").value);

          if(requested>1){

              $("#removeButton").show();

              $("#first_application").show();

          }else{

              $("#removeButton").hide();

              $("#first_application").hide();

          }

          if(requested<=max_application_number){ 

              if(requested>0){

                  if (requested > count) {

					   var firstname = [];

					   var last_name = [];

				       var date_of_birth = [];

				       var passportType = [];

				       var passport_number = [];

				       var pptIssueDate = [];

				       var pptExpiryDate = [];

				       var pptIssuePalace = [];

                      for(i=count; i<requested; i++) {

						  var j= i+ 1;

						  firstname[i] = "";

						  last_name[i] = "";

						  date_of_birth[i] = "";

						  passportType[i] = "";

						  passport_number[i] = "";

						  pptIssueDate[i] = "";

						  pptExpiryDate[i] = "";

						  pptIssuePalace[i] = "";

						  
						    if( typeof firstname[i] === "undefined" )

						    {

								firstname[i]="";

							}

							if( typeof last_name[i] === "undefined" )

						    {

								last_name[i]="";

							}

							if( typeof date_of_birth[i] === "undefined" )

						    {

								date_of_birth[i]="";

							}

							if( typeof passportType[i] === "undefined" )

						    {

								passportType[i]="";

							}

							if( typeof passport_number[i] === "undefined" )

						    {

								passport_number[i]="";

							}

							if( typeof pptIssueDate[i] === "undefined" )

						    {

								pptIssueDate[i]="";

							}

							if( typeof pptExpiryDate[i] === "undefined" )

						    {

								pptExpiryDate[i]="";

							}

							if( typeof pptIssuePalace[i] === "undefined" || pptIssuePalace[i] == "")

						    {

								pptIssuePalace[i]= "";

							}

							

                          var data = "<div class="row marginBottom childDiv" id="mainDiv-"+j+""><div class="row marginBottom"><div class="lineheightExtra">Applicant "+j+"</div></div><table><tr><td width="16%" align="left" valign="middle"  class="captionpnl"><select name="app_time[]" id="app_time-"+j+"" onChange="removeError(this.id);validateTimeSlot(this);" style="width:"" class="form-control-input validate"><option value="" selected="selected">l"heure du rendez-vous</option>"+slot+"</select><div class="caption">Appointment Time</div></td><td width="16%" align="left" valign="middle"  class="captionpnl"><select name="VisaTypeId[]" id="VisaTypeId-"+j+"" onChange="removeError(this.id);" style="width:"" class="form-control-input validate vtype"><option value="" selected="selected">Type de visa</option>"+visa+"</select><div class="caption">Visa Type</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" name="first_name[]" id="first_name-"+j+"" onFocus="removeError(this.id);" placeholder="Prénom"  class="form-control-input upperCase validate" value=""+firstname[i]+"" /><div class="caption">First Name</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Nom de famille" name="last_name[]" id="last_name-"+j+"" onFocus="removeError(this.id);" class="form-control-input upperCase validate" value=""+last_name[i]+"" /><div class="caption">Last Name</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Date de naissance" name="date_of_birth[]" id="date_of_birth-"+j+"" onFocus="removeError(this.id);" class="form-control-input date_of_birth validate" readonly value=""+date_of_birth[i]+""><div class="caption">Date of Birth</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><select name="nationality[]" id="nationality-"+j+"" onChange="removeError(this.id);"  class="form-control-input validate"><option value="" selected="selected">Nationalité</option>"+nationality+"</select><div class="caption">Nationality</div></td></tr><tr><td width="16%" align="left" valign="middle" class="captionpnl"><select name="passportType[]" id="passportType-"+j+"" onFocus="removeError(this.id);"  class="form-control-input validate"><option value="" selected="selected">Type de passeport </option>"+passport+"</select><div class="caption">Passport Type</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="No de passeport" name="passport_number[]" id="passport_number-"+j+"" onFocus="removeError(this.id);"  class="form-control-input upperCase validate" value=""+passport_number[i]+"" /><div class="caption">Passport Number</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Date d"émission" name="pptIssueDate[]" class="form-control-input pptIssueDate validate"  id="pptIssueDate-"+j+"" onFocus="removeError(this.id);" readonly value=""+pptIssueDate[i]+""><div class="caption">Passport Issue Date</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Date d"expiration" name="pptExpiryDate[]" class="form-control-input passport_validate_till validate" id="pptExpiryDate-"+j+"" onFocus="removeError(this.id);" readonly value=""+pptExpiryDate[i]+""><div class="caption">Passport Expiry Date</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Lieu d"émission" name="pptIssuePalace[]" class="form-control-input upperCase validate"  id="pptIssuePalace-"+j+"" onFocus="removeError(this.id);" value=""+pptIssuePalace[i]+""><div class="caption">Passport Issue Place</div></td></tr></table></div>";

                          var $ctrl = data; 

                          $("#mainDiv").append($ctrl);

						  var dtJS  = "2021-08-04";

						  $(".date_of_birth").datepicker({

								format: "yyyy-mm-dd",

								endDate: new Date(dtJS),

								startDate: "-100y",

								autoclose: true,

								startView: 2

						  });

						  $(".pptIssueDate").datepicker({

								format: "yyyy-mm-dd",

								endDate: new Date(dtJS),

								startDate: "-100y",

								autoclose: true,

								startView: 2

							});

						  $(".passport_validate_till").datepicker({

								format: "yyyy-mm-dd",

								startDate: new Date(dtJS),

								autoclose: true,

								startView: 2

						  });

                      }

                  }

                  else if (requested < count) {

                      var x = requested - 1;

                      $("#mainDiv .childDiv:gt(" + x + ")").remove();

                  }

              }else{

                  document.getElementById("number_of_application").value=1;

                  getRows();

              }

          }else{

              document.getElementById("number_of_application").value=max_application_number;

              getRows();

          }

		  

		  var counter = document.getElementById("number_of_application").value;

		  

		  var appTime = null;

		  var VisaTypeId = null;

		  var nationalityId = null;

		  var passportId = null;

		  for(m=1; m<=counter; m++) {

			$("#app_time-"+[m]+" option[value=""+appTime[m-1]+""]").attr("selected","selected");

			$("#VisaTypeId-"+[m]+" option[value="+VisaTypeId[m-1]+"]").attr("selected","selected"); 

			$("#nationality-"+[m]+" option[value="+nationalityId[m-1]+"]").attr("selected","selected");

			$("#passportType-"+[m]+" option[value="+passportId[m-1]+"]").attr("selected","selected"); 

		  }

      }

</script>

<script language="javascript">

$("body").bind("copy paste",function(e) {

    e.preventDefault(); return false; 

});

</script>









<!-- header section -->

<header class="row headerSection pull_left">
<!-- POP UP -->
<script>
function setCookie()
{
     $.ajax({
        type: "POST",
        data: "gofor=setCookie",
        url: "cookie_ajax.php",
        success: function(response)
        {
			document.getElementById("popup").style.display = "none";
        }
    });	
}
</script>
<div class="row paddingInBoxExtra white" style="background:rgba(0,0,0,0.8); position:fixed; bottom:0px;" id="popup">
<div class="wrap">
<div class="container">
<div class="marginRight padding-sm">We use cookies on this site to enhance your user experience, Please <a href="javascript:void(0);" onclick="setCookie();" style="float:none;color:#fff; text-decoration:underline"> click here </a>to proceed further.</div>
<div>
<!--<a href="javascript:void(0);" onclick="setCookie();" class="btn secondry-btn marginRight marginBottomNone">OK, I agree</a>-->
<a href="cookies.php" target="_blank" class="btn secondry-btn marginRight marginBottomNone">Read more</a></div>
</div>
</div>
</div>
<!-- POP UP -->
<div class="wrap">
<div class="row borderBottom">
<h1 class="logoSection"><a href="index.php"><img src="images/bls-logo.png" alt="BLS Logo" title="BLS Logo"></a></h1>
<div class="menuIcon"><img src="images/mobicon.png" width="20" height="20" alt="icon" title="icon"></div>

<div class="paddingInBox marginTop"><span class="padding-sm-updwn followbg">Follow Us</span> <a href="https://www.facebook.com/blsinternationalservices/" target="_blank"><img src="images/fb.png" class="marginLeft pull_right" alt="facebook" title="facebook"></a> <a href="https://twitter.com/blsintlservices" target="_blank"><img src="images/twitter.png" class="marginLeft pull_right" alt="twitter" title="twitter"></a> <a href="https://www.instagram.com/blsinternationalservicesltd/" target="_blank"><img src="images/insta.png" class="marginLeft pull_right" alt="insta" title="insta"></a> <a href="https://in.linkedin.com/company/bls-international-services-ltd" target="_blank"><img src="images/Linkedin.png" class="marginLeft pull_right" alt="Linkedin" title="Linkedin"></a></div>

<div class="pull_right paddingInBox paddingRightNone paddingBottomNone">
<div class="pull_right padding-sm paddingRightNone paddingTopNone">
<h3 class="marginRight paddingRight baseColor label">demande de visa pour l"Espagne <br>
au Maroc <img src="images/flag.jpg" class="pull_right  marginLeft borderAll" alt="flag" title="flag"></h3>
<div class="marginLeft paddingLeft lineheightExtra">
<a href="english/index.php" class="padding-sm"><span class="font11 borderRight paddingRight black">English</span></a>
<a href="spanish/index.php" class="padding-sm"><span class="font11 borderRight paddingRight black">Español</span></a>
<a href="#" class="padding-sm"><span class="font11 black">français</span></a>
</div>
</div>
</div>
</div>

<nav class="navigationPanel">
<a href="index.php"><img src="images/home.png" width="18" height="18" alt="icon" title="icon"></a>
<a href="#" data-flexmenu="flexmenu1">Type de visa</a>
<a href="#" data-flexmenu="flexmenu3">Réservez rendez-vous</a>
<a href="#" data-flexmenu="flexmenu2">informations générales</a>
<a href="track_application.php">Suivez Votre Demande</a>
<a href="#" data-flexmenu="flexmenu4" style="text-transform:none;">FAQs</a>
<a href="contact.php">Contactez nous</a>
<a href="mobile-biometric.php" title="Appliquer à partir de votre domicile"><strong class="blink"><span>Appliquer...</span></strong></a>
<!--HTML for Flex Drop Down Menu 1-->

<!--HTML for Flex Drop Down Menu 1-->

<!--HTML for Flex Drop Down Menu 4-->


<!--HTML for Flex Drop Down Menu 3-->


<!--HTML for Flex Drop Down Menu 3-->

</nav>

</div>
</header>

<!-- /header section -->





<!-- body Panel -->

<div class="row innerbodypanel">



<section class="row aboutUsPanel">

<div class="wrap">

<div class="row">

<h1 class="row fontweightNone alignCenter black marginBottom">formulaire de réservation de rendez-vous</h1>


<div class="row blueBG paddingInBoxExtra roundCornerExtra" style="color:#FFF">

<form name="mrc_app_second_fl" id="mrc_app_second_fl" action="/" method="post" onsubmit="return validateFrm();" autocomplete="off">

<table width="100%" border="0" cellpadding="5" cellspacing="0" align="center">

    <tbody><tr>

    	<td align="center" valign="top">

        	<table width="100%" align="center" cellpadding="0" cellspacing="0" class="">

                <tbody><tr id="app_date_tr" height="30">

                    <td width="20%" class="styleBlack" style="padding-left:10px;">

                        date du rendez-vous: <span style="color:#F00">*</span>

                    </td>

                    <td colspan="2">

                    <input type="text" readonly="" class="form-control-input app_date validate" style="width: 260px;" id="app_date" name="app_date" placeholder="YYYY-MM-DD" onchange="this.form.submit();showLoader();" value="" autocomplete="off">

                    </td>

                </tr>

                <input type="hidden" name="loc_selected" id="loc_selected" value="7" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off">

                <input type="hidden" name="mission_selected" id="mission_selected" value="12" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off">

                <input type="hidden" name="agentId" id="agentId" value="" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off">

                <tr>

                  <td colspan="3" height="5"></td>

                </tr>

                <tr id="loc_tr">

                    <td width="20%" class="" style="padding-left:10px; color:#FFF;">

                        adresse email : <span style="color:#F00">*</span><br>

                    </td>

                    <td colspan="2">

                    <input type="text" name="email" id="email" style="width: 260px;" class="form-control-input" value="wlad.hram@mailerman.site" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" readonly="">

                    </td>

                </tr>

                <tr id="loc_tr">

                    <td width="20%" class="" style="padding-left:10px; color:#FFF;">

                        numéro du téléphone mobile  : <span style="color:#F00">*</span><br>

                    </td>

                    <td colspan="2">

                    <input type="text" name="phone_code" id="phone_code" class="form-control-input" value="212" style="width:50px" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" readonly="">

                    <input type="text" name="phone" id="phone" class="form-control-input marginLeft" value="421652632" style="width:200px" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" readonly="">

                    </td>

                </tr>

                <tr id="loc_tr">

                    <td width="20%" class="" style="padding-left:10px; color:#FFF;">

                        Nombre de demandeurs : <span style="color:#F00">*</span><br>

                    </td>

                    <td colspan="2">

                    <input type="number" name="number_of_application" id="number_of_application" min="1" max="20" value="4" class="form-control-input validate" onkeyup="getRows();" onchange="getRows();" onfocus="removeError(this.id);" style="width:260px;" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off">

                    </td>

                </tr>

                <tr>

                  <td colspan="3" height="5"></td>

                </tr>

                <tr id="slot_tr" height="30">

                    <td colspan="3" align="center" class="styleBlack" style="padding-left:10px;">

                      <strong style="font-size:16px"> DÉTAILS DU DEMANDEUR</strong></td>

                  </tr>

                <tr>

                  <td colspan="3" height="5">

                  <div id="mainDiv">

                    <div class="row marginBottom childDiv" id="mainDiv-1">

                    <div class="row marginBottom" style="" id="first_application">Applicant 1</div> 

                        <table>

                        <tbody><tr>

                        <td width="16%" align="left" valign="middle" class="captionpnl">

                        <select class="form-control-input validate" name="app_time[]" id="app_time-1" onchange="validateTimeSlot(this);" autocomplete="off">					 

                        <option value="" selected="selected">l"heure du rendez-vous</option>

                        
                        </select>

                        <div class="caption">Appointment Time</div>

                        </td>

                        <td width="16%" align="left" valign="middle" class="captionpnl">

                        <select name="VisaTypeId[]" id="VisaTypeId-1" onchange="removeError(this.id);" style="width:" "="" class="form-control-input validate vtype">						

                        <option value="" selected="selected">Type de visa</option>

                        <option value="26">Schengen</option>
                        </select>

                        <div class="caption">Visa Type</div>

                        </td>  

                        <td width="16%" align="left" valign="middle" class="captionpnl">

                        <input type="text" name="first_name[]" id="first_name-1" onfocus="removeError(this.id);" placeholder="Prénom" class="form-control-input upperCase validate" value="" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off">

                        <div class="caption">First Name</div>

                        </td>

                        <td width="16%" align="left" valign="middle" class="captionpnl">

                        <input type="text" placeholder="Nom de famille" name="last_name[]" id="last_name-1" onfocus="removeError(this.id);" class="form-control-input upperCase validate" value="" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off">

                        <div class="caption">Last Name</div>

                        </td>

                        <td width="16%" align="left" valign="middle" class="captionpnl">

                        <input type="text" placeholder="Date de naissance" name="date_of_birth[]" id="date_of_birth-1" onfocus="removeError(this.id);" class="form-control-input date_of_birth validate" value="" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" readonly="">

                        <div class="caption">Date of Birth</div>

                        </td>                      

                        <td width="16%" align="left" valign="middle" class="captionpnl">

                        <select name="nationality[]" id="nationality-1" onchange="removeError(this.id);" class="form-control-input validate">

                        <option value="" selected="selected">Nationalité</option>

                        <option value="2">Afghanistan</option><option value="6">Albania</option><option value="62">Algeria</option><option value="12">American Samoa</option><option value="7">Andorra</option><option value="3">Angola</option><option value="4">Anguilla</option><option value="13">Antartica</option><option value="15">Antigua And Barbuda</option><option value="10">Argentina</option><option value="11">Armenia</option><option value="1">Aruba</option><option value="16">Australia</option><option value="17">Austria</option><option value="18">Azerbaijan</option><option value="26">Bahamas</option><option value="25">Bahrain</option><option value="23">Bangladesh</option><option value="33">Barbados</option><option value="28">Belarus</option><option value="20">Belgium</option><option value="29">Belize</option><option value="21">Benin</option><option value="30">Bermuda</option><option value="35">Bhutan</option><option value="31">Bolivia</option><option value="27">Bosnia and Herzegovina</option><option value="37">Botswana</option><option value="32">Brazil</option><option value="251">British Virgin Islands</option><option value="34">Brunei</option><option value="24">Bulgaria</option><option value="22">Burkina Faso</option><option value="19">Burundi</option><option value="115">Cambodia</option><option value="45">Cameroon</option><option value="39">Canada</option><option value="50">Cape Verde Islands</option><option value="54">Cayman Islands</option><option value="38">Central African Republic</option><option value="212">Chad</option><option value="42">Chile</option><option value="43">China</option><option value="48">Colombia</option><option value="49">Comoros</option><option value="47">Cook Islands</option><option value="51">Costa Rica</option><option value="97">Croatia</option><option value="52">Cuba</option><option value="55">Cyprus</option><option value="56">Czech Republic</option><option value="248">Democretic Republic Of Congo</option><option value="60">Denmark</option><option value="58">Djibouti</option><option value="59">Dominica</option><option value="61">Dominican Republic</option><option value="218">East Timor</option><option value="63">Ecuador</option><option value="64">Egypt</option><option value="196">El Salvador</option><option value="86">Equatorial Guinea</option><option value="65">Eritrea</option><option value="68">Estonia</option><option value="207">Eswatini</option><option value="69">Ethiopia</option><option value="71">Fiji</option><option value="70">Finland</option><option value="73">France</option><option value="91">French Guiana</option><option value="181">French Polynesia</option><option value="14">French Southern Territories</option><option value="77">Gabon</option><option value="84">Gambia</option><option value="79">Georgia</option><option value="57">Germany</option><option value="80">Ghana</option><option value="81">Gibraltar</option><option value="87">Greece</option><option value="89">Greenland</option><option value="88">Grenada</option><option value="83">Guadeloupe</option><option value="90">Guatemala</option><option value="82">Guinea</option><option value="85">Guinea Bissau</option><option value="93">Guyana</option><option value="98">Haiti</option><option value="96">Honduras</option><option value="249">Hong Kong</option><option value="99">Hungary</option><option value="106">Iceland</option><option value="101">India</option><option value="100">Indonesia</option><option value="104">Iran</option><option value="105">Iraq</option><option value="103">Ireland</option><option value="107">Israel</option><option value="108">Italy</option><option value="44">Ivory Coast</option><option value="109">Jamaica</option><option value="111">Japan</option><option value="110">Jordan</option><option value="112">Kazakhstan</option><option value="113">Kenya</option><option value="116">Kiribati</option><option value="253">Kosovo</option><option value="119">Kuwait</option><option value="114">Kyrgyzstan</option><option value="120">Laos</option><option value="130">Latvia</option><option value="121">Lebanon</option><option value="127">Lesotho</option><option value="122">Liberia</option><option value="123">Libya</option><option value="125">Liechtenstein</option><option value="128">Lithuania</option><option value="129">Luxembourg</option><option value="250">Macau</option><option value="135">Madagascar</option><option value="151">Malawi</option><option value="152">Malaysia</option><option value="136">Maldives</option><option value="140">Mali</option><option value="141">Malta</option><option value="138">Marshall Islands</option><option value="149">Martinique</option><option value="147">Mauritania</option><option value="150">Mauritius</option><option value="153">Mayotte</option><option value="137">Mexico</option><option value="75">Micronesia (Federated States Of)</option><option value="134">Moldova</option><option value="133">Monaco</option><option value="144">Mongolia</option><option value="143">Montenegro</option><option value="148">Montserrat</option><option value="132" selected="">Morocco</option><option value="146">Mozambique</option><option value="142">Myanmar</option><option value="154">Namibia</option><option value="164">Nauru</option><option value="163">Nepal</option><option value="161">Netherlands</option><option value="8">Netherlands Antilles</option><option value="166">New Zealand</option><option value="159">Nicaragua</option><option value="156">Niger</option><option value="158">Nigeria</option><option value="177">North Korea</option><option value="139">North Macedonia</option><option value="162">Norway</option><option value="167">Oman</option><option value="168">Pakistan</option><option value="173">Palau</option><option value="180">Palestine</option><option value="169">Panama</option><option value="174">Papua New Guinea</option><option value="179">Paraguay</option><option value="171">Peru</option><option value="172">Philippines</option><option value="175">Poland</option><option value="178">Portugal</option><option value="176">Puerto Rico</option><option value="182">Qatar</option><option value="46">Republic Of Congo</option><option value="183">Reunion Islands</option><option value="184">Romania</option><option value="185">Russian Federation</option><option value="186">Rwanda</option><option value="192">Saint Helena</option><option value="117">Saint Kitts And Nevis</option><option value="124">Saint Lucia</option><option value="234">Saint Vincent And The Grenadines</option><option value="241">Samoa</option><option value="197">San Marino</option><option value="202">Sao Tome And Principe</option><option value="187">Saudi Arabia</option><option value="252">Scotland</option><option value="189">Senegal</option><option value="200">Serbia</option><option value="208">Seychelles</option><option value="195">Sierra Leone</option><option value="190">Singapore</option><option value="204">Slovakia</option><option value="205">Slovenia</option><option value="194">Solomon Islands</option><option value="198">Somalia</option><option value="245">South Africa</option><option value="191">South Georgia And The South Sandwich Islands</option><option value="118">South Korea</option><option value="201">South Sudan</option><option value="67">Spain</option><option value="126">Sri Lanka</option><option value="188">Sudan</option><option value="203">Suriname</option><option value="193">Svalbard And Jan Mayen Islands</option><option value="206">Sweden</option><option value="41">Switzerland</option><option value="209">Syria</option><option value="224">Taiwan</option><option value="215">Tajikistan</option><option value="225">Tanzania</option><option value="214">Thailand</option><option value="213">Togo</option><option value="219">Tonga</option><option value="220">Trinidad And Tobago </option><option value="221">Tunisia</option><option value="222">Turkey</option><option value="217">Turkmenistan</option><option value="211">Turks And Caicos Islands</option><option value="223">Tuvalu</option><option value="226">Uganda</option><option value="227">Ukraine</option><option value="9">United Arab Emirates</option><option value="78">United Kingdom</option><option value="231">United States Of America</option><option value="230">Uruguay</option><option value="232">Uzbekistan</option><option value="239">Vanuatu</option><option value="233">Vatican City - Holy See</option><option value="235">Venezuela</option><option value="238">Vietnam</option><option value="66">Western Sahara</option><option value="243">Yemen</option><option value="246">Zambia</option><option value="247">Zimbabwe</option>
                        </select>

                        <div class="caption">Nationality</div>

                        </td>

                        </tr> 

                        <tr>

                        <td width="16%" align="left" valign="middle" class="captionpnl">

                        <select name="passportType[]" id="passportType-1" onfocus="removeError(this.id);" class="form-control-input validate" autocomplete="off">

                        <option value="" selected="selected">Type de passeport </option>

                        <option value="02">Collective passport</option><option value="13">D. Viaje Apatridas C. New York</option><option value="04">Diplomatic passport</option><option value="06">Government official on duty</option><option value="10">National laissez-passer</option><option value="14">Official passport</option><option value="01" selected="">Ordinary passport</option><option value="08">Passport of foreigners</option><option value="03">Protection passport</option><option value="12">Refugee Travel Document (Geneva Convention)</option><option value="16">Seaman’s book</option><option value="05">Service passport</option><option value="07">Special passport</option><option value="11">UN laissez-passer</option>
                        </select>

                        <div class="caption">Passport Type</div>

                        </td>

                        <td width="16%" align="left" valign="middle" class="captionpnl">

                        <input type="text" placeholder="No de passeport" name="passport_number[]" id="passport_number-1" onfocus="removeError(this.id);" class="form-control-input upperCase validate" value="">

                        <div class="caption">Passport Number</div>

                        </td>

                        <td width="16%" align="left" valign="middle" class="captionpnl">

                        <input type="text" placeholder="Date d" émission"="" name="pptIssueDate[]" class="form-control-input pptIssueDate validate" id="pptIssueDate-1" onfocus="removeError(this.id);" value="" readonly="">

                        <div class="caption">Passport Issue Date</div>

                        </td>

                        <td width="16%" align="left" valign="middle" class="captionpnl">

                        <input type="text" placeholder="Date d" expiration"="" name="pptExpiryDate[]" class="form-control-input passport_validate_till validate" id="pptExpiryDate-1" onfocus="removeError(this.id);" value="" readonly="">

                        <div class="caption">Passport Expiry Date</div>

                        

                        </td> 

                        <td width="16%" align="left" valign="middle" class="captionpnl">

                        <input type="text" placeholder="Lieu d" émission"="" name="pptIssuePalace[]" class="form-control-input upperCase validate" id="pptIssuePalace-1" onfocus="removeError(this.id);" value="" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off">

                        <div class="caption">Passport Issue Place</div>

                        </td>

                        </tr>  

                        </tbody></table>    

                    </div>

                  <div class="row marginBottom childDiv" id="mainDiv-2"><div class="row marginBottom"><div class="lineheightExtra">Applicant 2</div></div><table><tbody><tr><td width="16%" align="left" valign="middle" class="captionpnl"><select name="app_time[]" id="app_time-2" onchange="removeError(this.id);validateTimeSlot(this);" style="width:" "="" class="form-control-input validate"><option value="" selected="selected">l"heure du rendez-vous</option></select><div class="caption">Appointment Time</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><select name="VisaTypeId[]" id="VisaTypeId-2" onchange="removeError(this.id);" style="width:" "="" class="form-control-input validate vtype"><option value="" selected="selected">Type de visa</option><option value="26">Schengen</option></select><div class="caption">Visa Type</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" name="first_name[]" id="first_name-2" onfocus="removeError(this.id);" placeholder="Prénom" class="form-control-input upperCase validate" value=""><div class="caption">First Name</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Nom de famille" name="last_name[]" id="last_name-2" onfocus="removeError(this.id);" class="form-control-input upperCase validate" value=""><div class="caption">Last Name</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Date de naissance" name="date_of_birth[]" id="date_of_birth-2" onfocus="removeError(this.id);" class="form-control-input date_of_birth validate" readonly="" value=""><div class="caption">Date of Birth</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><select name="nationality[]" id="nationality-2" onchange="removeError(this.id);" class="form-control-input validate"><option value="" selected="selected">Nationalité</option><option value="2">Afghanistan</option><option value="6">Albania</option><option value="62">Algeria</option><option value="12">American Samoa</option><option value="7">Andorra</option><option value="3">Angola</option><option value="4">Anguilla</option><option value="13">Antartica</option><option value="15">Antigua And Barbuda</option><option value="10">Argentina</option><option value="11">Armenia</option><option value="1">Aruba</option><option value="16">Australia</option><option value="17">Austria</option><option value="18">Azerbaijan</option><option value="26">Bahamas</option><option value="25">Bahrain</option><option value="23">Bangladesh</option><option value="33">Barbados</option><option value="28">Belarus</option><option value="20">Belgium</option><option value="29">Belize</option><option value="21">Benin</option><option value="30">Bermuda</option><option value="35">Bhutan</option><option value="31">Bolivia</option><option value="27">Bosnia and Herzegovina</option><option value="37">Botswana</option><option value="32">Brazil</option><option value="251">British Virgin Islands</option><option value="34">Brunei</option><option value="24">Bulgaria</option><option value="22">Burkina Faso</option><option value="19">Burundi</option><option value="115">Cambodia</option><option value="45">Cameroon</option><option value="39">Canada</option><option value="50">Cape Verde Islands</option><option value="54">Cayman Islands</option><option value="38">Central African Republic</option><option value="212">Chad</option><option value="42">Chile</option><option value="43">China</option><option value="48">Colombia</option><option value="49">Comoros</option><option value="47">Cook Islands</option><option value="51">Costa Rica</option><option value="97">Croatia</option><option value="52">Cuba</option><option value="55">Cyprus</option><option value="56">Czech Republic</option><option value="248">Democretic Republic Of Congo</option><option value="60">Denmark</option><option value="58">Djibouti</option><option value="59">Dominica</option><option value="61">Dominican Republic</option><option value="218">East Timor</option><option value="63">Ecuador</option><option value="64">Egypt</option><option value="196">El Salvador</option><option value="86">Equatorial Guinea</option><option value="65">Eritrea</option><option value="68">Estonia</option><option value="207">Eswatini</option><option value="69">Ethiopia</option><option value="71">Fiji</option><option value="70">Finland</option><option value="73">France</option><option value="91">French Guiana</option><option value="181">French Polynesia</option><option value="14">French Southern Territories</option><option value="77">Gabon</option><option value="84">Gambia</option><option value="79">Georgia</option><option value="57">Germany</option><option value="80">Ghana</option><option value="81">Gibraltar</option><option value="87">Greece</option><option value="89">Greenland</option><option value="88">Grenada</option><option value="83">Guadeloupe</option><option value="90">Guatemala</option><option value="82">Guinea</option><option value="85">Guinea Bissau</option><option value="93">Guyana</option><option value="98">Haiti</option><option value="96">Honduras</option><option value="249">Hong Kong</option><option value="99">Hungary</option><option value="106">Iceland</option><option value="101">India</option><option value="100">Indonesia</option><option value="104">Iran</option><option value="105">Iraq</option><option value="103">Ireland</option><option value="107">Israel</option><option value="108">Italy</option><option value="44">Ivory Coast</option><option value="109">Jamaica</option><option value="111">Japan</option><option value="110">Jordan</option><option value="112">Kazakhstan</option><option value="113">Kenya</option><option value="116">Kiribati</option><option value="253">Kosovo</option><option value="119">Kuwait</option><option value="114">Kyrgyzstan</option><option value="120">Laos</option><option value="130">Latvia</option><option value="121">Lebanon</option><option value="127">Lesotho</option><option value="122">Liberia</option><option value="123">Libya</option><option value="125">Liechtenstein</option><option value="128">Lithuania</option><option value="129">Luxembourg</option><option value="250">Macau</option><option value="135">Madagascar</option><option value="151">Malawi</option><option value="152">Malaysia</option><option value="136">Maldives</option><option value="140">Mali</option><option value="141">Malta</option><option value="138">Marshall Islands</option><option value="149">Martinique</option><option value="147">Mauritania</option><option value="150">Mauritius</option><option value="153">Mayotte</option><option value="137">Mexico</option><option value="75">Micronesia (Federated States Of)</option><option value="134">Moldova</option><option value="133">Monaco</option><option value="144">Mongolia</option><option value="143">Montenegro</option><option value="148">Montserrat</option><option value="132" selected="">Morocco</option><option value="146">Mozambique</option><option value="142">Myanmar</option><option value="154">Namibia</option><option value="164">Nauru</option><option value="163">Nepal</option><option value="161">Netherlands</option><option value="8">Netherlands Antilles</option><option value="166">New Zealand</option><option value="159">Nicaragua</option><option value="156">Niger</option><option value="158">Nigeria</option><option value="177">North Korea</option><option value="139">North Macedonia</option><option value="162">Norway</option><option value="167">Oman</option><option value="168">Pakistan</option><option value="173">Palau</option><option value="180">Palestine</option><option value="169">Panama</option><option value="174">Papua New Guinea</option><option value="179">Paraguay</option><option value="171">Peru</option><option value="172">Philippines</option><option value="175">Poland</option><option value="178">Portugal</option><option value="176">Puerto Rico</option><option value="182">Qatar</option><option value="46">Republic Of Congo</option><option value="183">Reunion Islands</option><option value="184">Romania</option><option value="185">Russian Federation</option><option value="186">Rwanda</option><option value="192">Saint Helena</option><option value="117">Saint Kitts And Nevis</option><option value="124">Saint Lucia</option><option value="234">Saint Vincent And The Grenadines</option><option value="241">Samoa</option><option value="197">San Marino</option><option value="202">Sao Tome And Principe</option><option value="187">Saudi Arabia</option><option value="252">Scotland</option><option value="189">Senegal</option><option value="200">Serbia</option><option value="208">Seychelles</option><option value="195">Sierra Leone</option><option value="190">Singapore</option><option value="204">Slovakia</option><option value="205">Slovenia</option><option value="194">Solomon Islands</option><option value="198">Somalia</option><option value="245">South Africa</option><option value="191">South Georgia And The South Sandwich Islands</option><option value="118">South Korea</option><option value="201">South Sudan</option><option value="67">Spain</option><option value="126">Sri Lanka</option><option value="188">Sudan</option><option value="203">Suriname</option><option value="193">Svalbard And Jan Mayen Islands</option><option value="206">Sweden</option><option value="41">Switzerland</option><option value="209">Syria</option><option value="224">Taiwan</option><option value="215">Tajikistan</option><option value="225">Tanzania</option><option value="214">Thailand</option><option value="213">Togo</option><option value="219">Tonga</option><option value="220">Trinidad And Tobago </option><option value="221">Tunisia</option><option value="222">Turkey</option><option value="217">Turkmenistan</option><option value="211">Turks And Caicos Islands</option><option value="223">Tuvalu</option><option value="226">Uganda</option><option value="227">Ukraine</option><option value="9">United Arab Emirates</option><option value="78">United Kingdom</option><option value="231">United States Of America</option><option value="230">Uruguay</option><option value="232">Uzbekistan</option><option value="239">Vanuatu</option><option value="233">Vatican City - Holy See</option><option value="235">Venezuela</option><option value="238">Vietnam</option><option value="66">Western Sahara</option><option value="243">Yemen</option><option value="246">Zambia</option><option value="247">Zimbabwe</option></select><div class="caption">Nationality</div></td></tr><tr><td width="16%" align="left" valign="middle" class="captionpnl"><select name="passportType[]" id="passportType-2" onfocus="removeError(this.id);" class="form-control-input validate"><option value="" selected="selected">Type de passeport </option><option value="02">Collective passport</option><option value="13">D. Viaje Apatridas C. New York</option><option value="04">Diplomatic passport</option><option value="06">Government official on duty</option><option value="10">National laissez-passer</option><option value="14">Official passport</option><option value="01" selected="">Ordinary passport</option><option value="08">Passport of foreigners</option><option value="03">Protection passport</option><option value="12">Refugee Travel Document (Geneva Convention)</option><option value="16">Seaman’s book</option><option value="05">Service passport</option><option value="07">Special passport</option><option value="11">UN laissez-passer</option></select><div class="caption">Passport Type</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="No de passeport" name="passport_number[]" id="passport_number-2" onfocus="removeError(this.id);" class="form-control-input upperCase validate" value=""><div class="caption">Passport Number</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Date d" émission"="" name="pptIssueDate[]" class="form-control-input pptIssueDate validate" id="pptIssueDate-2" onfocus="removeError(this.id);" readonly="" value=""><div class="caption">Passport Issue Date</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Date d" expiration"="" name="pptExpiryDate[]" class="form-control-input passport_validate_till validate" id="pptExpiryDate-2" onfocus="removeError(this.id);" readonly="" value=""><div class="caption">Passport Expiry Date</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Lieu d" émission"="" name="pptIssuePalace[]" class="form-control-input upperCase validate" id="pptIssuePalace-2" onfocus="removeError(this.id);" value=""><div class="caption">Passport Issue Place</div></td></tr></tbody></table></div><div class="row marginBottom childDiv" id="mainDiv-3"><div class="row marginBottom"><div class="lineheightExtra">Applicant 3</div></div><table><tbody><tr><td width="16%" align="left" valign="middle" class="captionpnl"><select name="app_time[]" id="app_time-3" onchange="removeError(this.id);validateTimeSlot(this);" style="width:" "="" class="form-control-input validate"><option value="" selected="selected">l"heure du rendez-vous</option></select><div class="caption">Appointment Time</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><select name="VisaTypeId[]" id="VisaTypeId-3" onchange="removeError(this.id);" style="width:" "="" class="form-control-input validate vtype"><option value="" selected="selected">Type de visa</option><option value="26">Schengen</option></select><div class="caption">Visa Type</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" name="first_name[]" id="first_name-3" onfocus="removeError(this.id);" placeholder="Prénom" class="form-control-input upperCase validate" value=""><div class="caption">First Name</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Nom de famille" name="last_name[]" id="last_name-3" onfocus="removeError(this.id);" class="form-control-input upperCase validate" value=""><div class="caption">Last Name</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Date de naissance" name="date_of_birth[]" id="date_of_birth-3" onfocus="removeError(this.id);" class="form-control-input date_of_birth validate" readonly="" value=""><div class="caption">Date of Birth</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><select name="nationality[]" id="nationality-3" onchange="removeError(this.id);" class="form-control-input validate"><option value="" selected="selected">Nationalité</option><option value="2">Afghanistan</option><option value="6">Albania</option><option value="62">Algeria</option><option value="12">American Samoa</option><option value="7">Andorra</option><option value="3">Angola</option><option value="4">Anguilla</option><option value="13">Antartica</option><option value="15">Antigua And Barbuda</option><option value="10">Argentina</option><option value="11">Armenia</option><option value="1">Aruba</option><option value="16">Australia</option><option value="17">Austria</option><option value="18">Azerbaijan</option><option value="26">Bahamas</option><option value="25">Bahrain</option><option value="23">Bangladesh</option><option value="33">Barbados</option><option value="28">Belarus</option><option value="20">Belgium</option><option value="29">Belize</option><option value="21">Benin</option><option value="30">Bermuda</option><option value="35">Bhutan</option><option value="31">Bolivia</option><option value="27">Bosnia and Herzegovina</option><option value="37">Botswana</option><option value="32">Brazil</option><option value="251">British Virgin Islands</option><option value="34">Brunei</option><option value="24">Bulgaria</option><option value="22">Burkina Faso</option><option value="19">Burundi</option><option value="115">Cambodia</option><option value="45">Cameroon</option><option value="39">Canada</option><option value="50">Cape Verde Islands</option><option value="54">Cayman Islands</option><option value="38">Central African Republic</option><option value="212">Chad</option><option value="42">Chile</option><option value="43">China</option><option value="48">Colombia</option><option value="49">Comoros</option><option value="47">Cook Islands</option><option value="51">Costa Rica</option><option value="97">Croatia</option><option value="52">Cuba</option><option value="55">Cyprus</option><option value="56">Czech Republic</option><option value="248">Democretic Republic Of Congo</option><option value="60">Denmark</option><option value="58">Djibouti</option><option value="59">Dominica</option><option value="61">Dominican Republic</option><option value="218">East Timor</option><option value="63">Ecuador</option><option value="64">Egypt</option><option value="196">El Salvador</option><option value="86">Equatorial Guinea</option><option value="65">Eritrea</option><option value="68">Estonia</option><option value="207">Eswatini</option><option value="69">Ethiopia</option><option value="71">Fiji</option><option value="70">Finland</option><option value="73">France</option><option value="91">French Guiana</option><option value="181">French Polynesia</option><option value="14">French Southern Territories</option><option value="77">Gabon</option><option value="84">Gambia</option><option value="79">Georgia</option><option value="57">Germany</option><option value="80">Ghana</option><option value="81">Gibraltar</option><option value="87">Greece</option><option value="89">Greenland</option><option value="88">Grenada</option><option value="83">Guadeloupe</option><option value="90">Guatemala</option><option value="82">Guinea</option><option value="85">Guinea Bissau</option><option value="93">Guyana</option><option value="98">Haiti</option><option value="96">Honduras</option><option value="249">Hong Kong</option><option value="99">Hungary</option><option value="106">Iceland</option><option value="101">India</option><option value="100">Indonesia</option><option value="104">Iran</option><option value="105">Iraq</option><option value="103">Ireland</option><option value="107">Israel</option><option value="108">Italy</option><option value="44">Ivory Coast</option><option value="109">Jamaica</option><option value="111">Japan</option><option value="110">Jordan</option><option value="112">Kazakhstan</option><option value="113">Kenya</option><option value="116">Kiribati</option><option value="253">Kosovo</option><option value="119">Kuwait</option><option value="114">Kyrgyzstan</option><option value="120">Laos</option><option value="130">Latvia</option><option value="121">Lebanon</option><option value="127">Lesotho</option><option value="122">Liberia</option><option value="123">Libya</option><option value="125">Liechtenstein</option><option value="128">Lithuania</option><option value="129">Luxembourg</option><option value="250">Macau</option><option value="135">Madagascar</option><option value="151">Malawi</option><option value="152">Malaysia</option><option value="136">Maldives</option><option value="140">Mali</option><option value="141">Malta</option><option value="138">Marshall Islands</option><option value="149">Martinique</option><option value="147">Mauritania</option><option value="150">Mauritius</option><option value="153">Mayotte</option><option value="137">Mexico</option><option value="75">Micronesia (Federated States Of)</option><option value="134">Moldova</option><option value="133">Monaco</option><option value="144">Mongolia</option><option value="143">Montenegro</option><option value="148">Montserrat</option><option value="132" selected="">Morocco</option><option value="146">Mozambique</option><option value="142">Myanmar</option><option value="154">Namibia</option><option value="164">Nauru</option><option value="163">Nepal</option><option value="161">Netherlands</option><option value="8">Netherlands Antilles</option><option value="166">New Zealand</option><option value="159">Nicaragua</option><option value="156">Niger</option><option value="158">Nigeria</option><option value="177">North Korea</option><option value="139">North Macedonia</option><option value="162">Norway</option><option value="167">Oman</option><option value="168">Pakistan</option><option value="173">Palau</option><option value="180">Palestine</option><option value="169">Panama</option><option value="174">Papua New Guinea</option><option value="179">Paraguay</option><option value="171">Peru</option><option value="172">Philippines</option><option value="175">Poland</option><option value="178">Portugal</option><option value="176">Puerto Rico</option><option value="182">Qatar</option><option value="46">Republic Of Congo</option><option value="183">Reunion Islands</option><option value="184">Romania</option><option value="185">Russian Federation</option><option value="186">Rwanda</option><option value="192">Saint Helena</option><option value="117">Saint Kitts And Nevis</option><option value="124">Saint Lucia</option><option value="234">Saint Vincent And The Grenadines</option><option value="241">Samoa</option><option value="197">San Marino</option><option value="202">Sao Tome And Principe</option><option value="187">Saudi Arabia</option><option value="252">Scotland</option><option value="189">Senegal</option><option value="200">Serbia</option><option value="208">Seychelles</option><option value="195">Sierra Leone</option><option value="190">Singapore</option><option value="204">Slovakia</option><option value="205">Slovenia</option><option value="194">Solomon Islands</option><option value="198">Somalia</option><option value="245">South Africa</option><option value="191">South Georgia And The South Sandwich Islands</option><option value="118">South Korea</option><option value="201">South Sudan</option><option value="67">Spain</option><option value="126">Sri Lanka</option><option value="188">Sudan</option><option value="203">Suriname</option><option value="193">Svalbard And Jan Mayen Islands</option><option value="206">Sweden</option><option value="41">Switzerland</option><option value="209">Syria</option><option value="224">Taiwan</option><option value="215">Tajikistan</option><option value="225">Tanzania</option><option value="214">Thailand</option><option value="213">Togo</option><option value="219">Tonga</option><option value="220">Trinidad And Tobago </option><option value="221">Tunisia</option><option value="222">Turkey</option><option value="217">Turkmenistan</option><option value="211">Turks And Caicos Islands</option><option value="223">Tuvalu</option><option value="226">Uganda</option><option value="227">Ukraine</option><option value="9">United Arab Emirates</option><option value="78">United Kingdom</option><option value="231">United States Of America</option><option value="230">Uruguay</option><option value="232">Uzbekistan</option><option value="239">Vanuatu</option><option value="233">Vatican City - Holy See</option><option value="235">Venezuela</option><option value="238">Vietnam</option><option value="66">Western Sahara</option><option value="243">Yemen</option><option value="246">Zambia</option><option value="247">Zimbabwe</option></select><div class="caption">Nationality</div></td></tr><tr><td width="16%" align="left" valign="middle" class="captionpnl"><select name="passportType[]" id="passportType-3" onfocus="removeError(this.id);" class="form-control-input validate"><option value="" selected="selected">Type de passeport </option><option value="02">Collective passport</option><option value="13">D. Viaje Apatridas C. New York</option><option value="04">Diplomatic passport</option><option value="06">Government official on duty</option><option value="10">National laissez-passer</option><option value="14">Official passport</option><option value="01" selected="">Ordinary passport</option><option value="08">Passport of foreigners</option><option value="03">Protection passport</option><option value="12">Refugee Travel Document (Geneva Convention)</option><option value="16">Seaman’s book</option><option value="05">Service passport</option><option value="07">Special passport</option><option value="11">UN laissez-passer</option></select><div class="caption">Passport Type</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="No de passeport" name="passport_number[]" id="passport_number-3" onfocus="removeError(this.id);" class="form-control-input upperCase validate" value=""><div class="caption">Passport Number</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Date d" émission"="" name="pptIssueDate[]" class="form-control-input pptIssueDate validate" id="pptIssueDate-3" onfocus="removeError(this.id);" readonly="" value=""><div class="caption">Passport Issue Date</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Date d" expiration"="" name="pptExpiryDate[]" class="form-control-input passport_validate_till validate" id="pptExpiryDate-3" onfocus="removeError(this.id);" readonly="" value=""><div class="caption">Passport Expiry Date</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Lieu d" émission"="" name="pptIssuePalace[]" class="form-control-input upperCase validate" id="pptIssuePalace-3" onfocus="removeError(this.id);" value=""><div class="caption">Passport Issue Place</div></td></tr></tbody></table></div><div class="row marginBottom childDiv" id="mainDiv-4"><div class="row marginBottom"><div class="lineheightExtra">Applicant 4</div></div><table><tbody><tr><td width="16%" align="left" valign="middle" class="captionpnl"><select name="app_time[]" id="app_time-4" onchange="removeError(this.id);validateTimeSlot(this);" style="width:" "="" class="form-control-input validate"><option value="" selected="selected">l"heure du rendez-vous</option></select><div class="caption">Appointment Time</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><select name="VisaTypeId[]" id="VisaTypeId-4" onchange="removeError(this.id);" style="width:" "="" class="form-control-input validate vtype"><option value="" selected="selected">Type de visa</option><option value="26">Schengen</option></select><div class="caption">Visa Type</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" name="first_name[]" id="first_name-4" onfocus="removeError(this.id);" placeholder="Prénom" class="form-control-input upperCase validate" value=""><div class="caption">First Name</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Nom de famille" name="last_name[]" id="last_name-4" onfocus="removeError(this.id);" class="form-control-input upperCase validate" value=""><div class="caption">Last Name</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Date de naissance" name="date_of_birth[]" id="date_of_birth-4" onfocus="removeError(this.id);" class="form-control-input date_of_birth validate" readonly="" value=""><div class="caption">Date of Birth</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><select name="nationality[]" id="nationality-4" onchange="removeError(this.id);" class="form-control-input validate"><option value="" selected="selected">Nationalité</option><option value="2">Afghanistan</option><option value="6">Albania</option><option value="62">Algeria</option><option value="12">American Samoa</option><option value="7">Andorra</option><option value="3">Angola</option><option value="4">Anguilla</option><option value="13">Antartica</option><option value="15">Antigua And Barbuda</option><option value="10">Argentina</option><option value="11">Armenia</option><option value="1">Aruba</option><option value="16">Australia</option><option value="17">Austria</option><option value="18">Azerbaijan</option><option value="26">Bahamas</option><option value="25">Bahrain</option><option value="23">Bangladesh</option><option value="33">Barbados</option><option value="28">Belarus</option><option value="20">Belgium</option><option value="29">Belize</option><option value="21">Benin</option><option value="30">Bermuda</option><option value="35">Bhutan</option><option value="31">Bolivia</option><option value="27">Bosnia and Herzegovina</option><option value="37">Botswana</option><option value="32">Brazil</option><option value="251">British Virgin Islands</option><option value="34">Brunei</option><option value="24">Bulgaria</option><option value="22">Burkina Faso</option><option value="19">Burundi</option><option value="115">Cambodia</option><option value="45">Cameroon</option><option value="39">Canada</option><option value="50">Cape Verde Islands</option><option value="54">Cayman Islands</option><option value="38">Central African Republic</option><option value="212">Chad</option><option value="42">Chile</option><option value="43">China</option><option value="48">Colombia</option><option value="49">Comoros</option><option value="47">Cook Islands</option><option value="51">Costa Rica</option><option value="97">Croatia</option><option value="52">Cuba</option><option value="55">Cyprus</option><option value="56">Czech Republic</option><option value="248">Democretic Republic Of Congo</option><option value="60">Denmark</option><option value="58">Djibouti</option><option value="59">Dominica</option><option value="61">Dominican Republic</option><option value="218">East Timor</option><option value="63">Ecuador</option><option value="64">Egypt</option><option value="196">El Salvador</option><option value="86">Equatorial Guinea</option><option value="65">Eritrea</option><option value="68">Estonia</option><option value="207">Eswatini</option><option value="69">Ethiopia</option><option value="71">Fiji</option><option value="70">Finland</option><option value="73">France</option><option value="91">French Guiana</option><option value="181">French Polynesia</option><option value="14">French Southern Territories</option><option value="77">Gabon</option><option value="84">Gambia</option><option value="79">Georgia</option><option value="57">Germany</option><option value="80">Ghana</option><option value="81">Gibraltar</option><option value="87">Greece</option><option value="89">Greenland</option><option value="88">Grenada</option><option value="83">Guadeloupe</option><option value="90">Guatemala</option><option value="82">Guinea</option><option value="85">Guinea Bissau</option><option value="93">Guyana</option><option value="98">Haiti</option><option value="96">Honduras</option><option value="249">Hong Kong</option><option value="99">Hungary</option><option value="106">Iceland</option><option value="101">India</option><option value="100">Indonesia</option><option value="104">Iran</option><option value="105">Iraq</option><option value="103">Ireland</option><option value="107">Israel</option><option value="108">Italy</option><option value="44">Ivory Coast</option><option value="109">Jamaica</option><option value="111">Japan</option><option value="110">Jordan</option><option value="112">Kazakhstan</option><option value="113">Kenya</option><option value="116">Kiribati</option><option value="253">Kosovo</option><option value="119">Kuwait</option><option value="114">Kyrgyzstan</option><option value="120">Laos</option><option value="130">Latvia</option><option value="121">Lebanon</option><option value="127">Lesotho</option><option value="122">Liberia</option><option value="123">Libya</option><option value="125">Liechtenstein</option><option value="128">Lithuania</option><option value="129">Luxembourg</option><option value="250">Macau</option><option value="135">Madagascar</option><option value="151">Malawi</option><option value="152">Malaysia</option><option value="136">Maldives</option><option value="140">Mali</option><option value="141">Malta</option><option value="138">Marshall Islands</option><option value="149">Martinique</option><option value="147">Mauritania</option><option value="150">Mauritius</option><option value="153">Mayotte</option><option value="137">Mexico</option><option value="75">Micronesia (Federated States Of)</option><option value="134">Moldova</option><option value="133">Monaco</option><option value="144">Mongolia</option><option value="143">Montenegro</option><option value="148">Montserrat</option><option value="132" selected="">Morocco</option><option value="146">Mozambique</option><option value="142">Myanmar</option><option value="154">Namibia</option><option value="164">Nauru</option><option value="163">Nepal</option><option value="161">Netherlands</option><option value="8">Netherlands Antilles</option><option value="166">New Zealand</option><option value="159">Nicaragua</option><option value="156">Niger</option><option value="158">Nigeria</option><option value="177">North Korea</option><option value="139">North Macedonia</option><option value="162">Norway</option><option value="167">Oman</option><option value="168">Pakistan</option><option value="173">Palau</option><option value="180">Palestine</option><option value="169">Panama</option><option value="174">Papua New Guinea</option><option value="179">Paraguay</option><option value="171">Peru</option><option value="172">Philippines</option><option value="175">Poland</option><option value="178">Portugal</option><option value="176">Puerto Rico</option><option value="182">Qatar</option><option value="46">Republic Of Congo</option><option value="183">Reunion Islands</option><option value="184">Romania</option><option value="185">Russian Federation</option><option value="186">Rwanda</option><option value="192">Saint Helena</option><option value="117">Saint Kitts And Nevis</option><option value="124">Saint Lucia</option><option value="234">Saint Vincent And The Grenadines</option><option value="241">Samoa</option><option value="197">San Marino</option><option value="202">Sao Tome And Principe</option><option value="187">Saudi Arabia</option><option value="252">Scotland</option><option value="189">Senegal</option><option value="200">Serbia</option><option value="208">Seychelles</option><option value="195">Sierra Leone</option><option value="190">Singapore</option><option value="204">Slovakia</option><option value="205">Slovenia</option><option value="194">Solomon Islands</option><option value="198">Somalia</option><option value="245">South Africa</option><option value="191">South Georgia And The South Sandwich Islands</option><option value="118">South Korea</option><option value="201">South Sudan</option><option value="67">Spain</option><option value="126">Sri Lanka</option><option value="188">Sudan</option><option value="203">Suriname</option><option value="193">Svalbard And Jan Mayen Islands</option><option value="206">Sweden</option><option value="41">Switzerland</option><option value="209">Syria</option><option value="224">Taiwan</option><option value="215">Tajikistan</option><option value="225">Tanzania</option><option value="214">Thailand</option><option value="213">Togo</option><option value="219">Tonga</option><option value="220">Trinidad And Tobago </option><option value="221">Tunisia</option><option value="222">Turkey</option><option value="217">Turkmenistan</option><option value="211">Turks And Caicos Islands</option><option value="223">Tuvalu</option><option value="226">Uganda</option><option value="227">Ukraine</option><option value="9">United Arab Emirates</option><option value="78">United Kingdom</option><option value="231">United States Of America</option><option value="230">Uruguay</option><option value="232">Uzbekistan</option><option value="239">Vanuatu</option><option value="233">Vatican City - Holy See</option><option value="235">Venezuela</option><option value="238">Vietnam</option><option value="66">Western Sahara</option><option value="243">Yemen</option><option value="246">Zambia</option><option value="247">Zimbabwe</option></select><div class="caption">Nationality</div></td></tr><tr><td width="16%" align="left" valign="middle" class="captionpnl"><select name="passportType[]" id="passportType-4" onfocus="removeError(this.id);" class="form-control-input validate"><option value="" selected="selected">Type de passeport </option><option value="02">Collective passport</option><option value="13">D. Viaje Apatridas C. New York</option><option value="04">Diplomatic passport</option><option value="06">Government official on duty</option><option value="10">National laissez-passer</option><option value="14">Official passport</option><option value="01" selected="">Ordinary passport</option><option value="08">Passport of foreigners</option><option value="03">Protection passport</option><option value="12">Refugee Travel Document (Geneva Convention)</option><option value="16">Seaman’s book</option><option value="05">Service passport</option><option value="07">Special passport</option><option value="11">UN laissez-passer</option></select><div class="caption">Passport Type</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="No de passeport" name="passport_number[]" id="passport_number-4" onfocus="removeError(this.id);" class="form-control-input upperCase validate" value=""><div class="caption">Passport Number</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Date d" émission"="" name="pptIssueDate[]" class="form-control-input pptIssueDate validate" id="pptIssueDate-4" onfocus="removeError(this.id);" readonly="" value=""><div class="caption">Passport Issue Date</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Date d" expiration"="" name="pptExpiryDate[]" class="form-control-input passport_validate_till validate" id="pptExpiryDate-4" onfocus="removeError(this.id);" readonly="" value=""><div class="caption">Passport Expiry Date</div></td><td width="16%" align="left" valign="middle" class="captionpnl"><input type="text" placeholder="Lieu d" émission"="" name="pptIssuePalace[]" class="form-control-input upperCase validate" id="pptIssuePalace-4" onfocus="removeError(this.id);" value=""><div class="caption">Passport Issue Place</div></td></tr></tbody></table></div></div>

                  </td>

                </tr>

                <tr>

                  <td colspan="3" height="5"></td>

                </tr>

                
                <!--<tr id="pn_tr" height="30">

                    <td valign="middle" class="styleBlack" width="20%" style="padding-left:10px;">&nbsp;</td>

                    <td width="21%" align="left" valign="middle" id="termsborder">

                       <input type="checkbox" name="terms" id="terms" value="1" style="margin-top:3px;" >&nbsp; <a href="terms-and-condition.php" target="_blank" style="text-decoration:underline; float: none; color:#FFF" id="aterms"></a>

                    </td>

                    <td valign="middle" class="styleBlack" width="59%" style="padding-left:10px;">&nbsp;</td>

                </tr>-->

                <!--<tr  height="85">

                    <td  width="20%" valign="middle" class="styleBlack" style="padding-left:10px;">&nbsp;</td>

                    <td width="40%" align="left" valign="middle">

                    <div>

                    <div style="float:left">

                    <img src="captcha/captcha.php" id="captcha-img" style="margin:0; padding:0"/>

                    </div>

                    <div style="float:left; margin-top:20px; margin-left:10px;">

                    <a href="javascript:void(0)" onclick="document.getElementById("captcha-img").src="captcha/captcha.php?"+Math.random();"

                        id="change-image" style="float:left">

                        	<img border="0" src="images/refresh.png" alt="Not readable? Change text." title="Not readable? Change text." />

                    </a>

                    </div>

                    <div style="clear:both"></div>

                    </div>

                    </td>

                    <td width="59%" align="left" valign="middle">&nbsp;</td>

                </tr>-->

                <!--<tr height="30"  >

                	<td valign="middle" class="styleBlack" width="20%" style="padding-left:10px;">

                    	: <span style="color:#F00">*</span>

                    </td>

                    <td colspan="2" align="left" valign="middle">

                    <input type="text" name="captcha" id="captcha" style="width: 260px;" class="form-control-input validate" /></td>

                </tr>-->

                <tr height="30">

                	<td valign="middle" class="styleBlack" width="20%" style="padding-left:10px;">&nbsp;</td>

                    <td colspan="2" align="left" valign="middle">&nbsp;</td>

                </tr>

                <tr id="submit_tr">

                    <td>&nbsp;</td>

                    <td colspan="2" id="new">	

                        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response" value="03AGdBq24gqGoBBBhnNMjTnGxCmHhRr7UQYPRw-vc3NTnLc158CobkCGZlKMHPK3mH6q9uKP4Ra7dtGPIpX4_fC9DGeBV7GdFFHcEtR7lcYDFmx6NzIN7hmOo0Q-4-UwQ0GnLn2p80zwGZSEu36LXFwEefmjUN315AswNgVedXj991auKAc2SekK2AknnYjhI21oKDu15Bh97qdGARN8e-s0lQ2JX61tVafkaP4ShnMQaNruI2aDJ084uCyshkwxWbGFEf_297LKTkzoGEAryaNe4aArqsUQrPaAC22icQDoxfQ_ohtShlCmfLY2jp-0datt0fSot2xwWpE_l5_8mlP9IzvGMa6_qKwqtP5BTkfSLuu35SMTZvsy-UWAkf4kBJZzSso0HuKTkqNNk_bTh66tdYvANeJxOatBRK-e069YnEKZ6IkwSTKUGuFZ_ykyJFfHisUMx9_NR6LhTkBVypKFeJmgA4YboDvQ">

                        <input type="hidden" name="app_date_hidden" id="app_date_hidden" value="">

                        <input type="hidden" name="loc_final" id="loc_final" value="">

                        <input type="hidden" name="countryID" id="countryID" value="132">

                        <input type="hidden" name="missionId" id="missionId" value="12">

                        <input type="hidden" name="agentId" id="agentId" value="">

                        <input type="submit" name="save" value="Submit" class="btn primary-btn">

                    </td>	

                </tr>

            </tbody></table>

          </td>

      </tr>

</tbody></table>

</form>

</div>

<script type="text/javascript">

	var today = new Date();

	var dd = today.getDate()+1;

	var mm = today.getMonth()+1; //January is 0!

	var yyyy = today.getFullYear();

	if(dd<10){

		dd="0"+dd

	} 

	if(mm<10){

		mm="0"+mm

	} 

	var today = yyyy+"-"+mm+"-"+dd;

	function formatDate(rawDate) {

	  var day = ("0" + rawDate.getDate()).slice(-2);

	  var month = ("0" + (rawDate.getMonth() + 1)).slice(-2);

	  return (day)+ "-" + (month)+ "-" +rawDate.getFullYear() ;

	}		

	$(document).ready(function() {

		var dt1  = "2021-08-04";

		var checkService  = "Normal";

			 $(".date_of_birth").datepicker({

					format: "yyyy-mm-dd",

					endDate: new Date(dt1),

					startDate: "-100y",

					autoclose: true,

					startView: 2

			  });

			  $(".pptIssueDate").datepicker({

					format: "yyyy-mm-dd",

					endDate: new Date(dt1),

					startDate: "-100y",

					autoclose: true,

					startView: 2

				});

			  $(".passport_validate_till").datepicker({

					format: "yyyy-mm-dd",

					startDate: new Date(dt1),

					autoclose: true,

					startView: 2

			  });

		var dt4  = "2021-08-05";

		var blocked_dates = ["01-01-2018","29-03-2018","30-03-2018","01-05-2018","15-06-2018","30-07-2018","15-08-2018","22-08-2018","11-09-2018","12-10-2018","01-11-2018","20-11-2018","06-12-2018","25-12-2018","01-01-2019","18-04-2019","19-04-2019","01-05-2019","05-06-2019","30-07-2019","12-08-2019","15-08-2019","12-10-2019","01-11-2019","18-11-2019","06-12-2019","25-12-2019","01-01-2020","06-01-2020","09-04-2020","10-04-2020","01-05-2020","25-05-2020","30-07-2020","31-07-2020","01-01-2018","29-03-2018","30-03-2018","01-05-2018","15-06-2018","30-07-2018","15-08-2018","22-08-2018","11-09-2018","12-10-2018","01-11-2018","20-11-2018","06-12-2018","25-12-2018","01-01-2019","18-04-2019","19-04-2019","01-05-2019","05-06-2019","30-07-2019","12-08-2019","15-08-2019","12-10-2019","01-11-2019","18-11-2019","06-12-2019","25-12-2019","01-01-2020","06-01-2020","09-04-2020","10-04-2020","01-05-2020","25-05-2020","30-07-2020","31-07-2020"];

		var available_dates = [];

		var fullCapicity_dates = [];

		var offDates_dates = [];

		var allowArray = [1,4];

		if(checkService == "Normal")

		{

			/*if((jQuery.inArray(2, allowArray)!="-1") || (jQuery.inArray(3, allowArray)!="-1") || (jQuery.inArray(4, allowArray)!="-1")) 

			{

				var classFull = "fullcapspecial";

				var tooltipTitle = "&nbsp;";

				var backDatetitle = "Not Allowed";

			}else{

				var classFull = "fullcap";

				var tooltipTitle = "Slots Full";

				var backDatetitle = "Not Allowed";

			}*/

			var classFull = "fullcap";

			var tooltipTitle = "Slots Full";

			var backDatetitle = "Not Allowed";

		}else{

			var classFull = "fullcap";

			var tooltipTitle = "Slots Full";

			var backDatetitle = "Not Allowed";

		}

		$(".app_date").datepicker({

			language: "en",

			Default: true,

			format: "yyyy-mm-dd",

			startDate: new Date(dt4),

			endDate: "2020-07-31", 

			autoclose: true,

			forceParse:true,

			startView: 0,

			beforeShowDay: function(date){

				   var formattedDate = formatDate(date);

				   if ($.inArray(formattedDate.toString(), blocked_dates) != -1){

					   return {

						  enabled : false,

						  classes: "inactiveClass",

						  tooltip: "Holiday"

					   };

				   }

				   if ($.inArray(formattedDate.toString(), available_dates) != -1){

					   return {

						  enabled : true,

						  classes: "activeClass",

						  tooltip: "Book"

					   };

				   }

				   if ($.inArray(formattedDate.toString(), fullCapicity_dates) != -1){

					   return {

						  enabled : false,

						  classes: classFull,

						  tooltip: tooltipTitle

					   };

				   }

				   if ($.inArray(formattedDate.toString(), offDates_dates) != -1){

					   return {

						  enabled : false,

						  classes: "offday",

						  tooltip: "Off Day"

					   };

				   }

				   

					return {

					  enabled : false,

					  tooltip: backDatetitle

				   };

				  return;

			  }

	    });

		/*====== CALL POP FOR PL/PT IN NORMAL CASE=======*/

		if(checkService == "Normal")

		{

			if((jQuery.inArray(2, allowArray)!="-1") || (jQuery.inArray(3, allowArray)!="-1") || (jQuery.inArray(4, allowArray)!="-1")) 

		    {

				/*$(document).on("click", ".fullcap,.fullcapspecial", function () {

				$(".datepicker").hide();

				$(".popupBG").show();

				$("#IDBodyPanel").show();

				});

				$(".popupCloseIcon").click(function() {

				$(".popupBG").hide();

				$("#IDBodyPanel").hide(); 

				});*/

			

				/*$("input[type=radio][name=serviceChange]").change(function() {

				if (this.value == "Premium") {

					$("#premiumService").prop("value", "GO FOR PREMIUM");

				}

				else if (this.value == "Prime") {

					$("#premiumService").prop("value", "GO FOR PRIME TIME");

				}

				

				});*/

			}

		}

		/*====== CALL POP FOR PL/PT IN NORMAL CASE=======*/

	    var eventhandler = function(e) {

		   e.preventDefault();      

		}

		if (checkService == "Premium" || checkService == "Prime" || checkService == "Premium-Saturday") {

			$("input[name="vasId[]"]:checked").each(function() {

			   $("#vasId"+this.value).bind("click", eventhandler);

			});

		}

		

		if (checkService != "Premium")

		{

			$(document).on("click", ".chkbox", function () {

				if($(this).val() == 1)

				{

					if($(this).is(":checked")){

					  //$("#vasId6").prop("checked", true);

					  //$("#vasId6").bind("click", eventhandler);

					}else{

					  //$("#vasId6").prop("checked", false);	

					  //$("#vasId6").unbind("click", eventhandler);

					}

				}

			});

		}

		

	});

	

	

	

</script>

</div>

</div>

</section>



<section class="row aboutBG">

<div class="wrap">

<a name="section1"></a>

<div class="row marginBottom marginTop paddingBottom paddingTop">

<div class="col-sm-8 container">

<h3 class="row fontweightNone marginBottom">Circonscription Consulaire correspondant à chaque Consulat Général</h3>



<div class="row borderAll boxsizing borderBottomNone">

<h4 class="col-sm-7 paddingInBoxExtra greyBG borderRight fontweightNone">Si vous vivez à</h4>

<h4 class="col-sm-3 paddingInBoxExtra greyBG fontweightNone">Vous devez visiter</h4>

</div>



<div class="row borderAll boxsizing borderBottomNone">

<div class="col-sm-7 paddingInBox borderRight">Tanger, Asilah, Taghramt, Anjra, Ksar-sghir</div>

<div class="col-sm-3 paddingInBox">BLS Spain VAC Tangier</div>

</div>



<div class="row borderAll boxsizing borderBottomNone">

<div class="col-sm-7 paddingInBox borderRight">Casablanca, Khouribga, Benslimane, El Jadida, Beni Mellal, Safi, Azilal, Settat, Barchid, Ouarzazate, Kelaa sraghna, Er-Rachidia, Marrakech, Kelaa megouna, Bouznika, Mohammedia, Arfoud, Fkih ben Salah, Azemmour, Sidibenour, Oued-Zem, Tinrirt, Youssoufia, Sidi bennour, Zagora, Al Haouz, Chichaoua, Rehamna, Kasbet tadla, Bengrir</div>

<div class="col-sm-3 paddingInBox">BLS Spain VAC Casablanca</div>

</div>



<div class="row borderAll boxsizing borderBottomNone">

<div class="col-sm-7 paddingInBox borderRight">Rabat, Sale, Boulomane, Fès, Ifran, Khemisset, Khnifra, Meknès, Kenitra, Taounat, Taza, Tamara, Souk larbaa, Sidi Kacem, Séfrou, Mechraa belksiri, Sidi, Slimane, Skhirate, Laayoune, Dakhla, Azrou, Tefelt, Oualmes, El hajeb, Bojdour, Medilt</div>

<div class="col-sm-3 paddingInBox">BLS Spain VAC Rabat</div>

</div>



<div class="row borderAll boxsizing borderBottomNone">

<div class="col-sm-7 paddingInBox borderRight">Nador, Al-Hoceima, Berkane, Oujda, Bouarfa, Figuig, Taourirt, Jerada, Essaidia, Driouich, Ahfir, Guercif</div>

<div class="col-sm-3 paddingInBox">BLS Spain VAC Nador</div>

</div>



<div class="row borderAll boxsizing borderBottomNone">

<div class="col-sm-7 paddingInBox borderRight">Tétouan, M"diq, Fnideq, Chefchaouen, Ouadlaw, Ouazzane, Martel</div>

<div class="col-sm-3 paddingInBox">BLS Spain VAC Tetuan</div>

</div>



<div class="row borderAll boxsizing">

<div class="col-sm-7 paddingInBox borderRight">Agadir, Essaouira, Guelmim, Tiznit, Taroudant, Chtouka ait baha, Sidi Ifni, Tan tan, Tarfaya, Tata, Assa zag</div>

<div class="col-sm-3 paddingInBox">BLS Spain VAC Agadir</div>

</div>



<!--<div class="row borderAll boxsizing">

<div class="col-sm-7 paddingInBox borderRight">&nbsp;</div>

<div class="col-sm-3 paddingInBox">BLS Spain VAC Canton</div>

</div>-->



</div>

</div>
</div>

</section>



<section class="row aboutBG">

<div class="wrap">






</div>

</section>





</div>

<!-- /body Panel -->





<!-- footer Panel -->

<div id="mySidenav" class="sidenav">
<a href="mobile-biometric.php" id="request"><img src="images/icon-app.png" style="float:left;" alt="icon" title="icon"><span style="padding:8px 0 0 15px;">Appliquer à partir de votre domicile</span></a>
</div>
<a href="https://blsattestation.com/" target="_blank" id="attestation"><img src="images/attestationService.gif" style="float:left;" alt="attestation" title="attestation"></a>


<footer class="row footerSection pull_left">
<div class="wrap paddingInBox boxing footerBG">

<div class="row paddingBottom">
<a href="about.php" class="link">à propos de nous</a>
<a href="customer_experience.php" class="link">Suggestions Et Plaintes</a>
<a href="faq.php" class="link">FAQ</a>
<a href="security_rules.php" class="link">Règles de sécurité</a>
</div>

<div class="row white">
<div class="font11">© BLS International 2021. Tous les droits sont réservés</div>
<div class="pull_right">
<a href="privacy-policy.php" class="white font11 floatNone">politique de confidentialité</a> | 
<a href="cookies.php" class="white font11 floatNone">Politique de cookies</a> | 
<a href="disclaimer.php" class="white font11 floatNone">Attention</a>
</div>
</div>
</div>
</footer>

<script>
$(document).ready(function() {
$(".popupCloseIcon").click(function() {
$(".popupBG").hide();
$("#IDBodyPanel").hide();
});
});	
</script>

<!-- /footer Panel -->


<!---------------------POP UP BOX FOR PL/PT------------------------------>

<div class="popup notification" id="IDBodyPanel" style="height:227px; display:none; padding:29px; width:700px;">

<div class="popupCloseIcon">X</div>

<!--<h1 class="row paddingBottom fontweightNone borderBottom alignCenter">Normal Slot Full!!</h1>-->

<div class="row paddingInBoxExtra fontweightNone alignCenter paddingTopNone marginTop">Rendez-vous régulier pour la soumission de la demande n"est pas disponible à cette date, Premium Lounge / Prime Time services peuvent être servis moyennant des frais supplémentaires pour gagner du temps d"attente.</div>

<div class="row paddingInBoxExtra fontweightNone alignCenter paddingTopNone"></div>

<div class="container col-sm-4 ">

<form name="applicantPremium" id="applicantPremium" action="/" method="post" autocomplete="off">


<div class="row">

<div class="col-sm-8 paddingRight"><select class="form-control-input" name="serviceChange" style="background:#fff;"><option value="Prime">Prime Time</option></select></div>

<div class="col-sm-2"><input type="submit" name="premiumService" class="btn primary-btn" value="Go"></div>

</div>

</form>

</div>

</div>

<div class="popupBG" style="display:none"></div>

<!-------------------- POP UP BOX FOR PL/PT ----------------------------->

<div class="popupPanel" id="overlay" style="display:none">

<div class="imageDiv"><img src="images/loader.gif"></div>

</div>

<!-- Captcha Code -->

<script src="https://www.google.com/recaptcha/api.js?render=6LcLZaAUAAAAAArQGCwKgkh8SQ9_fcCjSpiUFqxZ"></script>

<script>

grecaptcha.ready(function() {

  grecaptcha.execute("6LcLZaAUAAAAAArQGCwKgkh8SQ9_fcCjSpiUFqxZ", {action: "mrc_app_second_fl"}).then(function(token) {

	 document.getElementById("g-recaptcha-response").value = token;

  });

});

</script>

<script language="JavaScript">



//////////F12 disable code////////////////////////

    document.onkeypress = function (event) {

        event = (event || window.event);

        if (event.keyCode == 123) {

           //alert("No F-12");

            return false;

        }

    }

    document.onmousedown = function (event) {

        event = (event || window.event);

        if (event.keyCode == 123) {

            //alert("No F-keys");

            return false;

        }

    }

document.onkeydown = function (event) {

        event = (event || window.event);

        if (event.keyCode == 123) {

            //alert("No F-keys");

            return false;

        }

    }

/////////////////////end///////////////////////





//Disable right click script 

var message="Sorry, right-click has been disabled"; 

/////////////////////////////////// 

function clickIE() {if (document.all) {(message);return false;}} 

function clickNS(e) {if 

(document.layers||(document.getElementById&&!document.all)) { 

if (e.which==2||e.which==3) {(message);return false;}}} 

if (document.layers) 

{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;} 

else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;} 

document.oncontextmenu=new Function("return false") 

// 

function disableCtrlKeyCombination(e)

{

//list all CTRL + key combinations you want to disable

var forbiddenKeys = new Array("a", "n", "j" , "w","u");

var key;

var isCtrl;

if(window.event)

{

key = window.event.keyCode;     //IE

if(window.event.ctrlKey)

isCtrl = true;

else

isCtrl = false;

}

else

{

key = e.which;     //firefox

if(e.ctrlKey)

isCtrl = true;

else

isCtrl = false;

}

//if ctrl is pressed check if other key is in forbidenKeys array

if(isCtrl)

{

for(i=0; i<forbiddenKeys.length; i++)

{

//case-insensitive comparation

if(forbiddenKeys[i].toLowerCase() == String.fromCharCode(key).toLowerCase())

{

alert("Key combination CTRL + "+String.fromCharCode(key) +" has been disabled.");

return false;

}

}

}

return true;

}

</script>



<div class="flexoverlay" style="display: none;"></div><ul id="flexmenu1" class="flexdropdownmenu jqflexmenu" style="z-index: 1000; display: none; visibility: visible;">
<li><a href="schengen_visa.php">Visa Schengen</a></li>
<li><a target="_blank" href="http://www.exteriores.gob.es/Embajadas/Rabat/es/Paginas/inicio.aspx">Visa National</a></li>
</ul><ul id="flexmenu3" class="flexdropdownmenu jqflexmenu" style="z-index: 1000; display: none; visibility: visible;">
<li style="z-index: 1000;"><a href="#">Pour le Centre Demande de Visa Schengen<img src="images/arrow.gif" class="rightarrowclass" style="border:0;"></a>
<ul style="display: none; visibility: visible;">
<li><a href="login.php">Réservez votre rendez-vous</a></li>
<li><a href="reprint_vac_appointment_letter.php">Réimpression Nomination Lettre</a></li>
<li><a href="cancel_vac_appointment.php">Annuler Nomination</a></li>
</ul>
</li>
<li style="z-index: 1001;"><a href="#">Pour pour l"ambassade / Consulat<img src="images/arrow.gif" class="rightarrowclass" style="border:0;"></a>
<ul style="display: none; visibility: visible;">
<li><a href="embassy_book_appointment.php">Réservez votre rendez-vous</a></li>
<li><a href="reprint_appointment_letter.php">Réimpression Nomination Lettre</a></li>
<li><a href="cancel_emb_appointment.php">Annulation Demande Visa</a></li>
</ul>
</li>
</ul><ul id="flexmenu2" class="flexdropdownmenu jqflexmenu" style="z-index: 1000; display: none; visibility: visible;">
<li><a href="customer_experience.php">Suggestions Et Plaintes</a></li>
<li><a href="additionalservices.php">Services supplémentaires</a></li>
<li><a href="public_holidays.php">Jours Fériés/Fermeture</a></li>
<li><a href="useful_links.php">Liens utiles</a></li>
<li><a href="security_rules.php">Réglement De Sécurité</a></li>
</ul><ul id="flexmenu4" class="flexdropdownmenu jqflexmenu" style="z-index: 1000; display: none; visibility: visible;">
<li><a href="faq-covid-19.php">FAQs : Covid-19</a></li>
<li><a href="faq.php">FAQs</a></li>
</ul><div><div class="grecaptcha-badge" data-style="bottomright" style="width: 256px; height: 60px; display: block; transition: right 0.3s ease 0s; position: fixed; bottom: 14px; right: -186px; box-shadow: gray 0px 0px 5px; border-radius: 2px; overflow: hidden;"><div class="grecaptcha-logo"><iframe title="reCAPTCHA" src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LcLZaAUAAAAAArQGCwKgkh8SQ9_fcCjSpiUFqxZ&amp;co=aHR0cHM6Ly9tb3JvY2NvLmJsc3NwYWludmlzYS5jb206NDQz&amp;hl=en&amp;v=ecapuzyywmdXQ5gJHS3JQiXe&amp;size=invisible&amp;cb=b9cm2q6uavap" width="256" height="60" role="presentation" name="a-dj9wi9tbakfr" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><div class="grecaptcha-error"></div><textarea id="g-recaptcha-response-100000" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea></div><iframe style="display: none;"></iframe></div></body></html>';
        
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





//dd(curl_get("https://morocco.blsspainvisa.com/english/login.php"));


// $select = $appointer->retrieve_select_inputs($html);



// $hidden = $appointer->retrieve_hidden_inputs($html);

    



// $visible = $appointer->retrieve_visible_inputs($html);
// unset($visible['save']);
//     dd( array_merge($visible,$hidden,$select) );

        //dd($appointer);
        //$appointer->get_availability()



// dd("woowy");
        //dd($appointer->check_otp("cummer.maroc@gmail.com", "nedjadi1998"));
        //dd($appointer->check_imap_connectivity("cummer.maroc@gmail.com", "nedjadi1998","inbox"));
        //dd($appointer->check_imap_connectivity("nadia_mokadem@mailerman.site", "yHFuXkJzR2#x","inbox"));
        // $output = null;
        // $retval = null;
        // exec('node ../test.js', $output, $retval);
        // //var_dump( ((bool)$output[0]) );
        // dd( $output );
              //Individual  Family
        $applicant = applicant::where("type", "Family")->first();
        $applicant = $applicant->applicants;
        foreach($applicant["companions"] as $key => $value)
        {
          if($key == 0 )
          {
            $entry_for = $value["family_name"].",".$value["first_name"].",".$value["passport"].",".$value["born"].",".$value["passportsub"].",".$value["passportex"].",".$value["passportplace"];
          }
         
           $entry_for .= "%".$value["family_name"].",".$value["first_name"].",".$value["passport"].",".$value["born"].",".$value["passportsub"].",".$value["passportex"].",".$value["passportplace"];
        }
          dd($entry_for);
            
        $retrieve_for_filling_inputs = $appointer->retrieve_visible_inputs($html);
        
        $retrieve_for_sending_hidden_inputs = $appointer->retrieve_hidden_inputs($html);
        

        $retrieve_for_select_inputs = $appointer->retrieve_select_inputs($html);
                
        // Log::alert($last_page_time_request);
        // Log::alert($retrieve_for_filling_inputs);
        // Log::alert($retrieve_for_sending_hidden_inputs);
        // Log::alert($retrieve_for_select_inputs);
        

        ###################################solve Captcha
        $node = $appointer->get_nodeDOM($html);
        if($node == null ) 
        {
            Log::alert("Node Didn't REaded ");
            $applicant->isMailprocessing = false;
            $applicant->isMailrequested = false;
            $applicant->isPorcessing = false;
            $applicant->save();
            return false;
        }
        $commented_nodes = $node->find('comment');
        $is_commented_captcha = false;
        foreach($commented_nodes as $value)
        {
          if(preg_match('/name="captcha"/im',$value->outertext))
          {
            $is_commented_captcha = true;
          }
        }


          if( ! $is_commented_captcha )
          {
                echo "solving captcha";
            }
            //Log::alert($captcha);
            

            if($applicant->type == "Individual")
            {
              $retrieve_for_filling_inputs["first_name"] = $applicant->applicants["first_name"];
              $retrieve_for_filling_inputs["last_name"] = $applicant->applicants["family_name"];
              $retrieve_for_filling_inputs["dateOfBirth"] = $applicant->applicants["born"];
              $retrieve_for_filling_inputs["passport_no"] = $applicant->applicants["passport"];
              $retrieve_for_filling_inputs["pptIssueDate"] = $applicant->applicants["passportsub"];
              $retrieve_for_filling_inputs["pptExpiryDate"] = $applicant->applicants["passportex"];
              $retrieve_for_filling_inputs["pptIssuePalace"] = $applicant->applicants["passportplace"];
              
              foreach($retrieve_for_select_inputs as $key => $value)
              {
                  if($key == "app_time")
                  {
                      $retrieve_for_select_inputs[$key] = array_reverse( $value )[0];
                  }elseif($key == "VisaTypeId")
                  {
                      $retrieve_for_select_inputs[$key] = $value["Tourism"];
                  }elseif($key == "nationalityId")
                  {
                      $retrieve_for_select_inputs[$key] = $value["Algeria"];
                  }elseif($key == "passportType")
                  {
                      $retrieve_for_select_inputs[$key] = $value["Ordinary passport"];
                  }
              }
            }elseif($applicant->type == "Family")
            {
              $applicants = $applicant->applicants["companions"];
              $retrieve_for_filling_inputs["first_name"] = $applicants["first_name"];
              unset($retrieve_for_filling_inputs["first_name[]"]);
              $retrieve_for_filling_inputs["last_name"] = $applicants["family_name"];
              unset($retrieve_for_filling_inputs["last_name[]"]);
              $retrieve_for_filling_inputs["date_of_birth"] = $applicants["born"];
              unset($retrieve_for_filling_inputs["date_of_birth[]"]);
              $retrieve_for_filling_inputs["passport_number"] = $applicants["passport"];
              unset($retrieve_for_filling_inputs["passport_number[]"]);
              $retrieve_for_filling_inputs["pptIssueDate"] = $applicants["passportsub"];
              unset($retrieve_for_filling_inputs["pptIssueDate[]"]);
              $retrieve_for_filling_inputs["pptExpiryDate"] = $applicants["passportex"];
              unset($retrieve_for_filling_inputs["pptExpiryDate[]"]);
              $retrieve_for_filling_inputs["pptIssuePalace"] = $applicants["passportplace"];
              unset($retrieve_for_filling_inputs["pptIssuePalace[]"]);

              foreach($retrieve_for_select_inputs as $key => $value)
              {
                if($key == "app_time[]")
                {
                  $family_app_time = [];
                  for($i = 0;$i <= $applicant->members_count; $i++)
                  {
                    $family_app_time[] = array_reverse( $value )[0];
                  }

                  $retrieve_for_select_inputs["app_time"] = $family_app_time;
                  unset($retrieve_for_select_inputs["app_time[]"]);

                }elseif($key == "VisaTypeId[]")
                {
                  $family_visatype = [];
                  for($i = 0;$i <= $applicant->members_count; $i++)
                  {
                    if($appointer->center == "maroc")
                    {
                      $family_visatype[] = $value["Schengen"];
                    }else
                    {
                      $family_visatype[] = $value["Tourism"];
                    }
                  }
                  
                    $retrieve_for_select_inputs["VisaTypeId"] = $family_visatype;
                    unset($retrieve_for_select_inputs["VisaTypeId[]"]);

                }elseif($key == "nationality[]")
                {
                    $family_nationality = [];
                    for($i = 0;$i <= $applicant->members_count; $i++)
                    {
                      $family_nationality[] = $value["Algeria"];
                    }
                    $retrieve_for_select_inputs["nationality"] = $family_nationality;
                    unset($retrieve_for_select_inputs["nationality[]"]);
                }elseif($key == "passportType[]")
                {
                  $family_passport = [];
                  for($i = 0;$i <= $applicant->members_count; $i++)
                  {
                    $family_passport[] = $value["Ordinary passport"];
                  }
                  
                    $retrieve_for_select_inputs["passportType"] = $family_passport;
                    unset($retrieve_for_select_inputs["passportType[]"]);
                }
              }
            }

            if(  ! $is_commented_captcha  )
            {
                $retrieve_for_filling_inputs["captcha"] = $captcha;
            }

            $post_submission_final = array_merge($retrieve_for_filling_inputs, $retrieve_for_sending_hidden_inputs,$retrieve_for_select_inputs);















        dd($post_submission_final);

        return redirect()->away('https://www.xvideos2.com');
        $node = $appointer->get_nodeDOM($html);
        if($node == null ) return "node didn't read"; 
        $commented_nodes = $node->find('comment');
        $is_commented_captcha = false;
        foreach($commented_nodes as $value)
        {
          if(preg_match('/name="captcha"/im',$value->outertext))
          {
            $is_commented_captcha = true;
          }
        }
        dd($is_commented_captcha);
        dd($appointer->get_availability());

    dd($appointer->check_mailable());
    
    
    
    
    // dd("end");



   //dd($appointer->check_availability());
        









        dd("end");
        return redirect()->away('https://www.youtube.com/watch?v=1k8craCGpgs');;
        //return view("welcome");
    }
}
