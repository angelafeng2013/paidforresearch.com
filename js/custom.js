function checkIfBrowserIE() {
	var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer, return version number
        // alert(parseInt(ua.substring(msie + 5, ua.indexOf(".", msie))));
    	return true;
    else                 // If another browser, return 0
    	return false;
        //alert('otherbrowser');
}

function sendForm() {
	var form = $('.survey_form');

	setPhoneAndAddress(form);

	var the_url = '../includes/sendLead.php?' + form.attr('action') + '?' + form.serialize();
	$.ajax({
		url: the_url,
		type: 'POST',
		error: function (jqXHR, text, errorThrown) {
		    console.log(jqXHR + " " + text + " " + errorThrown);
		    form.attr('data-sent','true').data('sent','true');
		},
		success: function(data) {
			console.log(data);
			console.log('SUCCESS');
			form.attr('data-sent','true').data('sent','true');
		}
	});
}

function manualSendForm(form) {
	
	setPhoneAndAddress(form);

	var the_url = '../includes/sendLead.php?' + form.attr('action') + '?' + form.serialize();
	$.ajax({
		url: the_url,
		type: 'POST',
		error: function (jqXHR, text, errorThrown) {
		    console.log(jqXHR + " " + text + " " + errorThrown);
		    form.attr('data-sent','true').data('sent','true');
		},
		success: function(data) {
			console.log(data);
			console.log('SUCCESS');
			form.attr('data-sent','true').data('sent','true');
		}
	});
}

function setNextSurvey(id, callback) {
	$.ajax({
		url:"../includes/form_function.php",
		type: 'POST',
		data: {
			type : 'set_next_survey',
			id : id
		},
		success: function(next_campaign_priority) {
			callback(next_campaign_priority);
		}
	});
}

function setNextStackSet() {
	$.ajax({
		url:"../includes/form_function.php",
		type: 'POST',
		data: {
			type : 'set_next_stack_set',
			set : $('#current_campaign_set').val()
		},
		success: function(next_set) {
			History.pushState({state:next_set}, null, "?campaign="+next_set+ "&" +document.cookie.match(/PHPSESSID=[^;]+/));
			var redUrl = window.location.origin + window.location.pathname + '?campaign=' + next_set+ '&' +document.cookie.match(/PHPSESSID=[^;]+/);
			window.location.replace(redUrl);
		}
	});
}

function trackCampaignNos() {
	var no_campaigns = [];
	$("form").each(function () {
		var form = $(this);
		if(form.find('[type="radio"][value="NO"]').is(':checked')) {
			no_campaigns.push(form.find('[name="eiq_campaign_id"]').val());
		}
	});

	if(no_campaigns.length > 0) {
		console.log('LOG NO');
		$.ajax({
			url: '../includes/curl.php?type=track_no',
			data: {
				campaigns : no_campaigns
			},
			type: 'POST',
			// success: function(data) {
			// 	console.log(data);
			// }
		});
	}
}

function setPhoneAndAddress(form) {
	//Checks if form has phone input

	if($('#user_phone').val() != '' && $('#user_address').val() != '') {
		return;
	}

	console.log('SET PHONE AND ADDRESS....');

	if(form.find('input[name="phone"]').length == 1 && form.find('input[name="phone"]').val() != '' && $('#user_phone').val() == '') {
		console.log('Phone');
		var phone = form.find('input[name="phone"]').val();
			phone = phone.replace(/\D/g,'');

		$.ajax({
			url:"../includes/form_function.php",
			type: 'POST',
			data: {
				type : 'set_phone',
				phone : phone
			},
			success: function(data) {
				$('#user_phone').val(phone);
			}
		});
	}

	//Checks if form has address input
	if((form.find('input[name="address"]').length == 1 || form.find('input[name="address1"]').length == 1) && (form.find('input[name="address"]').val() != ''|| form.find('input[name="address1"]').val() != '') && $('#user_address').val() == '') {
		console.log('Address');
		if(form.find('input[name="address1"]').length == 1) var address = form.find('input[name="address1"]').val();
		else var address = form.find('input[name="address"]').val();

		$.ajax({
			url:"../includes/form_function.php",
			type: 'POST',
			data: {
				type : 'set_address',
				address : address
			},
			success: function(data) {
				$('#user_address').val(address);
			}
		});
	}
}

function popupwindow(url, title, w, h) {
  var left = (screen.width/2)-(w/2);
  var top = (screen.height/2)-(h/2);
   window.open(url, title, "directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width="+w+", height="+h+", top="+top+", left="+left);
   return false;
}

jQuery.validator.addMethod("letterswithspace", function(value, element) {
	return this.optional(element) || /^[a-z\s\.]+$/i.test(value);
}, "letters only");  


jQuery.validator.addMethod("email2", function(value, element, param) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  	return emailReg.test( value );
}, jQuery.validator.messages.email);

jQuery.validator.addMethod("zipcode", function(value, element) {
  return this.optional(element) || /^\d{5}(?:-\d{4})?$/.test(value);
}, "Please provide a valid zipcode.");

jQuery.validator.addMethod("alphaSpace", function(value, element) {
	return this.optional(element) || /^[a-zA-Z\s]*$/.test(value);
}, "Letters and Spaces Only"); 

jQuery.validator.addMethod("alphaNumeric", function(value, element) {
	return this.optional(element) || /^[a-z0-9]+$/i.test(value);
}, "Letters and Numbers Only"); 

jQuery.validator.addMethod("zip_checker", function(value, element) {
  var ifValid = this.optional(element) || /^\d{5}(?:-\d{4})?$/.test(value);
  if(ifValid) {
  	$.ajax({
        url: $("meta[name='lrUrl']").attr('content') + 'zip_checker',
        crossDomain: true,
        type: "POST",
        data: {
        	zip: value
        },
        dataType: "jsonp",
        // jsonpCallback: function(json) {
        // 	console.log(json);
        // }
        success: function(isCorrect) {
	        if(isCorrect != 'true')ifValid = false;
	    }
    });
  }
  return ifValid;
}, "Please provide a valid US Zip Code.");

//add the custom validation method
$.validator.addMethod("minWordCount",
   function(value, element, param) {
      var count = getWordCount(value);
      var space = value;
      if(count >= param) {
        return true;
      }
   },
    $.validator.format("*")   
);

jQuery.validator.setDefaults({
	focusInvalid: false,
    invalidHandler: function(form, validator) {
        if (!validator.numberOfInvalids())
          return;

     	if ($('.longform-survey').length > 0) {
      		var error_name = $(validator.errorList[0].element).attr('name');
      		console.log(error_name);
		   $('html, body').animate({
		    scrollTop: $('.longform-survey input[name="'+error_name+'"] + div').offset().top - $('#progress_bar_box').height() - $('#headline1').height() - $('#headline2').height()
		   }, 2000);
        }else if($('input[name="eiq_campaign_id"]').length > 1) {
      		if(parseInt($('#error_validation_counter').val()) == 0) {
	          $('html, body').animate({
	              scrollTop: $(validator.errorList[0].element).offset().top - $('#progress_bar_box').height() - $('#headline1').height() - $('#headline2').height()
	          }, 2000);
	        }
	        $('#error_validation_counter').val( parseInt($('#error_validation_counter').val()) + 1);
      	}else {
      		$('html, body').animate({
              scrollTop: $(validator.errorList[0].element).offset().top - $('#progress_bar_box').height() - $('#headline1').height() - $('#headline2').height()
          	}, 2000);
      	}
        
    }
});

function getWordCount(wordString) {
  var words = wordString.split(" ");
  words = words.filter(function(words) { 
    return words.length > 0
  }).length;
  return words;
}

//Script to display additional input fields in Desktop
function showform()
{
    $( "#formtable" ).css("display", "block" );
    $( ".yes-no-desktop" ).css("display", "none" );
}

//Script to hide additional input fields for Desktop
function hideform()
{
    $( "#formtable" ).css("display", "none" );
    $( ".yes-no-desktop" ).css("display", "block" );
}
 
//Script to hide additional input fields in Mobile
function backquestion()
{
    $('.yes-no-mobile').fadeIn(500);
    $('#formtable').fadeOut(500);
    $('html, body').animate({
        scrollTop: $(".wrapper").offset().top
    }, 500);
}

//Script to send registration/profile question data to Lead Reactor
function sendRegistration() 
{
	var form_data = $("#registration_form").serialize();
    console.log($("#registration_form").serialize());

    /*FOR EXECUTION TIME *///var start_time = new Date();

    var path_type = 1;
	$.ajax({
		url:"../includes/curl.php?type=register",
		type: 'POST',
		data: form_data,
		success: function(json) {
		  json = JSON.parse(json);
		  console.log(json);
		  path_type = json.path_type;
		  // console.log(path_type);
		  $.ajax({
		    url:"../includes/form_function.php",
		    type: 'POST',
		    data: {
		      type : 'set_session',
		      data : json
		    },
		    success: function(data) {
		    	var myDate = new Date();
				myDate.setMonth(myDate.getMonth() + 60);
				document.cookie = "usr-dta=" + form_data + ";expires=" + myDate 
                  + ";domain=.paidforresearch.com;path=/";
		    	/*FOR EXECUTION TIME */
		  //   	var end_time = new Date();
		  //   	$.ajax({
				//     url:"../includes/form_function.php",
				//     type: 'POST',
				    // data: {
				//       type : 'set_execution',
				//       start : start_time,
				//       end : end_time,
				//       email : $('[name="email"]').val(),
				//       url : window.location.href
				//     }
				// });
		    	/*FOR EXECUTION TIME */
		    	
		      if(path_type == 1) {
		        //console.log(url + "survey.php?campaign=1");
		        window.location.href = 'survey.php?campaign=1';
		        //window.location.replace("survey.php?campaign=1");
		        // window.location.replace(url + "survey.php?campaign=1");
		      }else {
		        //console.log(url + "survey_stack.php?campaign=1");
		        window.location.href = 'survey_stack.php?&campaign=1'+ '&' +document.cookie.match(/PHPSESSID=[^;]+/);
		        //window.location.replace("survey_stack.php?campaign=1");
		        // window.location.replace(url + "survey_stack.php?campaign=1");
		      }
		    }
		  });
		}
	});
}

//Script for CPA Pixel
function sendCPAPixel() 
{
	$.ajax({
		url: '../includes/curl.php?type=cpa_pixel',
		type: 'POST',
		data: {
			eiq_affiliate_id : $('[name="affiliate_id"]').val(),
			rev_tracker : $('[name="affiliate_id"]').val(),
			eiq_campaign_id : 411,
			eiq_email : $('[name="email"]').val(),
			first_name : $('[name="first_name"]').val(),
			last_name : $('[name="last_name"]').val(),
			zip : $('[name="zip"]').val(),
			gender : $('[name="gender"]:checked').val(),
			reqid : $('[name="reqid"]').val()
		},
		success: function(data) {
			console.log(data);
			console.log('SUCCESS');
		}
	});
}

$(document).ready(function() {

	//Script to display additional input fields in Mobile
	$(".yes-no-mobile .class-yes").click(function(){
	    $('.yes-no-mobile').fadeOut(500);
	    $('#formtable').fadeIn(500);
	    $('html, body').animate({
	        scrollTop: $("#formtable").offset().top
	    }, 500);
	}); 

	var lrUrl = $("meta[name='lrUrl']").attr('content');
	
	var error_validation_counter = 0;

	$(document).on('submit','.survey_form',function(e) 
    {
		e.preventDefault();

		$('.submit_form').attr('disabled',true).prop('disabled', true).attr('type','button').css('background-image','url(images/yes-loading.gif)');
		$('.click-submit').attr('disabled',true).prop('disabled', true).attr('type','button').css('background-image','url(images/yes-loading.gif)');
		sendForm();

		var id = $('.survey_form input[name="eiq_campaign_id"]').val();
		console.log(id);
		setNextSurvey(id, function(next_campaign) {
			// loadSurvey(next_campaign);
			History.pushState({state:next_campaign}, null, "?campaign="+next_campaign+ "&" +document.cookie.match(/PHPSESSID=[^;]+/));
			var redUrl = window.location.origin + window.location.pathname + '?campaign=' + next_campaign+ '&' +document.cookie.match(/PHPSESSID=[^;]+/);
			console.log(redUrl);
			window.location.replace(redUrl);
			//location.reload();
		});

	});

	$(document).on('click','.next_survey',function(e) 
    {
		e.preventDefault();

		$(this).attr('disabled',true).prop('disabled', true).css('background-image','url(images/no-loading.gif)');
		
		var id = $('.survey_form input[name="eiq_campaign_id"]').val();
		console.log(id);
		setNextSurvey(id, function(next_campaign) {
			//loadSurvey(next_campaign);
			//location.reload();
			History.pushState({state:next_campaign}, null, "?campaign="+next_campaign+ "&" +document.cookie.match(/PHPSESSID=[^;]+/));
			var redUrl = window.location.origin + window.location.pathname + '?campaign=' + next_campaign+ '&' +document.cookie.match(/PHPSESSID=[^;]+/);
			window.location.replace(redUrl);
		});
	});

	$(document).on('click','.pop_up',function(e) 
    {
		e.preventDefault();
		var url = $(this).data('url');
		window.open(url, '_blank', 'scrollbars=1,height=800,width=1024,left=1,top=1,resizable=1');

		var id = $('.survey_form input[name="eiq_campaign_id"]').val();
		console.log(id);
		setNextSurvey(id, function(next_campaign) {
			History.pushState({state:next_campaign}, null, "?campaign="+next_campaign+ "&" +document.cookie.match(/PHPSESSID=[^;]+/));
			var redUrl = window.location.origin + window.location.pathname + '?campaign=' + next_campaign+ "&" +document.cookie.match(/PHPSESSID=[^;]+/);
			window.location.replace(redUrl);
			//loadSurvey(next_campaign);
		});
	});

	$(document).on('click','.pop_up_redirect',function() 
    {
		var url = $(this).data('url');
		window.open(url, '_blank', 'scrollbars=1,height=800,width=1024,left=1,top=1,resizable=1');
	});

	$.validator.messages.required = "*";

	$(document).on('click','#submit_stack_button',function(e) 
    {
    	e.preventDefault();

    	var this_button = $(this);
    	this_button.attr('disabled',true).prop('disabled', true);

		var total_yes = $('.submit_stack_campaign:checked').length;
		var validation_counter = 0;
		var sent_counter = 0;
		 $('#error_validation_counter').val( 0 );

		// console.log( $('.submit_stack_campaign:checked').length );
	    if($('.submit_stack_campaign:checked').length == 0) {
	    	console.log('No YES');
	    	trackCampaignNos();
	    	setNextStackSet();
	    }else {
			$("form").each(function () {
			    var form = $(this);
			    if(form.find('.submit_stack_campaign').is(':checked')) { 
			    	if(form.valid()) {
			    		validation_counter++;
			    	}
			    	/* 
			    	if(typeof form.attr('data-valid') === 'undefined' || form.data('valid') == 'true') {
			    		if(typeof form.attr('data-sent') === 'undefined' || form.data('sent') == 'false') {
			    			form.submit();
							if(form.valid()) sent_counter++;
			    		}else {
							sent_counter++;
			    		}
			    	}else {
			    		//if form valid == false has an additional validation to be checked
			    		console.log(form.attr('id'));
			    		if(form.valid()) sent_counter++;
			    	}
					
					// console.log(total_yes + ' - ' + sent_counter);
					if(total_yes == sent_counter ) {
						console.log('REDIRECT');
						setNextStackSet();
					}
					*/
			    }
			});

			if(total_yes == validation_counter) {
				this_button.html('Sending');
				$("form").each(function () {
					var form = $(this);
					if(form.find('.submit_stack_campaign').is(':checked')) {
						if(form.valid()) {
							var hasAcceptChecker = true,
								acceptAttr = form.attr('data-accept');

							if(typeof acceptAttr !== typeof undefined && acceptAttr !== false) {
								console.log('I HAVE ACCEPT');
								
								if(acceptAttr == true || acceptAttr == 'true') hasAcceptChecker = true;
								else {
									hasAcceptChecker = false;
									errorCounter = 0;
									$.each(form.find('[data-check]'), function(i, object) {
										if($(this).is('select')) {
											// console.log('select');
											// console.log($(this).attr('name') + ' - ' + $(this).val());
											if(typeof $(this).find('option[value="'+$(this).val()+'"]').attr('accepted') === typeof undefined) {
												// console.log('errror');
												errorCounter++;
											}
										}else {
											if($(this).attr('type') == 'checkbox') {
												if(typeof $(this).attr('accepted') !== typeof undefined) {
													// console.log('Accepted: ' +$(this).attr('name') + ' - ' + $(this).val());
													if($(this).prop('checked') === false){
														// console.log('errror');
														errorCounter++;
													}
												}else {
													// console.log('Not Accepted: ' +$(this).attr('name') + ' - ' + $(this).val());
													if($(this).prop('checked') === true){
														// console.log('errror');
														errorCounter++;
													}
												}
											}else if($(this).attr('type') == 'radio') {
												// console.log($(this).attr('name'));
												if(typeof $('[name="'+$(this).attr('name')+'"]:checked').attr('accepted') === typeof undefined) {
													// console.log('errror');
													errorCounter++;
												}
											}
											
										}
									});

									if(errorCounter == 0) hasAcceptChecker = true;
								}
							}

							if((typeof form.attr('data-valid') === 'undefined' || form.data('valid') == 'true') && hasAcceptChecker) {
								form.submit();
								console.log('SUBMIT');
							}
				    	}
					}
				});
				console.log('Next Stack');
				trackCampaignNos();
				setNextStackSet();
			}else {
				console.log('Not Submit');
				$(this).attr('disabled',false);
			}
	    }

	   

	});

	$(document).on('submit','.stack_survey_form',function(e) 
    {
    	e.preventDefault();    

    	// var submit_button = $('#submit_stack_button');
    	// submit_button.css('background-image','url("images/loading-button.gif")');

		var form = $(this);

		setPhoneAndAddress(form);

		console.log(form.attr('id'));
		if(form.attr('action') != '') {
			// $.ajax({
			// 	url: form.attr('action'),
			// 	dataType: 'jsonp',
			// 	data: form.serialize(),
			// 	error: function (jqXHR, text, errorThrown) {
			// 		// submit_button.css('background-image','url("images/submit_button_form.png")');
			// 	    console.log(jqXHR + " " + text + " " + errorThrown);
			// 	    form.attr('data-sent','true').data('sent','true');
			// 	},
			// 	success: function(data) {
			// 		console.log(data);
			// 		// submit_button.css('background-image','url("images/submit_button_form.png")');
			// 		console.log('SUCCESS');
			// 		form.attr('data-sent','true').data('sent','true');
			// 	}
			// });
			var the_url = '../includes/sendLead.php?' + form.attr('action') + '?' + form.serialize();
			$.ajax({
				url: the_url,
				type: 'POST',
				error: function (jqXHR, text, errorThrown) {
				    console.log(jqXHR + " " + text + " " + errorThrown);
				    form.attr('data-sent','true').data('sent','true');
				},
				success: function(data) {
					console.log(data);
					console.log('SUCCESS');
					form.attr('data-sent','true').data('sent','true');
				}
			});
			console.log('SENT');
		}else {
			console.log('SKIP');
		}
		
	});

	$(document).on('click','.show_custom_questions',function(e) 
	{
	  var form = $(this).closest('form');
	  form.find('#custom_questions').css("display", "block" );
	});

	$(document).on('click','.hide_custom_questions',function(e) 
	{
	  var form = $(this).closest('form');
	  form.find('#custom_questions').css("display", "none" );
	});

	$(document).on('click','.pop_up_stack',function() 
    {
    	var url = $(this).data('url');
		window.open(url, '_blank', 'scrollbars=1,height=800,width=1024,left=1,top=1,resizable=1');
	});

	$(document).on('change','input[name="phone"]',function() 
    {
    	var phone = $(this).val();
    	// phone = phone.replace(/\D/g,'');
    	$('input[name="phone"]').val(phone);	
	});

	$(document).on('change','input[name="address"]',function() 
    {
    	var address = $(this).val();
    	$('input[name="address"]').val(address);	
	});

	$("input[name=phone]").mask("(999) 999-9999");
    // $("input[name=phone]").on("blur", function() {
    //     var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );
    //     if( last.length == 5 ) {
    //         var move = $(this).val().substr( $(this).val().indexOf("-") + 1, 1 );

    //         var lastfour = last.substr(1,4);
            
    //         var first = $(this).val().substr( 0, 9 );
            
    //         $(this).val( first + move + '-' + lastfour );
    //         console.log( first + move + '-' + lastfour);
    //     }
    // });

    $(".act-more").click(function(){
		$(".more-content").slideToggle(300);
		$('html, body').animate({
			scrollTop: $(".more-content").offset().top
		}, 500);
	}); 

	$(".read-more-btn").click(function(){
		var the_content = $(this).closest('.read-more-div').find(".read-more-cnt");
		the_content.slideToggle(300);
		$('html, body').animate({
			scrollTop: the_content.offset().top
		}, 500);
	}); 
});

//Function for Trusted Form Cert URL
(function() {
    var field = 'xxTrustedFormCertUrl';
    var provideReferrer = false;
    var tf = document.createElement('script');
    tf.type = 'text/javascript'; tf.async = true; 
    tf.src = 'http' + ('https:' == document.location.protocol ? 's' : '') +
    '://api.trustedform.com/trustedform.js?provide_referrer=' + escape(provideReferrer) + '&field=' + escape(field) + '&l='+new Date().getTime()+Math.random();
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(tf, s); }
)();