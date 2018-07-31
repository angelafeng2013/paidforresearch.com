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

	$.ajax({
		url: form.attr('action'),
		dataType: 'jsonp',
		data: form.serialize(),
		success: function(data) {
			// console.log(data);
			data = JSON.parse(data);
		},
		error: function () {
		    // console.log(jqXHR + " " + text + " " + errorThrown);
		}
	});
}

function manualSendForm(form) {
	
	setPhoneAndAddress(form);

	$.ajax({
		url: form.attr('action'),
		dataType: 'jsonp',
		data: form.serialize(),
		success: function(data) {
			// console.log(data);
			data = JSON.parse(data);
		},
		error: function () {
		    // console.log(jqXHR + " " + text + " " + errorThrown);
		}
	});
}

function setNextSurvey(id, callback) {
	$.ajax({
		url:"includes/form_function.php",
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

function loadSurvey(id) {
	var lrUrl = $("meta[name='lrUrl']").attr('content');
	$.ajax({
		url: lrUrl + "get_campaign_content",
		dataType: 'jsonp', 
		data: {
			'id' : id
		},
		success:function(json){
			$.ajax({
				url:"includes/form_function.php",
				type: 'POST',
				data: {
					type : 'convert_html',
					html : json.content
				},
				success: function(converted_html) {
					//$('#contentbox').html(json.content);
					$( "#progress_bar_row td.cell_noshade:first" ).removeClass('cell_noshade').addClass('cell_shade');
					var cur_num = parseInt($('#progress_bar_current_number').html()) + 1;
					$('#progress_bar_current_number').html(cur_num);
					$('#contentbox').html(converted_html);

					if(converted_html.indexOf('<script>') > 0)
	                {         
	                    //location.reload();  
	                    $("#contentbox").find("script").each(function(i) {
	                        eval($(this).text());
	                    });
	                }
					//console.log(converted_html);
					console.log('loadSurvey');
				}
			});
		},
		error:function(){
		 alert("Error");
		}      
	});

}

function convertHtml(html,callback) {
	$.ajax({
		url:"includes/form_function.php",
		type: 'POST',
		data: {
			type : 'convert_html',
			html : html
		},
		success: function(converted_html) {
			callback(converted_html);
		}
	});
}

function setNextStackSet() {
	console.log('setNextStackSet');
	$.ajax({
		url:"includes/form_function.php",
		type: 'POST',
		data: {
			type : 'set_next_stack_set',
			set : $('#current_campaign_set').val()
		},
		success: function(next_set) {
			console.log('mao ni sya ' + $('#current_campaign_set').val());
			console.log('next_set ' + next_set);
			History.pushState({state:next_set}, null, "?campaign="+next_set);
			var redUrl = window.location.origin + window.location.pathname + '?campaign='+next_set;
			console.log(redUrl);
			window.location.replace(redUrl);
		}
	});
}

function setPhoneAndAddress(form) {
	//Checks if form has phone input

	if($('#user_phone').val() != '' && $('#user_address').val() != '') {
		return;
	}

	console.log('SETTING....');

	if(form.find('input[name="phone"]').length == 1 && $('#user_phone').val() == '') {
		console.log('Phone');
		var phone = form.find('input[name="phone"]').val();
			phone = phone.replace(/\D/g,'');

		$.ajax({
			url:"includes/form_function.php",
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
	if((form.find('input[name="address"]').length == 1 || form.find('input[name="address1"]').length == 1)&& $('#user_address').val() == '') {
		// console.log('Address');
		if(form.find('input[name="address1"]').length == 1) var address = form.find('input[name="address1"]').val();
		else var address = form.find('input[name="address"]').val();

		$.ajax({
			url:"includes/form_function.php",
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
	return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "letters only");  


jQuery.validator.addMethod("email2", function(value, element, param) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  	return emailReg.test( value );
}, jQuery.validator.messages.email);

jQuery.validator.addMethod("zipcode", function(value, element) {
  return this.optional(element) || /^\d{5}(?:-\d{4})?$/.test(value);
}, "Please provide a valid zipcode.");

jQuery.validator.setDefaults({
	focusInvalid: false,
    invalidHandler: function(form, validator) {
        if (!validator.numberOfInvalids())
          return;

      	if($('input[name="eiq_campaign_id"]').length > 1) {
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

    var path_type = 1;
	$.ajax({
		url:"includes/lead_reactor_function.php",
		type: 'POST',
		data: form_data,
		success: function(json) {
		  json = JSON.parse(json);
		  console.log(json);
		  path_type = json.path_type;
		  // console.log(path_type);
		  $.ajax({
		    url:"includes/form_function.php",
		    type: 'POST',
		    data: {
		      type : 'set_session',
		      data : json
		    },
		    success: function(data) {
		      if(path_type == 1) {
		        //console.log(url + "survey.php?campaign=1");
		        window.location.href = 'survey.php?campaign=1';
		        //window.location.replace("survey.php?campaign=1");
		        // window.location.replace(url + "survey.php?campaign=1");
		      }else {
		        //console.log(url + "survey_stack.php?campaign=1");
		        window.location.href = 'survey_stack.php?campaign=1';
		        //window.location.replace("survey_stack.php?campaign=1");
		        // window.location.replace(url + "survey_stack.php?campaign=1");
		      }
		    }
		  });
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

	// $("#registration_form").validate({
	// 	rules : {
	// 		gender : {
	// 			required : true
	// 		},
	// 		first_name : {
	// 			letterswithspace : true
	// 		},
	// 		last_name : {
	// 			letterswithspace : true
	// 		},
	// 		city : {
	// 			letterswithspace : true
	// 		},
	// 		zip : {
	// 			zipcode : true,
	// 			remote: {
 //                    url: lrUrl + 'zip_checker',
	// 		      	dataType: 'jsonp',
	// 				data : {
	// 			      	zip : function() {
	// 			            return $( 'input[name="zip"]' ).val();
	// 			        }
	// 			    }
 //                }
	// 		},
	// 		email : {
	// 			email2 : true
	// 		}
	// 	},submitHandler: function(form) {

	// 		if(checkIfBrowserIE() == false) {
	// 			console.log('NOT IE');
	// 			if($('.submit_button_form').css('background').indexOf('rgba(0, 0, 0, 0)') == -1) //Mobile
	// 	    	{
	// 	    		$('.submit_button_form').attr('type','button')
	// 	    		.css('background-image','url(images/icon_loading.gif)')
	// 	    		.css('background-repeat','no-repeat')
	// 	    		.css('background-size','contain')
	// 	    		.css('color','transparent')
	// 	    		.css('background-position','center');
	// 	    	}else $('.submit_button_form').attr('type','button').css('background-image','url(images/loading-button.gif)');
	// 		}else console.log('IE EW');

	// 	    var birthdate = $('select[name="dobyear"]').val() + '-' + $('select[name="dobmonth"]').val() + '-' + $('select[name="dobday"]').val();
	// 	    $('input[name="birthdate"]').val(birthdate);
	// 	    var form_data = $("#registration_form").serialize();
	// 	    console.log($("#registration_form").serialize());

	// 	    var path_type = 1;

	// 	    $.ajax({
	// 			url: lrUrl + "get_campaign_list",
	// 			dataType: 'jsonp',
	// 			data: form_data,
	// 			success:function(json){
	// 				console.log(json);
	// 				path_type = json.path_type;
	// 				$.ajax({
	// 					url:"includes/form_function.php",
	// 					type: 'POST',
	// 					data: {
	// 						type : 'set_session',
	// 						data : json
	// 					},
	// 					success: function(data) {
	// 						// console.log(data);
	// 						// History.pushState({state:0}, null, window.location.href);
	// 						// var url = window.location.protocol + '//' + window.location.hostname + window.location.pathname;
	// 						if(path_type == 1) {
	// 							//console.log(url + "survey.php?campaign=1");
	// 							window.location.href = 'survey.php?campaign=1';
	// 							//window.location.replace("survey.php?campaign=1");
	// 							// window.location.replace(url + "survey.php?campaign=1");
	// 						}else {
	// 							//console.log(url + "survey_stack.php?campaign=1");
	// 							window.location.href = 'survey_stack.php?campaign=1';
	// 							//window.location.replace("survey_stack.php?campaign=1");
	// 							// window.location.replace(url + "survey_stack.php?campaign=1");
	// 						}
	// 					}
	// 				});
	// 			},
	// 			error:function(){
	// 			 alert("Error");
	// 			}      
	// 		});
	// 	}
	// });	

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
			History.pushState({state:next_campaign}, null, "?campaign="+next_campaign);
			var redUrl = window.location.origin + window.location.pathname + '?campaign=' + next_campaign;
			console.log(redUrl);
			window.location.replace(redUrl);
			//location.reload();
		});

	});

	// $(document).on('click','.submit_form',function(e) 
 //    {
	// 	e.preventDefault();
	// 	//$('#contentbox').html('<div align="center"><img src="images/icon_loading.gif" /><h2>Loading Surveys...</h2></div>');
		
	// 	$('.survey_form').submit();
	// });

	$(document).on('click','.next_survey',function(e) 
    {
		e.preventDefault();

		$(this).attr('disabled',true).prop('disabled', true).css('background-image','url(images/no-loading.gif)');
		
		var id = $('.survey_form input[name="eiq_campaign_id"]').val();
		console.log(id);
		setNextSurvey(id, function(next_campaign) {
			//loadSurvey(next_campaign);
			//location.reload();
			History.pushState({state:next_campaign}, null, "?campaign="+next_campaign);
			var redUrl = window.location.origin + window.location.pathname + '?campaign=' + next_campaign;
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
			History.pushState({state:next_campaign}, null, "?campaign="+next_campaign);
			var redUrl = window.location.origin + window.location.pathname + '?campaign=' + next_campaign;
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
	// $('.stack_survey_form').each(function() {  // attach to all form elements on page
 //        $(this).validate({       // initialize plugin on each form
 //            // global options for plugin
 //        });
 //    });

	$(document).on('click','.submit_stack_campaign',function(e) 
    {
		var form = $(this).closest("form");
		
		//form.submit();
	});
	
	$(document).on('click','#submit_stack_button',function(e)
    {
    	e.preventDefault();
    	var this_button = $(this);
    	this_button.attr('disabled',true).prop('disabled', true);

		var total_yes = $('.submit_stack_campaign:checked').length;
		var validation_counter = 0;
		var sent_counter = 0;
		 $('#error_validation_counter').val( 0 );

		console.log( $('.submit_stack_campaign:checked').length );
	    if($('.submit_stack_campaign:checked').length === 0) {
	    	console.log('No YES');
	    	setNextStackSet();
	    }else {
	    	console.log('naay Yes');
			$("form").each(function () {
			    var form = $(this);
			    if(form.find('.submit_stack_campaign').is(':checked')) { 
			    	if(form.valid()) {
			    		validation_counter++;
			    	}
			    }
			});

			if(total_yes == validation_counter) {
				this_button.html('Sending');
				$("form").each(function () {
					var form = $(this);
					if(form.find('.submit_stack_campaign').is(':checked')) {
						if(form.valid()) {
							if(typeof form.attr('data-valid') === 'undefined' || form.data('valid') == 'true') {
								form.submit();
								console.log('SUBMIT');
							}
				    	}
					}
				});
				console.log('Next Stack');
				setNextStackSet();
			}else {
				console.log('Not Submit');
				$(this).attr('disabled',false);
			}
	    }

	   

	});

	$(document).on('submit','.stack_survey_form_orig',function(e) 
	// $(document).on('submit','.stack_survey_form',function(e) 
    {
    	e.preventDefault();    

		var form = $(this);

		setPhoneAndAddress(form);

		console.log(form.attr('action'));

		if(form.attr('action') != '') {
			var base_url = window.location.href.match(/^.*\//);
			var url = base_url + 'survey_stack_curl.php?' + form.attr('action') + '?' + form.serialize() + '&ignore=1';
			// var url = 'http://pfrprefetch.dev/dynamic_live/survey_stack_curl.php?http://leadreactor.engageiq.com/sendLead?' + form.serialize() + '&ignore=1';	
			console.log(url);	
			$.ajax({
				// url: form.attr('action'),
				url: url,
				// dataType: 'json',
				// data: form.serialize(),
				error: function (jqXHR, text, errorThrown, data) {
				    console.log(jqXHR + " " + text + " " + errorThrown);
				    form.attr('data-sent','true').data('sent','true');
				},
				success: function(data) {
					console.log(data);
					console.log('SUCCESS');
					form.attr('data-sent','true').data('sent','true');
					submitForm();
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