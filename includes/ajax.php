<?php 
	session_start();
	if($_POST['type'] == 'set_session') {
		$data = $_POST['data'];
		$_SESSION['campaigns'] = $data['campaigns'];
		$_SESSION['user'] = $data['user'];
                $_SESSION['user']['affiliate_id'] = $data['affiliate_id'];
                $_SESSION['user']['offer_id'] = $data['offer_id'];
                $_SESSION['user']['campaign_id'] = $data['campaign_id'];
                $_SESSION['user']['revenue_tracker_id'] = $data['revenue_tracker_id'];        
		$_SESSION['campaigns_anwered_counter'] = 0;
		$_SESSION['campaigns_answered'] = array();
		echo $data['user']['first_name'];
	}else if($_POST['type'] == 'get_campaign_id') {
		$num = $_SESSION['campaigns_anwered_counter'];
		$id = $_SESSION['campaigns'][$num];
		echo $id;
	}else if($_POST['type'] == 'set_next_survey') {
		if(!in_array($_POST['id'],$_SESSION['campaigns_answered'])) {
                        // $_SESSION['campaigns_answered'][$_SESSION['campaigns_anwered_counter']] = $_POST['id'];
			$_SESSION['campaigns_anwered_counter'] = $_SESSION['campaigns_anwered_counter'] + 1;
			array_push($_SESSION['campaigns_answered'], $_POST['id']);
		}
                $num = $_SESSION['campaigns_anwered_counter'];
                $id = $_SESSION['campaigns'][$num];
                echo $id;

	}else if($_POST['type'] == 'convert_html') {
		$html = $_POST['html'];

		echo offer_html($html);
	}else if($_POST['type'] == 'send_survey') {
                if(!in_array($_POST['id'],$_SESSION['campaigns_answered'])) {
                        $_SESSION['campaigns_anwered_counter'] = $_SESSION['campaigns_anwered_counter'] + 1;
                        array_push($_SESSION['campaigns_answered'], $_POST['id']);
                }
                $num = $_SESSION['campaigns_anwered_counter'];
                $id = $_SESSION['campaigns'][$num];
        }


	function offer_html($html)
	{
	/*$html = str_replace('<?php echo','',$html);
        $html = str_replace('; ?>','',$html);
        $html = preg_replace('/^<\?php(.*)(\?>)?$/s', '$1', $html);*/

        $gender = $_SESSION['user']['gender'] == 0 ? 'Female' : 'Male';
        if($_SESSION['user']['gender'] == 1) $title = 'Mr.';
        else $title = 'Mrs.';

        if(strpos($html,'[VALUE_REV_TRACKER]') !== false) $html = str_replace('[VALUE_REV_TRACKER]', $_SESSION['user']['revenue_tracker_id'], $html);
        if(strpos($html,'[VALUE_AFFILIATE_ID]') !== false) $html = str_replace('[VALUE_AFFILIATE_ID]', $_SESSION['user']['affiliate_id'], $html);
        if(strpos($html,'[VALUE_PUB_TIME]') !== false) $html = str_replace('[VALUE_PUB_TIME]', date('Y-m-d H:i:s'), $html);
        if(strpos($html,'[VALUE_DOBMONTH]') !== false) $html = str_replace('[VALUE_DOBMONTH]', $_SESSION['user']['dobmonth'], $html);
        if(strpos($html,'[VALUE_DOBDAY]') !== false) $html = str_replace('[VALUE_DOBDAY]', $_SESSION['user']['dobday'], $html);
        if(strpos($html,'[VALUE_DOBYEAR]') !== false) $html = str_replace('[VALUE_DOBYEAR]', $_SESSION['user']['dobyear'], $html);
        if(strpos($html,'[VALUE_EMAIL]') !== false) $html = str_replace('[VALUE_EMAIL]', $_SESSION['user']['email'], $html);
        if(strpos($html,'[VALUE_FIRST_NAME]') !== false) $html = str_replace('[VALUE_FIRST_NAME]', $_SESSION['user']['first_name'], $html);
        if(strpos($html,'[VALUE_LAST_NAME]') !== false) $html = str_replace('[VALUE_LAST_NAME]', $_SESSION['user']['last_name'], $html);
        if(strpos($html,'[VALUE_ZIP]') !== false) $html = str_replace('[VALUE_ZIP]', $_SESSION['user']['zip'], $html);
        if(strpos($html,'[VALUE_CITY]') !== false) $html = str_replace('[VALUE_CITY]', $_SESSION['user']['city'], $html);
        if(strpos($html,'[VALUE_STATE]') !== false) $html = str_replace('[VALUE_STATE]', $_SESSION['user']['state'], $html);
        if(strpos($html,'[VALUE_GENDER]') !== false) $html = str_replace('[VALUE_GENDER]', $gender, $html);
        if(strpos($html,'[VALUE_BIRTHDATE]') !== false) $html = str_replace('[VALUE_BIRTHDATE]', $_SESSION['user']['birthdate'], $html);
        if(strpos($html,'[VALUE_IP]') !== false) $html = str_replace('[VALUE_IP]', $_SESSION['user']['ip'], $html);
        if(strpos($html,'[VALUE_ADDRESS1]') !== false) $html = str_replace('[VALUE_ADDRESS1]', $_SESSION['user']['address'], $html);
        if(strpos($html,'[VALUE_PHONE]') !== false) $html = str_replace('[VALUE_PHONE]', $_SESSION['user']['phone'], $html);
        if(strpos($html,'[VALUE_PHONE1]') !== false) $html = str_replace('[VALUE_PHONE1]', $_SESSION['user']['phone1'], $html);
        if(strpos($html,'[VALUE_PHONE2]') !== false) $html = str_replace('[VALUE_PHONE2]', $_SESSION['user']['phone2'], $html);
        if(strpos($html,'[VALUE_PHONE3]') !== false) $html = str_replace('[VALUE_PHONE3]', $_SESSION['user']['phone3'], $html);
        if(strpos($html,'[VALUE_TITLE]') !== false) $html = str_replace('[VALUE_TITLE]', $title, $html);
        if(strpos($html,'[VALUE_TODAY]') !== false) $html = str_replace('[VALUE_TODAY]', date("m/d/Y"), $html);
        if(strpos($html,'[VALUE_DATE_TIME]') !== false) $html = str_replace('[VALUE_DATE_TIME]', date("m/d/Y H:i:s"), $html);

        $html = eval('?>'.$html.'<?php;');

        return $html;
	}
?>