<?php 

if(session_id() == '') {
    session_start();
}

function curler($url) {
	$curl = curl_init();
	curl_setopt ($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_USERPWD, $_SESSION['auth_cred']); 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
	$output = curl_exec($curl);
	curl_close ($curl);

	return $output;
}

if(isset($_SESSION['leadreactor_url'])) {
	// $_SESSION['SERVER'] = $_SERVER;
	if($_SERVER['REQUEST_METHOD'] == 'POST') {	
		// $_SESSION['GET'] = $_GET;
		if(isset($_GET['type'])) {

			/* USER REGISTRATION */
			if($_GET['type'] == 'register') {
				$data = http_build_query($_POST);
				$url = $_SESSION['leadreactor_url'].'api/get_campaign_list?'.$data;
				echo $output = curler($url);
				$_SESSION['registration_return'] = $output;
			}

			/* CAMPAIGN NO TRACKING */
			else if($_GET['type'] == 'track_no') {
				$data = http_build_query($_POST);
				$email = $_SESSION['user']['email'];
				$session = $_SESSION['user']['session_id'];
				$url = $_SESSION['leadreactor_url'].'api/track_campaign_nos/?email='.$email.'&session='.$session.'&'.$data;
				echo $output = curler($url);
			}

			/* CPA PIXEL */
			else if($_GET['type'] == 'cpa_pixel') {
				$data = http_build_query($_POST); 
				$url = $_SESSION['leadreactor_url'].'sendLead/?'.$data;
				echo $output = curler($url);
			}
		}
	}else{
		if(isset($_GET['type'])) {
			/* LOG PAGE VIEW */
			if($_GET['type'] == 'log_page_view') {
				$rev_tracker = isset($_SESSION['user']['revenue_tracker_id']) ? $_SESSION['user']['revenue_tracker_id'] : $_SESSION['rev_tracker'];
				$affiliate_id = isset($_SESSION['user']['affiliate_id']) ? $_SESSION['user']['affiliate_id'] : $rev_tracker;
				$lr_url = $_SESSION['leadreactor_url'];
				$sub_id = $_GET['sub_id'];
				$url = $lr_url.'api/logPageView?affiliate_id='.$affiliate_id.'&revenue_tracker_id='.$rev_tracker.'&sub_id='.$sub_id;
				echo curler($url);
			}
		}
	} 	
}
?>