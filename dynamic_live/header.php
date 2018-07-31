<?php 
require_once '../token.php';
include_once("../includes/form_function.php");  
include_once("../includes/function.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<!-- <meta name="lrUrl" content="http://localhost:1234/" /> -->
<!-- <meta name="lrUrl" content="http://leadreactor.engageiq.com/" /> -->
<meta name="lrUrl" content="<?= $_SESSION['leadreactor_url']?>" />
<title>Welcome to Paid For Research</title>
<link href="css/style.css" type="text/css" rel="stylesheet"></link>
<link href="css/mobile.css" type="text/css" rel="stylesheet"></link>
<link href="css/opt-in.css" type="text/css" rel="stylesheet"></link>
<link href="css/stack.css" type="text/css" rel="stylesheet"></link>
<script src="../js/jquery-1.11.1.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<script src="../js/additional-methods.min.js"></script>
<script src="../js/jquery.autotab.min.js"></script>
<!-- <script src="../js/htmlParser.js"></script>
<script src="../js/postscribe.js"></script> -->
<script src="../js/jquery.history.js"></script>
<script src="../js/jquery.maskedinput.min.js"></script>
<script src="../js/custom.js?v=2"></script>
<script type="text/javascript" src="//storage.googleapis.com/cdn.pippio.com/sdk
/pippio.min.js" async></script>

<!-- Hotjar Tracking Code for Path6 - dynamic_live - Green -->
<!--
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:488286,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script> -->

<!-- Smartlook Tracking Code for http://path6.paidforresearch.com/dynamic_live/ -->
<script type="text/javascript">
    window.smartlook||(function(d) {
    var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
    var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
    c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', '66a3a2b6b2a89801cd1e1f9ff3186e48d763e665');
</script>
<!-- End of Smartlook Tracking Code for http://path6.paidforresearch.com/dynamic_live/ -->

<?php
$tracker = $_SESSION['rev_tracker'];
if (isset($_SESSION['rev_tracker']) && $_SESSION['rev_tracker']=="7929") { ?>

<!-- PushCrew Tracking Code for http://path6.paidforresearch.com/dynamic_live_red/  7929 tracker-->
<!-- <script type="text/javascript">
  (function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/0f9511d0742b3ad9a4d9c00af22905bd.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
  })(window,document);
</script> -->

<?php } elseif (isset($_SESSION['rev_tracker']) && $_SESSION['rev_tracker']=="7920") { ?>

<!-- PushCrew Tracking Code for http://path6.paidforresearch.com/dynamic_live_red/  7920 tracker-->
<!-- <script type="text/javascript">
  (function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/1ea8b27ff3274d2c07a91db56eae6d6f.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
  })(window,document);
</script> -->

<?php } elseif (isset($_SESSION['rev_tracker']) && $_SESSION['rev_tracker']=="8206") { ?>

<!-- PushCrew Tracking Code for http://path6.paidforresearch.com/dynamic_live_red/  8206 tracker-->
<!-- <script type="text/javascript">
  (function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/571e277881a68068f4465bd9d5f46ee7.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
  })(window,document);
</script> -->

<?php } elseif (isset($_SESSION['rev_tracker']) && $_SESSION['rev_tracker']=="8262") { ?>

<!-- PushCrew Tracking Code for http://path6.paidforresearch.com/dynamic_live_red/  8262 tracker-->
<!-- <script type="text/javascript">
  (function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/d61e11db2220b636e1d1b410e8adaaa0.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
  })(window,document);
</script> -->

<?php } elseif (isset($_SESSION['rev_tracker']) && $_SESSION['rev_tracker']=="8094") { ?>

<!-- PushCrew Tracking Code for http://path6.paidforresearch.com/dynamic_live/ 8094 tracker-->
<!-- <script type="text/javascript">
  (function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/f488503a0fd34224e39c927eb1429171.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
  })(window,document);
</script> -->

<?php } elseif (isset($_SESSION['rev_tracker']) && $_SESSION['rev_tracker']=="8128") { ?>

<!-- PushCrew Tracking Code for http://path6.paidforresearch.com/dynamic_live/ 8128 tracker-->
<!-- <script type="text/javascript">
  (function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/eeee802df824a145fcf2931a5ed02666.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
  })(window,document);
</script> -->

<?php } elseif (isset($_SESSION['rev_tracker']) && $_SESSION['rev_tracker']=="8138") { ?>

<!-- PushCrew Tracking Code for http://path6.paidforresearch.com/dynamic_live/ 8138 tracker-->
<!-- <script type="text/javascript">
  (function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/74e0ba5390fdfc1666f17275bfb6a7c2.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
  })(window,document);
</script> -->

<?php } elseif (isset($_SESSION['rev_tracker']) && $_SESSION['rev_tracker']=="8275") { ?>

<!-- PushCrew Tracking Code for http://path6.paidforresearch.com/dynamic_live/ 8275 tracker-->
<!-- <script type="text/javascript">
  (function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/30b6fadf0c145478915f52976924a2b7.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
  })(window,document);
</script> -->

<?php } elseif (isset($_SESSION['rev_tracker']) && $_SESSION['rev_tracker']=="7935") { ?>

<!-- PushCrew Tracking Code for http://path6.paidforresearch.com/dynamic_live/ 7935 tracker-->
<!-- <script type="text/javascript">
  (function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/435dc25ef383238170e157cc3da4c6a3.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
  })(window,document);
</script> -->


<?php } elseif (isset($_SESSION['rev_tracker']) && $_SESSION['rev_tracker']=="8263") { ?>

<!-- PushCrew Tracking Code for http://path6.paidforresearch.com/dynamic_live/ 8263 tracker-->
<!-- <script type="text/javascript">
  (function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/e7a24720bd8dcb113f7fb6467c63e1e0.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
  })(window,document);
</script> -->

<?php } elseif (isset($_SESSION['rev_tracker']) && $_SESSION['rev_tracker']=="8054") { ?>

<!-- PushCrew Tracking Code for http://path6.paidforresearch.com/dynamic_live/ 8054 tracker-->
<!-- <script type="text/javascript">
  (function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/3543623f96f983085714c099b5e2fc20.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
  })(window,document);
</script> -->

<?php } elseif (isset($_SESSION['rev_tracker']) && $_SESSION['rev_tracker']=="8127") { ?>

<!-- PushCrew Tracking Code for http://path6.paidforresearch.com/dynamic_live/ 8127 tracker-->
<!-- <script type="text/javascript">
  (function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/98cb7ceb5193ce47f13399b5b414b3ee.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
  })(window,document);
</script> -->

<?php } elseif (isset($_SESSION['rev_tracker']) && $_SESSION['rev_tracker']=="8095") { ?>

<!-- PushCrew Tracking Code for http://path6.paidforresearch.com/dynamic_live_phn/  8095 tracker-->
<!-- <script type="text/javascript">
  (function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/77b62a49f56b8fb6f37b31bdf44dcd1f.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
  })(window,document);
</script> -->

<?php } else {
  //do nothing
  echo "<!-- tracker: $tracker -->";
  } ?>

<?php
// $curpage = $_SERVER['PHP_SELF'];
// echo "<!-- $curpage -->\n";
// $pos = strpos($curpage,'index.php');
// echo "<!-- $pos -->\n";

// if ($pos>=1 && isset($_SESSION['rev_tracker']) && ($_SESSION['rev_tracker']=="8338" || $_SESSION['rev_tracker']=="8339" || $_SESSION['rev_tracker']=="8340" || $_SESSION['rev_tracker']=="8341" || $_SESSION['rev_tracker']=="8342" || $_SESSION['rev_tracker']=="8343" || $_SESSION['rev_tracker']=="8344" || $_SESSION['rev_tracker']=="8345")) { ?>
<!-- PowerInbox Pixel BEGIN-->
<!-- <script type="text/javascript">
window.pi_params = {};
pi_params.company_id = '1930';
pi_params.value = '0.25';
pi_params.currency = 'USD';
(function() {
var pin = document.createElement('script');
pin.async = true;
pin.src = '//cdn.powerinboxedge.com/framework/pi-notify.js';
var ref = document.getElementsByTagName('script')[0];
ref.parentNode.insertBefore(pin, ref);
})();
</script> -->
<!-- PowerInbox Pixel END-->
<?php //} ?>  

<?php echo isset($_SESSION['pixel']['header']) ? offer_html(html_entity_decode($_SESSION['pixel']['header'])) : '';
?>
</head>
<body>
<?php echo isset($_SESSION['pixel']['body']) ? offer_html(html_entity_decode($_SESSION['pixel']['body'])) : ''; ?> 
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJGF638"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  
  <!--PIXEL FIRE START -->
  <?php fire_pixel(); ?>
  <!--PIXEL FIRE END -->
  <div class="wrapper"> <!--BEGIN Div wrapper-->
    <div id="headline1" align="center" style="display: block !important;">
      <img style="max-width: 100%;" src="images/header1.png">
    </div>
    <div id="headline2"><span class="text_header1">Answer these quick questions to find surveys and freebies just for you!</span></div>

<input type="hidden" name="error_validation_counter" id="error_validation_counter" value="0"/>

<script>
$( document ).ready(function() {
  var History = window.History;
  History.enabled;
  History.Adapter.bind(window,'statechange',function(){ 
      var State = History.getState(); 
      //History.log(State.data, State.title, State.url);
      window.location.href=(State.url);
  });
});
</script>    