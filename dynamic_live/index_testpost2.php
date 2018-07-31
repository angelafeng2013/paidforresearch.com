<?php 
require_once '../token.php';
include_once("header.php");

if(! isset($_SESSION['user'])) {
  header("Refresh:0");
  exit;
}

$user = $_SESSION['user'];

// $affiliate_id = isset($_POST['affiliate_id']) ? $_POST['affiliate_id'] : $user['affiliate_id'];
// $offer_id = isset($_POST['offer_id']) ? $_POST['offer_id'] : $user['offer_id'];
// $campaign_id = isset($_POST['campaign_id']) ? $_POST['campaign_id'] : $user['campaign_id'];
// $first_name = isset($_POST['firstname']) ? $_POST['firstname'] : $user['first_name'];
// $last_name = isset($_POST['lastname']) ? $_POST['lastname'] : $user['last_name'];
// $dobmonth = isset($_POST['dobmonth']) ? $_POST['dobmonth'] : $user['dobmonth'];
// $dobday = isset($_POST['dobday']) ? $_POST['dobday'] : $user['dobday'];
// $dobyear = isset($_POST['dobyear']) ? $_POST['dobyear'] : $user['dobyear'];
// $state = isset($_POST['state']) ? $_POST['state'] : $user['state'];
// $city = isset($_POST['city']) ? $_POST['city'] : $user['city'];
// $zip = isset($_POST['zip']) ? $_POST['zip'] : $user['zip'];
// $email = isset($_POST['email']) ? $_POST['email'] : $user['email'];
// $gender = isset($_POST['gender']) ? $_POST['gender'] : $user['gender'];
// $ethnicity = isset($_POST['ethnicity']) ? $_POST['ethnicity'] : $user['ethnicity'];
// $address = isset($_POST['address']) ? $_POST['address'] : $user['address'];
// $phone = isset($_POST['phone']) ? $_POST['phone'] : $user['phone'];
// $phone1 = isset($_POST['phone1']) ? $_POST['phone1'] : $user['phone1'];
// $phone2 = isset($_POST['phone2']) ? $_POST['phone2'] : $user['phone2']; 
// $phone3 = isset($_POST['phone3']) ? $_POST['phone3'] : $user['phone3'];
// $image = isset($_POST['image']) ? $_POST['image'] : $user['image'];
// $s1 = isset($_POST['s1']) ? $_POST['s1'] : $user['s1'];
// $s2 = isset($_POST['s2']) ? $_POST['s2'] : $user['s2'];
// $s3 = isset($_POST['s3']) ? $_POST['s3'] : $user['s3'];
// $s4 = isset($_POST['s4']) ? $_POST['s4'] : $user['s4'];
// $s5 = isset($_POST['s5']) ? $_POST['s5'] : $user['s5'];
// $d1 = isset($_POST['d1']) ? $_POST['d1'] : $_SESSION['d1'];
// $d2 = isset($_POST['d2']) ? $_POST['d2'] : $_SESSION['d2'];
// $d3 = isset($_POST['d3']) ? $_POST['d3'] : $_SESSION['d3'];
// $d4 = isset($_POST['d4']) ? $_POST['d4'] : $_SESSION['d4'];
// $d5 = isset($_POST['d5']) ? $_POST['d5'] : $_SESSION['d5'];

$affiliate_id = isset($_POST['affiliate_id']) ? $_POST['affiliate_id'] : '';
$offer_id = isset($_POST['offer_id']) ? $_POST['offer_id'] : '';
$campaign_id = isset($_POST['campaign_id']) ? $_POST['campaign_id'] : '';
$first_name = isset($_POST['firstname']) ? $_POST['firstname'] : '';
$last_name = isset($_POST['lastname']) ? $_POST['lastname'] : '';
$dobmonth = isset($_POST['dobmonth']) ? $_POST['dobmonth'] : '';
$dobday = isset($_POST['dobday']) ? $_POST['dobday'] : '';
$dobyear = isset($_POST['dobyear']) ? $_POST['dobyear'] : '';
$state = isset($_POST['state']) ? $_POST['state'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$zip = isset($_POST['zip']) ? $_POST['zip'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$ethnicity = isset($_POST['ethnicity']) ? $_POST['ethnicity'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$phone1 = isset($_POST['phone1']) ? $_POST['phone1'] : '';
$phone2 = isset($_POST['phone2']) ? $_POST['phone2'] : '';
$phone3 = isset($_POST['phone3']) ? $_POST['phone3'] : '';
$image = isset($_POST['image']) ? $_POST['image'] : '';
$s1 = isset($_POST['s1']) ? $_POST['s1'] : '';
$s2 = isset($_POST['s2']) ? $_POST['s2'] : '';
$s3 = isset($_POST['s3']) ? $_POST['s3'] : '';
$s4 = isset($_POST['s4']) ? $_POST['s4'] : '';
$s5 = isset($_POST['s5']) ? $_POST['s5'] : '';
$d1 = isset($_POST['d1']) ? $_POST['d1'] : '';
$d2 = isset($_POST['d2']) ? $_POST['d2'] : '';
$d3 = isset($_POST['d3']) ? $_POST['d3'] : '';
$d4 = isset($_POST['d4']) ? $_POST['d4'] : '';
$d5 = isset($_POST['d5']) ? $_POST['d5'] : '';

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
<?php 
if(isset($_POST['s2'],$_POST['tmgrv'])) {
$urlparam="tmgsr=".$_POST['s2']."&tmgrv=".$_POST['tmgrv'];
echo '<iframe src="http://www.usopinionpoll.com/pixel.aspx?'.$urlparam.'" height="1" width="1" frameborder="0"></iframe>';
}
 ?>

<?php 
 echo '<!--CD18457 CD8043 pixel Begin-->'."\n";
  $s2 = isset($_POST['s2']) ? $_POST['s2'] : '';
  if ($affiliate_id=="18457" && strtolower($s1)=="usopinionpoll" && trim($offer_id)=="6"  )
  { 
    if(isset($_POST['s2'])){
    //echo $prepop_lead_info['affid'];
    //echo $prepop_lead_info[s1];
    $urlparam="tmgsr=".$_POST['s2']."&tmgrv=0.45";
    echo '<iframe src="http://www.usopinionpoll.com/pixel.aspx?'.$urlparam.'" height="1" width="1" frameborder="0"></iframe>';
  }else{
    echo '<!--CD18457 CD8043 pixel End-->'."\n";
  }
  echo '<!--CD18457 CD8043 pixel End-->'."\n";
  }
?> 

<div id="contentbox_main" style="padding-right: 20px; padding-top: 150px; padding-left: 20px; padding-bottom: 50px; position: relative; border: solid 5px #636363;">
      
  <!-- DCSTACK ELEMENTS -->
  <img style="position: absolute; bottom: -2px; right: 15px; display: none;" src="images/giraffe.png">
  <img class="quote1 move" src="images/quote1.png">
  <img class="quote2 move" src="images/quote2.png">
  <img class="quote3 move" src="images/quote3.png">
  <!-- DCSTACK ELEMENTS -->
  <div class=""> <!-- opacity -->
    <div style="text-align:center;"><span class="title_text" style="font-size:20px;color: #565656;">Accepting 
      <span style="color: #4d8478; border: 2px solid #10aa85; padding: 1px 2px 1px 6px; margin-right: 5px;"><?php echo rand(10, 10 + strval(date("i"))); ?></span> survey takers as of <span id="engage_clock1" style="color: #4d8478;"> <?php echo date("Y h:i:s A"); ?>.</span></span><br />
    </div>
    <br />
    <div style="text-align:center;">
      <p style="font-size: 25px; color: #565656;">Do you want to begin your survey<br /> and start earning?</p>
      <div style="text-align: center;">  
        <form method="post" name="hostedform_main" id="hostedform_main" enctype="text" action="registration_test_post1.php"> 
          
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

<?php include_once("footer.php"); ?>        
