<?php 
        if(session_id() == '') {
                session_start();
        }
        if($_POST) {
                if($_POST['type'] == 'set_session') {
                        $data = $_POST['data'];
                        $_SESSION['campaigns'] = $data['campaigns'];
                        $_SESSION['user'] = $data['user'];
                        $_SESSION['user']['revenue_tracker_id'] = $data['revenue_tracker_id'];  
                        $_SESSION['creatives'] = isset($data['creatives']) ? $data['creatives'] : array();  
                        $_SESSION['user']['path_type'] = $data['path_type'];        
                        $_SESSION['campaigns_anwered_counter'] = 0;
                        $_SESSION['campaigns_answered'] = array();
                        // $_SESSION['user']['session_id'] = session_id().'-'.time();
                        $_SESSION['user']['session_id'] = session_id().'-'.date('ymd');
                        echo $data['user']['first_name'];
                }else if($_POST['type'] == 'get_campaign_id') {
                        $num = $_SESSION['campaigns_anwered_counter'];
                        $id = $_SESSION['campaigns'][$num];
                        echo $id;
                }else if($_POST['type'] == 'set_next_survey') {
                        if(isset($_SESSION['user']) && isset($_SESSION['campaigns']) 
                                && isset($_SESSION['campaigns_answered']) 
                                && isset($_SESSION['campaigns_anwered_counter']) ) {
                                //PATH Long = 1; Stack = 2
                                $path_type = $_SESSION['user']['path_type'];
                                if($path_type == '1') {
                                        $the_id = $_POST['id'];
                                }else {
                                        $needle = $_POST['id'];
                                        $campaigns = $_SESSION['campaigns'];
                                        foreach($campaigns as $key => $values) {
                                                foreach($values as $value) {
                                                        if($value == $needle) {
                                                                $the_id = $key;
                                                                break;
                                                        }
                                                }
                                        }
                                }
                                if(!in_array($the_id,$_SESSION['campaigns_answered'])) {
                                        
                                        // $_SESSION['campaigns_answered'][$_SESSION['campaigns_anwered_counter']] = $_POST['id'];
                                        $_SESSION['campaigns_anwered_counter'] = $_SESSION['campaigns_anwered_counter'] + 1;
                                        // array_push($_SESSION['campaigns_answered'], $_POST['id']);
                                        array_push($_SESSION['campaigns_answered'], $the_id);
                                }
                                $num = $_SESSION['campaigns_anwered_counter'];
                                $id = $_SESSION['campaigns'][$num];
                                //echo $id;
                                echo $num + 1;
                        }else echo 0;
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
                }else if ($_POST['type'] == 'set_next_stack_set') {
                        if(isset($_SESSION['campaigns_answered']) && isset($_SESSION['campaigns_anwered_counter']) ) {
                                $current_set = $_POST['set'];

                                if(!in_array($current_set,$_SESSION['campaigns_answered'])) {
                                        // $_SESSION['campaigns_answered'][$_SESSION['campaigns_anwered_counter']] = $_POST['id'];
                                        $_SESSION['campaigns_anwered_counter'] = $_SESSION['campaigns_anwered_counter'] + 1;
                                        array_push($_SESSION['campaigns_answered'], $current_set);
                                }
                                echo $_SESSION['campaigns_anwered_counter'] + 1;
                        }else echo 0;
                }else if ($_POST['type'] == 'set_phone') {
                        $phone_num = $_POST['phone'];
                        $_SESSION['user']['phone'] = $phone_num;
                        $_SESSION['user']['phone1'] = substr($phone_num,0,3);
                        $_SESSION['user']['phone2'] = substr($phone_num,3,3);
                        $_SESSION['user']['phone3'] = substr($phone_num,6,4);
                }else if ($_POST['type'] == 'set_address') {
                        $_SESSION['user']['address'] = $_POST['address'];
                }else if($_POST['type'] == 'set_execution') {

                        $exec['page'] = 'registration';
                        $exec['email'] = $_POST['email'];
                        $exec['url'] = $_POST['url'];

                        $start = explode(' ',$_POST['start']);
                        $month = date("m", strtotime($start[1]));
                        $start_datetime = $start[3].'-'.$month.'-'.$start[2].' '.$start[4];
                        $start_time = new DateTime($start_datetime);
                        $exec['start_time'] = $start_time->format('Y-m-d H:i:s');

                        $end = explode(' ',$_POST['end']);
                        $month = date("m", strtotime($end[1]));
                        $end_datetime = $end[3].'-'.$month.'-'.$end[2].' '.$end[4];
                        $end_time = new DateTime($end_datetime);
                        $exec['end_time'] = $end_time->format('Y-m-d H:i:s');

                        $interval = $end_time->diff($start_time);
                        $exec['interval'] = $interval->format('%H:%I:%S');
                        $_SESSION['registration_execution'] = $exec;
                }else{
                        die();
                }
        }
        else if($_GET) {
                if(isset($_GET['type'])) {
                        if($_GET['type'] == 'redirect_to_next_campaign') {
                                // $url = get_survey_url('survey.php');
                                $path_url = isset($_GET['path']) ? $_GET['path'] : $_SESSION['path_url'];
                                $url = $path_url.'/survey.php';

                                $id = $_GET['id'];

                                $next_page = array_search($id, $_SESSION['campaigns']) + 2;
                                $url .= '?campaign=' . $next_page; 

                                if(!in_array($id,$_SESSION['campaigns_answered'])) {
                                        $_SESSION['campaigns_anwered_counter'] = $_SESSION['campaigns_anwered_counter'] + 1;
                                        array_push($_SESSION['campaigns_answered'], $id);
                                }
                                //echo $url;
                                header("Location: ". $url);
                        }else if($_GET['type'] == 'redirect_to_next_stack_campaign') {
                                // $path_folder = isset($_SESSION['path_folder']) ? $_SESSION['path_folder'] : 'dynamic_live';
                                // $url = get_survey_url('..'.$path_folder.'survey_stack.php');
                                // $url = $_SESSION['path_url'].'/survey_stack.php';

                                $path_url = isset($_GET['path']) ? $_GET['path'] : $_SESSION['path_url'];
                                $url = $path_url.'/survey_stack.php';

                                /* Check Session */
                                if( !isset($_SESSION['campaigns']) || !isset($_SESSION['campaigns_answered']) 
                                        || !isset($_SESSION['campaigns_anwered_counter']) ) {
                                        header("Location: ". $path_url);
                                }

                                $id = $_GET['id'];
                                $the_stack = 0;
                                if(isset($_SESSION['campaigns'])) {
                                        foreach($_SESSION['campaigns'] as $stack => $set) {
                                                foreach($set as $campaign) {
                                                        if($campaign == $id) {
                                                                $the_stack = $stack;
                                                                break 2;
                                                        }
                                                }
                                        }    
                                }     
                                //echo $the_stack;
                                $for_stack = $the_stack + 2;
                                $url .= '?campaign='. $for_stack;

                                if(!in_array($the_stack,$_SESSION['campaigns_answered'])) {
                                        $_SESSION['campaigns_anwered_counter'] = $_SESSION['campaigns_anwered_counter'] + 1;
                                        
                                        if(isset($_SESSION['campaigns_answered']) && is_array($_SESSION['campaigns_answered']) ) {
                                                array_push($_SESSION['campaigns_answered'], $the_stack);
                                        }else {
                                                $_SESSION['campaigns_answered'] = array();
                                        }
                                }
                                header("Location: ". $url);

                        }
                }
        }

        function get_survey_url($page)
        {
                $currentPath = $_SERVER['PHP_SELF']; // output: /myproject/index.php
                $pathInfo = pathinfo($currentPath); // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
                $hostName = $_SERVER['HTTP_HOST']; // output: localhost
                $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://'; // output: http://
                $dirname = explode('/',$pathInfo['dirname']);
                //$survey_page = 'survey.php'; // --> changeable
                $url = $protocol.$hostName.'/'.$dirname[1].'/'.$page;
                return $url;
        }

        

        function offer_html($html)
        {

        if(strpos($html,'[VALUE_URL_REDIRECT_STACK_PAGE]') !== false || strpos($html,'[VALUE_URL_REDIRECT_PAGE]') !== false || strpos($html,'[VALUE_URL_SURVEY_PAGE]') !== false) {
                $url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
                $url .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                $path_folder = dirname($url);
                $_SESSION['path_url'] = $path_folder;

                if(!isset($_SESSION['path_dir'])) {
                        $_SESSION['path_dir'] = dirname($path_folder);
                }
        }         
        

        $gender = '';
        $one_letter_gender = '';
        $title = '';
        if(isset($_SESSION['user'])) {
                $gender = $_SESSION['user']['gender'] == 'F' ? 'Female' : 'Male';
                $one_letter_gender = $_SESSION['user']['gender'];
                $title = $_SESSION['user']['gender'] == 'M' ? 'Mr.' : 'Ms.';
        }

        $age = date_diff(date_create($_SESSION['user']['birthdate']), date_create('today'))->y;

        if(strpos($html,'[VALUE_REV_TRACKER]') !== false) $html = str_replace('[VALUE_REV_TRACKER]', $_SESSION['user']['revenue_tracker_id'], $html);
        if(strpos($html,'[VALUE_AFFILIATE_ID]') !== false) $html = str_replace('[VALUE_AFFILIATE_ID]', $_SESSION['user']['affiliate_id'], $html);
        if(strpos($html,'[VALUE_DOBMONTH]') !== false) $html = str_replace('[VALUE_DOBMONTH]', $_SESSION['user']['dobmonth'], $html);
        if(strpos($html,'[VALUE_DOBDAY]') !== false) $html = str_replace('[VALUE_DOBDAY]', $_SESSION['user']['dobday'], $html);
        if(strpos($html,'[VALUE_DOBYEAR]') !== false) $html = str_replace('[VALUE_DOBYEAR]', $_SESSION['user']['dobyear'], $html);
        if(strpos($html,'[VALUE_EMAIL]') !== false) $html = str_replace('[VALUE_EMAIL]', $_SESSION['user']['email'], $html);
        if(strpos($html,'[VALUE_FIRST_NAME]') !== false) $html = str_replace('[VALUE_FIRST_NAME]', $_SESSION['user']['first_name'], $html);
        if(strpos($html,'[VALUE_LAST_NAME]') !== false) $html = str_replace('[VALUE_LAST_NAME]', $_SESSION['user']['last_name'], $html);
        if(strpos($html,'[VALUE_ZIP]') !== false) $html = str_replace('[VALUE_ZIP]', $_SESSION['user']['zip'], $html);
        if(strpos($html,'[VALUE_CITY]') !== false) $html = str_replace('[VALUE_CITY]', $_SESSION['user']['city'], $html);
        if(strpos($html,'[VALUE_STATE]') !== false) $html = str_replace('[VALUE_STATE]', $_SESSION['user']['state'], $html);
        if(strpos($html,'[VALUE_GENDER]') !== false) $html = str_replace('[VALUE_GENDER]', $one_letter_gender, $html);
        if(strpos($html,'[VALUE_GENDER_FULL]') !== false) $html = str_replace('[VALUE_GENDER_FULL]', $gender, $html);
        if(strpos($html,'[VALUE_BIRTHDATE]') !== false) $html = str_replace('[VALUE_BIRTHDATE]', $_SESSION['user']['birthdate'], $html);
        if(strpos($html,'[VALUE_IP]') !== false) $html = str_replace('[VALUE_IP]', $_SESSION['user']['ip'], $html);
        if(strpos($html,'[VALUE_ADDRESS1]') !== false) $html = str_replace('[VALUE_ADDRESS1]', $_SESSION['user']['address'], $html);
        if(strpos($html,'[VALUE_PHONE]') !== false) $html = str_replace('[VALUE_PHONE]', $_SESSION['user']['phone'], $html);
        if(strpos($html,'[VALUE_PHONE1]') !== false) $html = str_replace('[VALUE_PHONE1]', $_SESSION['user']['phone1'], $html);
        if(strpos($html,'[VALUE_PHONE2]') !== false) $html = str_replace('[VALUE_PHONE2]', $_SESSION['user']['phone2'], $html);
        if(strpos($html,'[VALUE_PHONE3]') !== false) $html = str_replace('[VALUE_PHONE3]', $_SESSION['user']['phone3'], $html);
        if(strpos($html,'[VALUE_TITLE]') !== false) $html = str_replace('[VALUE_TITLE]', $title, $html);
        if(strpos($html,'[VALUE_PUB_TIME]') !== false) $html = str_replace('[VALUE_PUB_TIME]', date('Y-m-d H:i:s'), $html);
        if(strpos($html,'[VALUE_DATE_TIME]') !== false) $html = str_replace('[VALUE_DATE_TIME]', date("m/d/Y H:i:s"), $html);
        if(strpos($html,'[VALUE_TODAY]') !== false) $html = str_replace('[VALUE_TODAY]', date("m/d/Y"), $html);
        if(strpos($html,'[VALUE_TODAY_MONTH]') !== false) $html = str_replace('[VALUE_TODAY_MONTH]', date("m"), $html);
        if(strpos($html,'[VALUE_TODAY_DAY]') !== false) $html = str_replace('[VALUE_TODAY_DAY]', date("d"), $html);
        if(strpos($html,'[VALUE_TODAY_YEAR]') !== false) $html = str_replace('[VALUE_TODAY_YEAR]', date("Y"), $html);
        if(strpos($html,'[VALUE_TODAY_HOUR]') !== false) $html = str_replace('[VALUE_TODAY_HOUR]', date("H"), $html);
        if(strpos($html,'[VALUE_TODAY_MIN]') !== false) $html = str_replace('[VALUE_TODAY_MIN]', date("i"), $html);
        if(strpos($html,'[VALUE_TODAY_SEC]') !== false) $html = str_replace('[VALUE_TODAY_SEC]', date("s"), $html);
        if(strpos($html,'[VALUE_AGE]') !== false) $html = str_replace('[VALUE_AGE]', $age, $html);
        if(strpos($html,'[VALUE_ETHNICITY]') !== false) $html = str_replace('[VALUE_ETHNICITY]', $_SESSION['user']['ethnicity'], $html);
        if(strpos($html,'[VALUE_CURRENT_CAMPAIGN_PRIORITY]') !== false) $html = str_replace('[VALUE_CURRENT_CAMPAIGN_PRIORITY]', count($_SESSION['campaigns_answered']) + 1, $html);
        if(strpos($html,'[VALUE_NEXT_CAMPAIGN_PRIORITY]') !== false) $html = str_replace('[VALUE_NEXT_CAMPAIGN_PRIORITY]', count($_SESSION['campaigns_answered']) + 2, $html);
        if(strpos($html,'[VALUE_PATH_ID]') !== false) $html = str_replace('[VALUE_PATH_ID]', $_SESSION['path_id'], $html);
        
        // if(strpos($html,'[VALUE_URL_SURVEY_PAGE]') !== false) $html = str_replace('[VALUE_URL_SURVEY_PAGE]', get_survey_url('survey.php'), $html);
        if(strpos($html,'[VALUE_URL_SURVEY_PAGE]') !== false) $html = str_replace('[VALUE_URL_SURVEY_PAGE]', $path_folder.'/survey.php', $html);
        // if(strpos($html,'[VALUE_URL_REDIRECT_PAGE]') !== false) $html = str_replace('[VALUE_URL_REDIRECT_PAGE]', get_survey_url('includes/form_function.php?type=redirect_to_next_campaign'), $html);
        if(strpos($html,'[VALUE_URL_REDIRECT_PAGE]') !== false) $html = str_replace('[VALUE_URL_REDIRECT_PAGE]', $_SESSION['path_dir'].'includes/form_function.php?type=redirect_to_next_campaign&path='.$path_folder, $html);
        // if(strpos($html,'[VALUE_URL_REDIRECT_STACK_PAGE]') !== false) $html = str_replace('[VALUE_URL_REDIRECT_STACK_PAGE]', get_survey_url('../includes/form_function.php?type=redirect_to_next_stack_campaign'), $html);
        // if(strpos($html,'[VALUE_URL_REDIRECT_STACK_PAGE]') !== false) $html = str_replace('[VALUE_URL_REDIRECT_STACK_PAGE]', 'http://'.$_SERVER['HTTP_HOST'].'/includes/form_function.php?type=redirect_to_next_stack_campaign&path='.$path_folder, $html);
        if(strpos($html,'[VALUE_URL_REDIRECT_STACK_PAGE]') !== false) $html = str_replace('[VALUE_URL_REDIRECT_STACK_PAGE]', $_SESSION['path_dir'].'/includes/form_function.php?type=redirect_to_next_stack_campaign&path='.$path_folder, $html);

        /*FOR TESTING*///if(strpos($html,'http://leadreactor.engageiq.com/sendLead/') !== false) $html = str_replace('http://leadreactor.engageiq.com/sendLead/', 'http://testleadreactor.engageiq.com/sendLead/', $html);
        /*FOR TESTING*///if(strpos($html,'http://leadfilter.engageiq.com/storeLead') !== false) $html = str_replace('http://leadfilter.engageiq.com/storeLead', 'http://testleadfilter.engageiq.com/storeLead', $html);

        /* BROWSER DETECT */
        if(strpos($html,'[DETECT_OS]') !== false) $html = str_replace('[DETECT_OS]', $_SESSION['browser']['os'], $html);
        if(strpos($html,'[DETECT_OS_VER]') !== false) $html = str_replace('[DETECT_OS_VER]', $_SESSION['browser']['os_version'], $html);
        if(strpos($html,'[DETECT_BROWSER]') !== false) $html = str_replace('[DETECT_BROWSER]', $_SESSION['browser']['browser'], $html);
        if(strpos($html,'[DETECT_BROWSER_VER]') !== false) $html = str_replace('[DETECT_BROWSER_VER]', 
                $_SESSION['browser']['browser_version'], $html);
        if(strpos($html,'[DETECT_USER_AGENT]') !== false) $html = str_replace('[DETECT_USER_AGENT]', 
                $_SESSION['browser']['user_agent'], $html);
        /* MOBILE DETECT */
        if(strpos($html,'[DETECT_DEVICE]') !== false) $html = str_replace('[DETECT_DEVICE]', $_SESSION['device']['type'], $html);
        if(strpos($html,'[DETECT_ISMOBILE]') !== false) $html = str_replace('[DETECT_ISMOBILE]', $_SESSION['device']['isMobile'], $html);
        if(strpos($html,'[DETECT_ISTABLET]') !== false) $html = str_replace('[DETECT_ISTABLET]', $_SESSION['device']['isTablet'], $html);
        if(strpos($html,'[DETECT_ISDESKTOP]') !== false) $html = str_replace('[DETECT_ISDESKTOP]', $_SESSION['device']['isDesktop'], $html);

        /* OTHERS */
        if(strpos($html,'[VALUE_OFFER_ID]') !== false) 
                $html = str_replace('[VALUE_OFFER_ID]', $_SESSION['user']['offer_id'], $html);
        if(strpos($html,'[VALUE_CAMPAIGN_ID]') !== false) 
                $html = str_replace('[VALUE_CAMPAIGN_ID]', $_SESSION['user']['campaign_id'], $html);
        if(strpos($html,'[VALUE_S1]') !== false) 
                $html = str_replace('[VALUE_S1]', $_SESSION['user']['s1'], $html);
        if(strpos($html,'[VALUE_S2]') !== false) 
                $html = str_replace('[VALUE_S2]', $_SESSION['user']['s2'], $html);
        if(strpos($html,'[VALUE_S3]') !== false) 
                $html = str_replace('[VALUE_S3]', $_SESSION['user']['s3'], $html);
        if(strpos($html,'[VALUE_S4]') !== false) 
                $html = str_replace('[VALUE_S4]', $_SESSION['user']['s4'], $html);
        if(strpos($html,'[VALUE_S5]') !== false) 
                $html = str_replace('[VALUE_S5]', $_SESSION['user']['s5'], $html);
        if(strpos($html,'[VALUE_D1]') !== false) 
                $html = str_replace('[VALUE_D1]', $_SESSION['d1'], $html);
        if(strpos($html,'[VALUE_D2]') !== false) 
                $html = str_replace('[VALUE_D2]', $_SESSION['d2'], $html);
        if(strpos($html,'[VALUE_D3]') !== false) 
                $html = str_replace('[VALUE_D3]', $_SESSION['d3'], $html);
        if(strpos($html,'[VALUE_D4]') !== false) 
                $html = str_replace('[VALUE_D4]', $_SESSION['d4'], $html);
        if(strpos($html,'[VALUE_D5]') !== false) 
                $html = str_replace('[VALUE_D5]', $_SESSION['d5'], $html);
        
        /*$html = eval('?>'.$html.'<?php;');*/

        ob_start();
        eval('?>'.$html);
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
        }

        function fire_pixel() {
                /*'PAGE_FIRE_PIXEL' => [
                    1 => 'Landing Page',
                    2 => 'Registration Page',
                    3 => '1st Offer Page',
                    4 => '2nd Offer Page',
                    5 => '3rd Offer Page',
                    6 => '4th Offer Page',
                    7 => '5th Offer Page',
                    8 => '6th Offer Page',
                    9 => '7th Offer Page',
                    10 => '8th Offer Page',
                    11 => '9th Offer Page',
                    12 => 'CPAWALL Page',
                    13 => 'Last Submit Page'
                ]*/
                if(isset($_SESSION['pixel']) && $_SESSION['pixel']['postback'] != '' && !isset($_SESSION['pixel']['done'])) {
                        /* PIXEL FIRING */
                        $postback = html_entity_decode($_SESSION['pixel']['postback']);
                        $fire_at = $_SESSION['pixel']['fire_at'];
                        // echo '<br>';
                        $current_page = $_SERVER["SCRIPT_NAME"];
                        $break = explode('/', $current_page);
                        $file = $break[count($break) - 1];
                        // echo '<br>';

                        if($file == 'index.php' && $fire_at == 1) { //Landing Page
                                echo offer_html($postback); 
                                $_SESSION['pixel']['done'] = 1;
                        }
                        else if($file == 'registration.php' && $fire_at == 2) { //Registration Page
                                echo offer_html($postback); 
                                $_SESSION['pixel']['done'] = 1;
                        }
                        else if($file == 'survey_stack.php') {
                                $string = $_SERVER["QUERY_STRING"];
                                $total_pages = count($_SESSION['campaigns']);
                                $cpawall = $total_pages-1;
                                if($string == 'campaign='.$total_pages && $fire_at == 13) { //Last Submit Page
                                        echo offer_html($postback); 
                                        $_SESSION['pixel']['done'] = 1;
                                }
                                else if($string == 'campaign='.$cpawall && $fire_at == 12) { //CPAWALL Page
                                        echo offer_html($postback); 
                                        $_SESSION['pixel']['done'] = 1;
                                }
                                else if($string == 'campaign=1' && $fire_at == 3) { //1st Offer Page
                                        echo offer_html($postback); 
                                        $_SESSION['pixel']['done'] = 1;
                                }
                                else if($string == 'campaign=2' && $fire_at == 4) { //2nd Offer Page
                                        echo offer_html($postback); 
                                        $_SESSION['pixel']['done'] = 1;
                                }
                                else if($string == 'campaign=3' && $fire_at == 5) { //3rd Offer Page
                                        echo offer_html($postback); 
                                        $_SESSION['pixel']['done'] = 1;
                                }
                                else if($string == 'campaign=4' && $fire_at == 6) { //4th Offer Page
                                        echo offer_html($postback); 
                                        $_SESSION['pixel']['done'] = 1;
                                }
                                else if($string == 'campaign=5' && $fire_at == 7) { //5th Offer Page
                                        echo offer_html($postback); 
                                        $_SESSION['pixel']['done'] = 1;
                                }
                                else if($string == 'campaign=6' && $fire_at == 8) { //6th Offer Page
                                        echo offer_html($postback); 
                                        $_SESSION['pixel']['done'] = 1;
                                }
                                else if($string == 'campaign=7' && $fire_at == 9) { //7th Offer Page
                                        echo offer_html($postback); 
                                        $_SESSION['pixel']['done'] = 1;
                                }
                                else if($string == 'campaign=8' && $fire_at == 10) {//8th Offer Page
                                        echo offer_html($postback); 
                                        $_SESSION['pixel']['done'] = 1;
                                }
                                else if($string == 'campaign=9' && $fire_at == 11) { //9th Offer Page
                                        echo offer_html($postback); 
                                        $_SESSION['pixel']['done'] = 1;
                                }
                        }
                }
        }
?>