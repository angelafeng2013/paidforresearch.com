<?php 
// Start a session
session_id($_GET['php_session']);
session_start();
$php_session=session_id();

//Call all required files
include_once("includes/function.php"); 
require_once("includes/mod_managepath.php");

//Establish Sessions
$lead_info = array();
if (isset($_SESSION["lead_info"])){
   $lead_info = $_SESSION["lead_info"];
 } 
 else{
   echo SESSION_ERROR_MSG;
   exit();
 }

if(isset($_COOKIE['tolunaaddress'])){
    $lead_info['address'] = $_COOKIE['tolunaaddress'];
}
else{
    // Cookie is not set
}

if(isset($_COOKIE['tolunaphone1']) && isset($_COOKIE['tolunaphone2']) && isset($_COOKIE['tolunaphone3'])){
    $lead_info['phone1'] = $_COOKIE['tolunaphone1'];
    $lead_info['phone2'] = $_COOKIE['tolunaphone2'];
    $lead_info['phone3'] = $_COOKIE['tolunaphone3'];
}
else{
    // Cookie is not set
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<title>Welcome to Paid For Research</title>
<link href="css/style.css" type="text/css" rel="stylesheet"></link>
<link href="css/mobile.css" type="text/css" rel="stylesheet">
<link href="css/opt-in.css" type="text/css" rel="stylesheet">
<link href="css/stack.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="js/functions.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery.validate.js"></script>

<!--[if lte IE 8]>
  <script type="text/javascript" src="js/selectivizr-min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/ie8.css" />
<![endif]-->

<script>
var virtualURL = document.querySelector("#private_progress_bar").innerText.trim();
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-69356760-32', 'auto');
  ga('send', 'pageview', location.pathname+virtualURL+location.search);
 

</script>

<!-- Hotjar Tracking Code for http://path6.paidforresearch.com/dynamic_live/ -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:519545,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>

<!-- Push Crew Script -->
<script type="text/javascript">
    (function(p,u,s,h){
        p._pcq=p._pcq||[];
        p._pcq.push(['_currentTime',Date.now()]);
        s=u.createElement('script');
        s.type='text/javascript';
        s.async=true;
        s.src='https://cdn.pushcrew.com/js/b3e38f443545d70e6179a2f17c608bf6.js';
        h=u.getElementsByTagName('script')[0];
        h.parentNode.insertBefore(s,h);
    })(window,document);
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WJGF638');</script>
<!-- End Google Tag Manager -->
<?php echo isset($_SESSION['pixel']['header']) ? html_entity_decode($_SESSION['pixel']['header']) : '';
?>
</head>
<body>
<?php echo isset($_SESSION['pixel']['body']) ? html_entity_decode($_SESSION['pixel']['body']) : ''; ?> 

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJGF638"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  <div class="wrapper"> <!--BEGIN Div wrapper-->
    <div id="headline1"></div>
    <div id="headline2" class="second-step">
		<img class="first-step-img" src="images/2ndstep.png">
		<img class="img-logo" src="images/100guaranteed.png" style="padding-right:10px">
		<img class="img-logo" src="images/100secure.png" >
		<img class="img-logo" src="images/arrow.png">
		<img class="img-logo-2" src="images/bbb_acredited.png">
	</div>

