<?php 
	include_once("header_survey.php"); 

	if( !isset($_SESSION['campaigns'])
		|| !isset($_SESSION['user']) 
		|| !isset($_SESSION['campaigns_anwered_counter'])
		|| !isset($_SESSION['leadreactor_url'])
		|| !isset($_SESSION['path_id']) 
		|| !isset($_SESSION['leadreactor_token'])
		) :
		// header('Location: '.get_survey_url('').'?affiliate_id=1&campaign_id=1&offer_id=1');
		echo '<script>window.location.replace("'.get_survey_url('').'?affiliate_id=1&campaign_id=1&offer_id=1");</script>';
		exit;
	else :
	
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
	<?php echo '<span style="display:none" id="private_progress_bar">'.$cur_bar.'/'.$bar_num.'</span>'; ?>
	<!-- <div id="contentbox_main" style="padding-right: 20px; padding-top: 150px; padding-left: 20px; padding-bottom: 50px; position: relative; border: solid 5px #6EB438;"> -->
   
	<div id="contentbox">    
		<div id="contentbox">   
			<?php 
				if($_SESSION['leadreactor_url'] != null || $_SESSION['leadreactor_url'] != '') $url = $_SESSION['leadreactor_url'];
				else $url = 'http://leadreactor.engageiq.com/';
				$output = curler($url."api/get_stack_campaign_content_php?affiliate_id=".$_SESSION['user']['revenue_tracker_id'].'&session='.$_SESSION['user']['session_id'].'&path='.$_SESSION['path_id'].'&'.$campaign_link.$creative_link);
		    	echo $output = offer_html($output);
			?>
		</div>
	</div>

<!---------- JORNAYA START -------->
<?php 
	$mo1 = array_search('MO1', $_SESSION['campaign_type_code']);
	$mo2 = array_search('MO2', $_SESSION['campaign_type_code']);
	$mo3 = array_search('MO3', $_SESSION['campaign_type_code']);
	$mo4 = array_search('MO4', $_SESSION['campaign_type_code']);
	if(isset($_GET['campaign'])) $page = $_GET['campaign'];
	else $page = $_SESSION['campaigns_anwered_counter'];

	$cur_camp_set = $_SESSION['campaign_types'][$page - 1];

	$hasJornayaScript = true;
	switch($cur_camp_set) {
		case $mo1:
			// echo 'Mixed1';
			$script = '//create.lidstatic.com/campaign/00a0189e-a665-2bc6-1acd-898f1adaa58e.js?snippet_version=2';
			$noscript = '//create.leadid.com/noscript.gif?lac=fb729c08-5ff7-ef6e-aa26-7424c8a7e644&lck=00a0189e-a665-2bc6-1acd-898f1adaa58e&snippet_version=2';
			break;
		case $mo2:
			// echo 'Mixed2';
			$script = '//create.lidstatic.com/campaign/efec0577-4fbf-b98d-b8bd-b99948ead41a.js?snippet_version=2';
			$noscript = '//create.leadid.com/noscript.gif?lac=fb729c08-5ff7-ef6e-aa26-7424c8a7e644&lck=efec0577-4fbf-b98d-b8bd-b99948ead41a&snippet_version=2';
			break;
		case $mo3:
			// echo 'Mixed3';
			$script = '//create.lidstatic.com/campaign/ab761332-3731-41ee-b321-94dcd8fd4277.js?snippet_version=2';
			$noscript = '//create.leadid.com/noscript.gif?lac=fb729c08-5ff7-ef6e-aa26-7424c8a7e644&lck=ab761332-3731-41ee-b321-94dcd8fd4277&snippet_version=2';
			break;
		case $mo4:
			// echo 'Mixed5';
			$script = '//create.lidstatic.com/campaign/87c71679-d13e-740d-9134-1144abeb8d36.js?snippet_version=2';
			$noscript = '//create.leadid.com/noscript.gif?lac=fb729c08-5ff7-ef6e-aa26-7424c8a7e644&lck=87c71679-d13e-740d-9134-1144abeb8d36&snippet_version=2';
			break;
		default:
			$hasJornayaScript = false;
			break;
	}

	if($hasJornayaScript) :
?>
	<input id="leadid_token" name="universal_leadid_original" type="hidden" value=""/>
	<script>
		function jornayaLeadIDToken() {
			console.log('jornaya loaded');
			var lead_token = document.getElementById('leadid_token').value,
				uni_ids = document.getElementsByName("universal_leadid");
			for (var i=0;i<uni_ids.length;i++) {
				uni_ids[i].value = lead_token;
			}
			if(uni_ids.length > 0) {
				if($('[name="universal_leadid"]').val() == '') valueChecker = setTimeout(jornayaLeadIDToken, 5000);
				else {
					if(typeof valueChecker !== 'undefined') clearTimeout(valueChecker);
				}
			}else console.log('No universal_leadid found');
		}
	</script>
	<script id="LeadiDscript" type="text/javascript">
	// <!--
	(function() {
	var s = document.createElement('script');
	s.id = 'LeadiDscript_campaign';
	s.type = 'text/javascript';
	s.async = true;
	s.src = '<?= $script ?>';
	//Custom Addition
	s.onload = jornayaLeadIDToken();
	var LeadiDscript = document.getElementById('LeadiDscript');
	LeadiDscript.parentNode.insertBefore(s, LeadiDscript);
	})();
	// -->
	</script>
	<noscript><img src='<?= $noscript ?>' /></noscript>
<?php
	endif;
?>
<!---------- JORNAYA END ---------->
<?php 
	include_once("footer.php"); 
	endif;
?>    

