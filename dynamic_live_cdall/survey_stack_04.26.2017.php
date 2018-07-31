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
