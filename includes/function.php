<?php
	function get_client_ip() {
	    $ipaddress = '';
	    if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

	function display_progress_bar($current_page,$total_number,$display_info) {
		$mobile_percentage = 0;
		if($current_page > 0 && $total_number > 0) {
			$mobile_percentage = $display_info ? round(($current_page*100)/$total_number) : 0;
		}
		$mobile_percentage .= '%';
		echo '<div id="progress_bar_box">';
			echo '<div class="the-progress" style="width:'.$mobile_percentage.'"></div>';
		  	echo '<div id="progress_bar_holder">';
    			echo '<table id="progress_bar_table" width="100%" border="0" cellpadding="0" cellspacing="1">';
      				echo '<tr id="progress_bar_row">';
				        for($lop=1;$lop<=$total_number;$lop+=1)
				        {
				          	if ($lop<=$current_page) {
				          		echo '<td class="cell_shade" align="center">&nbsp;'.'</td>'; 
				      		}
				            else { 
				            	echo '<td class="cell_noshade" align="center">&nbsp;'.'</td>'; 
				            }
				        }
				    echo '</tr>';
				    
				    $display_info_display = $display_info ? 'show' : 'none';
			    	echo '<tr>';
        				echo '<td id="progress_bar_row_label" colspan="'.$total_number.'" style="display:'.$display_info_display.';height: 26px;" align="center">';
          					echo '<strong id="progress_bar_current_number">'.$current_page.'</strong>';
          					echo '<strong> of '.$total_number.'</strong> Question(s) to go';
        				echo '</td>';
      				echo '</tr>';
    			echo '</table>';
  			echo '</div>';
		echo '</div>';
		echo '<div style="height:10px;"></div>';
		// echo '<span style="display:none"> '.$current_page.' of '.$total_number.'  Question(s) to go</span>';
	}

	function getCakePageCode() {
		$code = null;
		$currentPath = $_SERVER['PHP_SELF']; // output: /myproject/index.php
        $pathInfo = pathinfo($currentPath); // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )

       	if($pathInfo['filename'] == 'index') $code = 'LP';
       	else if($pathInfo['filename'] == 'registration' || $pathInfo['filename'] == 
       		'first_page') $code = 'RP';
       	else if($pathInfo['filename'] == 'survey_stack'){
       		$parts = parse_url($_SERVER['REQUEST_URI']);
	       	if(isset($parts['query'])) { //get campaign id
	       		parse_str($parts['query'], $query);
	       		if(isset($query['campaign'])) {
	       			$campaign_list_id = $query['campaign'] - 1;
	       			$campaign_type_id = $_SESSION['campaign_types'][$campaign_list_id];
	       			$code = $_SESSION['campaign_type_code'][$campaign_type_id];
	       		}

	       		if($code == 'External Path') {
	       			$external_id = $_SESSION['campaigns'][$campaign_list_id][0];
	       			if(isset($_SESSION['external_campaigns_code'][$external_id])) {
	       				$code = $_SESSION['external_campaigns_code'][$external_id];
	       			}
	       		}
	       	}
       	}
		// echo $code;

		if($code != null) {
			echo '<iframe src="../includes/curl.php?type=log_page_view&sub_id='.$code.'" height="1" width="1" frameborder="0"></iframe>';
		}
	}

	getCakePageCode();
?>