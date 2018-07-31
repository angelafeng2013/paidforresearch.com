<?php 
session_start();
if(isset($_SESSION['leadreactor_token'])) {
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$curl = curl_init();
		curl_setopt ($curl, CURLOPT_URL, $_SERVER['QUERY_STRING']);
	 //    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		//     'leadreactortoken:'.$_SESSION['leadreactor_token'],
		// ));
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
	    $output = curl_exec($curl);
	    curl_close ($curl);
	    echo $output;

		// $url = $_POST['url'];
		// $data = $_POST['data']; 
		// $the_url = $url.'?'.$data;
		// $curl = curl_init();
		// curl_setopt ($curl, CURLOPT_URL, $the_url);
		// curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		//     'leadreactortoken:'.$_SESSION['leadreactor_token'],
		// ));
		// curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
		// $output = curl_exec($curl);
		// curl_close ($curl);
		// echo $output;

	}
}
?>