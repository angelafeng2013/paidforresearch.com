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
  <script src="../js/jquery.history.js"></script>
  <script src="../js/jquery.maskedinput.min.js"></script>
  <script src="../js/custom.js?v=2"></script>
  <script type="text/javascript" src="//storage.googleapis.com/cdn.pippio.com/sdk
/pippio.min.js" async></script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W6M3RT2');</script>
<!-- End Google Tag Manager -->
<!--  
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:519545,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>-->

<!-- Smartlook Tracking Code for http://path6.paidforresearch.com/dynamic_live_cd3432/ -->
<script type="text/javascript">
    window.smartlook||(function(d) {
    var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
    var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
    c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', 'e69818560e75cf61991bed9a8727861af3a25b38');
</script>
<!-- End of Smartlook Tracking Code for http://path6.paidforresearch.com/dynamic_live_cd3432/ -->
  
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
<?php echo isset($_SESSION['pixel']['header']) ? offer_html(html_entity_decode($_SESSION['pixel']['header'])) : '';
?>
</head>
<body>
<?php echo isset($_SESSION['pixel']['body']) ? offer_html(html_entity_decode($_SESSION['pixel']['body'])) : ''; ?> 
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W6M3RT2"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->  
  <!--PIXEL FIRE START -->
  <?php fire_pixel(); ?>
  <!--PIXEL FIRE END -->
  <div class="wrapper"> <!--BEGIN Div wrapper-->
    
    <!-- old header -->
    <!--   
    <div id="headline1" align="center" style="display: block !important;">
      <img style="max-width: 100%;" src="images/header1.png">
    </div>
    <div id="headline2">
      <span class="text_header1">Answer these quick questions to find surveys and freebies just for you!</span>
    </div> -->

    <div id="headline1"></div>
    <div id="headline2">
      <img class="first-step-img lazy" src="images/1ststep.png">
      <img class="img-logo lazy" src="images/100guaranteed.png" style="padding-right:10px">
      <img class="img-logo lazy" src="images/100secure.png">
      <img class="img-logo lazy" src="images/arrow.png">
      <img class="img-logo-2 lazy" src="images/bbb_acredited.png">
    </div>

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