<?php 
//Attach header page
include_once("header.php");

$user = $_SESSION['user'];

$affiliate_id = isset($_GET['affiliate_id']) ? $_GET['affiliate_id'] : $user['affiliate_id'];
$offer_id = isset($_GET['offer_id']) ? $_GET['offer_id'] : $user['offer_id'];
$campaign_id = isset($_GET['campaign_id']) ? $_GET['campaign_id'] : $user['campaign_id'];
$first_name = isset($_GET['firstname']) ? $_GET['firstname'] : $user['first_name'];
$last_name = isset($_GET['lastname']) ? $_GET['lastname'] : $user['last_name'];
$dobmonth = isset($_GET['dobmonth']) ? $_GET['dobmonth'] : $user['dobmonth'];
$dobday = isset($_GET['dobday']) ? $_GET['dobday'] : $user['dobday'];
$dobyear = isset($_GET['dobyear']) ? $_GET['dobyear'] : $user['dobyear'];
$state = isset($_GET['state']) ? $_GET['state'] : $user['state'];
$city = isset($_GET['city']) ? $_GET['city'] : $user['city'];
$zip = isset($_GET['zip']) ? $_GET['zip'] : $user['zip'];
$email = isset($_GET['email']) ? $_GET['email'] : $user['email'];
$email2 = isset($_GET['email2']) ? $_GET['email2'] : '';
$gender = isset($_GET['gender']) ? $_GET['gender'] : $user['gender'];
$ethnicity = isset($_GET['ethnicity']) ? $_GET['ethnicity'] : $user['ethnicity'];
$address = isset($_GET['address']) ? $_GET['address'] : $user['address'];
$phone = isset($_GET['phone']) ? $_GET['phone'] : $user['phone'];
$phone1 = isset($_GET['phone1']) ? $_GET['phone1'] : $user['phone1'];
$phone2 = isset($_GET['phone2']) ? $_GET['phone2'] : $user['phone2'];
$phone3 = isset($_GET['phone3']) ? $_GET['phone3'] : $user['phone3'];
$image = isset($_GET['image']) ? $_GET['image'] : $user['image'];
$s1 = isset($_GET['s1']) ? $_GET['s1'] : $user['s1'];
$s2 = isset($_GET['s2']) ? $_GET['s2'] : $user['s2'];
$s3 = isset($_GET['s3']) ? $_GET['s3'] : $user['s3'];
$s4 = isset($_GET['s4']) ? $_GET['s4'] : $user['s4'];
$s5 = isset($_GET['s5']) ? $_GET['s5'] : $user['s5'];
$d1 = isset($_GET['d1']) ? $_GET['d1'] : $_SESSION['d1'];
$d2 = isset($_GET['d2']) ? $_GET['d2'] : $_SESSION['d2'];
$d3 = isset($_GET['d3']) ? $_GET['d3'] : $_SESSION['d3'];
$d4 = isset($_GET['d4']) ? $_GET['d4'] : $_SESSION['d4'];
$d5 = isset($_GET['d5']) ? $_GET['d5'] : $_SESSION['d5'];
$screen_view = isset($_GET['screen_view']) ? $_GET['screen_view'] : $user['screen_view'];
$source_url = isset($_GET['source_url']) ? $_GET['source_url'] : $user['source_url'];
$ip = isset($_GET['ip']) ? $_GET['ip'] : $user['ip'];
$birthdate = isset($_GET['birthdate']) ? $_GET['birthdate'] : $user['birthdate'];
?>  

<!-- PROGRESS BAR START -->
<?php display_progress_bar(3,15,false); ?>
<!-- PROGRESS BAR END -->

<!-- <div id="contentbox_main" style="padding-right: 20px; padding-top: 150px; padding-left: 20px; padding-bottom: 50px; position: relative; border: solid 5px #6EB438;"> -->
  <!-- <div id="contentbox"> -->
  <div id="contentbox" style="padding-right: 20px; padding-left: 20px; padding-top: 15px; padding-bottom: 15px; position: relative; border: solid 5px #636363;">
  <div id="contentbox">          
    <form id="registration_form" method="post" name="hostedform" class="hostedform" enctype="text" action="">
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
      <input type="hidden" name="address"      value="<?= $address ?>" /> 
      <input type="hidden" name="phone1"       value="<?= $phone1 ?>" /> 
      <input type="hidden" name="phone2"       value="<?= $phone2 ?>" /> 
      <input type="hidden" name="phone3"       value="<?= $phone3 ?>" /> 
      <input type="hidden" name="phone"       value="<?= $phone ?>" /> 
      <input type="hidden" name="source_url"  value="<?= $source_url ?>"/>
      <input type="hidden" name="screen_view" value="<?= $screen_view ?>" />
      <input type="hidden" name="ip" value="<?= $ip ?>"/>
      <input name="image" type="hidden" value="<?= $image ?>"/>
      <input type="hidden" name="first_name"      value="<?= $first_name ?>" />                    
      <input type="hidden" name="last_name"      value="<?= $last_name ?>" />                    
      <input type="hidden" name="email"      value="<?= $email ?>" />                    
      <input type="hidden" name="zip"      value="<?= $zip ?>" />                     
      <input type="hidden" name="dobmonth"      value="<?= $dobmonth ?>" />
      <input type="hidden" name="dobday"      value="<?= $dobday ?>" />                    
      <input type="hidden" name="dobyear"      value="<?= $dobyear ?>" />                    
      <input type="hidden" name="birthdate"      value="<?= $birthdate ?>" />                     
      <input type="hidden" name="gender"      value="<?= $gender ?>" />   
      <input type="hidden" name="email2"      value="<?= $email2 ?>" /> 

      <?php 
        $questions = $_SESSION['filter_questions'];
        foreach($questions as $id => $question):
          $filters[] = 'filter_questions['.$id.']';
      ?>
        <table style="width: 100%;">
          <tr>
            <input type="hidden" name="yesnoto" id="id-1" hidden>
            <td width='35%' style="padding-left: 30px;">
              <div class="form-input-section form-input-filter_question">
                <input name="filter_questions[<?php echo $id; ?>]" id="filter_question_<?php echo $id; ?>_yes" type="radio" value="1"/>
                <label for="filter_question_<?php echo $id; ?>_yes" class="filter_question-yes" style="font-size:0px;">Yes</label>
                <input name="filter_questions[<?php echo $id; ?>]" id="filter_question_<?php echo $id; ?>_no" type="radio" value="0"/>
                <label for="filter_question_<?php echo $id; ?>_no" class="filter_question-no">No</label>
                <div style="clear: both;"></div>
                <label for="filter_questions[<?php echo $id; ?>]" class="error"></label>
              </div>
            </td>
            <td width='50%'>
              <div class="content-desktop2"> 
                <b>
                  <?php echo $question; ?><span style="color:red">*</span>
                </b>
              </div>
            </td>
            <td width='15%' style="text-align: right;">
              <?php 
                $profile_icon = '../images/default_profile_icon.png';
                if(isset($_SESSION['filter_icons'][$id])){
                  if($_SESSION['filter_icons'][$id] != '') {
                    $profile_icon = $_SESSION['filter_icons'][$id];
                  }
                }
              ?>
              <img class="m-badge" src="<?php echo $profile_icon ?>" align="absmiddle" />
            </td>
          </tr>
        </table>
        <div class="separator" style=""></div>
      <?php endforeach; ?>
      <div align="center">
        <input type="submit" class="submit_button_form the-submit-btn" id="submitBtn" name="submitBtn" value="Submit"/>  
      </div>
    </form>             
  </div>
  <div style="clear:both"></div>  
  </div>


<?php include_once("footer.php"); ?>    

<script>
  $(document).ready(function() {

    var lrUrl = $("meta[name='lrUrl']").attr('content');    
    $("#registration_form").validate({
      ignore: [],
      rules : {
        <?php 
          foreach($filters as $f) {
            echo '"'.$f.'" : {required : true},';
          }
        ?>
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
          
          sendRegistration();
          // var form_data = $("#registration_form").serialize();
          // console.log($("#registration_form").serialize());
          // var path_type = 1;
          // $.ajax({
          //   url:"includes/lead_reactor_function.php",
          //   type: 'POST',
          //   data: form_data,
          //   success: function(json) {
          //     json = JSON.parse(json);
          //     console.log(json);
          //     path_type = json.path_type;
          //     // console.log(path_type);
          //     $.ajax({
          //       url:"includes/form_function.php",
          //       type: 'POST',
          //       data: {
          //         type : 'set_session',
          //         data : json
          //       },
          //       success: function(data) {
          //         if(path_type == 1) {
          //           //console.log(url + "survey.php?campaign=1");
          //           window.location.href = 'survey.php?campaign=1';
          //           //window.location.replace("survey.php?campaign=1");
          //           // window.location.replace(url + "survey.php?campaign=1");
          //         }else {
          //           //console.log(url + "survey_stack.php?campaign=1");
          //           window.location.href = 'survey_stack.php?campaign=1';
          //           //window.location.replace("survey_stack.php?campaign=1");
          //           // window.location.replace(url + "survey_stack.php?campaign=1");
          //         }
          //       }
          //     });
          //   }
          // });
      }
    }); 
  });
</script> 

