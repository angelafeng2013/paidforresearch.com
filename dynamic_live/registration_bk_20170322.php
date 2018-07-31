<?php 
//Attach header page
include_once("header.php");
require_once '../token.php';
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

$affiliate_id = isset($_GET['affiliate_id']) ? $_GET['affiliate_id'] : null;
$offer_id = isset($_GET['offer_id']) ? $_GET['offer_id'] : null;
$campaign_id = isset($_GET['campaign_id']) ? $_GET['campaign_id'] : null;
$first_name = isset($_GET['firstname']) ? $_GET['firstname'] : null;
$last_name = isset($_GET['lastname']) ? $_GET['lastname'] : null;
$dobmonth = isset($_GET['dobmonth']) ? $_GET['dobmonth'] : null;
$dobday = isset($_GET['dobday']) ? $_GET['dobday'] : null;
$dobyear = isset($_GET['dobyear']) ? $_GET['dobyear'] : null;
$state = isset($_GET['state']) ? $_GET['state'] : null;
$city = isset($_GET['city']) ? $_GET['city'] : null;
$zip = isset($_GET['zip']) ? $_GET['zip'] : null;
$email = isset($_GET['email']) ? $_GET['email'] : null;
$gender = isset($_GET['gender']) ? $_GET['gender'] : null;
$ethnicity = isset($_GET['ethnicity']) ? $_GET['ethnicity'] : null;
$address = isset($_GET['address']) ? $_GET['address'] : null;
$phone = isset($_GET['phone']) ? $_GET['phone'] : null;
$phone1 = isset($_GET['phone1']) ? $_GET['phone1'] : null;
$phone2 = isset($_GET['phone2']) ? $_GET['phone2'] : null;
$phone3 = isset($_GET['phone3']) ? $_GET['phone3'] : null;
$s1 = isset($_GET['s1']) ? $_GET['s1'] : null;
$s2 = isset($_GET['s2']) ? $_GET['s2'] : null;
$s3 = isset($_GET['s3']) ? $_GET['s3'] : null;
$s4 = isset($_GET['s4']) ? $_GET['s4'] : null;
$s5 = isset($_GET['s5']) ? $_GET['s5'] : null;
$image = isset($_GET['image']) ? $_GET['image'] : null;

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

/* GET FILTER QUESTIONS AND PATH DETAILS */
if($_SESSION['leadreactor_url'] != null || $_SESSION['leadreactor_url'] != '') $url = $_SESSION['leadreactor_url'];
else $url = 'http://leadreactor.engageiq.com/';

//GET SURVEY PATH URL
$current_filename = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
$cleaned_php_self = explode($current_filename,$_SERVER['PHP_SELF']);
$survey_path = 'http://'.$_SERVER['HTTP_HOST'].$cleaned_php_self[0];
$qSt = '?path='.$survey_path;

$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url.'api/get_path_additional_details'.$qSt);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  'leadreactortoken:'.$_SESSION['leadreactor_token'],
));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($curl);
curl_close ($curl);
$details = json_decode($output);
$questions = $details->filters;
$filters = array();
$icons = array();
foreach($questions as $q):
  $filters[$q->id] = $q->name;
  $icons[$q->id] = $q->image;
endforeach;

$_SESSION['filter_questions'] = $filters;
$_SESSION['filter_icons'] = $icons;
$has_filter_questions = count($filters) > 0 ? 1 : 0;
$_SESSION['path_id'] = $details->path_id;
$_SESSION['path_folder'] = $cleaned_php_self[0];
?>
<input type="hidden" name="has_form_questions" id="has_form_questions" value="<?= $has_filter_questions ?>" />

<!-- PROGRESS BAR START -->
<?php display_progress_bar(2,14,false); ?>
<!-- PROGRESS BAR END -->

<!-- <div id="contentbox_main" style="padding-right: 20px; padding-top: 150px; padding-left: 20px; padding-bottom: 50px; position: relative; border: solid 5px #6EB438;"> -->
  <!-- <div id="contentbox"> -->
  <div id="contentbox" style="padding-right: 20px; padding-left: 20px; padding-bottom: 50px; position: relative; border: solid 5px #636363;">
    <p align="center" style="margin-top: 10px;">
      <strong>Fill out  all the fields below and hit Submit to start the survey with PaidForResearch.com<br /><br /></strong>
    </p>
  <div>
  <div id="form_box" style="text-align:center">                  
    <form id="registration_form" method="get" name="hostedform" class="hostedform" enctype="text" action="questions.php">
      <input type="hidden" name="submit" id="submit" value="engageiq_post_data" /> 
      <input type="hidden" name="affiliate_id"        value="<?= $affiliate_id ?>" />
      <input type="hidden" name="offer_id"      value="<?= $offer_id ?>" />     
      <input type="hidden" name="campaign_id"      value="<?= $campaign_id ?>" />     
      <input type="hidden" name="s1"      value="<?= $s1 ?>" />                    
      <input type="hidden" name="s2"      value="<?= $s2 ?>" />                    
      <input type="hidden" name="s3"      value="<?= $s3 ?>" />                    
      <input type="hidden" name="s4"      value="<?= $s4 ?>" />                     
      <input type="hidden" name="s5"      value="<?= $s5 ?>" />    
      <input type="hidden" name="address"      value="<?= $address ?>" /> 
      <input type="hidden" name="phone1"       value="<?= $phone1 ?>" /> 
      <input type="hidden" name="phone2"       value="<?= $phone2 ?>" /> 
      <input type="hidden" name="phone3"       value="<?= $phone3 ?>" /> 
      <input type="hidden" name="phone"       value="<?= $phone ?>" /> 
      <!-- <input type="hidden" name="city"         value="" /> 
      <input type="hidden" name="state"        value="" />    
      <input type="hidden" name="nextpage"     value=""/>
      <input type="hidden" name="php_session"  value=""/> -->
      <input type="hidden" name="source_url"  value="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>"/>
      <input type="hidden" name="screen_view" value="<?= $view ?>" />
      <input type="hidden" name="ip" value="<?= get_client_ip() ?>"/>
      <input name="image" type="hidden" value="<?= $image ?>"/>

      <div class="form-input-section">
        <label>First Name:</label> 
        <input name="first_name" type="text" value="<?= $first_name ?>" required/>
        <div style="clear: both;"></div>
      </div>

      <div class="form-input-section">
        <label>Last Name:</label> 
        <input name="last_name" type="text" value="<?= $last_name ?>" required/>
        <div style="clear: both;"></div>
      </div>

      <div class="form-input-section">
        <label>Email:</label> 
        <input name="email" type="text" value="<?= $email ?>" required/>
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

      <div class="form-input-section agree-terms agree-check">
        <!-- <input name="chk_agree" type="checkbox" value="" id="chk_agree" required/>  
        I agree to the <a href="http://www.paidforresearch.com/terms.htm" target="_blank">Terms of Use</a> & <a href="http://www.paidforresearch.com/privacy.htm" target="_blank">Privacy Policy</a> and to receive daily email from PaidforResearch. -->
        <input name="chk_agree" type="checkbox" value="" id="chk_agree" required/>  
        <label for="chk_agree"></label>
        I agree to the <a href="http://www.paidforresearch.com/terms.htm" target="_blank">Terms of Use</a> & <a href="http://www.paidforresearch.com/privacy.htm" target="_blank">Privacy Policy</a> and to receive daily email from <b>PaidForResearch.com and ResearchUnlimitedInc.</b>
        <label for="chk_agree" class="error"></label>
        <div style="clear: both;"></div>

      </div>

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
  $(document).ready(function() {
    var lrUrl = $("meta[name='lrUrl']").attr('content');
    $("#registration_form").validate({
      ignore: [],
      // errorPlacement: function(error, element) {},
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
          email2 : true
        }
      },submitHandler: function(form) {
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

