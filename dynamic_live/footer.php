	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-69356760-32', 'auto');
  ga('send', 'pageview',location.pathname+"/virtual/"+document.querySelector("#private_progress_bar").innerHTML.trim()+location.search);

</script>
  <br />
    <div style="clear:both"></div>    
    <div id="footer1">
    <hr />
    <?php
     	if ( isset($_SESSION['user']['first_name']) && $_SESSION['user']['first_name'] != '') {
	        $firstname = $_SESSION['user']['first_name'];
	    } else if(isset($_GET['firstname'])) {
      		$firstname = $_GET['firstname'];
      	}else {
	        $firstname = '';
	    }

      	if ( isset($_SESSION['user']['last_name']) && $_SESSION['user']['last_name'] != '') {
        	$lastname = $_SESSION['user']['last_name'];
      	} else if(isset($_GET['lastname'])) {
      		$lastname = $_GET['lastname'];
      	}else {
        	$lastname = '';
      	}

      	if ( isset($_SESSION['user']['email']) && $_SESSION['user']['email'] != '') {
        	$email = $_SESSION['user']['email'];
      	} else if(isset($_GET['email'])) {
      		$email = $_GET['email'];
      	}else {
	        $email = '';
	    }

      	if ( isset($_SESSION['user']['ip']) && $_SESSION['user']['ip'] != '') {
        	$ip = $_SESSION['user']['ip'];
      	} else if(isset($_GET['ip'])) {
      		$ip = $_GET['ip'];
      	}
      	else {
        	$ip = '';
      	}

      	if ( isset($_SESSION['user']['zip']) && $_SESSION['user']['zip'] != '') {
        	$zip = $_SESSION['user']['zip'];
      	} else if(isset($_GET['zip'])) {
      		$zip = $_GET['zip'];
      	}else {
        	$zip = '';
      	}

      	if ( isset($_SESSION['user']['revenue_tracker_id']) && $_SESSION['user']['revenue_tracker_id'] != '') {
        	$addcode = 'CD'.$_SESSION['user']['revenue_tracker_id'];
      	} else if(isset($_GET['add_code'])) {
      		$addcode = $_GET['add_code'];
      	}else {
        	$addcode = '';
      	}    

      	if ( isset($_SESSION['user']['state']) && $_SESSION['user']['state'] != '') {
        	$state = $_SESSION['user']['state'];
      	} else if(isset($_GET['state'])) {
      		$state = $_GET['state'];
      	}else {
        	$state = '';
      	}

      	if ( isset($_SESSION['user']['city']) && $_SESSION['user']['city'] != '') {
        	$city = $_SESSION['user']['city'];
      	} else if(isset($_GET['city'])) {
      		$city = $_GET['city'];
      	}else {
        	$city = '';
      	}

      	if ( isset($_SESSION['user']['address']) && $_SESSION['user']['address'] != '') {
        	$address = $_SESSION['user']['address'];
      	} else if(isset($_GET['address1'])) {
      		$address = $_GET['address1'];
      	}else {
        	$address = '';
      	}

    ?>
       	<a onclick="popupwindow('../feedback.php?name=<?php echo $firstname; ?>&lname=<?php echo $lastname; ?>&email=<?php echo $email; ?>&city=<?php echo $city; ?>&state=<?php echo $state; ?>&ip=<?php echo $ip; ?>&zip=<?php echo $zip; ?>&address=<?php echo $address; ?>&addcode=<?php echo $addcode; ?>&url='+encodeURIComponent(window.location.href), 'Feedback', 380, 350)" href="javascript:void(0)">Feedback: Report any errors here.</a><br />
       	<a href="http://www.paidforresearch.com/privacy.htm" target="_blank">Privacy Policy</a> | <a href="http://www.paidforresearch.com/terms.htm" target="_blank" >Terms of Services</a><br />
       	&copy; <?php echo date("Y"); ?>, paidforresearch.com
        <br />
        <br />
      <div style="clear:both"></div>
    </div>
  </div> <!--END div Wrapper -->

<!-- <script src="js/jquery-1.11.1.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>
<script src="js/htmlParser.js"></script>
<script src="js/postscribe.js"></script>
<script src="js/custom.js"></script> -->
<?php echo isset($_SESSION['pixel']['footer']) ? offer_html(html_entity_decode($_SESSION['pixel']['footer'])) : ''; ?>
</body>
</html>
