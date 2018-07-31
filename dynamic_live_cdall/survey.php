<?php 
	include_once("header_survey.php"); 
	include_once("../includes/form_function.php"); 	

	if(! isset($_SESSION['campaigns'])) {
		header('Location: '.get_survey_url('').'?affiliate_id=1&campaign_id=1&offer_id=1');
	}
	
	$bar_num = count($_SESSION['campaigns']);
	if($_GET && isset($_GET['campaign']) && $_GET['campaign'] != '' && is_numeric($_GET['campaign']) && $_GET['campaign'] <= count($_SESSION['campaigns']) ) {
		$campaignID = $_SESSION['campaigns'][$_GET['campaign'] - 1];
		$cur_bar = $_GET['campaign'];
	}else {
		$campaignCount = $_SESSION['campaigns_anwered_counter'];
    	// $campaignID = $_SESSION['campaigns'][$campaignCount];
    	//$cur_bar = $_SESSION['campaigns_anwered_counter'] + 1;
    	$campaignID = $_SESSION['campaigns'][0];
    	$cur_bar = 1;
    	header('Location: '.'?campaign=1');
	}
?>	
	
	<input type="hidden" name="user_phone" id="user_phone" value="<?= $_SESSION['user']['phone1'].$_SESSION['user']['phone2'].$_SESSION['user']['phone3']?>" />
	<input type="hidden" name="user_address" id="user_address" value="<?= $_SESSION['user']['address']?>" />
	
	<div id="progress_bar_box">
		<div class="the-progress"></div>
		<div id="progress_bar_holder">
			<table id="progress_bar_table" width="100%" border="0" cellpadding="0" cellspacing="1">
				<tr id="progress_bar_row">
					<?php 
					for($lop=1;$lop<=$bar_num;$lop+=1)
					{
						if ($lop<=$cur_bar) 
						{ echo '<td class="cell_shade" align="center">&nbsp;'.'</td>'; }
					  	else
					  	{ echo '<td class="cell_noshade" align="center">&nbsp;'.'</td>'; }
					 }		
					?>
				</tr>
				<tr>
					<td id="progress_bar_row_label" align="center" style="height: 26px;" colspan="<?= $bar_num ?>">
						<strong id="progress_bar_current_number"><?= $cur_bar?></strong>
						<strong><?=' of '.$bar_num ?></strong> Question(s) to go
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div style="height:10px;"></div>
	
	<div id="contentbox">    
		<?php 
			if($_SESSION['leadreactor_url'] != null || $_SESSION['leadreactor_url'] != '') $url = $_SESSION['leadreactor_url'];
			else $url = 'http://leadreactor.engageiq.com/';
			$curl = curl_init();
			curl_setopt ($curl, CURLOPT_URL, $url."get_campaign_content_php?id=".$campaignID);
			// curl_setopt ($curl, CURLOPT_URL, "http://localhost:1234/get_campaign_content_php?id=".$campaignID);
		    // curl_setopt ($curl, CURLOPT_URL, "http://leadreactor.engageiq.com/get_campaign_content_php?id=".$campaignID);
		    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			    'leadreactortoken:'.$_SESSION['leadreactor_token'],
			));
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		    $output = curl_exec($curl);
		    curl_close ($curl);
		    $output = offer_html($output);
		?>     
	</div>
<?php include_once("footer.php"); ?>    
