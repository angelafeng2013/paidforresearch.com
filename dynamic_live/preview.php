<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
	include_once("header_survey.php"); 
    include_once("../includes/preview_function.php");
    
	$bar_num = 1;
	$campaignCount = 1;
	$cur_bar = 1;

    if($_SESSION['leadreactor_url'] != null || $_SESSION['leadreactor_url'] != '') $url = $_SESSION['leadreactor_url'];
    else $url = 'http://leadreactor.engageiq.com/';
?>		
<style>
    .warning {
        border: #f0ad4e 2px solid !important;
    }
</style>

	<!-- PROGRESS BAR START -->
    <?php display_progress_bar($cur_bar,$bar_num,true); ?>
    <!-- PROGRESS BAR END -->
    <?php echo '<span style="display:none" id="private_progress_bar">'.$cur_bar.'/'.$bar_num.'</span>'; ?>
	
    <div style="padding: 20px;border: 2px solid #fff">
        <div style="background-color: #3F51B5;color: #fff;padding: 20px;">
            <div class="wrapper" style="min-height: unset;">
                <form id="getCampaignTypeForm" action='' style="margin:0px">
                    <!-- <label for="campaign_type">Type:</label> -->
                    <?php
                        if(! isset($_SESSION['preview'])) {
                            $_SESSION['preview'] = json_decode(curler($url."api/get_all_campaign_for_testing"), true);

                            //unset campaigns
                            preview_unset_campaign(801); //pushcrew
                            preview_unset_campaign(32); //tester
                        }
                        $chosen = isset($_GET['ct']) ? $_GET['ct'] : 1;
                        $chosen_id = isset($_GET['id']) ? $_GET['id'] : '';
                        $campaign_types = array(
                            1  => 'Mixed Co-reg (1st Grp)',
                            2  => 'Mixed Co-reg (2nd Grp)',
                            8  => 'Mixed Co-reg (3rd Grp)',
                            13 => 'Mixed Co-reg (4th Grp)',
                            3  => 'Long Form Co-reg (1st Grp)',
                            4  => 'External Path',
                            5  => 'Link Out',
                            6  => 'Exit Page',
                            7  => 'Long Form Co-reg (2nd Grp)',
                            9  => 'Simple Co-reg',
                            10 => 'Custom Co-reg',
                            11 => 'Targeted Offers (1st Grp)',
                            12 => 'Targeted Offers (2nd Grp)',
                            14 => 'Iframe (1st Grp)',
                            15 => 'Iframe (2nd Grp)',
                            16 => 'Iframe (3rd Grp)',
                        );
                        echo '<select name="campaign_type">';
                        foreach($campaign_types as $ct => $name) {
                            $selected = $ct == $chosen ? ' selected' : '';
                            echo "<option value='$ct'$selected>$name</option>";
                        }
                        echo '</select>';

                        $required = in_array($chosen, [4, 6, 3, 7]) ? 'required' : '';
                        echo '<select name="id" '.$required.'><option></option>';
                        foreach($_SESSION['preview']['names'] as $type => $campaigns) {
                            foreach($campaigns as $id => $name) {
                                $selected = $id == $chosen_id ? ' selected' : '';
                                $hidden = $chosen == $type ? '' : ' style="display:none"';
                                echo "<option value='$id'$selected data-type='$type'$hidden>$name</option>";
                            }
                        }
                        echo '</select>';
                    ?>
                   
                    <input type="submit" value="Get" />
                    <br>
                    <label for="all_campaign_radio">Yes to All</label>
                    <input type="radio" name="all_campaign_radio" value='1'> Yes
                    <input type="radio" name="all_campaign_radio" value='0'> No
                </form>
            </div>
        </div>
    
    </div>

    <div id="contentbox">    
        <div class="border-5">
		<?php 
            if($chosen_id != '') {
                $hasCreative = '';
                if(isset($_SESSION['preview']['creatives'][$chosen][$chosen_id])) {
                    $hasCreative = '&creatives['.$chosen_id.']='.$_SESSION['preview']['creatives'][$chosen][$chosen_id];
                }
                
                $add_url = 'campaigns[0]='.$chosen_id.$hasCreative;
            }else {
                $request['campaigns'] = isset($_SESSION['preview']['active'][$chosen]) ? $_SESSION['preview']['active'][$chosen] : [];
                $request['creatives'] = isset($_SESSION['preview']['creatives'][$chosen]) ? $_SESSION['preview']['creatives'][$chosen] : [];
                $add_url = http_build_query($request);
            }

            $output = curler($url."api/get_stack_campaign_content_php?".$add_url);
            $output = preview_offer_html($output);
		?>     
        </div>
	</div>
<?php include_once("footer.php"); ?>    
<script>
    //For Campaign Type
    $(document).on('submit','#getCampaignTypeForm',function(e) 
    {
        e.preventDefault();
        var campaign_type = $('#getCampaignTypeForm [name="campaign_type"]').val(),
            campaign_id = $('#getCampaignTypeForm [name="id"]').val(),
            url = 'preview.php?ct=' + campaign_type; 
        if(campaign_id != '') {
            url += '&id=' + campaign_id; 
        }

        window.location.href = url;
    });

    //Campaign Type Change
    $(document).on('change','#getCampaignTypeForm [name="campaign_type"]',function() 
    {
        var type = $(this).val();
        $('#getCampaignTypeForm [name="id"]').val('');
        $('#getCampaignTypeForm [name="id"] [data-type]').hide();
        $('#getCampaignTypeForm [name="id"] [data-type="'+type+'"]').show();

        if(type == 4 || type == 6 || type == 3 || type == 7) {
            $('#getCampaignTypeForm [name="id"]').attr('required', true);
        }else $('#getCampaignTypeForm [name="id"]').removeAttr('required');
    });

    //For All Campaign radio
    $(document).on('change','[name="all_campaign_radio"]',function() 
    {
        var state = $('[name="all_campaign_radio"]:checked').val();
        if(state == 1) {
            $('.submit_stack_campaign').prop('checked',true).trigger('click');
            $('.show_custom_questions').trigger('click');
        }else {
            $('[type="radio"][value="NO"]').prop('checked',true).trigger('click');
        }
    });
    
    

    $(document).on('submit','.survey_form',function(e) 
    {
        e.preventDefault();

        alert('Campaign Submitted. This is just a preview');
        die();
    });
    
    $(document).on('click','.next_survey',function(e) 
    {
        e.preventDefault();

        alert('Next Campaign. This is just a preview');
        die();
    });

	$(document).on('submit','.stack_survey_form',function(e) 
    {
    	e.preventDefault();

		alert('Campaign Submitted. This is just a preview');
		die();
	});

    $(document).on('click','#prev_submit_stack_button',function(e) 
    {
        e.preventDefault();

        var total_yes = $('.submit_stack_campaign:checked').length;
        var validation_counter = 0;
        var submit_counter = 0;
        var sent_counter = 0;

        console.log( $('.submit_stack_campaign:checked').length );
        if($('.submit_stack_campaign:checked').length == 0) {
            
            alert('Next Campaign. This is just a preview');
            die();
        }

        $("form").each(function () {
            var form = $(this);
            if(form.find('.submit_stack_campaign').is(':checked')) { 
                if(form.valid()) {
                    validation_counter++;
                }
            }
        });

        if(total_yes == validation_counter) {
            $("form").each(function () {
                var form = $(this);
                if(form.find('.submit_stack_campaign').is(':checked')) { 
                    if(form.valid()) {
                        var hasAcceptChecker = true,
                            acceptAttr = form.attr('data-accept');
                        if(typeof acceptAttr !== typeof undefined && acceptAttr !== false) {
                                    
                            if(acceptAttr == true || acceptAttr == 'true') hasAcceptChecker = true;
                            else {
                                hasAcceptChecker = false;
                                errorCounter = 0;
                                $.each(form.find('[data-check]'), function(i, object) {
                                    console.log($(this).attr('name'));
                                    if($(this).is('select')) {
                                        if(typeof $(this).find('option[value="'+$(this).val()+'"]').attr('accepted') === typeof undefined) {
                                            errorCounter++;
                                        }
                                    }else {
                                        if($(this).attr('type') == 'checkbox') {
                                            if(typeof $(this).attr('accepted') !== typeof undefined) {
                                                if($(this).prop('checked') === false){
                                                    errorCounter++;
                                                }
                                            }else {
                                                if($(this).prop('checked') === true){
                                                    errorCounter++;
                                                }
                                            }
                                        }else if($(this).attr('type') == 'radio') {
                                            if(typeof $('[name="'+$(this).attr('name')+'"]:checked').attr('accepted') === typeof undefined) {
                                                errorCounter++;
                                            }
                                        }
                                        
                                    }
                                });

                                if(errorCounter == 0) {
                                    hasAcceptChecker = true;
                                }
                            }
                        }

                        if((typeof form.attr('data-valid') === 'undefined' || form.data('valid') == 'true') && hasAcceptChecker) {
                            // form.submit();
                            // console.log('SUBMIT');
                            submit_counter++;
                            form.css('border','');
                        }else {
                            form.css('border','2px solid red');
                        }
                    }
                }
            });

            alert('Total Campaign Yes: '+total_yes+"\n"+'Total Campaign Sent: '+submit_counter+"\n"+'This is just a preview.');
            die();
        }
    });

    $('form[data-accept]').on('change','[data-check]',function(e) 
    {
        var field = $(this);
        if(field.is('select')) {
            if(typeof field.find('option[value="'+field.val()+'"]').attr('accepted') === typeof undefined) {
                field.addClass('warning');
            }else {
                field.removeClass('warning');
            }
        }else {
            if($(this).attr('type') == 'checkbox') {
                if(typeof $(this).attr('accepted') !== typeof undefined) {
                    if($(this).prop('checked') === false){
                        field.addClass('warning');
                    }else {
                        field.removeClass('warning');
                    }
                }else {
                    if($(this).prop('checked') === true){
                        field.addClass('warning');
                    }else {
                        field.removeClass('warning');
                    }
                }
            }else if($(this).attr('type') == 'radio') {
                if(typeof $('[name="'+$(this).attr('name')+'"]:checked').attr('accepted') === typeof undefined) {
                    field.addClass('warning');
                }else {
                    field.removeClass('warning');
                }
            }
            
        }
    });
</script>
