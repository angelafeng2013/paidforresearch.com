<?php
$affiliate_id = isset($_GET['affiliate_id']) ? $_GET['affiliate_id'] : '';
$offer_id = isset($_GET['offer_id']) ? $_GET['offer_id'] : '';
$campaign_id = isset($_GET['campaign_id']) ? $_GET['campaign_id'] : '';
$first_name = isset($_GET['firstname']) ? $_GET['firstname'] : '';
$last_name = isset($_GET['lastname']) ? $_GET['lastname'] : '';
$dobmonth = isset($_GET['dobmonth']) ? $_GET['dobmonth'] : '';
$dobday = isset($_GET['dobday']) ? $_GET['dobday'] : '';
$dobyear = isset($_GET['dobyear']) ? $_GET['dobyear'] : '';
$state = isset($_GET['state']) ? $_GET['state'] : '';
$city = isset($_GET['city']) ? $_GET['city'] : '';
$zip = isset($_GET['zip']) ? $_GET['zip'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$gender = isset($_GET['gender']) ? $_GET['gender'] : '';
$ethnicity = isset($_GET['ethnicity']) ? $_GET['ethnicity'] : '';
$address = isset($_GET['address']) ? $_GET['address'] : '';
$phone = isset($_GET['phone']) ? $_GET['phone'] : '';
$phone1 = isset($_GET['phone1']) ? $_GET['phone1'] : '';
$phone2 = isset($_GET['phone2']) ? $_GET['phone2'] : '';
$phone3 = isset($_GET['phone3']) ? $_GET['phone3'] : '';
$image = isset($_GET['image']) ? $_GET['image'] : '';
$s1 = isset($_GET['s1']) ? $_GET['s1'] : '';
$s2 = isset($_GET['s2']) ? $_GET['s2'] : '';
$s3 = isset($_GET['s3']) ? $_GET['s3'] : '';
$s4 = isset($_GET['s4']) ? $_GET['s4'] : '';
$s5 = isset($_GET['s5']) ? $_GET['s5'] : '';
$d1 = isset($_GET['d1']) ? $_GET['d1'] : '';
$d2 = isset($_GET['d2']) ? $_GET['d2'] : '';
$d3 = isset($_GET['d3']) ? $_GET['d3'] : '';
$d4 = isset($_GET['d4']) ? $_GET['d4'] : '';
$d5 = isset($_GET['d5']) ? $_GET['d5'] : '';
$revTracker= isset($_GET['revTracker']) ? $_GET['revTracker'] : '';

//Phone
if($phone != '' && $phone1 == '' && $phone2 == '' && $phone3 == '' ) {
  $phone_num = preg_replace("/[^0-9,.]/", "", $phone);
  if(strlen($phone_num)==10) {
    $phone1 = substr($phone_num,0,3);
    $phone2 = substr($phone_num,3,3);
    $phone3 = substr($phone_num,6,4);
  }
}

if($phone == '' && $phone1 != '' && $phone2 != '' && $phone3 != '') {
  $phone = $phone1.$phone2.$phone3;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<title>Toluna</title>
<link href="css/style.css" type="text/css" rel="stylesheet"></link>
<link href="css/mobile.css" type="text/css" rel="stylesheet">
<link href="css/opt-in.css" type="text/css" rel="stylesheet">
<link href="css/stack.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<script type="text/javascript" src="js/functions.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery.validate.js"></script>
</head>

<body>
<form id="hostedform" method="get"  name="hostedform" class="survey_form" enctype="text" action="http://leadreactor.engageiq.com/sendLead/">
    <div id="contentbox">
      <!-- Standard Required Data BEGIN-->
          <!-- Standard Required Data BEGIN-->
    <input type="hidden" name="eiq_campaign_id" value="543"/> 
    <input type="hidden" name="eiq_affiliate_id" value="<?= $revTracker ?>"/> 
    <input type="hidden" name="eiq_email" value="<?= $email ?>"/> 
    <input type="hidden" name="rev_tracker" value="CD<?= $revTracker ?>"/> 
      <!-- Standard Required Data END-->

      <!-- Add Here additional input fields needed -->   
     
          <input type="hidden" name="address"      value="<?= $address ?>" /> 
          <input type="hidden" name="phone1"       value="<?= $phone1 ?>" /> 
          <input type="hidden" name="phone2"       value="<?= $phone2 ?>" /> 
          <input type="hidden" name="phone3"       value="<?= $phone3 ?>" />
          <input type="hidden" name="phone"       value="<?= $phone ?>" /> 
          <input name="ethnicity" type="hidden" value="<?= $ethnicity ?>"/>
          <input name="firstname" type="hidden" value="<?= $first_name ?>"/>
          <input name="lastname" type="hidden" value="<?= $last_name ?>"/>
          <input name="dobmonth" type="hidden" value="<?= $dobmonth ?>"/>
          <input name="dobday" type="hidden" value="<?= $dobday ?>"/>
          <input name="dobyear" type="hidden" value="<?= $dobyear ?>"/>
          <input name="email" type="hidden" value="<?= $email ?>"/>
          <input name="gender" type="hidden" value="<?= $gender ?>"/>
          <input name="zip" type="hidden" value="<?= $zip ?>"/>
          
    

    <div align="center">    
     <div class="content-desktop" style="width: 100%;">
    
     <img src="http://leadreactor.engageiq.com/images/gallery/tolunasticker.png" align="absmiddle" />
            <br>
        <!-- Paste Desktop Creative Here -->
        <b> Earn rewards each time you qualify and complete a survey!</b><br>
The Toluna community wants your opinion and will never try to sell you anything. Join in just three easy steps: fill out the form below, check your email for the confirmation link, and then take the survey to start earning! Enter to win $4,500 cash just for signing up!
       <!--  <img src="http://leadreactor.engageiq.com/images/gallery/toluna600X120.png" align="absmiddle" /> -->
   
 
     </div> 
     <div class="content-mobile" style="width: 100%;">
   <img src="http://leadreactor.engageiq.com/images/gallery/tolunasticker.png" align="absmiddle" />
        <br />
       <b> Earn rewards each time you qualify and complete a survey!</b><br>
The Toluna community wants your opinion and will never try to sell you anything. Join in just three easy steps: fill out the form below, check your email for the confirmation link, and then take the survey to start earning! Enter to win $4,500 cash just for signing up!
     </div>
          <br />
      <div class="content-desktop2">
          <table width="70%" border="0" cellspacing="0" cellpadding="0" id="formtable" >
            <!-- Paste here additional custom questions here -->
          
            <!-- Custom Question Start -->
              <tr>
                <td height="38" align="right">
                  <!-- Paste Question Here -->
                   
                  Enter your email:
                </td>
                <td height="38">&nbsp;</td>
                <td height="38" align="left">
                 
                 <input name="email" type="text" value="<?= urldecode($email) ?>" required/>
                </td>
            </tr>
            <tr>
                <td height="38" align="right">
                  <!-- Paste Question Here -->
                   
                  <b>1.</b> Ethnicity:
                </td>
                <td height="38">&nbsp;</td>
                <td height="38" align="left">
                  <!-- Paste Question Value Here -->
                  <label>
                        <select id="q1" name="q1">
                          <option value="">Select</option>
            <option value="2000264">Asian</option>
                        <option value="2000265">Black or African-American</option>
                         <option value="2000267">Native American or Alaska Native</option>
                          <option value="2000268">Native Hawaiian or Other Pacific Islander</option>
                           <option value="2000269">Other Ethnicity</option>
                            <option value="2000271">White</option>
                             <option value="2000272">Don't know/prefer not to answer</option>
                        </select>
                    </label>
                </td>
            </tr> 
            <tr>
                <td height="38" align="right">
                  <!-- Paste Question Here -->
                  <b>2.</b> Household Yearly Income:
                </td>
                <td height="38">&nbsp;</td>
                <td height="38" align="left">
                  <!-- Paste Question Value Here -->
                  <label>
                        <select id="q2" name="q2">
                          <option value="">Select</option>
            <option value="2002313">Under $15,000</option>
                        <option value="2002314">$15,000-$19,999</option>
                        <option value="2002315">$20,000-$24,999</option>
                        <option value="2002316">$25,000-$29,999</option>
                        <option value="2002317">$30,000-$34,999</option>
                        <option value="2002318">$35,000-$39,999</option>
                        <option value="2002319">$40,000-$44,999</option>
                        <option value="2002320">$45,000-$49,999</option>
                        <option value="2002321">$50,000-$54,999</option>
                        <option value="2002322">$55,000-$59,999</option>
                        <option value="2002323">$60,000-$64,999</option>
                        <option value="2002324">$65,000-$69,999</option>
                        <option value="2002325">$70,000-$74,999</option>
                        <option value="2002326">$75,000-$79,999</option>
                        <option value="2002327">$80,000-$84,999</option>
                        <option value="2002328">$85,000-$89,999</option>
                        <option value="2002329">$90,000-$94,999</option>
                        <option value="2002330">$95,000-$99,999</option>
                        <option value="2002331">$100,000-$124,999</option>
                        <option value="2002332">$125,000-$149,999</option>
                        <option value="2002334">$200,000+</option>
                        <option value="2002335">Prefer not to say</option>
                        </select>
                    </label>
                </td>
            </tr> 
            <tr>
                <td height="38" align="right">
                  <!-- Paste Question Here -->
                  <b>3.</b> Highest level of education completed:
                </td>
                <td height="38">&nbsp;</td>
                <td height="38" align="left">
                  <!-- Paste Question Value Here -->
                  <label>
                         <select id="q3" name="q3" >
                          <option value="">Select</option>
                        <option value="2002268">Elementary School</option>
                        <option value="2002269">Middle School/Junior High School</option>
                        <option value="2002270">High School</option>
                        <option value="2002271">Some College/University</option>
                        <option value="2002272">Graduated 2-year College</option>
                        <option value="2002273">Graduated 4-year College/University</option>
                        <option value="2002274">Graduate School</option>
                        <option value="2002275">Postgraduate</option>
                        <option value="2002277">Prefer not to say</option>
                         </select>
                    </label>
                </td>
            </tr> 
            <tr>
                <td height="38" align="right">
                  <!-- Paste Question Here -->
                   <b>4.</b> Work Position:
                </td>
                <td height="38">&nbsp;</td>
                <td height="38" align="left">
                  <!-- Paste Question Value Here -->
                  <label>
                        <select id="q4" name="q4" >
                          <option value="">Select</option>
                        <option value="2796310">High managerial, administrative or professional</option>
                        <option value="2796311">Intermediate managerial, administrative or professional</option>
                        <option value="2796312">Supervisor; clerical; junior managerial, administrative or professional</option>
                        <option value="2796313">Skilled manual worker</option>
                        <option value="2796314">Semi-skilled or unskilled manual worker</option>
                        <option value="2796316">Retired</option>
                        <option value="2796317">Student</option>
                        <option value="2796318">Unemployed</option>
                        <option value="2796315">Housewife / Homemaker</option>
                        <option value="3502718">Intermediate Professional Liberal Profession</option>
                        <option value="2801628">Farmer ( farm owner)</option>
                        <option value="2801629">Craftman, shop owner, managing director</option>
                        <option value="2801630">Intellectual profession, Executive, Freelance</option>
                        <option value="2801631">Intermediate profession:  Public sector ( health, teaching…) companies</option>
                        <option value="2801632">Employee, public sector companies</option>
                         </select>
                    </label>
                </td>
            </tr> 
            <tr>
                <td height="38" align="right">
                  <!-- Paste Question Here -->
                   <b>5.</b> The number of people in household including you:
                </td>
                <td height="38">&nbsp;</td>
                <td height="38" align="left">
                  <!-- Paste Question Value Here -->
                  <label>
                         <select id="q5" name="q5" >
                          <option value="">Select</option>
                        <option value="2002336">1</option>
                       
                        <option value="2002338">2</option>
                        <option value="2002339">3</option>
                        <option value="2002340">4</option>
                        <option value="2002341">5</option>
                        <option value="2002342">6</option>
                        <option value="2002343">7</option>
                        <option value="2002344">8</option>
                        <option value="2002345">9</option>
                         <option value="2002337">10+</option>
                         </select>
                    </label>
                </td>
            </tr> 
            <tr>
                <td height="38" align="right">
                  <!-- Paste Question Here -->
                  <b>6.</b> he number of children under 18 in household:
                </td>
                <td height="38">&nbsp;</td>
                <td height="38" align="left">
                  <!-- Paste Question Value Here -->
                  <label>
                        <select id="q6" name="q6" >
                          <option value="">Select</option>
                        <option value="2002346">0</option>
                      
                         <option value="2002349">1</option>
                         <option value="2002350">2</option>
                        <option value="2002351">3</option>
                         <option value="2002352">4</option>
                        <option value="2002353">5</option>
                         <option value="2002354">6</option>
                        <option value="2002355">7</option>
                         <option value="2002356">8</option>
                          <option value="2002347">9</option>
                         <option value="2788232">10+</option>
                         </select>
                    </label>
                </td>
            </tr> 
            <tr>
                <td height="38" align="right">
                  <!-- Paste Question Here -->
                   <b>7.</b>Are you the primary grocery shopper in your household?
                </td>
                <td height="38">&nbsp;</td>
                <td height="38" align="left">
                  <!-- Paste Question Value Here -->
                  <label>
                        <select id="q7" name="q7" >
                          <option value="">Select</option>
                        <option value="2003930">Yes</option>
                        <option value="2003931">No</option>
                         <option value="2003932">Share responsibility</option>
                         </select>
                    </label>
                </td>
            </tr> 
             <!-- Custom Question End -->
      <tr>
      <td height="43" colspan="3" align="center" valign="bottom"><hr/>    
    <div id="contentbox" style="padding: 0 26px;">
     <br />
      <div class="validate-wrap">
    <div id="validate-desktop" class="validate-container" align="center">
         <button class="w3-btn w3-white w3-border w3-border-red w3-round-xlarge"><input  id="email-search-link" onclick="submitform();window.location='https://mail.google.com/mail/u/0/?shva=1#advanced-search/subset=ast&has=toluna'" class="btn btn-primary btn-lg"  >Click here to search for your confirmation email!</a></button>
    
    </div>
</div>
     
   </div>
         </td>
       </tr>   
 <!--       <tr>
            <td height="43" colspan="3" align="center" valign="bottom"><hr/>    
              <div class="yes-no-desktop">
                <input id="email-search-link" name="yesno_top" type="radio" value="YES" onclick="submitform();" />
                <label class="class-yes" for="yes_top">Click here to search for your confirmation email!</label>     
               
              </div>  
              <div class="fixed-button new-mobile-toluna">
                <input id="email-search-link" name="yesno_top" type="radio" value="YES" onclick="submitform();"/>
                <label class="class-yes" for="yes_top">Click here to search for your confirmation email!</label>
               
              </div>    
            </td>
          </tr> -->    
          </table>
          </div>
  
    </div>
</form>      

   <?php
   
   $yahoolink="https://login.yahoo.com/?.src=ym&.intl=us&.lang=en-US&.done=https%3a//mail.yahoo.com&login-username=".$email;
   echo "<!--Ping reply $yahoolink-->";
   ?>
<script type="text/javascript">
  function submitform()
 {
  var form = $("#hostedform");
  form.validate();
  if(form.valid())
  {   
     
     var emailAddress = '<?= urldecode($email) ?>';
      if (emailDomain == "gmail.com" || emailDomain == "googlemail.com") {
               
               window.open('https://mail.google.com/mail/u/0/?shva=1#advanced-search/subset=ast&has=toluna','_blank');
               form.submit();  
            }
  }
} 
    $( document ).ready(function() {
        //ga('send', 'event', 'validate', 'view');
    });
    // get query string
    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }
    
    var emailAddress = '<?= urldecode($email) ?>';
    var userFirstName = '<?= urldecode($first_name) ?>';
    
    var apiLink = "//api.sweepstakesalerts.com/datacollection/?s=96&ak=a75ce3b0-9a6d-4278-a3f5-cfdf886eb053&email=" + emailAddress + "&firstname=" + userFirstName;
     
    
    $('#send-email-link').one( "click", function() {
        //ga('send', 'event', 'validate', 'click', 'send email');
        if (emailAddress) {
            setTimeout(
            function() {
                var img = $('<img width="1" height="1" id="SAapiPixel">'); 
                img.attr('src', apiLink);
                img.appendTo('body');
                //ga('send', 'event', 'validate', 'pixel', 'mobile pixel');
                //$.get( "//api.sweepstakesalerts.com/datacollection/", { s: "51&ak=7a5e5486-4063-4fb0-b47d-ae31b6f30c44", email: emailAddress } );
            }, 10000);
        }
    });
    
    $('#email-search-link').one( "click", function() {
        //ga('send', 'event', 'validate', 'click', 'search email');
    });

        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            $('#email-search-link').hide(function() {
                $('.alternate-email-message').show();
            });
        }
    
        else {
            // get email address from query string
            if (emailAddress) {
                var emailDomain = emailAddress.split('@').slice(1);
                //var img = $('<img width="1" height="1" id="SAapiPixel">'); 
                //img.attr('src', apiLink);
                //img.appendTo('body');
                //$.get( "//api.sweepstakesalerts.com/datacollection/", { s: "51&ak=7a5e5486-4063-4fb0-b47d-ae31b6f30c44", email: emailAddress } );
            }

            if (emailDomain == "gmail.com" || emailDomain == "googlemail.com") {

               window.open('https://mail.google.com/mail/u/0/?shva=1#advanced-search/subset=ast&has=toluna','_blank')
               
            }

            else if (emailDomain == "live.com" || emailDomain == "hotmail.com") {
                $('#email-search-link').attr('href', 'https://mail.live.com/?fid=flsearch&srch=1&sfrm=paidforresearch&sdr=4&satt=0');
            }

            else if (emailDomain == "yahoo.com") {
                $('#email-search-link').attr('href', '<?php echo $yahoolink; ?>');
            }

            else if (emailDomain == "aol.com") {
                $('#email-search-link').attr('href', 'http://mail.aol.com');
            }

            else {
                $('#email-search-link').hide(function() {
                    $('.alternate-email-message').show();
                });
            }
        }
    
</script>

	</body>
</html>