<?php 
if(session_id() == '') {
    session_start();
}

if(!isset($_SESSION['browser'])) {
    require_once '../includes/class.browserdetect.php';
    $browser = new BrowserDetection(); 
    $_SESSION['browser'] = array(
      'os'          => $browser->getPlatform(),
      'os_version'  => $browser->getPlatformVersion(),
      'browser'           => $browser->getName(),
      'browser_version'   => $browser->getVersion(),
      'user_agent'  => $browser->getUserAgent()
    );
}

if(!isset($_SESSION['device'])) {
    require_once '../includes/Mobile_Detect.php';
    $detect = new Mobile_Detect;

    if($detect->isMobile()) {
      $type = 'Mobile';
      $view = 2;
    }
    else if($detect->isTablet()) {
      $type = 'Tablet';
      $view = 3;
    } else {
      $type = 'Desktop';
      $view = 1;
    }
    $_SESSION['device'] = array(
      'isMobile'  => $detect->isMobile(),
      'isTablet'  => $detect->isTablet(),
      'isDesktop' => !$detect->isMobile() && !$detect->isTablet() ? true : false,
      'type' => $type
    );
}

if($_GET) {
        if(isset($_GET['type'])) {
                if($_GET['type'] == 'redirect_to_next_campaign') {
                        $path_url = isset($_GET['path']) ? $_GET['path'] : $_SESSION['path_url'];
                        $url = $path_url.'/preview_survey.php';
                        $id = $_GET['id'];
                        $url .= '?id='.$id;
                        header("Location: ". $url);
                }else if($_GET['type'] == 'redirect_to_next_stack_campaign') {
                        $path_url = isset($_GET['path']) ? $_GET['path'] : $_SESSION['path_url'];
                        $url = $path_url.'/preview_stack.php';
                        $id = $_GET['id'];
                        $url .= '?id='.$id;
                        header("Location: ". $url);
                }
        }
}

function preview_offer_html($html)
{
        if(strpos($html,'[VALUE_URL_REDIRECT_STACK_PAGE]') !== false || strpos($html,'[VALUE_URL_REDIRECT_PAGE]') !== false || strpos($html,'[VALUE_URL_SURVEY_PAGE]') !== false) {
                $url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
                $url .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                $path_folder = dirname($url);

                if(!isset($_SESSION['path_dir'])) {
                        $_SESSION['path_dir'] = dirname($path_folder);
                }
        }        

        $gender = 'Male';
        $one_letter_gender = 'M';

        $title = 'Mr.';

        $age = date_diff(date_create('1991-1-01'), date_create('today'))->y;

        //Custom
        if(strpos($html,'[VALUE_REV_TRACKER]') !== false) 
            $html = str_replace('[VALUE_REV_TRACKER]', 8263, $html);
        if(strpos($html,'[VALUE_AFFILIATE_ID]') !== false) 
            $html = str_replace('[VALUE_AFFILIATE_ID]', 8263, $html);
        if(strpos($html,'[VALUE_PATH_ID]') !== false) 
            $html = str_replace('[VALUE_PATH_ID]', 242, $html);

        //Original
        // if(strpos($html,'[VALUE_REV_TRACKER]') !== false) 
        //     $html = str_replace('[VALUE_REV_TRACKER]', 1, $html);
        // if(strpos($html,'[VALUE_AFFILIATE_ID]') !== false) 
        //     $html = str_replace('[VALUE_AFFILIATE_ID]', 1, $html);
        if(strpos($html,'[VALUE_DOBMONTH]') !== false) 
            $html = str_replace('[VALUE_DOBMONTH]', 1, $html);
        if(strpos($html,'[VALUE_DOBDAY]') !== false) 
            $html = str_replace('[VALUE_DOBDAY]', 1, $html);
        if(strpos($html,'[VALUE_DOBYEAR]') !== false) 
            $html = str_replace('[VALUE_DOBYEAR]', 1991, $html);
        if(strpos($html,'[VALUE_EMAIL]') !== false) 
            $html = str_replace('[VALUE_EMAIL]', 'admin@engageiq.com', $html);
        if(strpos($html,'[VALUE_FIRST_NAME]') !== false) 
            $html = str_replace('[VALUE_FIRST_NAME]', 'First Name', $html);
        if(strpos($html,'[VALUE_LAST_NAME]') !== false) 
            $html = str_replace('[VALUE_LAST_NAME]', 'Last Name', $html);
        if(strpos($html,'[VALUE_ZIP]') !== false) 
            $html = str_replace('[VALUE_ZIP]', 95136, $html);
        if(strpos($html,'[VALUE_CITY]') !== false) 
            $html = str_replace('[VALUE_CITY]', 'San Jose', $html);
        if(strpos($html,'[VALUE_STATE]') !== false) 
            $html = str_replace('[VALUE_STATE]', 'CA', $html);
        if(strpos($html,'[VALUE_GENDER]') !== false) $html = str_replace('[VALUE_GENDER]', $one_letter_gender, $html);
        if(strpos($html,'[VALUE_GENDER_FULL]') !== false) 
            $html = str_replace('[VALUE_GENDER_FULL]', $gender, $html);
        if(strpos($html,'[VALUE_BIRTHDATE]') !== false) 
            $html = str_replace('[VALUE_BIRTHDATE]', '1991-1-01', $html);
        if(strpos($html,'[VALUE_BIRTHDATE_MDY]') !== false) 
            $html = str_replace('[VALUE_BIRTHDATE_MDY]', '01/01/1991', $html);
        if(strpos($html,'[VALUE_IP]') !== false) 
            $html = str_replace('[VALUE_IP]', '127.0.0', $html);
        if(strpos($html,'[VALUE_ADDRESS1]') !== false) 
            $html = str_replace('[VALUE_ADDRESS1]', '', $html);
        if(strpos($html,'[VALUE_PHONE]') !== false) 
            $html = str_replace('[VALUE_PHONE]', '', $html);
        if(strpos($html,'[VALUE_PHONE1]') !== false) 
            $html = str_replace('[VALUE_PHONE1]', '', $html);
        if(strpos($html,'[VALUE_PHONE2]') !== false) 
            $html = str_replace('[VALUE_PHONE2]', '', $html);
        if(strpos($html,'[VALUE_PHONE3]') !== false) 
            $html = str_replace('[VALUE_PHONE3]', '', $html);
        if(strpos($html,'[VALUE_TITLE]') !== false) 
            $html = str_replace('[VALUE_TITLE]', $title, $html);
        if(strpos($html,'[VALUE_PUB_TIME]') !== false) 
            $html = str_replace('[VALUE_PUB_TIME]', date('Y-m-d H:i:s'), $html);
        if(strpos($html,'[VALUE_DATE_TIME]') !== false) 
            $html = str_replace('[VALUE_DATE_TIME]', date("m/d/Y H:i:s"), $html);
        if(strpos($html,'[VALUE_TODAY]') !== false) 
            $html = str_replace('[VALUE_TODAY]', date("m/d/Y"), $html);
        if(strpos($html,'[VALUE_TODAY_MONTH]') !== false) 
            $html = str_replace('[VALUE_TODAY_MONTH]', date("m"), $html);
        if(strpos($html,'[VALUE_TODAY_DAY]') !== false) 
            $html = str_replace('[VALUE_TODAY_DAY]', date("d"), $html);
        if(strpos($html,'[VALUE_TODAY_YEAR]') !== false) 
            $html = str_replace('[VALUE_TODAY_YEAR]', date("Y"), $html);
        if(strpos($html,'[VALUE_TODAY_HOUR]') !== false) 
            $html = str_replace('[VALUE_TODAY_HOUR]', date("H"), $html);
        if(strpos($html,'[VALUE_TODAY_MIN]') !== false) 
            $html = str_replace('[VALUE_TODAY_MIN]', date("i"), $html);
        if(strpos($html,'[VALUE_TODAY_SEC]') !== false) 
            $html = str_replace('[VALUE_TODAY_SEC]', date("s"), $html);
        if(strpos($html,'[VALUE_AGE]') !== false) 
            $html = str_replace('[VALUE_AGE]', $age, $html);
        if(strpos($html,'[VALUE_ETHNICITY]') !== false) 
            $html = str_replace('[VALUE_ETHNICITY]', 'Caucasian', $html);
        if(strpos($html,'[VALUE_URL_SURVEY_PAGE]') !== false) 
            $html = str_replace('[VALUE_URL_SURVEY_PAGE]', $path_folder.'/survey.php', $html);
        if(strpos($html,'[VALUE_URL_REDIRECT_PAGE]') !== false) 
            $html = str_replace('[VALUE_URL_REDIRECT_PAGE]', $_SESSION['path_dir'].'/includes/preview_function.php?type=redirect_to_next_campaign&path='.$path_folder, $html);
        if(strpos($html,'[VALUE_CURRENT_CAMPAIGN_PRIORITY]') !== false) 
            $html = str_replace('[VALUE_CURRENT_CAMPAIGN_PRIORITY]', 1, $html);
        if(strpos($html,'[VALUE_NEXT_CAMPAIGN_PRIORITY]') !== false) 
            $html = str_replace('[VALUE_NEXT_CAMPAIGN_PRIORITY]', 2, $html);
        if(strpos($html,'[VALUE_URL_REDIRECT_STACK_PAGE]') !== false) $html = str_replace('[VALUE_URL_REDIRECT_STACK_PAGE]', $_SESSION['path_dir'].'/includes/preview_function.php?type=redirect_to_next_stack_campaign&path='.$path_folder, $html);
        
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
        
        /*FOR NLR*/if(strpos($html,'http://leadreactor.engageiq.com/sendLead/') !== false) $html = str_replace('http://leadreactor.engageiq.com/sendLead/', 'http://nlr.engageiq.com/sendLead/', $html);
        /*FOR LF*/if(strpos($html,'http://leadfilter.engageiq.com/storeLead') !== false) $html = str_replace('http://leadfilter.engageiq.com/storeLead', 'http://lf.engageiq.com/storeLead', $html);

        if(strpos($html,'id="submit_stack_button"') !== false) $html = str_replace('id="submit_stack_button"', 'id="prev_submit_stack_button"', $html);

        $html = eval('?>'.$html.'<?php;');

        return $html;
}

function preview_unset_campaign($id) {
    //[preview]= 
        //[campaign_types] -> campaign's campaign_type
        //[creatives] -> campaign creatives
        //[names] -> campaign names
        //[active] -> active campaigns

    if(!isset($_SESSION['preview']) || $id == '' || $id == null) return;

    $preview = $_SESSION['preview'];

    $campaign_type = null;

    //get campaign_type
    foreach($preview['campaign_types'] as $ct => $cid) {
        if(in_array($id, $cid)) {
            $campaign_type = $ct;
            break;
        }
    }

    // echo "Campaign ID: $id Type: $campaign_type <br>";

    if($campaign_type != null) {
        //find campaign key in array
        $campaign_key = array_search($id, $preview['active'][$campaign_type]);
        unset($_SESSION['preview']['active'][$campaign_type][$campaign_key]);
    }
}
?>