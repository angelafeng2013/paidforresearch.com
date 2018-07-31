<?php 
//Attach header page
include_once("header.php");

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

function display_info_box()
{
   var infobox=document.getElementById('infobox').style.display;
   if (infobox=='none')
   {document.getElementById('infobox').style.display="block"; }
   else
   {document.getElementById('infobox').style.display="none";} 
} 

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

<br><br>
<!-- <div id="contentbox_main" style="padding-right: 20px; padding-top: 150px; padding-left: 20px; padding-bottom: 50px; position: relative; border: solid 5px #6EB438;"> -->
<div id="contentbox_main" style="margin-left:20px; padding-right:20px; ">
  <div style="text-align:center;"><span class="title_text" style="font-size:25px;"><strong><span class="red_text"><?php echo ( strval(date("z")) + 500 + (5*strval(date("s"))) ); ?></span> FREE VIP Openings Available on PaidForResearch.com as of <span id="engage_clock1" class="red_text"> <?php echo date("Y h:i:s A"); ?>.</span></strong></span><br /></div>
  <div style="font-size:16px;text-align:center;">(Limited number available nationwide - when you act fast). </div><br />
  <div style=" width:470px; float:left;text-align:justify">             
    <span class="subtitle_text"><strong>Are you ready to claim your FREE VIP Admission in PaidForResearch.com?<br />
    <br />
    <span class="blue_text"><a href="#" onclick="display_info_box()">More Info</a></span></strong></span>
    <div style="clear: both;"></div>
    <div id="infobox" style="margin-left:20px; display:none;"><strong class="blue_text">Why do we limit how many membership can join?</strong><br />
      <br />
      Just imagine if we let everyone sign up, it would over flood the opportunities we find. Our mission is to make this a win-win for everyone. If the above membership availability counter is at zero then please sign up and you will be on our waiting list for next month. Don't let this opportunity pass by.
    </div>                 
  </div>

  <div style=" float:left; padding-left:80px;">             
    <span class="subtitle_text">
      <form method="get" name="hostedform_main" id="hostedform_main" enctype="text" action="registration.php">               
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
        <input name="firstname" type="hidden" value="<?= $first_name ?>"/>
        <input name="lastname" type="hidden" value="<?= $last_name ?>"/>
        <input name="dobmonth" type="hidden" value="<?= $dobmonth ?>"/>
        <input name="dobday" type="hidden" value="<?= $dobday ?>"/>
        <input name="dobyear" type="hidden" value="<?= $dobyear ?>"/>
        <input name="email" type="hidden" value="<?= $email ?>"/>
        <input name="gender" type="hidden" value="<?= $gender ?>"/>
        <input name="ethnicity" type="hidden" value="<?= $ethnicity ?>"/>
        <input name="zip" type="hidden" value="<?= $zip ?>"/>                                                                            
        <div class="fixed-button">
          <input id="id-yes" name="yesno_main" type="radio" value="YES" onclick="submit_this_form()" /> 
          <label class="class-yes" for="id-yes">Yes</label>            
          <input id="id-no" name="yesno_main" type="radio" value="NO" onclick="submit_this_form()" />
          <label class="class-no" for="id-no">No</label>
        </div>
      </form>                            
    </span>
  </div>
  <div style="clear:both"></div>   
</div>
     
<script>
  // $(window).load(function() {
  //   $('.quote1').addClass('move');
  //   $('.quote2').addClass('move');
  //   $('.quote3').addClass('move');
  //   $('.fade-content').addClass('move');
  // });
</script>

<?php include_once("footer.php"); ?>        
