$(document).ready(function()
{
	$('.input-group.date').datepicker({
        format: "yyyy-mm-dd",
        clearBtn: true,
        autoclose: true,
        todayHighlight: true
    });

	var revStatsTable = $('#stats-table').DataTable({
        'processing': true,
        'serverSide': true,
        "order": [[ 0, "desc" ]],
        "searching": false,
        // "info":     false,
        'ajax':{
            url: '../includes/anura.php?type=get_user', // json datasource
            type: 'post',
            // 'data': $('#search-leads').serialize(),
            'data': function(d)
            {
            	d.affiliate_id = $('#affiliate').val();
                d.revenue_tracker_id = $('#rev_tracker').val();
                d.anura_id = $('#anura_id').val();
                d.email = $('#email').val();
                d.gender = $('#gender').val();
                d.zip = $('#zip').val();
                d.source_url = $('#source_url').val();
                d.date_from = $('#date_from').val();
                d.date_to = $('#date_to').val();
                d.status = $('#status').val();
            },
            "dataSrc": function ( json ) {
                console.log(json);
                $('#getAnuraUsersBtn').removeAttr('disabled');
                $('#downloadAnuraUsers').removeAttr('disabled');
                return json.data;
            },
            error: function(xhr, error, thrown){  // error handling
            	console.log('Error');
                console.log(xhr);
                console.log(xhr.responseText);
                console.log(error);
                console.log(thrown);
            }
        },
        lengthMenu: [[25,50,100,1000,2000,3000],[25,50,100,1000,2000,3000]]
    });

	$(document).on('click','.more-details',function() 
	{
		var id = $(this).data('id'),
			details = $.parseJSON($('#user-'+id+'-details').val());

		$('#md-id').html(details.anura_id);
		$('#md-stat').html(details.status);
		$('#md-aff').html(details.affiliate_id);
		$('#md-rt').html(details.revenue_tracker_id);
		$('#md-fn').html(details.first_name);
		$('#md-ln').html(details.last_name);
		$('#md-em').html(details.email);
		$('#md-bd').html(details.birthdate);
		$('#md-gd').html(details.gender);
		$('#md-zip').html(details.zip);
		$('#md-ste').html(details.state);
		$('#md-cty').html(details.city);
		$('#md-add').html(details.address);
		$('#md-phn').html(details.phone);
		$('#md-ip').html(details.ip);
        $('#md-surl').html(details.source_url);
		$('#md-im').html(details.mobile);
		$('#md-ba').html(details.browseragent);
		$('#md-ldt').html(details.localdatetime);
		$('#md-ca').html(details.created_at);
		$('#more-details-modal').modal('show');
	});

	$(document).on('click','#getAnuraUsersBtn', function(e)
    {
        e.preventDefault();
        var from_date = $('#date_from').val(),
            to_date = $('#date_to').val();

        if(from_date == '' || to_date == '') {
        	$('label[for="date_from"]').removeClass('error_label error');
            $('#date_from').removeClass('error_field error');
            $('label[for="date_to"]').removeClass('error_label error');
            $('#date_to').removeClass('error_field error');
            $('#getAnuraUsersBtn').attr('disabled', true);
        	$('#downloadAnuraUsers').attr('disabled', true);
            revStatsTable.order([]);
            revStatsTable.ajax.reload();
        }
        else if(from_date != '' && to_date != '' && to_date >= from_date) {
            $('label[for="date_from"]').removeClass('error_label error');
            $('#date_from').removeClass('error_field error');
            $('label[for="date_to"]').removeClass('error_label error');
            $('#date_to').removeClass('error_field error');
            $('#getAnuraUsersBtn').attr('disabled', true);
            $('#downloadAnuraUsers').attr('disabled', true);
            revStatsTable.order([]);
            revStatsTable.ajax.reload();
        }else {
            $('label[for="date_from"]').addClass('error_label error');
            $('#date_from').addClass('error_field error');
            $('label[for="date_to"]').addClass('error_label error');
            $('#date_to').addClass('error_field error');
        }    
    });

	$('#more-details-modal').on('hide.bs.modal', function (event) 
	{
		$('.md-deets').html('');
	});

    $('#clear').click(function()
    {
        $('#stats-filter-form .form-control').val('');
    });
});