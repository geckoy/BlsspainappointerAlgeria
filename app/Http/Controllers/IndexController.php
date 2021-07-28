<?php

namespace App\Http\Controllers; // use App\Http\Controllers\IndexController;

/**
 * @Dependencies
 */
use Illuminate\Http\Request;

use App\lib\providers\captchasolverProvider;

use App\lib\blsappointer;

use App\Models\applicant;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\gmailchecker;
// use App\lib\providers\webscrapeProvider;

class IndexController extends Controller
{
    public function FrontPage(Request $request, blsappointer $appointer, captchasolverProvider $captcha)
    {


        $html = '<!DOCTYPE html>
        <html>
        <head>
        
        ﻿<meta charset="UTF-8">
        <meta name="description" content="Here applicants can book online appointment for BLS VAC, Republic of Cote d’Ivoire how to Book Your Appointment, Republic of Cote d’Ivoire Book Your Appointment Online, Schedule an Appointment, Book Your Appointment for Spain Visa Republic of Cote d’Ivoire Citizen Book Appointment to Spain Visa, Book Your Appointment for Spain Visa from Republic of Cote d’Ivoire." />
        <meta name="keywords" content="Republic of Cote d’Ivoire how to Book Your Appointment, Republic of Cote d’Ivoire Book Your Appointment Online, Schedule an Appointment, Book Your Appointment for Spain Visa Republic of Cote d’Ivoire Citizen Book Appointment to Spain Visa, Book Your Appointment for Spain Visa from Republic of Cote d’Ivoire "/>
        <meta name="google-site-verification" content="k-AjmBS5LOIvMtHlcUJCjPj8TDwGUTjaE_2pL76ZrCs" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        
        <title>Republic of Cote d’Ivoire BLS Spain Visa:  Spain Visa for Republic of Cote d’Ivoire How to Book Your Appointment for BLS VAC</title>
        <link rel="shortcut icon" href="images/favicon.ico"/>
        
        <link href="css/style.css" type="text/css" rel="stylesheet"/>
        
        <link rel="stylesheet" type="text/css" href="css/mobile-responsive.css"/>
        
        <script src="js/jquery-1.11.0.min.js"></script>
        
        <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
        
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
        
        
        
        <link rel="stylesheet" type="text/css" href="css/flexdropdown.css" />
        
        <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
        
        <script type="text/javascript" src="js/flexdropdown.js">
        
        
        
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
        
          ga("create", "UA-89640989-1", "auto");
          ga("send", "pageview");
        
        </script>
        <!--<script>
          (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,"script","https://www.google-analytics.com/analytics.js","ga");
        
          ga("create", "UA-89720325-1", "auto");
          ga("send", "pageview");
        
        </script>--><link rel="stylesheet" type="text/css" href="css/calendar.css?v=982122641"/>
        <style>
        span{ float:none;}
        .popupPanel{background:rgba(255,255,255,0.8); width:100%; height:100%; position:fixed; left:0px; right:0px; bottom:0px; top:0px; z-index:10000;}
        .imageDiv{width:32px; height:32px; position:fixed; left:0px; right:0px; bottom:0px; top:0px; margin:auto;}
        </style>
        <script>
        function validateFrm(){
            var flags=0;
            if(document.getElementById("app_date").value!=""){
                    $("#app_date").removeClass("error");
            }else{
                    flags=1;
                    $("#app_date").addClass("error");
            }
            if(document.getElementById("app_date").value!=""){
                if(document.getElementById("app_time").value!=""){
                        $("#app_time").removeClass("error");
                }else{
                        flags=1;
                        $("#app_time").addClass("error");
                }
            }
            if(document.getElementById("VisaTypeId").value!=""){
                    $("#VisaTypeId").removeClass("error");
            }else{
                    flags=1;
                    $("#VisaTypeId").addClass("error");
            }
            if(document.getElementById("first_name").value!=""){
                    $("#first_name").removeClass("error");
            }else{
                    flags=1;
                    $("#first_name").addClass("error");
            }
            if(document.getElementById("last_name").value!=""){
                    $("#last_name").removeClass("error");
            }else{
                    flags=1;
                    $("#last_name").addClass("error");
            }
            if(document.getElementById("dateOfBirth").value!=""){
                    $("#dateOfBirth").removeClass("error");
            }else{
                    flags=1;
                    $("#dateOfBirth").addClass("error");
            }
            if(document.getElementById("phone_code").value!=""){
                    $("#phone_code").removeClass("error");
            }else{
                    flags=1;
                    $("#phone_code").addClass("error");
            }
            if(document.getElementById("phone").value!=""){
                    $("#phone").removeClass("error");
            }else{
                    flags=1;
                    $("#phone").addClass("error");
            }
            if(document.getElementById("nationalityId").value!=""){
                    $("#nationalityId").removeClass("error");
            }else{
                    flags=1;
                    $("#nationalityId").addClass("error");
            }
            if(document.getElementById("passportType").value!=""){
                    $("#passportType").removeClass("error");
            }else{
                    flags=1;
                    $("#passportType").addClass("error");
            }
            if(document.getElementById("passport_no").value!=""){
                    $("#passport_no").removeClass("error");
            }else{
                    flags=1;
                    $("#passport_no").addClass("error");
            }
            if(document.getElementById("pptIssueDate").value!=""){
                    $("#pptIssueDate").removeClass("error");
            }else{
                    flags=1;
                    $("#pptIssueDate").addClass("error");
            }
            if(document.getElementById("pptExpiryDate").value!=""){
                    $("#pptExpiryDate").removeClass("error");
            }else{
                    flags=1;
                    $("#pptExpiryDate").addClass("error");
            }
            if(document.getElementById("pptIssuePalace").value!=""){
                    $("#pptIssuePalace").removeClass("error");
            }else{
                    flags=1;
                    $("#pptIssuePalace").addClass("error");
            }
            /*if ($("#terms").is(":checked")) {
                $("#termsborder").removeClass("error");
                $("#aterms").css("color","white");
            }
            else {
                flags=1;
                $("#termsborder").addClass("error");
                $("#aterms").css("color","red");
            }*/
            if(document.getElementById("captcha").value!=""){
                    $("#captcha").removeClass("error");
            }else{
                    flags=1;
                    $("#captcha").addClass("error");
            }
        
            if(flags == 1){
                return false;
            }else{	
                return confirm("Please confirm all the information and VAS for your application.");		
            }
        }
        
        function showLoader()
        {
            $("#overlay").show({
                    }, 1500);
        }
        </script>
        <script language="javascript">
        $("body").bind("copy paste",function(e) {
            e.preventDefault(); return false; 
        });
        </script>
        </head>
        <body>
        <!-- header section -->
        <style>
        #sidebar {
            position: fixed;
            left: 0;
            top: 150px;
            z-index: 1000;
        }
        </style>
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
        <h1 class="logoSection"><a href="index.php"><img src="images/bls-logo.png" alt="BLS Logo" title="BLS Logo"/></a></h1>
        <div class="menuIcon"><img src="images/mobicon.png" width="20" height="20"/></div>
        <div class="pull_right paddingInBox paddingRightNone paddingBottomNone">
        <div class="pull_right padding-sm paddingRightNone paddingTopNone">
        <h3 class="marginRight paddingRight baseColor label">Apply for VISA to Spain In Cote D"Ivoire <img src="images/flag.jpg" class="pull_right  marginLeft borderAll"/></h3>
        <div class="marginLeft paddingLeft lineheightExtra">
        <a href="#" class="padding-sm"><span class="font11 borderRight paddingRight black">English</span></a>
        <a href="spanish/index.php" class="padding-sm"><span class="font11 borderRight paddingRight black">Español</span></a>
        <a href="french/index.php" class="padding-sm"><span class="font11 black">français</span></a>
        </div>
        </div>
        </div>
        </div>
        
        <nav class="navigationPanel">
        <a href="index.php"><img src="images/home.png" width="18" height="18"/></a>
        <a href="#" data-flexmenu="flexmenu1">Visa Type</a>
        <a href="#" data-flexmenu="flexmenu3">Book Appointment</a>
        <a href="#" data-flexmenu="flexmenu2">General Information</a>
        <a href="track_application.php">Track Application</a>
        <a href="#" data-flexmenu="flexmenu4" style="text-transform:none;">FAQs</a>
        <a href="contact.php">Contact Us</a>
        
        <!--HTML for Flex Drop Down Menu 1  short_term_visa.php-->
        <ul id="flexmenu1" class="flexdropdownmenu">
        <li><a href="#">Short Term Visa(Maximum stay of 90 days)</a>
        <ul>
        <li><a href="tourist.php">Tourism</a></li>
        <li><a href="business.php">Business</a></li>
        <li><a href="family_visit.php">Family Visit</a></li>
        <li><a href="Owners_visa.php">Owners</a></li>
        <li><a href="student.php">Student(less than 90 days)</a></li>
        <li><a href="mission_visa.php">Mission</a></li>
        <li><a href="medical_visa.php">Medical Visa</a></li>
        </ul>
        </li>
        </ul>
        <!--HTML for Flex Drop Down Menu 1-->
        
        <!--HTML for Flex Drop Down Menu 4-->
        <ul id="flexmenu4" class="flexdropdownmenu">
        <li><a href="faq-covid-19.php">FAQs : Covid-19</a></li>
        <li><a href="faq.php">FAQs</a></li>
        </ul>
        
        <!--HTML for Flex Drop Down Menu 3-->
        <ul id="flexmenu2" class="flexdropdownmenu">
        <li><a href="customer_experience.php">Customer Experience</a></li>
        <li><a href="additionalservices.php">Additional Services</a></li>
        <li><a href="public_holidays.php">Public Holidays / Closures</a></li>
        <li><a href="useful_links.php">Useful Links</a></li>
        <li><a href="security_rules.php">Security Rules</a></li>
        </ul>
        
        <!--HTML for Flex Drop Down Menu 3-->
        <ul id="flexmenu3" class="flexdropdownmenu">
        <li><a href="#">For BLS Visa Application Center</a>
        <ul>
        <li><a href="book_appointment.php">Book Your Appointment</a></li>
        <li><a href="reprint_vac_appointment_letter.php">Reprint Appointment Letter</a></li>
        <li><a href="cancel_vac_appointment.php">Cancel Appointment</a></li>
        </ul>
        </li>
        
        <li><a href="#">FOR EMBASSY</a>
        <ul>
        <li><a href="embassy_book_appointment.php">Book Your Appointment</a></li>
        <li><a href="reprint_appointment_letter.php">Reprint Appointment Letter</a></li>
        <li><a href="cancel_emb_appointment.php">Cancel Appointment</a></li>
        </ul>
        </li>
        
        <!--<li><a href="agent/">FOR TRAVEL AGENTS</a></li>-->
        </ul>
        </nav>
        
        <!-- JavaScript Alert Start  -->
        <!-- Show a message -->
        <noscript>
        <div class="row alertline">
        <span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>
          For full functionality of this site it is necessary to enable JavaScript. 
          Here are the <a href="http://www.enable-javascript.com/" target="_blank" style="float:none">
          instructions how to enable JavaScript in your web browser</a>
        </div>
        </noscript>
        <!-- JavaScript Alert End  -->
        </div>
        </header>
        <!-- /header section -->
        <!-- body Panel -->
        <div class="row innerbodypanel">
        <section class="row aboutUsPanel">
        <div class="wrap">
        <div class="container paddingBottom paddingTop">
        
        <h4 class="alignCenter"><a href="javascript:void(0)" class="blue floatNone" onclick="document.getElementById("light").style.display="block";document.getElementById("fade").style.display="block""><strong>Click here</strong></a> to know how to book your appointment.</h4>
        
        </div>
        
        <div id="light" class="white_content">
        
        <a href="javascript:void(0)" class="blue" style="float:right" onclick="document.getElementById("light").style.display="none";document.getElementById("fade").style.display="none""><strong>Close X</strong></a>
        
        
        
        <div class="row">
        
        <h5 class="row marginBottom">Schedule an Appointment</h5>
        
        <p>All applicants are required book an appointment online to submit their visa application at the Spain Visa application centre.</p>
        
        </div>
        
        
        
        <div class="row">
        
        <h5 class="row marginBottom">Important:</h5>
        
        <p>As part of the visa application procedure, from 2 November 2015 applicants will need to provide Biometric fingerprint data along with a digital photograph. If you have temporary injuries on your fingers, applicants are advised to wait until the injuries have healed before you book your appointment. Henna on fingertips may also mean we are unable to get a clear scanned image and should be removed or allowed to fade before your appointment date.<br />
        
        <br />
        
        Before you make an appointment you should carefully read the visa application process available on the website to submit your visa application and supporting documents at the visa application center.<br />
        
        <br />
        
        If you have missed your appointment on the scheduled day, the system will not allow you to reschedule or cancel and you will require to book a new appointment after 24 hours.<br />
        
        <br />
        
        Please make sure you arrive at the visa application center 15 minutes prior to your appointment time. Applicants are not allowed to be accompanied inside the visa application center. The only exceptions to this are those accompanying children under 18 years-of- age or applicants who need special assistance for health reasons or disability.<br />
        
        <br />
        
        If you are part of a family or group, each member of the family or group must make an individual appointment. For example, if you are a family of 4 with 2 adults and 2 children you must make 4 individual appointments.<br />
        
        <br />
        
        BLS appointment system is compatible with most popular browsers. BLS will soon introduce appointment scheduling through call Centre for the ease of applicants.</p>
        
        
        
        <h5 class="row marginBottom">How to book an appointment</h5>
        
        
        
        <p>Please ensure you have checked the jurisdiction section before submission of your application
        
        in Abidjan. Applications must be submitted at either of the offices in
        
        accordance with your actual place of residence. See link “Where to apply”</p>
        
        
        
        <p>Please note it may take more than the prescribed time mentioned on your Appointment
        
        letter while submitting your Application at BLS Centre. Applicants will be issued with a
        
        token number at the Application Centre and will be entertained as per the token number
        
        assigned. It may take more time depending on the number of Applications submitted at the
        
        counter by an Individual.</p>
        
        
        
        </div>
        
        
        
        </div>
        
        <div id="fade" class="black_overlay"></div><div class="col-sm-8 container">
        <h1 class="row fontweightNone alignCenter black marginBottom">FOR BLS VAC</h1>
        <div class="col-sm-6 container paddingInBoxExtra roundCornerExtra" style="color:#F00;background-color: rgba(244, 67, 54, 0.14); margin-bottom:10px">
        Please select centre.<br/>Please select your appointment time.<br/>Invalid time slot.Please enter your first name.<br/>Please enter your last name.<br/>Please enter your date of birth.<br/>Please enter your present passport number.<br/>Please enter passport issue date.<br/>Please enter passport expiry date.<br/>Please enter passport issue place.<br/>Please select visa type.<br/>Invalid Date.<br/>Please enter the correct image characters.<br/>Error!.<br/>         
        </div>
        <div class="col-sm-7 container blueBG paddingInBoxExtra roundCornerExtra" style="color:#FFF">
        <table width="100%" border="0" cellpadding="5" cellspacing="0" align="center">
            <tr>
                <td align="center"  style="padding-left:10px; font-size:26px; color:#FFF;">
                    Appointment Booking Form        </td>
            </tr>
            <tr>
                <td valign="top">
                    <table width="100%" align="center" cellpadding="0" cellspacing="0" class="">
                        <tr><td colspan="2" height="15"></td></tr>   
                        <tr>
                            <td colspan="2" align="left" class="" style="padding-left:10px; color:#FFF;">
                                Fields marked with <span style="color:#F00; float:none;">*</span> are mandatory.                    </td>
                        </tr>
                        <tr><td colspan="2" height="15"></td></tr>
                        <tr>
                            <td colspan="2" class="" style="padding-left:10px; color:#FFF;">
                               Kindly fill this form in english only                    </td>
                        </tr>
                        <tr><td colspan="2" height="15"></td></tr>
                        <form name="applicantBooking2" id="applicantBooking2" action="/" method="post" onSubmit="return validateFrm();">
                        <tr id="app_date_tr" height="30">
                            <td width="20%" class="styleBlack" style="padding-left:10px;">
                                Appointment Date: <span style="color:#F00">*</span>
                            </td>
                            <td colspan="2">
                            <input type="text" readonly class="form-control-input app_date validate" style="width: 260px;" id="app_date" name="app_date" placeholder="YYYY-MM-DD" onchange="this.form.submit();showLoader();" value="2021-07-30">
                            </td>
                        </tr>
                        <input type="hidden" name="loc_selected" id="loc_selected" value="44" />
                        <input type="hidden" name="mission_selected" id="mission_selected" value="44" />
                        <tr id="slot_tr" height="30">
                            <td width="34%" class="styleBlack" style="padding-left:10px;">
                                Appointment Time: <span style="color:#F00">*</span>
                            </td>
                            <td width="66%">
                                <select class="form-control-input" name="app_time" id="app_time"><option value="">Select</option><option value="08:30 - 08:45">08:30 - 08:45</option><option value="09:00 - 09:15">09:00 - 09:15</option><option value="09:15 - 09:30">09:15 - 09:30</option><option value="09:30 - 09:45">09:30 - 09:45</option><option value="09:45 - 10:00">09:45 - 10:00</option><option value="10:00 - 10:15">10:00 - 10:15</option><option value="10:15 - 10:30">10:15 - 10:30</option><option value="10:30 - 10:45">10:30 - 10:45</option><option value="10:45 - 11:00">10:45 - 11:00</option><option value="11:00 - 11:15">11:00 - 11:15</option><option value="11:15 - 11:30">11:15 - 11:30</option><option value="11:30 - 11:45">11:30 - 11:45</option><option value="11:45 - 12:00">11:45 - 12:00</option><option value="12:00 - 12:15">12:00 - 12:15</option><option value="12:15 - 12:30">12:15 - 12:30</option><option value="12:30 - 12:45">12:30 - 12:45</option><option value="12:45 - 13:00">12:45 - 13:00</option></select>                    </td>
                        </tr>
                        <tr id="appl_tr"  height="30">
        
                            <td valign="middle" class="styleBlack" width="34%" style="padding-left:10px;">
        
                                Visa Type: <span style="color:#F00">*</span> 
        
                            </td>
        
                            <td width="66%" align="left" valign="middle">
                                <select name="VisaTypeId" id="VisaTypeId" class="form-control-input">
                                <option value="" selected="selected">Select </option>
                                                       <option value="231"   >Tourism</option>
                                                       <option value="232"   >Business</option>
                                                       <option value="233"   >Family Visit</option>
                                                       <option value="234"   >Owners</option>
                                                       <option value="235"   >Students</option>
                                                       <option value="236"   >Sports / Cultural / Artistic / Scientific</option>
                                                       <option value="237"   >Mission</option>
                                                       <option value="238"   >Medical Visit</option>
                                                       <option value="239"   >Transit</option>
                                                     </select>
                            </td>
                        </tr>
        
                        <tr id="appl_tr"  height="30">
                            <td valign="middle" class="styleBlack" width="34%" style="padding-left:10px;">
                                First Name: <span style="color:#F00">*</span> 
                            </td>
                            <td width="66%" align="left" valign="middle">
                                <input type="text" name="first_name" id="first_name" class="form-control-input upperCase" value=""  onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off"/>
                            </td>
                        </tr>
        
                        <tr id="appl_tr"  height="30">
                            <td valign="middle" class="styleBlack" width="34%" style="padding-left:10px;">
                                Last Name: <span style="color:#F00">*</span> 
                            </td>
        
                            <td width="66%" align="left" valign="middle">
                                <input type="text" name="last_name" id="last_name" class="form-control-input upperCase" value=""  onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off"/>
                            </td>
                        </tr>
                        <tr id="appl_tr"  height="30">
                            <td valign="middle" class="styleBlack" width="34%" style="padding-left:10px;">
                                Date Of Birth: <span style="color:#F00">*</span> 
                            </td>
                            <td width="66%" align="left" valign="middle">
                                <input type="text" name="dateOfBirth" class="form-control-input" id="dateOfBirth" value="" readonly>
                            </td>
                        </tr>
        
                        <tr id="ap_tr" height="30">
                            <td valign="middle" class="styleBlack" width="34%" style="padding-left:10px;">
                                Mobile Number: <span style="color:#F00">*</span>
                            </td>
                            <td width="66%" align="left" valign="middle">
                                <input type="text" name="phone_code" id="phone_code" class="form-control-input col-sm-1" value="213" readonly onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off"/>
                                <input type="text" name="phone" id="phone" class="form-control-input col-sm-5 marginLeft" value="78554123235" readonly onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off"/>
                            </td>
                        </tr>
                        <tr id="em_tr" height="30" class="hid_tr">
                            <td valign="middle" class="styleBlack" width="34%" style="padding-left:10px;">
                                Nationality: <span style="color:#F00">*</span>
                            </td>
                            <td width="66%" align="left" valign="middle">
                                <select name="nationalityId" id="nationalityId" class="form-control-input">
                                <option value="" selected="selected">Select </option>
                                                       <option value="2"  
                                >
                                    Afghanistan</option>
                                                       <option value="6"  
                                >
                                    Albania</option>
                                                       <option value="62"  
                                >
                                    Algeria</option>
                                                       <option value="12"  
                                >
                                    American Samoa</option>
                                                       <option value="7"  
                                >
                                    Andorra</option>
                                                       <option value="3"  
                                >
                                    Angola</option>
                                                       <option value="4"  
                                >
                                    Anguilla</option>
                                                       <option value="13"  
                                >
                                    Antartica</option>
                                                       <option value="15"  
                                >
                                    Antigua And Barbuda</option>
                                                       <option value="10"  
                                >
                                    Argentina</option>
                                                       <option value="11"  
                                >
                                    Armenia</option>
                                                       <option value="1"  
                                >
                                    Aruba</option>
                                                       <option value="16"  
                                >
                                    Australia</option>
                                                       <option value="17"  
                                >
                                    Austria</option>
                                                       <option value="18"  
                                >
                                    Azerbaijan</option>
                                                       <option value="26"  
                                >
                                    Bahamas</option>
                                                       <option value="25"  
                                >
                                    Bahrain</option>
                                                       <option value="23"  
                                >
                                    Bangladesh</option>
                                                       <option value="33"  
                                >
                                    Barbados</option>
                                                       <option value="28"  
                                >
                                    Belarus</option>
                                                       <option value="20"  
                                >
                                    Belgium</option>
                                                       <option value="29"  
                                >
                                    Belize</option>
                                                       <option value="21"  
                                >
                                    Benin</option>
                                                       <option value="30"  
                                >
                                    Bermuda</option>
                                                       <option value="35"  
                                >
                                    Bhutan</option>
                                                       <option value="31"  
                                >
                                    Bolivia</option>
                                                       <option value="27"  
                                >
                                    Bosnia and Herzegovina</option>
                                                       <option value="37"  
                                >
                                    Botswana</option>
                                                       <option value="32"  
                                >
                                    Brazil</option>
                                                       <option value="251"  
                                >
                                    British Virgin Islands</option>
                                                       <option value="34"  
                                >
                                    Brunei</option>
                                                       <option value="24"  
                                >
                                    Bulgaria</option>
                                                       <option value="22"  
                                >
                                    Burkina Faso</option>
                                                       <option value="19"  
                                >
                                    Burundi</option>
                                                       <option value="115"  
                                >
                                    Cambodia</option>
                                                       <option value="45"  
                                >
                                    Cameroon</option>
                                                       <option value="39"  
                                >
                                    Canada</option>
                                                       <option value="50"  
                                >
                                    Cape Verde Islands</option>
                                                       <option value="54"  
                                >
                                    Cayman Islands</option>
                                                       <option value="38"  
                                >
                                    Central African Republic</option>
                                                       <option value="212"  
                                >
                                    Chad</option>
                                                       <option value="42"  
                                >
                                    Chile</option>
                                                       <option value="43"  
                                >
                                    China</option>
                                                       <option value="48"  
                                >
                                    Colombia</option>
                                                       <option value="49"  
                                >
                                    Comoros</option>
                                                       <option value="47"  
                                >
                                    Cook Islands</option>
                                                       <option value="51"  
                                >
                                    Costa Rica</option>
                                                       <option value="97"  
                                >
                                    Croatia</option>
                                                       <option value="52"  
                                >
                                    Cuba</option>
                                                       <option value="55"  
                                >
                                    Cyprus</option>
                                                       <option value="56"  
                                >
                                    Czech Republic</option>
                                                       <option value="248"  
                                >
                                    Democretic Republic Of Congo</option>
                                                       <option value="60"  
                                >
                                    Denmark</option>
                                                       <option value="58"  
                                >
                                    Djibouti</option>
                                                       <option value="59"  
                                >
                                    Dominica</option>
                                                       <option value="61"  
                                >
                                    Dominican Republic</option>
                                                       <option value="218"  
                                >
                                    East Timor</option>
                                                       <option value="63"  
                                >
                                    Ecuador</option>
                                                       <option value="64"  
                                >
                                    Egypt</option>
                                                       <option value="196"  
                                >
                                    El Salvador</option>
                                                       <option value="86"  
                                >
                                    Equatorial Guinea</option>
                                                       <option value="65"  
                                >
                                    Eritrea</option>
                                                       <option value="68"  
                                >
                                    Estonia</option>
                                                       <option value="207"  
                                >
                                    Eswatini</option>
                                                       <option value="69"  
                                >
                                    Ethiopia</option>
                                                       <option value="71"  
                                >
                                    Fiji</option>
                                                       <option value="70"  
                                >
                                    Finland</option>
                                                       <option value="73"  
                                >
                                    France</option>
                                                       <option value="91"  
                                >
                                    French Guiana</option>
                                                       <option value="181"  
                                >
                                    French Polynesia</option>
                                                       <option value="14"  
                                >
                                    French Southern Territories</option>
                                                       <option value="77"  
                                >
                                    Gabon</option>
                                                       <option value="84"  
                                >
                                    Gambia</option>
                                                       <option value="79"  
                                >
                                    Georgia</option>
                                                       <option value="57"  
                                >
                                    Germany</option>
                                                       <option value="80"  
                                >
                                    Ghana</option>
                                                       <option value="81"  
                                >
                                    Gibraltar</option>
                                                       <option value="87"  
                                >
                                    Greece</option>
                                                       <option value="89"  
                                >
                                    Greenland</option>
                                                       <option value="88"  
                                >
                                    Grenada</option>
                                                       <option value="83"  
                                >
                                    Guadeloupe</option>
                                                       <option value="90"  
                                >
                                    Guatemala</option>
                                                       <option value="82"  
                                >
                                    Guinea</option>
                                                       <option value="85"  
                                >
                                    Guinea Bissau</option>
                                                       <option value="93"  
                                >
                                    Guyana</option>
                                                       <option value="98"  
                                >
                                    Haiti</option>
                                                       <option value="96"  
                                >
                                    Honduras</option>
                                                       <option value="249"  
                                >
                                    Hong Kong</option>
                                                       <option value="99"  
                                >
                                    Hungary</option>
                                                       <option value="106"  
                                >
                                    Iceland</option>
                                                       <option value="101"  
                                >
                                    India</option>
                                                       <option value="100"  
                                >
                                    Indonesia</option>
                                                       <option value="104"  
                                >
                                    Iran</option>
                                                       <option value="105"  
                                >
                                    Iraq</option>
                                                       <option value="103"  
                                >
                                    Ireland</option>
                                                       <option value="107"  
                                >
                                    Israel</option>
                                                       <option value="108"  
                                >
                                    Italy</option>
                                                       <option value="44"  
                                selected>
                                    Ivory Coast</option>
                                                       <option value="109"  
                                >
                                    Jamaica</option>
                                                       <option value="111"  
                                >
                                    Japan</option>
                                                       <option value="110"  
                                >
                                    Jordan</option>
                                                       <option value="112"  
                                >
                                    Kazakhstan</option>
                                                       <option value="113"  
                                >
                                    Kenya</option>
                                                       <option value="116"  
                                >
                                    Kiribati</option>
                                                       <option value="253"  
                                >
                                    Kosovo</option>
                                                       <option value="119"  
                                >
                                    Kuwait</option>
                                                       <option value="114"  
                                >
                                    Kyrgyzstan</option>
                                                       <option value="120"  
                                >
                                    Laos</option>
                                                       <option value="130"  
                                >
                                    Latvia</option>
                                                       <option value="121"  
                                >
                                    Lebanon</option>
                                                       <option value="127"  
                                >
                                    Lesotho</option>
                                                       <option value="122"  
                                >
                                    Liberia</option>
                                                       <option value="123"  
                                >
                                    Libya</option>
                                                       <option value="125"  
                                >
                                    Liechtenstein</option>
                                                       <option value="128"  
                                >
                                    Lithuania</option>
                                                       <option value="129"  
                                >
                                    Luxembourg</option>
                                                       <option value="250"  
                                >
                                    Macau</option>
                                                       <option value="135"  
                                >
                                    Madagascar</option>
                                                       <option value="151"  
                                >
                                    Malawi</option>
                                                       <option value="152"  
                                >
                                    Malaysia</option>
                                                       <option value="136"  
                                >
                                    Maldives</option>
                                                       <option value="140"  
                                >
                                    Mali</option>
                                                       <option value="141"  
                                >
                                    Malta</option>
                                                       <option value="138"  
                                >
                                    Marshall Islands</option>
                                                       <option value="149"  
                                >
                                    Martinique</option>
                                                       <option value="147"  
                                >
                                    Mauritania</option>
                                                       <option value="150"  
                                >
                                    Mauritius</option>
                                                       <option value="153"  
                                >
                                    Mayotte</option>
                                                       <option value="137"  
                                >
                                    Mexico</option>
                                                       <option value="75"  
                                >
                                    Micronesia (Federated States Of)</option>
                                                       <option value="134"  
                                >
                                    Moldova</option>
                                                       <option value="133"  
                                >
                                    Monaco</option>
                                                       <option value="144"  
                                >
                                    Mongolia</option>
                                                       <option value="143"  
                                >
                                    Montenegro</option>
                                                       <option value="148"  
                                >
                                    Montserrat</option>
                                                       <option value="132"  
                                >
                                    Morocco</option>
                                                       <option value="146"  
                                >
                                    Mozambique</option>
                                                       <option value="142"  
                                >
                                    Myanmar</option>
                                                       <option value="154"  
                                >
                                    Namibia</option>
                                                       <option value="164"  
                                >
                                    Nauru</option>
                                                       <option value="163"  
                                >
                                    Nepal</option>
                                                       <option value="161"  
                                >
                                    Netherlands</option>
                                                       <option value="8"  
                                >
                                    Netherlands Antilles</option>
                                                       <option value="166"  
                                >
                                    New Zealand</option>
                                                       <option value="159"  
                                >
                                    Nicaragua</option>
                                                       <option value="156"  
                                >
                                    Niger</option>
                                                       <option value="158"  
                                >
                                    Nigeria</option>
                                                       <option value="177"  
                                >
                                    North Korea</option>
                                                       <option value="139"  
                                >
                                    North Macedonia</option>
                                                       <option value="162"  
                                >
                                    Norway</option>
                                                       <option value="167"  
                                >
                                    Oman</option>
                                                       <option value="168"  
                                >
                                    Pakistan</option>
                                                       <option value="173"  
                                >
                                    Palau</option>
                                                       <option value="180"  
                                >
                                    Palestine</option>
                                                       <option value="169"  
                                >
                                    Panama</option>
                                                       <option value="174"  
                                >
                                    Papua New Guinea</option>
                                                       <option value="179"  
                                >
                                    Paraguay</option>
                                                       <option value="171"  
                                >
                                    Peru</option>
                                                       <option value="172"  
                                >
                                    Phillippines</option>
                                                       <option value="175"  
                                >
                                    Poland</option>
                                                       <option value="178"  
                                >
                                    Portugal</option>
                                                       <option value="176"  
                                >
                                    Puerto Rico</option>
                                                       <option value="182"  
                                >
                                    Qatar</option>
                                                       <option value="46"  
                                >
                                    Republic Of Congo</option>
                                                       <option value="183"  
                                >
                                    Reunion Islands</option>
                                                       <option value="184"  
                                >
                                    Romania</option>
                                                       <option value="185"  
                                >
                                    Russian Federation</option>
                                                       <option value="186"  
                                >
                                    Rwanda</option>
                                                       <option value="192"  
                                >
                                    Saint Helena</option>
                                                       <option value="117"  
                                >
                                    Saint Kitts And Nevis</option>
                                                       <option value="124"  
                                >
                                    Saint Lucia</option>
                                                       <option value="234"  
                                >
                                    Saint Vincent And The Grenadines</option>
                                                       <option value="241"  
                                >
                                    Samoa</option>
                                                       <option value="197"  
                                >
                                    San Marino</option>
                                                       <option value="202"  
                                >
                                    Sao Tome And Principe</option>
                                                       <option value="187"  
                                >
                                    Saudi Arabia</option>
                                                       <option value="252"  
                                >
                                    Scotland</option>
                                                       <option value="189"  
                                >
                                    Senegal</option>
                                                       <option value="200"  
                                >
                                    Serbia</option>
                                                       <option value="208"  
                                >
                                    Seychelles</option>
                                                       <option value="195"  
                                >
                                    Sierra Leone</option>
                                                       <option value="190"  
                                >
                                    Singapore</option>
                                                       <option value="204"  
                                >
                                    Slovakia</option>
                                                       <option value="205"  
                                >
                                    Slovenia</option>
                                                       <option value="194"  
                                >
                                    Solomon Islands</option>
                                                       <option value="198"  
                                >
                                    Somalia</option>
                                                       <option value="245"  
                                >
                                    South Africa</option>
                                                       <option value="191"  
                                >
                                    South Georgia And The South Sandwich Islands</option>
                                                       <option value="118"  
                                >
                                    South Korea</option>
                                                       <option value="201"  
                                >
                                    South Sudan</option>
                                                       <option value="67"  
                                >
                                    Spain</option>
                                                       <option value="126"  
                                >
                                    Sri Lanka</option>
                                                       <option value="188"  
                                >
                                    Sudan</option>
                                                       <option value="203"  
                                >
                                    Suriname</option>
                                                       <option value="193"  
                                >
                                    Svalbard And Jan Mayen Islands</option>
                                                       <option value="206"  
                                >
                                    Sweden</option>
                                                       <option value="41"  
                                >
                                    Switzerland</option>
                                                       <option value="209"  
                                >
                                    Syria</option>
                                                       <option value="224"  
                                >
                                    Taiwan</option>
                                                       <option value="215"  
                                >
                                    Tajikistan</option>
                                                       <option value="225"  
                                >
                                    Tanzania</option>
                                                       <option value="214"  
                                >
                                    Thailand</option>
                                                       <option value="213"  
                                >
                                    Togo</option>
                                                       <option value="219"  
                                >
                                    Tonga</option>
                                                       <option value="220"  
                                >
                                    Trinidad And Tobago </option>
                                                       <option value="221"  
                                >
                                    Tunisia</option>
                                                       <option value="222"  
                                >
                                    Turkey</option>
                                                       <option value="217"  
                                >
                                    Turkmenistan</option>
                                                       <option value="211"  
                                >
                                    Turks And Caicos Islands</option>
                                                       <option value="223"  
                                >
                                    Tuvalu</option>
                                                       <option value="226"  
                                >
                                    Uganda</option>
                                                       <option value="227"  
                                >
                                    Ukraine</option>
                                                       <option value="9"  
                                >
                                    United Arab Emirates</option>
                                                       <option value="78"  
                                >
                                    United Kingdom</option>
                                                       <option value="231"  
                                >
                                    United States Of America</option>
                                                       <option value="230"  
                                >
                                    Uruguay</option>
                                                       <option value="232"  
                                >
                                    Uzbekistan</option>
                                                       <option value="239"  
                                >
                                    Vanuatu</option>
                                                       <option value="233"  
                                >
                                    Vatican City - Holy See</option>
                                                       <option value="235"  
                                >
                                    Venezuela</option>
                                                       <option value="238"  
                                >
                                    Vietnam</option>
                                                       <option value="66"  
                                >
                                    Western Sahara</option>
                                                       <option value="243"  
                                >
                                    Yemen</option>
                                                       <option value="246"  
                                >
                                    Zambia</option>
                                                       <option value="247"  
                                >
                                    Zimbabwe</option>
                                                     </select>
                            </td>
                        </tr>
                        <tr id="em_tr" height="30" class="hid_tr">
                            <td valign="middle" class="styleBlack" width="34%" style="padding-left:10px;">
                                Passport Type: <span style="color:#F00">*</span>
                            </td>
        
                            <td width="66%" align="left" valign="middle">
                                <select name="passportType" id="passportType" class="form-control-input">
                                <option value="" selected="selected">Select </option>
                                                       <option value="02"  
                                 >
                                    Collective passport</option>
                                                       <option value="13"  
                                 >
                                    D. Viaje Apatridas C. New York</option>
                                                       <option value="04"  
                                 >
                                    Diplomatic passport</option>
                                                       <option value="06"  
                                 >
                                    Government official on duty</option>
                                                       <option value="10"  
                                 >
                                    National laissez-passer</option>
                                                       <option value="14"  
                                 >
                                    Official passport</option>
                                                       <option value="01"  
                                selected >
                                    Ordinary passport</option>
                                                       <option value="08"  
                                 >
                                    Passport of foreigners</option>
                                                       <option value="03"  
                                 >
                                    Protection passport</option>
                                                       <option value="12"  
                                 >
                                    Refugee Travel Document (Geneva Convention)</option>
                                                       <option value="16"  
                                 >
                                    Seaman&rsquo;s book</option>
                                                       <option value="05"  
                                 >
                                    Service passport</option>
                                                       <option value="07"  
                                 >
                                    Special passport</option>
                                                       <option value="11"  
                                 >
                                    UN laissez-passer</option>
                                                     </select>
                            </td>
                        </tr>
        
                        <tr id="pn_tr" height="30" class="hid_tr">
                            <td valign="middle" class="styleBlack" width="34%" style="padding-left:10px;">
                                Passport Number: <span style="color:#F00">*</span>
                            </td>
                            <td width="66%" align="left" valign="middle">
                               <input type="text" name="passport_no" id="passport_no" class="form-control-input upperCase" value="" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off"/>
                            </td>
                        </tr>
        
                        <tr id="pn_tr" height="30" class="hid_tr">
                            <td valign="middle" class="styleBlack" width="34%" style="padding-left:10px;">
                                Passport Issue Date: <span style="color:#F00">*</span>
                            </td>
                            <td width="66%" align="left" valign="middle">
                               <input type="text" name="pptIssueDate" class="form-control-input" id="pptIssueDate" value="" readonly>
                            </td>
                        </tr>
                        <tr id="pn_tr" height="30" class="hid_tr">
                            <td valign="middle" class="styleBlack" width="34%" style="padding-left:10px;">
                                Passport Expiry Date: <span style="color:#F00">*</span>
                            </td>
        
                            <td width="66%" align="left" valign="middle">
                               <input type="text" name="pptExpiryDate" class="form-control-input" id="pptExpiryDate" value="" readonly>
                            </td>
                        </tr>
        
                        <tr id="pn_tr" height="30" class="hid_tr">
        
                            <td valign="middle" class="styleBlack" width="34%" style="padding-left:10px;">
                                Passport Issue Place: <span style="color:#F00">*</span>
                            </td>
                            <td width="66%" align="left" valign="middle">
                              <input type="text" name="pptIssuePalace" class="form-control-input upperCase" id="pptIssuePalace" value="" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off">
                            </td>
                        </tr>
                                                        <tr id="pn_tr" height="30" class="hid_tr">
                            <td valign="top" class="styleBlack" width="34%" style="padding-left:10px;">Choose Other Value Added Services: </td>
                            <td valign="middle" class="styleBlack" width="34%">
                              <div class="row marginBottom vasParent">                	
                                <div class="checkbox-inline clearfix vasId">
                                    <input type="checkbox" name="courierId" id="courierId" value="Y" class="chkbox"> &nbsp; Courier
                                </div>
                              </div>
                                                  <div class="row marginBottom vasParent">                	
                                <div class="checkbox-inline clearfix vasId" for="vasId5">
                                    <input type="checkbox" name="vasId[]" id="vasId5" value="5"   
                                    class="chkbox" > &nbsp; Photograph                        </div>
                                <div>
                                <input type="hidden" name="vasNos5" id="vasNos5" value="" class="form-control-input marginBottomNone col-sm-5 " onclick="removeError(this.id);"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g, "");"   placeholder="No. of copies" style="margin-left: 10px;padding: 1px;">
                                </div>
                              </div>
                                                    <div class="row marginBottom vasParent">                	
                                <div class="checkbox-inline clearfix vasId" for="vasId6">
                                    <input type="checkbox" name="vasId[]" id="vasId6" value="6"   
                                    class="chkbox" > &nbsp; Form Filling                        </div>
                                <div>
                                <input type="hidden" name="vasNos6" id="vasNos6" value="" class="form-control-input marginBottomNone col-sm-5 " onclick="removeError(this.id);"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g, "");"   placeholder="No. of copies" style="margin-left: 10px;padding: 1px;">
                                </div>
                              </div>
                                                    <div class="row marginBottom vasParent">                	
                                <div class="checkbox-inline clearfix vasId" for="vasId37">
                                    <input type="checkbox" name="vasId[]" id="vasId37" value="37"   
                                    class="chkbox" > &nbsp; Flexi hours                        </div>
                                <div>
                                <input type="hidden" name="vasNos37" id="vasNos37" value="" class="form-control-input marginBottomNone col-sm-5 " onclick="removeError(this.id);"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g, "");"   placeholder="No. of copies" style="margin-left: 10px;padding: 1px;">
                                </div>
                              </div>
                                                    <div class="row marginBottom vasParent">                	
                                <div class="checkbox-inline clearfix vasId" for="vasId17">
                                    <input type="checkbox" name="vasId[]" id="vasId17" value="17"   
                                    class="chkbox" > &nbsp; Printing                        </div>
                                <div>
                                <input type="hidden" name="vasNos17" id="vasNos17" value="" class="form-control-input marginBottomNone col-sm-5 chkVasno" onclick="removeError(this.id);"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g, "");"   placeholder="No. of copies" style="margin-left: 10px;padding: 1px;">
                                </div>
                              </div>
                                                    </td>
                        </tr>
                        
                        <tr id="pn_tr" height="30" class="hid_tr">
                            <td valign="middle" class="styleBlack" width="34%" style="padding-left:10px;">&nbsp;</td>
                            <td width="66%" align="left" valign="middle">The Value Added Services are optional and doesn"t in any way influence or fast track my application. The decision to grant a visa is purely a decision of the Consulate and BLS has no influence over the same.</td>
                        </tr>
                                        <!--<tr id="pn_tr" height="30" class="hid_tr">
                            <td valign="middle" class="styleBlack" width="34%" style="padding-left:10px;">&nbsp;</td>
                            <td width="66%" align="left" valign="middle" id="termsborder">
                               <input type="checkbox" name="terms" id="terms" value="1" style="margin-top:3px;" >&nbsp; <a href="terms-and-condition.php" target="_blank" style="text-decoration:underline; float: none; color:#FFF" id="aterms"></a>
                            </td>
                        </tr>-->
        
                        <tr class="hid_tr" height="85">
                            <td  width="34%" valign="middle" class="styleBlack" style="padding-left:10px;">&nbsp;</td>
                            <td width="10%" align="left" valign="middle">
                            <div style="float:left">
                            <img src="captcha/captcha.php" id="captcha-img" style="margin:0; padding:0"/>
                            </div>
                            <div style="float:left; margin-left:20px; margin-top:25px;">
                            <a href="javascript:void(0)" onclick="document.getElementById("captcha-img").src="captcha/captcha.php?"+Math.random();"
                                id="change-image">
                                    <img border="0" src="images/refresh.png" alt="Not readable? Change text." title="Not readable? Change text." />
                            </a>
                            </div>
                            <div style="clear:both"></div>
                            </td>
                        </tr>
                        <tr height="30" class="hid_tr" >
                            <td valign="middle" class="styleBlack" width="34%" style="padding-left:10px;">
                                Enter Captcha: <span style="color:#F00">*</span>
                            </td>
                            <td width="66%" align="left" valign="middle"><input type="text" name="captcha" id="captcha" class="form-control-input" /></td>
                        </tr>
                        <tr id="submit_tr" class="hid_tr">
                            <td>&nbsp;
                           </td>
                            <td id="new">	
                                <input type="submit" name="save" value="Submit" class="btn primary-btn">
                                <input type="hidden" name="app_date_hidden" id="app_date_hidden" value="2021-07-30" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off"/>
                                <input type="hidden" name="type_hidden" id="type_hidden" value="" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off"/>
                                <input type="hidden" name="loc_final" id="loc_final" value="44" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off"/>
                                <input type="hidden" name="countryID" id="countryID" value="44" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off"/>
                                <input type="hidden" name="missionId" id="missionId" value="44" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off"/>
                            </td>	
                        </tr>
                        </form>
                    </table>
                  </td>
              </tr>
        </table>
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
                var dt1  = "2021-07-25";
                var checkService  = "Normal";
                $("#dateOfBirth").datepicker({
                    format: "yyyy-mm-dd",
                    endDate: new Date(dt1),
                    startDate: "-100y",
                    autoclose: true,
                    startView: 2
                });
                $("#pptIssueDate").datepicker({
                    format: "yyyy-mm-dd",
                    endDate: new Date(dt1),
                    startDate: "-100y",
                    autoclose: true,
                    startView: 2
                });
                $("#pptExpiryDate").datepicker({
                    format: "yyyy-mm-dd",
                    startDate: new Date(dt1),
                    autoclose: true,
                    startView: 2
                });
                var dt4  = "2021-07-26";
                var blocked_dates = ["01-01-2020","21-05-2020","25-05-2020","20-07-2021","01-01-2020","21-05-2020","25-05-2020","20-07-2021"];
                var available_dates = ["26-07-2021","27-07-2021","28-07-2021","29-07-2021","30-07-2021"];
                var fullCapicity_dates = [];
                var offDates_dates = ["31-07-2021"];
                var allowArray = [1];
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
                    endDate: "2021-07-31",
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
                if (checkService == "Premium" || checkService == "Prime") {
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
                              //$("#vasId15").prop("checked", true);
                              //$("#vasId15").bind("click", eventhandler);
                            }else{
                              //$("#vasId6").prop("checked", false);	
                              //$("#vasId6").unbind("click", eventhandler);
                              //$("#vasId15").prop("checked", false);	
                              //$("#vasId15").unbind("click", eventhandler);
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
        <div class="row marginBottom marginTop paddingBottom paddingTop">
        <div class="col-sm-8 container">
        <h3 class="row fontweightNone marginBottom">Know your Jurisdiction</h3>
        
        <div class="row borderAll boxsizing borderBottomNone">
        <h4 class="col-sm-7 paddingInBoxExtra greyBG borderRight fontweightNone">If you are living in</h4>
        <h4 class="col-sm-3 paddingInBoxExtra greyBG fontweightNone">You have to visit</h4>
        </div>
        
        <div class="row borderAll boxsizing">
        <div class="col-sm-7 paddingInBox borderRight">&nbsp;</div>
        <div class="col-sm-3 paddingInBox">BLS Spain VAC Abidjan </div>
        </div>
        
        <!--<div class="row borderAll boxsizing borderBottomNone">
        <div class="col-sm-7 paddingInBox borderRight">&nbsp;</div>
        <div class="col-sm-3 paddingInBox">BLS Spain VAC Guayaquil  </div>
        </div>-->
        
        <!--<div class="row borderAll boxsizing borderBottomNone">
        <div class="col-sm-7 paddingInBox borderRight">&nbsp;</div>
        <div class="col-sm-3 paddingInBox">BLS Spain VAC Rabat </div>
        </div>
        
        <div class="row borderAll boxsizing borderBottomNone">
        <div class="col-sm-7 paddingInBox borderRight">&nbsp;</div>
        <div class="col-sm-3 paddingInBox">BLS Spain VAC Nadar </div>
        </div>
        
        <div class="row borderAll boxsizing borderBottomNone">
        <div class="col-sm-7 paddingInBox borderRight">&nbsp;</div>
        <div class="col-sm-3 paddingInBox">BLS Spain VAC Tetuan  </div>
        </div>
        
        <div class="row borderAll boxsizing">
        <div class="col-sm-7 paddingInBox borderRight">&nbsp;</div>
        <div class="col-sm-3 paddingInBox">BLS Spain VAC Agadir  </div>
        </div>-->
        
        <!--<div class="row borderAll boxsizing">
        <div class="col-sm-7 paddingInBox borderRight">&nbsp;</div>
        <div class="col-sm-3 paddingInBox">BLS Spain VAC Canton</div>
        </div>-->
        
        </div>
        </div></div>
        </section>
        <section class="row aboutBG">
        <div class="wrap">
        </div>
        </section>
        </div>
        <!-- /body Panel -->
        <!-- footer Panel -->
        <style>
        #mySidenav a {
            position:fixed;
            right: -200px;
            transition: 0.3s;
            padding: 15px;
            width: 280px;
            text-decoration: none;
            font-size: 16px;
            color: white;
            border-radius: 5px 0 0 5px;
            margin-top: 100px;
        }
        
        #mySidenav a:hover {
            right: 0;
        }
        
        #request {
            top: 20px;
            background-color: #bf8f2c;
        }
        #attestation {
            top: 95px;
            background-color: #bf8f2c;
            position:fixed;
            right: -185px;
            padding: 10px;
            width: 260px;
            text-decoration: none;
            font-size: 16px;
            color: white;
            border-radius: 5px 0 0 5px;
            margin-top: 100px;
        }
        </style>
        <!--<div id="mySidenav" class="sidenav">
        <a href="mobile-biometric.php" id="request"><img src="images/icon-app.png" style="float:left;"><span style="padding:8px 0 0 15px;">Servicio a Domicillio</span></a>
        </div>-->
        <a href="https://blsattestation.com/" target="_blank" id="attestation"><img src="images/attestationService.gif" style="float:left;"></a>
        
        
        <footer class="row footerSection pull_left">
        <div class="wrap paddingInBox boxing footerBG">
        
        <div class="row paddingBottom">
        <a href="about.php" class="link">About Us</a>
        <a href="customer_experience.php" class="link">Customer Experience</a>
        <a href="faq.php" class="link">FAQ</a>
        <a href="security_rules.php" class="link">Security Rules</a>
        </div>
        
        <div class="row white">
        <div class="font11">&copy; BLS International 2021. All Rights Reserved</div>
        <div class="pull_right">
        <a href="privacy-policy.php" class="white font11 floatNone">Privacy Policy</a> | 
        <a href="cookies.php" class="white font11 floatNone">Cookies Policy</a> | 
        <a href="disclaimer.php" class="white font11 floatNone">Disclaimer</a>
        </div>
        </div>
        </div>
        </footer>
        <!-- /footer Panel -->
        <!---------------------POP UP BOX FOR PL/PT------------------------------>
        <div class="popup notification" id="IDBodyPanel" style="height:227px; display:none; padding:29px; width:700px;">
        <div class="popupCloseIcon">X</div>
        <!--<h1 class="row paddingBottom fontweightNone borderBottom alignCenter">Normal Slot Full!!</h1>-->
        <div class="row paddingInBoxExtra fontweightNone alignCenter paddingTopNone marginTop">Regular Appointment for application submission is not available on this date, Premium Lounge / Prime Time services can be availed at an additional fee to save waiting time.</div>
        <div class="row paddingInBoxExtra fontweightNone alignCenter paddingTopNone"></div>
        <div class="container col-sm-4 ">
        <form name="applicantPremium" id="applicantPremium" action="/appointment.php" method="post" autocomplete="off">
        <div class="row">
        <div class="col-sm-8 paddingRight"><select class="form-control-input" name="serviceChange" style="background:#fff;" ></select></div>
        <div class="col-sm-2"><input type="submit" name="premiumService" class="btn primary-btn" value="Go"/></div>
        </div>
        </form>
        </div>
        </div>
        <div class="popupBG" style="display:none"></div>
        <!-------------------- POP UP BOX FOR PL/PT ----------------------------->
        <div class="popupPanel" id="overlay" style="display:none">
        <div class="imageDiv"><img src="images/loader.gif"/></div>
        </div>
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
        </body>
        </html>';

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
        dd($appointer->get_availability());










        


        // dd($appointer->get_availability());

    dd($appointer->check_mailable());
    
    
    
    
    // dd("end");



   //dd($appointer->check_availability());
        









        dd("end");
        return redirect()->away('https://www.youtube.com/watch?v=1k8craCGpgs');;
        //return view("welcome");
    }
}
