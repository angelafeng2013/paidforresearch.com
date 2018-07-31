<?php 
	include_once("header_survey.php"); 
	include_once("../includes/form_function.php"); 	

	if(! isset($_SESSION['campaigns'])) {
		header('Location: '.get_survey_url('').'?affiliate_id=1&campaign_id=1&offer_id=1');
	}
	
	$bar_num = count($_SESSION['campaigns']);
	
	if($_GET && isset($_GET['campaign']) && $_GET['campaign'] != '' && is_numeric($_GET['campaign']) && $_GET['campaign'] < count($_SESSION['campaigns']) + 1 ) {
		$campaignID = $_SESSION['campaigns'][$_GET['campaign'] - 1];
		$cur_bar = $_GET['campaign'];
		$campaigns['campaigns'] = $_SESSION['campaigns'][$_GET['campaign'] - 1];
		$current_set = $_GET['campaign'] - 1;
	}else {
		$campaignCount = $_SESSION['campaigns_anwered_counter'];
    	$campaignID = $_SESSION['campaigns'][$campaignCount];
    	$cur_bar = $_SESSION['campaigns_anwered_counter'] + 1;
    	$campaigns['campaigns'] = $_SESSION['campaigns'][$_SESSION['campaigns_anwered_counter']];
    	$current_set = $campaignCount;
	}
	// print_r();
	$campaign_link = http_build_query($campaigns);
	
	/* Get Campaign Creatives */
	$creatives = array();
	if(isset($_SESSION['creatives'])) {
		if(count($_SESSION['creatives'])) {
			$campaign_creatives = $_SESSION['creatives'];
			foreach($campaigns['campaigns'] as $campaign_id) {
				if(array_key_exists($campaign_id,$campaign_creatives)){
					$creatives[$campaign_id] = $campaign_creatives[$campaign_id];
				}
			}
		}
	}
	$creative['creatives'] = $creatives;
	$creative_link = '';
	if(count($creatives) > 0) {
		$creative_link = '&'.http_build_query($creative);
	}
?>	
	<input type="hidden" name="current_campaign_set" id="current_campaign_set" value="<?php echo $current_set?>">
	<input type="hidden" name="user_phone" id="user_phone" value="<?= $_SESSION['user']['phone1'].$_SESSION['user']['phone2'].$_SESSION['user']['phone3']?>" />
	<input type="hidden" name="user_address" id="user_address" value="<?= $_SESSION['user']['address']?>" />
	
	<!-- PROGRESS BAR START -->
	<?php display_progress_bar($cur_bar,$bar_num,true); ?>
	<!-- PROGRESS BAR END -->
	
	<!-- <div id="contentbox_main" style="padding-right: 20px; padding-top: 150px; padding-left: 20px; padding-bottom: 50px; position: relative; border: solid 5px #6EB438;"> -->

<!-- BEGIN - Insert here the pixel of the Publisher -->    
    <?php     
     //Insert here the pixel of the publisher 
     //echo "Revenue Tracker is:". $_SESSION['user']['revenue_tracker_id']."<\br>";
     //echo "Campaign Number is:". $_GET['campaign'];
     
     if ($_GET['campaign']==1)
     { // Only Fire Pixel on the first page offer in the path.

       if($_SESSION['user']['revenue_tracker_id']==8189) // Show 8189 Pixel
	     {

 		   //echo "8189 Pixel is placed";

 		   echo '
           <script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"5626510"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script><noscript><img src="//bat.bing.com/action/0?ti=5626510&Ver=2" height="0" width="0" style="display:none; visibility: hidden;" /></noscript>
           ';

	    
	     }

	     if($_SESSION['user']['revenue_tracker_id']==8190) // Show 8189 Pixel
	     {

 			//echo "8190 Pixel is placed";
 			
 			echo '	
 			<script type="application/javascript">(function(w,d,t,r,u){w[u]=w[u]||[];w[u].push({\'projectId\':\'10000\',\'properties\':{\'pixelId\':\'10028643\'}});var s=d.createElement(t);s.src=r;s.async=true;s.onload=s.onreadystatechange=function(){var y,rs=this.readyState,c=w[u];if(rs&&rs!="complete"&&rs!="loaded"){return}try{y=YAHOO.ywa.I13N.fireBeacon;w[u]=[];w[u].push=function(p){y([p])};y(c)}catch(e){}};var scr=d.getElementsByTagName(t)[0],par=scr.parentNode;par.insertBefore(s,scr)})(window,document,"script","https://s.yimg.com/wi/ytc.js","dotq");</script>

 			';
	     }
	   //   if($_SESSION['user']['revenue_tracker_id']==8203) // Show 8203 Pixel
	   //   {

 			// //echo "8203 Pixel is placed";
 			
 			// echo '	
 			//   <script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"5626510"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script><noscript><img src="//global.clicktrackurl.com/pixel.do?o=52&t=pb&request_id='.$s2.'" height="0" width="0" style="display:none; visibility: hidden;" /></noscript>

 			// ';
	   //   }
	   //   if($_SESSION['user']['revenue_tracker_id']==8204 ) // Show 8204  Pixel
	   //   {

 			// //echo "8204  Pixel is placed";
 			
 			// echo '	
 			//   <script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"5626510"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script><noscript><img src="//global.clicktrackurl.com/pixel.do?o=51&t=pb&request_id='.$s2.'" height="0" width="0" style="display:none; visibility: hidden;" /></noscript>

 			// ';
	   //   }
 	 }
     
     
    ?>
   
	<!-- END - Insert here the pixel of the Publisher -->
	
	<div id="contentbox">    
		<div id="contentbox">   
			<?php 
				if($_SESSION['leadreactor_url'] != null || $_SESSION['leadreactor_url'] != '') $url = $_SESSION['leadreactor_url'];
				else $url = 'http://leadreactor.engageiq.com/';
				$curl = curl_init();
				curl_setopt ($curl, CURLOPT_URL, $url."api/get_stack_campaign_content_php?affiliate_id=".$_SESSION['user']['revenue_tracker_id'].'&session='.$_SESSION['user']['session_id'].'&path='.$_SESSION['path_id'].'&'.$campaign_link.$creative_link);
				// curl_setopt ($curl, CURLOPT_URL, $url."get_stack_campaign_content_php?".$campaign_link);
				// curl_setopt ($curl, CURLOPT_URL, "http://stagingleadreactor.engageiq.com/get_stack_campaign_content_php?".$campaign_link);
				// curl_setopt ($curl, CURLOPT_URL, "http://localhost:1234/get_stack_campaign_content_php?".$campaign_link);
			    // curl_setopt ($curl, CURLOPT_URL, "http://leadreactor.engageiq.com/get_stack_campaign_content_php?".$campaign_link);
			    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				    'leadreactortoken:'.$_SESSION['leadreactor_token'],
				));
			    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
			    $output = curl_exec($curl);
			    curl_close ($curl);
			    $output = offer_html($output);
			?>
		</div>
	</div>
<?php include_once("footer.php"); ?>    
