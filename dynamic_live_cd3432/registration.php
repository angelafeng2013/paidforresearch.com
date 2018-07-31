<?php 
//Attach header page
include_once("header.php");

if(! isset($_SESSION['user'])) {
  header("Refresh:0");
  exit;
}

$user = $_SESSION['user'];

$affiliate_id = isset($_GET['affiliate_id']) && $_GET['affiliate_id'] != '' ? $_GET['affiliate_id'] : $user['affiliate_id'];
$offer_id = isset($_GET['offer_id']) && $_GET['offer_id'] != '' ? $_GET['offer_id'] : $user['offer_id'];
$campaign_id = isset($_GET['campaign_id']) && $_GET['campaign_id'] != '' ? $_GET['campaign_id'] : $user['campaign_id'];
$first_name = isset($_GET['firstname']) && $_GET['firstname'] != '' ? $_GET['firstname'] : $user['first_name'];
$last_name = isset($_GET['lastname']) && $_GET['lastname'] != '' ? $_GET['lastname'] : $user['last_name'];
$dobmonth = isset($_GET['dobmonth']) && $_GET['dobmonth'] != '' ? $_GET['dobmonth'] : $user['dobmonth'];
$dobday = isset($_GET['dobday']) && $_GET['dobday'] != '' ? $_GET['dobday'] : $user['dobday'];
$dobyear = isset($_GET['dobyear']) && $_GET['dobyear'] != '' ? $_GET['dobyear'] : $user['dobyear'];
$state = isset($_GET['state']) && $_GET['state'] != '' ? $_GET['state'] : isset($user['state']) ? $user['state'] : '';
$city = isset($_GET['city']) && $_GET['city'] != '' ? $_GET['city'] : isset($user['city']) ? $user['city'] : '';
$zip = isset($_GET['zip']) && $_GET['zip'] != '' ? $_GET['zip'] : $user['zip'];
$email = isset($_GET['email']) && $_GET['email'] != '' ? $_GET['email'] : $user['email'];
$gender = isset($_GET['gender']) && $_GET['gender'] != '' ? $_GET['gender'] : $user['gender'];
$ethnicity = isset($_GET['ethnicity']) && $_GET['ethnicity'] != '' ? $_GET['ethnicity'] : $user['ethnicity'];
$address = isset($_GET['address']) && $_GET['address'] != '' ? $_GET['address'] : $user['address'];
$phone = isset($_GET['phone']) && $_GET['phone'] != '' ? $_GET['phone'] : $user['phone'];
$phone1 = isset($_GET['phone1']) && $_GET['phone1'] != '' ? $_GET['phone1'] : $user['phone1'];
$phone2 = isset($_GET['phone2']) && $_GET['phone2'] != '' ? $_GET['phone2'] : $user['phone2'];
$phone3 = isset($_GET['phone3']) && $_GET['phone3'] != '' ? $_GET['phone3'] : $user['phone3'];
$image = isset($_GET['image']) && $_GET['image'] != '' ? $_GET['image'] : $user['image'];
$s1 = isset($_GET['s1']) && $_GET['s1'] != '' ? $_GET['s1'] : $user['s1'];
$s2 = isset($_GET['s2']) && $_GET['s2'] != '' ? $_GET['s2'] : $user['s2'];
$s3 = isset($_GET['s3']) && $_GET['s3'] != '' ? $_GET['s3'] : $user['s3'];
$s4 = isset($_GET['s4']) && $_GET['s4'] != '' ? $_GET['s4'] : $user['s4'];
$s5 = isset($_GET['s5']) && $_GET['s5'] != '' ? $_GET['s5'] : $user['s5'];
$d1 = isset($_GET['d1']) && $_GET['d1'] != '' ? $_GET['d1'] : $_SESSION['d1'];
$d2 = isset($_GET['d2']) && $_GET['d2'] != '' ? $_GET['d2'] : $_SESSION['d2'];
$d3 = isset($_GET['d3']) && $_GET['d3'] != '' ? $_GET['d3'] : $_SESSION['d3'];
$d4 = isset($_GET['d4']) && $_GET['d4'] != '' ? $_GET['d4'] : $_SESSION['d4'];
$d5 = isset($_GET['d5']) && $_GET['d5'] != '' ? $_GET['d5'] : $_SESSION['d5'];

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

$has_filter_questions = count($_SESSION['filter_questions']) > 0 ? 1 : 0;
?>

<link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">

<style type="text/css" media="screen">
  *, *:before, *:after {
    box-sizing: content-box;
  }
  table {
    border-collapse: separate;
    border-spacing: 1px;
  }
  select {
    height: 2.3rem;
  }
  .input-field label {
    color: #565656;
  }
  .chk_error:before {
    border: 2px solid red !important;
  }
  .birthdate--container {
    margin-bottom: 10%;
  }
  [type="checkbox"]:checked + label:before {
    border-top: 2px solid transparent !important;
    border-left: 2px solid transparent !important;
    border-right: 2px solid #8bc34a !important;
    border-bottom: 2px solid #8bc34a !important;
  }
  label.chk_error {
    color: #565656 !important;
  }
  #ch-placeholder {
    margin-top: 10%;
    text-align: center;
  }
  .spacer {
    margin-bottom: 5%;
  }
  .button-holder {
    text-align: center;
  }
  strong {
    font-weight: 700;
  }
  #progress_bar_row > td.cell_shade, #progress_bar_row > td.cell_noshade {
    padding: 0;
    border-spacing: 1px !important;
    border-collapse: separate !important;
    border-radius: 0;
    line-height: 19px;
  }
  .ch-danger-reg {
    font-size: 14px;
    position: inherit;
    color: #ffffff;
    text-align: left;
    line-height: inherit;
    height: auto;
    margin: 0;
    background-color: #EF5350;
    border-color: #f32c1e;
    padding: 15px;
    width: 95%;
  }
  select.error, textarea.error, input[type="text"].error {
    border-top: none !important;
    border-left: none !important;
    border-right: none !important;
    border-bottom: red 2px solid !important;
  }
  small#fname-error,
  small#gender-error,
  small#lname-error,
  small#email-error,
  small#zip-error,
  small#dobmonth-error,
  small#dobday-error,
  small#dobyear-error,
  small#phone1-error,
  small#phone2-error,
  small#phone3-error {
    position: absolute;
    display: block;
    top: 4.5em;
    color: #FF0000;
  }
  .meta-optional {
  	display: block;
    font-size: 11px;
    color: #a1a1a1;
  }
  .material-tcpa label[for="chk_agree"] {
  	height: auto;
  }
  @media screen and (max-width: 859px) {
    #contentbox {
      font-size: 1rem;
    }
    .the-submit-btn {
      width: auto !important;
    }  
  }
  @media screen and (max-width: 620px) {
    .material-tcpa {
      min-height: 140px;
    }
    .ch-danger-reg {
      font-size: 9px;
    }
    #ch-placeholder {
      margin-top: 20%;
    }
  }
</style>

<input type="hidden" name="has_form_questions" id="has_form_questions" value="<?= $has_filter_questions ?>" />

<!-- PROGRESS BAR START -->
<?php display_progress_bar(2,14,false); ?>
<!-- PROGRESS BAR END -->
<?php echo '<span style="display:none" id="private_progress_bar">regis</span>'; ?>
<!-- <div id="contentbox_main" style="padding-right: 20px; padding-top: 150px; padding-left: 20px; padding-bottom: 50px; position: relative; border: solid 5px #6EB438;"> -->
  <!-- <div id="contentbox"> -->
  <div id="contentbox" style="padding-right: 20px; padding-left: 20px; padding-bottom: 50px; position: relative; border: solid 5px #636363;">
    <p align="center" style="margin-top: 10px;">
      <strong>Fill out  all the fields below and hit Submit to start the survey with PaidForResearch.com<br /><br /></strong>
    </p>
  <div>
  <div class="container form-container">
      <div class="row">                  
    <form id="registration_form" method="get" name="hostedform" class="hostedform" enctype="text" action="questions.php">
      <input type="hidden" name="affiliate_id"        value="<?= $affiliate_id ?>" />
      <input type="hidden" name="offer_id"      value="<?= $offer_id ?>" />     
      <input type="hidden" name="campaign_id"      value="<?= $campaign_id ?>" />     
      <input type="hidden" name="s1"      value="<?= $s1 ?>" />                    
      <input type="hidden" name="s2"      value="<?= $s2 ?>" />                    
      <input type="hidden" name="s3"      value="<?= $s3 ?>" />                    
      <input type="hidden" name="s4"      value="<?= $s4 ?>" />                     
      <input type="hidden" name="s5"      value="<?= $s5 ?>" />  
      <input type="hidden" name="d1"      value="<?= $d1 ?>" />                    
      <input type="hidden" name="d2"      value="<?= $d2 ?>" />                    
      <input type="hidden" name="d3"      value="<?= $d3 ?>" />                    
      <input type="hidden" name="d4"      value="<?= $d4 ?>" />                     
      <input type="hidden" name="d5"      value="<?= $d5 ?>" />  
      <input type="hidden" name="image"   value="<?= $image ?>"/>
      <input type="hidden" name="address"      value="<?= $address ?>" /> 
      <input type="hidden" name="phone1"       value="<?= $phone1 ?>" /> 
      <input type="hidden" name="phone2"       value="<?= $phone2 ?>" /> 
      <input type="hidden" name="phone3"       value="<?= $phone3 ?>" /> 
      <input type="hidden" name="phone"       value="<?= $phone ?>" /> 
      <input name="ethnicity" type="hidden" value="<?= $ethnicity ?>"/>
      <input type="hidden" name="source_url"  value="<?= $_SESSION['source_url'] ?>"/>
      <input type="hidden" name="screen_view" value="<?= $_SESSION['device']['view'] ?>" />
      <input type="hidden" name="ip" value="<?= $_SESSION['client_ip'] ?>"/>
      <input type="hidden" name="email2" value="" />  
      <input type="hidden" name="user_agent" value="<?= $_SESSION['browser']['user_agent']?>"/>

      <div class="input-field col m6 s12">
        <input name="first_name" type="text" id="fname" class="fname validate" value="<?= urldecode($first_name) ?>" required/>
        <label for="fname">First Name</label>
      </div>

      <div class="input-field col m6 s12">
        <input name="last_name" id="lname" type="text" class="validate" value="<?= urldecode($last_name) ?>" required/>
        <label for="lname">Last Name</label>
      </div>

      <div class="input-field col s12">
        <input name="email" id="email" type="text" value="<?= urldecode($email) ?>" class="validate" required/>
        <label for="email">Email</label>
      </div>

      <div class="input-field col s12">
        <input name="zip" type="text" id="zip" value="<?= $zip ?>" required aria-required="true"/>
        <label for="zip">Zip code</label>
      </div>

      <div class="col s12">
            <div class="row">
              <div class="input-field col s12 m3 birthdate--container">
                <label for="birthdate">Birthdate</label>
                <input type="hidden" name="birthdate" id="birthdate" />
              </div>
              <div class="input-field col m3 s4">
                <select name="dobmonth" class="browser-default validate" required>
                    <option value="" disabled selected>MM</option>
                    <?php
                      for($lop=1;$lop<=12;$lop++)
                      {
                        echo '<option value="'.sprintf("%02d", $lop).'" ';
                        if($dobmonth == $lop) echo 'selected';
                        echo '>'.sprintf("%02d", $lop).'</option>';
                      }
                    ?>
                  </select>
              </div>

              <div class="input-field col m3 s4">
                <select name="dobday" class="browser-default validate" required>
                    <option value="" disabled selected>DD</option>
                    <?php
                      for($lop=1;$lop<=31;$lop++)
                      {
                        echo '<option value="'.sprintf("%02d", $lop).'" ';
                        if($dobday == $lop) echo 'selected';
                        echo '>'.sprintf("%02d", $lop).'</option>';
                      }
                    ?>
                  </select>
              </div>

              <div class="input-field col m3 s4">
                <select name="dobyear" class="browser-default validate" required>
                    <option value="" disabled selected>YYYY</option>
                    <?php
                      for($lop=date("Y") - 13;$lop>=1910;$lop--)
                      {
                        echo '<option value="'.$lop.'" ';
                        if($dobyear == $lop) echo 'selected';
                        echo '>'.$lop.'</option>';
                      }
                    ?>
                  </select>
              </div>
            </div>
          </div>

      <?php 
        $gender = strtolower($gender);
        if($gender == 'm' || $gender == 'male') {
          $mChecker = 'selected';
          $fChecker = '';
        }else if($gender == 'f' || $gender == 'female') {
          $mChecker = '';
          $fChecker = 'selected';
        }else {
          $mChecker = '';
          $fChecker = '';
        }
      ?>
      <div class="input-field col s3">
        <label for="gender">Gender</label>
      </div>

      <div class="input-field col s9">
          <select name="gender" class="browser-default validate" required aria-required="true">
            <option value="" disabled selected>Select Gender</option>
            <option name="gender" id="gender_M" value="M" <?= $mChecker ?>>Male</option>
            <option name="gender" id="gender_F" value="F" <?= $fChecker ?>>Female</option>
          </select>
      </div>

      <!-- Phone -->
      <!--
      <div class="col s12">
        <div class="row">
          <div class="input-field col s12 m3 birthdate--container">
            <label for="birthdate">Phone <span class="meta-optional">Optional</span></label>
          </div>
          <div class="input-field col m3 s4">
             <input name="phone1" id="phone1" class="phone-check" value="<?= $phone1 ?>" type="text" maxlength="3">
          </div>
          <div class="input-field col m3 s4">
            <input name="phone2" id="phone2" class="phone-check" value="<?= $phone2 ?>" type="text" maxlength="3">
          </div>
          <div class="input-field col m3 s4">
            <input name="phone3" id="phone3" class="phone-check" value="<?= $phone3 ?>" type="text" maxlength="4">
          </div>
        </div>
      </div>
      -->
      <!-- Phone -->

      <div class="col s12">
        <div id="ch-placeholder"></div>
      </div>
	  
      <div class="input-field col s12">
        <p class="material-tcpa">
          <input type="checkbox" id="chk_agree" name="chk_agree" required />
          <label for="chk_agree">
              I agree to the <a href="http://www.paidforresearch.com/terms.htm" target="_blank">Terms of Use</a> &amp; <a href="http://www.paidforresearch.com/privacy.htm" target="_blank">Privacy Policy</a> and to receive daily email from <strong>PaidForResearch and Research Unlimited Inc.</strong> <span id="tcpa_hide" style="display: none;">and to receive phone calls and text messages (standard rates may apply) from Research Rewards at the number I provided above.  I understand that I am waiving any Do Not Call list registrations, and that calls may be made using an automated dialing system and feature a prerecorded voice, and that my agreement to accept calls is not a condition for the purchase of any goods or services.</span>
          </label>
        </p>
      </div>
	  
      <div class="col s12">
          <div class="spacer"></div>
            <div class="button-holder">
              <button style="margin-top: 5%" type="submit" class="submit_button_form the-submit-btn waves-effect waves-light btn-large blue" id="submitBtn" name="submitBtn">Submit <i class="material-icons right">send</i></button>
              <!-- <input style="margin-top: 5%" type="submit" class="submit_button_form the-submit-btn waves-effect waves-light btn-large blue" id="submitBtn" name="submitBtn" value="Submit"/> -->
              <img id="loader-gif" src="//leadreactor.engageiq.com/images/gallery/loader.gif" width="15%" style="display: none;" />
            </div>
          </div>
    </form>             
  </div>
  </div>
  </div>
  <div style="clear:both"></div>  
  </div>
<div style="display: block;padding-right: 20px; padding-top: 20px; padding-left: 20px; padding-bottom: 0px; position: relative;  text-align:center;">
   <img style="max-width: 100%;" align="center" src="//leadreactor.engageiq.com/images/gallery/landing_and_reg_brands.png">
</div>
<?php include_once("footer.php"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>

<script>
  window.onpageshow = function(event) {
    if (event.persisted) {
      window.location.reload(); 
    }
  };
  
  $.validator.messages.required = "*";

  jQuery.validator.addMethod("letterswithspace", function(value, element) {
    return this.optional(element) || /^[a-zA-Z][a-z\s]*$/i.test(value);
  }, "Please provide a valid name.");

  jQuery.validator.addMethod("agree", function(value, element) {
    if($("input[name='chk_agree']").prop('checked') == false){
      console.log('agree checker');
    }
  }, "Please check the box to agree.");

  jQuery.validator.addMethod("email2", function(value, element, param) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      return emailReg.test( value );
  }, jQuery.validator.messages.email);

  jQuery.validator.addMethod("zipcode", function(value, element) {
    return this.optional(element) || /^\d{5}(?:-\d{4})?$/.test(value);
  }, "Please provide a valid zipcode.");

/*
  $('.phone-check').autotab('number');
  $('.phone-check').on('keyup keypress', function(e) {
   if (e.type=="keyup") {
    var phone1 = $('#phone1').val();
    var phone2 = $('#phone2').val();
    var phone3 = $('#phone3').val();

    if(phone1 || phone2 || phone3){
      $('#tcpa_hide').show();
    } else {
      $('#tcpa_hide').hide();
    }
   } else {
      $('#tcpa_hide').show();
   }
  });
*/
  $(document).ready(function() {
/*
  	var p1 = $('#phone1').val();
    var p2 = $('#phone2').val();
    var p3 = $('#phone1').val();

    if (p1 || p2 || p3){
      $('#tcpa_hide').show();
    } else {
      $('#tcpa_hide').hide();
    }
    */

    $('#ch-placeholder').css('display', 'none');
    if ( document.location.href.indexOf('registration') > -1 ) {
      // console.log('you are in registration page');
      // ga('set', 'page', '/dynamic_live_fm/registration.php');
      // ga('send', 'pageview');
    }

    $("select[name='dobmonth']").change(function() {
      $("select[name='dobmonth']").removeClass('error');
      $('dobmonth-error').remove();
    });

    $("select[name='dobday']").change(function() {
      $("select[name='dobday']").removeClass('error');
      $('dobday-error').remove();
    });

    $("select[name='dobyear']").change(function() {
      $("select[name='dobyear']").removeClass('error');
      $("#dobmonth-error").remove();
    });

    $("select[name='gender']").change(function() {
      $("select[name='gender']").removeClass('error');
      $('#gender-error').remove();
    });

    var lrUrl = $("meta[name='lrUrl']").attr('content');
    $("#registration_form").validate({
      ignore: [],
      errorClass: 'error',
      validClass: 'valid',
      errorElement: "small",
      showErrors: function (errorMap, errorList, error) {
        var errors = this.numberOfInvalids();
        if (errors == 0) {
          $('#error-holder').hide();
        }
        this.defaultShowErrors();
      },
      errorPlacement: function(error, element) {
        if (element.attr("name") == "chk_agree" ) {
          $('label[for="chk_agree"]').addClass('chk_error');
          error.addClass('ch-danger-reg').appendTo("#ch-placeholder");
          $('#ch-placeholder').css('display', 'block');
        }else{
          error.insertAfter(element);
        }
      },
      rules : {
        gender : {
          required : true
        },
        first_name : {
          letterswithspace : true,
        },
        last_name : {
          letterswithspace : true,
        },
        city : {
          letterswithspace : true
        },
        zip : {
          zipcode : true,
          required: {
            depends:function(){
              var zipval = $(this).val();
              $(this).val($.trim(zipval.replace(/ /g, "")));
              //$(this).val(zipval2.replace(/ /g, ""));
              return true;
            }
          },
          remote: {
            url: lrUrl + 'zip_checker',
            dataType: 'jsonp',
            data : {
              zip : function() {
                return $( 'input[name="zip"]' ).val();
              }
            }
          }
        },
        email : {
          required: {
            depends:function(){
              var emailval = $(this).val();
              $(this).val($.trim(emailval.replace(/ /g, "")));
              return true;
            }
          },
          email2 : true
        },/*
        phone1:      {
          required:function(){
            if($('#phone1').val() || $('#phone2').val() || $('#phone3').val()){
              return true;
            } else{
              return false;
            }
          },digits:true,minlength:3
        },
        phone2:      {
          required:function(){
            if($('#phone1').val() || $('#phone2').val() || $('#phone3').val()){
              return true;
            } else{
              return false;
            }
          },digits:true,minlength:3
        },
        phone3:      {
          required:function(){
            if($('#phone1').val() || $('#phone2').val() || $('#phone3').val()){
              return true;
            } else{
              return false;
            }
          },digits:true,minlength:4
        },
        */
      },

      messages: {
        chk_agree: {
          required: "Please check the checkbox below to agree."
        },
        first_name: "Please enter a valid firstname.",
        last_name: "Please enter a valid lastname.",
        email: "Please enter a valid email.",
        zip: "Please enter a valid zipcode.",
        dobmonth: "Required",
        dobday: "Required",
        dobyear: "Required",
       /* phone1: "Required",
        phone2: "Required",
        phone3: "Required", */
        gender: "Please select gender"
      },submitHandler: function(form) {
        // $('.submit_button_form').attr('type','button').css('background-image','url(public/images/loader.gif)');
        $('.submit_button_form').hide();
        $('#loader-gif').show();

        var birthdate = $('select[name="dobyear"]').val() + '-' + $('select[name="dobmonth"]').val() + '-' + $('select[name="dobday"]').val();
        $('input[name="birthdate"]').val(birthdate);
        sendRegistration();
      }
    });
  });
</script> 

