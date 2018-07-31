<?php 
        function pre_reg_offer_html($html)
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
        

        $rev_tracker = isset($_SESSION['user']['revenue_tracker_id']) ? $_SESSION['user']['revenue_tracker_id'] : $_SESSION['rev_tracker'];
        if(strpos($html,'[VALUE_REV_TRACKER]') !== false) $html = str_replace('[VALUE_REV_TRACKER]', $rev_tracker, $html);
        if(strpos($html,'[VALUE_AFFILIATE_ID]') !== false) $html = str_replace('[VALUE_AFFILIATE_ID]', $_SESSION['user']['affiliate_id'], $html);

        $gender = '';
        $one_letter_gender = '';
        $title = '';
        if(isset($_SESSION['user'])) {
                $gender = $_SESSION['user']['gender'] == 'F' ? 'Female' : 'Male';
                $one_letter_gender = $_SESSION['user']['gender'];
                $title = $_SESSION['user']['gender'] == 'M' ? 'Mr.' : 'Ms.';
        }

        $age = isset($_SESSION['user']['birthdate']) ? date_diff(date_create($_SESSION['user']['birthdate']), date_create('today'))->y : '';

        if(strpos($html,'[VALUE_DOBMONTH]') !== false && $_SESSION['user']['dobmonth'] != '') 
                $html = str_replace('[VALUE_DOBMONTH]', $_SESSION['user']['dobmonth'], $html);
        if(strpos($html,'[VALUE_DOBDAY]') !== false && $_SESSION['user']['dobday'] != '') 
                $html = str_replace('[VALUE_DOBDAY]', $_SESSION['user']['dobday'], $html);
        if(strpos($html,'[VALUE_DOBYEAR]') !== false && $_SESSION['user']['dobyear'] != '')
                $html = str_replace('[VALUE_DOBYEAR]', $_SESSION['user']['dobyear'], $html);
        if(strpos($html,'[VALUE_EMAIL]') !== false && $_SESSION['user']['email'] != '')
                $html = str_replace('[VALUE_EMAIL]', $_SESSION['user']['email'], $html);
        if(strpos($html,'[VALUE_FIRST_NAME]') !== false && $_SESSION['user']['first_name'] != '')
                $html = str_replace('[VALUE_FIRST_NAME]', $_SESSION['user']['first_name'], $html);
        if(strpos($html,'[VALUE_LAST_NAME]') !== false && $_SESSION['user']['last_name'] != '')
                $html = str_replace('[VALUE_LAST_NAME]', $_SESSION['user']['last_name'], $html);
        if(strpos($html,'[VALUE_ZIP]') !== false && $_SESSION['user']['zip'] != '')
                $html = str_replace('[VALUE_ZIP]', $_SESSION['user']['zip'], $html);
        if(strpos($html,'[VALUE_CITY]') !== false && $_SESSION['user']['city'] != '')
                $html = str_replace('[VALUE_CITY]', $_SESSION['user']['city'], $html);
        if(strpos($html,'[VALUE_STATE]') !== false && $_SESSION['user']['state'] != '')
                $html = str_replace('[VALUE_STATE]', $_SESSION['user']['state'], $html);
        if(strpos($html,'[VALUE_GENDER]') !== false && $one_letter_gender != '')
                $html = str_replace('[VALUE_GENDER]', $one_letter_gender, $html);
        if(strpos($html,'[VALUE_GENDER_FULL]') !== false && $gender != '')
                $html = str_replace('[VALUE_GENDER_FULL]', $gender, $html);
        if(strpos($html,'[VALUE_BIRTHDATE]') !== false && $_SESSION['user']['birthdate'] != '')
                $html = str_replace('[VALUE_BIRTHDATE]', $_SESSION['user']['birthdate'], $html);
        if(strpos($html,'[VALUE_BIRTHDATE_MDY]') !== false && $_SESSION['user']['dobmonth'] != '' && $_SESSION['user']['dobday'] != '' && $_SESSION['user']['dobyear'] != '')
                $html = str_replace('[VALUE_BIRTHDATE_MDY]', $_SESSION['user']['dobmonth'].'/'.$_SESSION['user']['dobday'].'/'.$_SESSION['user']['dobyear'], $html);
        // if(strpos($html,'[VALUE_IP]') !== false && $_SESSION['user']['ip'] != '')
        //         $html = str_replace('[VALUE_IP]', $_SESSION['user']['ip'], $html);
        if(strpos($html,'[VALUE_TITLE]') !== false && $title != '')
                $html = str_replace('[VALUE_TITLE]', $title, $html);
        if(strpos($html,'[VALUE_AGE]') !== false && $age != '')
                $html = str_replace('[VALUE_AGE]', $age, $html);
        if(strpos($html,'[VALUE_ETHNICITY]') !== false && $_SESSION['user']['ethnicity'] != '')
                $html = str_replace('[VALUE_ETHNICITY]', $_SESSION['user']['ethnicity'], $html);

        if(strpos($html,'[VALUE_ADDRESS1]') !== false) $html = str_replace('[VALUE_ADDRESS1]', $_SESSION['user']['address'], $html);
        if(strpos($html,'[VALUE_PHONE]') !== false) $html = str_replace('[VALUE_PHONE]', $_SESSION['user']['phone'], $html);
        if(strpos($html,'[VALUE_PHONE1]') !== false) $html = str_replace('[VALUE_PHONE1]', $_SESSION['user']['phone1'], $html);
        if(strpos($html,'[VALUE_PHONE2]') !== false) $html = str_replace('[VALUE_PHONE2]', $_SESSION['user']['phone2'], $html);
        if(strpos($html,'[VALUE_PHONE3]') !== false) $html = str_replace('[VALUE_PHONE3]', $_SESSION['user']['phone3'], $html);
        if(strpos($html,'[VALUE_PUB_TIME]') !== false) $html = str_replace('[VALUE_PUB_TIME]', date('Y-m-d H:i:s'), $html);
        if(strpos($html,'[VALUE_DATE_TIME]') !== false) $html = str_replace('[VALUE_DATE_TIME]', date("m/d/Y H:i:s"), $html);
        if(strpos($html,'[VALUE_TODAY]') !== false) $html = str_replace('[VALUE_TODAY]', date("m/d/Y"), $html);
        if(strpos($html,'[VALUE_TODAY_MONTH]') !== false) $html = str_replace('[VALUE_TODAY_MONTH]', date("m"), $html);
        if(strpos($html,'[VALUE_TODAY_DAY]') !== false) $html = str_replace('[VALUE_TODAY_DAY]', date("d"), $html);
        if(strpos($html,'[VALUE_TODAY_YEAR]') !== false) $html = str_replace('[VALUE_TODAY_YEAR]', date("Y"), $html);
        if(strpos($html,'[VALUE_TODAY_HOUR]') !== false) $html = str_replace('[VALUE_TODAY_HOUR]', date("H"), $html);
        if(strpos($html,'[VALUE_TODAY_MIN]') !== false) $html = str_replace('[VALUE_TODAY_MIN]', date("i"), $html);
        if(strpos($html,'[VALUE_TODAY_SEC]') !== false) $html = str_replace('[VALUE_TODAY_SEC]', date("s"), $html);
        
        if(strpos($html,'[VALUE_CURRENT_CAMPAIGN_PRIORITY]') !== false) $html = str_replace('[VALUE_CURRENT_CAMPAIGN_PRIORITY]', count($_SESSION['campaigns_answered']) + 1, $html);
        if(strpos($html,'[VALUE_NEXT_CAMPAIGN_PRIORITY]') !== false) $html = str_replace('[VALUE_NEXT_CAMPAIGN_PRIORITY]', count($_SESSION['campaigns_answered']) + 2, $html);
        if(strpos($html,'[VALUE_PATH_ID]') !== false) $html = str_replace('[VALUE_PATH_ID]', $_SESSION['path_id'], $html);
        
        if(strpos($html,'[VALUE_URL_SURVEY_PAGE]') !== false) $html = str_replace('[VALUE_URL_SURVEY_PAGE]', $path_folder.'/survey.php', $html);
        if(strpos($html,'[VALUE_URL_REDIRECT_PAGE]') !== false) $html = str_replace('[VALUE_URL_REDIRECT_PAGE]', $_SESSION['path_dir'].'includes/form_function.php?type=redirect_to_next_campaign&path='.$path_folder, $html);
        if(strpos($html,'[VALUE_URL_REDIRECT_STACK_PAGE]') !== false) $html = str_replace('[VALUE_URL_REDIRECT_STACK_PAGE]', $_SESSION['path_dir'].'/includes/form_function.php?type=redirect_to_next_stack_campaign&path='.$path_folder, $html);

        /*FOR TESTING*/// if(strpos($html,'http://leadreactor.engageiq.com/sendLead/') !== false) $html = str_replace('http://leadreactor.engageiq.com/sendLead/', 'http://leadreactor.test/sendLead/', $html);
        /*FOR TESTING*/// if(strpos($html,'http://leadfilter.engageiq.com/storeLead') !== false) $html = str_replace('http://leadfilter.engageiq.com/storeLead', 'http://leadfilter.test/storeLead', $html);

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

        if(strpos($html,'stack_survey_form') !== false) $html = str_replace('stack_survey_form', 'pre_reg_stack_survey_form', $html);
        if(strpos($html,'id="submit_stack_button"') !== false) $html = str_replace('id="submit_stack_button"', 'id="pre_reg_submit_stack_button"', $html);

        ob_start();
        eval('?>'.$html);
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
        }
?>