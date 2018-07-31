<?php
	include_once("includes/form_function.php");

	$curl = curl_init();
	curl_setopt ($curl, CURLOPT_URL, $_SERVER['QUERY_STRING']);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	    'leadreactortoken:'.$_SESSION['leadreactor_token'],
	));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close ($curl);
    
    if (array_key_exists('ignore', $_GET)) echo $output;
    else $output = offer_html($output);
?>
