<?php 
session_start();
if(isset($_SESSION['leadreactor_url'])) {
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
	       $_SESSION['selected_pre_reg_campaigns'][$_POST['id']] = $_SERVER['QUERY_STRING'];
	}else {
                if(isset($_SESSION['selected_pre_reg_campaigns'])) {
                        include_once("form_function.php"); 
                        foreach($_SESSION['selected_pre_reg_campaigns'] as $id => $pre_reg) {
                                $campaign = offer_html(utf8_decode(urldecode($pre_reg))); //replace shortcodes
                                $campaign_url = parse_url($campaign); //parse url to get url query
                                parse_str($campaign_url['query'], $query); //clean url query
                                $query = http_build_query($query);
                                $lead_url = $campaign_url['scheme'].'://'.$campaign_url['host'].$campaign_url['path'].'?'.$query; //generate clean url

                                $curl = curl_init();
                                curl_setopt ($curl, CURLOPT_URL, $lead_url);
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
                                echo $output = curl_exec($curl);
                                curl_close ($curl);

                                $_SESSION['pre_reg_output'][$id] = $output;

                                unset($_SESSION['selected_pre_reg_campaigns'][$id]);
                        }
                        unset($_SESSION['selected_pre_reg_campaigns']);
                } 
        }
}
?>