<?php 
include_once("header.php");

if(! isset($_SESSION['user'])) {
  header("Refresh:0");
  exit;
}

$user = $_SESSION['user'];

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

<script>  
function submit_this_form()
{
  // $("#hostedform_main").submit();
  // console.log('click');
  document.getElementById("hostedform_main").submit();
 // document.hostedform_main.submit();
}
function checkTime(i){if (i<10){i="0" + i;}return i;}
function display_time()
{  
  var today=new Date();
  var Y=today.getYear();
  if (Y< 1000) Y+=1900;
  var M=today.getMonth();
  var d=today.getDate();
  var h=today.getHours();
  var m=today.getMinutes();
  var s=today.getSeconds();
  var SS=today.getMilliseconds();
  var MM="AM";

  if(h>12){ h=h-12; MM="PM"; }
  // add a zero in front of numbers<10
  m=checkTime(m);
  s=checkTime(s);
  SS=checkTime(Math.round(SS/10));
  $('#engage_clock1').html(Y+" "+h+":"+m+":"+s+":"+SS+" "+MM);
}
var myVar=setInterval(function(){display_time()},100);
</script>

<!-- PROGRESS BAR START -->
<?php display_progress_bar(1,14,false); ?>
<!-- PROGRESS BAR END -->
<?php echo '<span style="display:none" id="private_progress_bar">index</span>'; ?>

<div id="contentbox_main" style="padding-right: 20px; padding-top: 150px; padding-left: 20px; padding-bottom: 50px; position: relative; border: solid 5px #FFF;">
      
  <!-- DCSTACK ELEMENTS -->
  <img id="img-giraffe" style="position: absolute; bottom: -2px; right: 15px; display: none;" src="images/giraffe.png">
  <img class="quote1 move" src="images/quote1.png">
  <img class="quote2 move" src="images/quote2.png">
  <img class="quote3 move" src="images/quote3.png">
  <!-- DCSTACK ELEMENTS -->
  <div class="index_count_div"> <!-- opacity -->
    <div style="text-align:center;"><span class="title_text" style="font-size:20px;color: #565656;">Accepting 
      <span style="color: #4d8478; border: 2px solid #10aa85; padding: 1px 2px 1px 6px; margin-right: 5px;"><?php echo rand(10, 10 + strval(date("i"))); ?></span> survey takers as of <span id="engage_clock1" style="color: #4d8478;"> <?php echo date("Y h:i:s A"); ?>.</span></span><br />
    </div>
    <br />
    <div style="text-align:center;">
      <p style="font-size: 25px; color: #565656;">Do you want to begin your survey<br /> and start earning?</p>
      <div style="text-align: center;">  
        <form method="get" name="hostedform_main" id="hostedform_main" enctype="text" action="registration.php">    
          <input type="hidden" name="PHPSESSID"        value="<?= session_id() ?>" />           
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
          <input name="image" type="hidden" value="<?= $image ?>"/>
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
          <input name="city" type="hidden" value="<?= $city ?>"/>
          <input name="state" type="hidden" value="<?= $state ?>"/>
          <input type="hidden" name="source_url"  value="<?= $_SESSION['source_url'] ?>"/>
          <input type="hidden" name="screen_view" value="<?= $_SESSION['device']['view'] ?>" />
          <input type="hidden" name="ip" value="<?= $_SESSION['client_ip'] ?>"/>
          <input name="browser_agent" type="hidden" value="<?= $_SESSION['browser']['user_agent'] ?>"/>
          <input type="hidden" name="source"  value="CD<?= $_SESSION['rev_tracker'] ?>"/>
          
          <div class="fixed-button">
            <button type="submit" class="submit-intro-btn the-yes-btn">Yes</button>
            <button type="submit" class="submit-intro-btn the-no-btn">No</button>
          </div>
        </form>  
      </div>
      <div style="clear:both"></div>
    </div>  
  </div>      
</div>
<div style="padding-right: 20px; padding-top: 20px; padding-left: 20px; padding-bottom: 0px; position: relative;  text-align:center;">
   <img style="max-width: 100%;" align="center" src="//leadreactor.engageiq.com/images/gallery/landing_and_reg_brands.png">
</div>

<?php include_once("footer.php"); ?>        
