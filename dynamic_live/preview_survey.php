<?php 
	include_once("header_survey.php"); 	
    include_once("../includes/preview_function.php"); 

    if(! isset($_GET['id'])) die();

	$bar_num = 1;
	$campaignCount = 1;
	$cur_bar = 1;
	$campaignID = $_GET['id'];
?>		
	<!-- PROGRESS BAR START -->
    <?php display_progress_bar($cur_bar,$bar_num,true); ?>
    <!-- PROGRESS BAR END -->
    
	<div id="contentbox">    
		<?php 
            if($_SESSION['leadreactor_url'] != null || $_SESSION['leadreactor_url'] != '') $url = $_SESSION['leadreactor_url'];
            else $url = 'http://leadreactor.engageiq.com/';
			$curl = curl_init();
		    curl_setopt ($curl, CURLOPT_URL,  $url."get_campaign_content_php?id=".$campaignID);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'leadreactortoken:'.$_SESSION['leadreactor_token'],
            ));
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		    $output = curl_exec($curl);
		    curl_close ($curl);
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
    $(document).on('click','.pop_up',function(e) 
    {
        e.preventDefault();
        var url = $(this).data('url');
        window.open(url, '_blank', 'scrollbars=1,height=800,width=1024,left=1,top=1,resizable=1');

        alert('Open Pop Up. This is just a preview');
        die();
    });
</script>
