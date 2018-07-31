<?php 
	include_once("header_survey.php"); 	
    include_once("../includes/preview_function.php");  

    if(! isset($_GET['id'])) die();

	$bar_num = 1;
	$campaignCount = 1;
	$cur_bar = 1;
	$campaignID = $_GET['id'];
?>		
<style>
    .warning {
        border: #f0ad4e 2px solid !important;
    }
</style>
	<!-- PROGRESS BAR START -->
    <?php display_progress_bar($cur_bar,$bar_num,true); ?>
    <!-- PROGRESS BAR END -->
    
	<div id="contentbox">    
		<?php 
            if($_SESSION['leadreactor_url'] != null || $_SESSION['leadreactor_url'] != '') $url = $_SESSION['leadreactor_url'];
            else $url = 'http://leadreactor.engageiq.com/';

            $hasCreative = '';
            if(isset($_GET['creative']) && $_GET['creative'] != "") {
                $hasCreative = '&creatives['.$campaignID.']='.$_GET['creative'];
            }else {
                $creative_id = curler($url."api/get_campaign_creative_id?id=".$campaignID);
                if($creative_id != '') {
                    $hasCreative = '&creatives['.$campaignID.']='.$creative_id;
                }
            }
            
            $output = curler($url."api/get_stack_campaign_content_php?campaigns[0]=".$campaignID.$hasCreative);
            $output = preview_offer_html($output);
        ?>      
	</div>
<?php include_once("footer.php"); ?>    
<script>
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
                        form.submit();
                        console.log('SUBMIT');
                    }else {
                        alert('Next Campaign. This is just a preview');
                        die();
                    }
                }
            }
            
        });
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
