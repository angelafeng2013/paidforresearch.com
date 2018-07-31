<?php 
//Attach header page
require_once '../token.php';
include_once("header.php");
require_once '../includes/Mobile_Detect.php';
require_once '../includes/class.browserdetect.php';

$browser = new BrowserDetection(); 
$detect = new Mobile_Detect;

$_SESSION['browser'] = array(
  'os'          => $browser->getPlatform(),
  'os_version'  => $browser->getPlatformVersion(),
  'browser'           => $browser->getName(),
  'browser_version'   => $browser->getVersion(),
  'user_agent'  => $browser->getUserAgent()
);

if($detect->isMobile()) {
  $type = 'Mobile';
  $view = 2;
}
else if($detect->isTablet()) {
  $type = 'Tablet';
  $view = 3;
} else {
  $type = 'Desktop';
  $view = 1;
}
$_SESSION['device'] = array(
  'isMobile'  => $detect->isMobile(),
  'isTablet'  => $detect->isTablet(),
  'isDesktop' => !$detect->isMobile() && !$detect->isTablet() ? true : false,
  'type' => $type
);

if(! isset($_SESSION['user'])) {
  header("Refresh:0");
  exit;
}

$user = $_SESSION['user'];

$affiliate_id = isset($_POST['affiliate_id']) ? $_POST['affiliate_id'] : $user['affiliate_id'];
$offer_id = isset($_POST['offer_id']) ? $_POST['offer_id'] : $user['offer_id'];
$campaign_id = isset($_POST['campaign_id']) ? $_POST['campaign_id'] : $user['campaign_id'];
$first_name = isset($_POST['firstname']) ? $_POST['firstname'] : $user['first_name'];
$last_name = isset($_POST['lastname']) ? $_POST['lastname'] : $user['last_name'];
$dobmonth = isset($_POST['dobmonth']) ? $_POST['dobmonth'] : $user['dobmonth'];
$dobday = isset($_POST['dobday']) ? $_POST['dobday'] : $user['dobday'];
$dobyear = isset($_POST['dobyear']) ? $_POST['dobyear'] : $user['dobyear'];
$state = isset($_POST['state']) ? $_POST['state'] : isset($user['state']) ? $user['state'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : isset($user['city']) ? $user['city'] : '';
$zip = isset($_POST['zip']) ? $_POST['zip'] : $user['zip'];
$email = isset($_POST['email']) ? $_POST['email'] : $user['email'];
$gender = isset($_POST['gender']) ? $_POST['gender'] : $user['gender'];
$ethnicity = isset($_POST['ethnicity']) ? $_POST['ethnicity'] : $user['ethnicity'];
$address = isset($_POST['address']) ? $_POST['address'] : $user['address'];
$phone = isset($_POST['phone']) ? $_POST['phone'] : $user['phone'];
$phone1 = isset($_POST['phone1']) ? $_POST['phone1'] : $user['phone1'];
$phone2 = isset($_POST['phone2']) ? $_POST['phone2'] : $user['phone2'];
$phone3 = isset($_POST['phone3']) ? $_POST['phone3'] : $user['phone3'];
$image = isset($_POST['image']) ? $_POST['image'] : $user['image'];
$s1 = isset($_POST['s1']) ? $_POST['s1'] : $user['s1'];
$s2 = isset($_POST['s2']) ? $_POST['s2'] : $user['s2'];
$s3 = isset($_POST['s3']) ? $_POST['s3'] : $user['s3'];
$s4 = isset($_POST['s4']) ? $_POST['s4'] : $user['s4'];
$s5 = isset($_POST['s5']) ? $_POST['s5'] : $user['s5'];
$d1 = isset($_POST['d1']) ? $_POST['d1'] : $_SESSION['d1'];
$d2 = isset($_POST['d2']) ? $_POST['d2'] : $_SESSION['d2'];
$d3 = isset($_POST['d3']) ? $_POST['d3'] : $_SESSION['d3'];
$d4 = isset($_POST['d4']) ? $_POST['d4'] : $_SESSION['d4'];
$d5 = isset($_POST['d5']) ? $_POST['d5'] : $_SESSION['d5'];

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

<style>
  .phone-optional .dash { float: left; }
  #form_box .phone-optional label.error { position: absolute; }
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
  <div id="form_box" style="text-align:center">                  
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

      <input type="hidden" name="source_url"  value="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>"/>
      <input type="hidden" name="screen_view" value="<?= $view ?>" />
      <input type="hidden" name="ip" value="<?= get_client_ip() ?>"/>
      <input type="hidden" name="email2" value="" />    

      <div class="form-input-section">
        <label>First Name:</label> 
        <input name="first_name" type="text" value="<?= urldecode($first_name) ?>" required/>
        <div style="clear: both;"></div>
      </div>

      <div class="form-input-section">
        <label>Last Name:</label> 
        <input name="last_name" type="text" value="<?= urldecode($last_name) ?>" required/>
        <div style="clear: both;"></div>
      </div>

      <div class="form-input-section">
        <label>Email:</label> 
        <input name="email" type="text" value="<?= urldecode($email) ?>" required/>
        <div style="clear: both;"></div>
      </div>

      <div class="form-input-section">
        <label>Zip:</label> 
        <input name="zip" type="text" value="<?= $zip ?>" required/>
        <div style="clear: both;"></div>
      </div>

      <div class='form-input-section'>
        <label>Birth Date:</label>
        <input type="hidden" name="birthdate" id="birthdate" />
        <div class='form-select-birth'>
          <div class="selectmonthcont">
            <select name="dobmonth" style="width:45px;" required>
              <option value="">MM</option>
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
          <div class="dash">&nbsp</div>
          <div class="selectdaycont">
            <select name="dobday" style="width:45px;" required>
              <option value="">DD</option>
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
          <div class="dash">&nbsp</div>
          <div class="selectyearcont">
            <select name="dobyear" style="width:60px;" required>
              <option value="">YYYY</option>
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
          <div style='clear: both;'></div>
        </div>
        <div style='clear: both;'></div>
      </div>

      <?php 
        $gender = strtolower($gender);
        if($gender == 'm' || $gender == 'male') {
          $mChecker = 'checked';
          $fChecker = '';
        }else if($gender == 'f' || $gender == 'female') {
          $mChecker = '';
          $fChecker = 'checked';
        }else {
          $mChecker = '';
          $fChecker = '';
        }
      ?>
      <!-- <div class="form-input-section">
        <label>Gender:</label>
        <div class="form-input-gender">
          <input type="radio" name="gender" id="gender_M" value="M" <?= $mChecker ?> /> Male
          <input type="radio" name="gender" id="gender_F" value="F" <?= $fChecker ?> /> Female
          <div style="clear: both;"></div>
        </div>
        <div style="clear: both;"></div>
      </div> -->
      <div class="form-input-section">
        <label>Gender:</label>
        <div class="form-input-gender">
          <input type="radio" name="gender" id="gender_M" value="M" <?= $mChecker ?>/>
          <label for="gender_M" class="gender-m" style="font-size:0px">Male</label> 
          <input type="radio" name="gender" id="gender_F" value="F" <?= $fChecker ?>/>
          <label for="gender_F" class="gender-f" style="font-size:0px">Female</label>
          <div style="clear: both;"></div>
          <label for="gender" class="error"></label>
        </div>
        <div style="clear: both;"></div>
      </div>

      <!--
      <div class="form-input-section phone-optional">
        <label>(Optional) Phone:</label> 
        <input style="width: 50px !important" name="phone1" id="phone1" class="phone-check" value="<?= $phone1 ?>" type="text" maxlength="3"><label class="error" for="phone1"></label>
    <div class="dash">&nbsp;</div>
        <input style="width: 50px !important" name="phone2" id="phone2" class="phone-check" value="<?= $phone2 ?>" type="text" maxlength="3"><label class="error" for="phone2"></label>
    <div class="dash">&nbsp;</div>
        <input style="width: 70px !important" name="phone3" id="phone3" class="phone-check" value="<?= $phone3 ?>" type="text" maxlength="4"><label class="error" for="phone3"></label>
        <div style="clear: both;"></div>
      </div>
      -->

      <div id="ch-placeholder" style="margin-bottom: 20px; text-align: left; background: #f2dede; border-left:3px solid red; padding-left: 5px !important;"></div>

      <div style="width: 100%; overflow: hidden;">
        <div style="width: 10%; float: left; margin-right: 3%; height: 30px;">
          <input name="chk_agree" type="checkbox" value="" id="chk_agree" required/>
        </div>
        <div style="text-align: left;">
          I agree to the <a href="http://www.paidforresearch.com/privacy.htm" target="_blank">Privacy Policy</a> &amp; <a href="http://www.paidforresearch.com/terms.htm" target="_blank">Terms of Conditions</a>.

        </div>
        <div style="clear: both;"></div>
      </div><br/>

      <div style="width: 100%; overflow: hidden;">
        <div style="width: 10%; float: left; margin-right: 3%; height: 30px;">
          <input name="chk_agree1" type="checkbox" value="" id="chk_agree2"/>
        </div>
        <div style="text-align: left;">
           I agree to receive relevant emails from <strong>PaidForResearch.</strong>

        </div>
        <div style="clear: both;"></div>
      </div><br/>

      <div align="center">
        <input type="submit" class="submit_button_form the-submit-btn" id="submitBtn" name="submitBtn" value="Submit"/>  
      </div>
      <!-- <div align="right" class="submit_button_wrapper" style="padding-right:86px;">
        <button type="submit" class="the-submit-btn">Submit</button> 
        <input type="submit" class="submit_button_form the-submit-btn" id="submitBtn" name="submitBtn" value="Submit"/>  
      </div> -->
    </form>             
  </div>
  </div>
  <div style="clear:both"></div>  
  </div>

<?php include_once("footer.php"); ?>    

<script>
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
    var lrUrl = $("meta[name='lrUrl']").attr('content');
    $("#registration_form").validate({
      ignore: [],
      errorPlacement: function(error, element) {
        if (element.attr("name") == "chk_agree" ) {
          error.addClass('ch-danger').appendTo("#ch-placeholder");          
          $('#ch-placeholder').css('display', 'block');
          $('.ch-danger').css({
            'font-size' : '14px',
            'color' : '#a94442',
            'text-align' : 'left',
            'line-height' : 'inherit',
            'height' : 'auto',
            'margin' : '10px'
          });
        }else{
          error.insertAfter(element);
        }
      },
      rules : {
        gender : {
          required : true
        },
        first_name : {
          letterswithspace : true
        },
        last_name : {
          letterswithspace : true
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
        },
        /*
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
        }
      },
      submitHandler: function(form) {
        if(checkIfBrowserIE() == false) {
          console.log('NOT IE');
          if($('.submit_button_form').css('background').indexOf('rgba(0, 0, 0, 0)') == -1) //Mobile
            {
              $('.submit_button_form').attr('type','button')
              .css('background-image','url(images/icon_loading.gif)')
              .css('background-repeat','no-repeat')
              .css('background-size','contain')
              .css('color','transparent')
              .css('background-position','center');
            }else $('.submit_button_form').attr('type','button').css('background-image','url(images/loading-button.gif)');
        }else console.log('IE EW');

        /* // ENABLE FILTER QUESTIONS
        if($('#has_form_questions').val() == 1) { //if has filter questions, go to questions page
          form.submit();
        }else {
          var birthdate = $('select[name="dobyear"]').val() + '-' + $('select[name="dobmonth"]').val() + '-' + $('select[name="dobday"]').val();
          $('input[name="birthdate"]').val(birthdate);

          sendRegistration();
        }*/
        // DISABLE FILTER QUESTIONS
        var birthdate = $('select[name="dobyear"]').val() + '-' + $('select[name="dobmonth"]').val() + '-' + $('select[name="dobday"]').val();
        $('input[name="birthdate"]').val(birthdate);

        sendRegistration();
        
      }
    }); 
  });
</script> 

