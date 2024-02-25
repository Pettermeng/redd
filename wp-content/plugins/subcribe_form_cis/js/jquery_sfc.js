jQuery(document).ready(function(){
	jQuery('#sfc_subscribe_frm').validate({
		rules: {
			"data[full_name]"	: {required: true},
			"data[email]"		: {required: true,email: true},
			"data[phone]"		: {required: true,number: true}
		},
		submitHandler: function (form) {
			submit_subscribe_frm();
		}
	});
	
});//End of jQuery(document).ready...
function submit_subscribe_frm(){
	var form_data = jQuery('#sfc_subscribe_frm').formSerialize()+'&action=submit_subscriber';
	jQuery('#loading').show();
	jQuery.ajax({
		url: myAjax.ajaxurl,
		type: "POST",
		data:  form_data,
		success: function(respone){
			jQuery('#loading').hide();
			var result = jQuery.parseJSON(respone);
			
			if(result.error =='email'){
				alert('This email already subscribed! Please choose another one.');
			/*}else if(result.error =='captcha'){
				alert('Please verify you are not a robot!');*/
			}else{
				jQuery('#sfc_wrapper').html(result.error);
			}
			//alert(paged);
			
		},
		error: function(){ /*Error Message Here!*/ }
    });
}//
function show_all_subscriber_admin_func(paged){
	var paged 		= paged;
	jQuery.ajax({
		url: myAjax.ajaxurl,
		type: "POST",
		data: {
			action		: 'sfc_load_subscriber_for_admin',
			//schl_title	: schl_title,
			paged		: paged
		},
		success: function(respone){
			jQuery('#admin_all_subscribers').html(respone);
		},
		error: function(){ /*Error Message Here!*/ }
    });
}
function sfc_change_status(id){
	var paged = jQuery('#admin_all_subscribers .pagination li.active').attr('p');
	jQuery.ajax({
		url: myAjax.ajaxurl,
		type: "POST",
		data: {
			action	: 'act_sfc_change_status',
			id		: id
		},
		success: function(respone){
			show_all_subscriber_admin_func(paged);
		},
		error: function(){ /*Error Message Here!*/ }
    });
}
function sfc_delete_user(id){
	var paged = jQuery('#admin_all_subscribers .pagination li.active').attr('p');
	jQuery.ajax({
		url: myAjax.ajaxurl,
		type: "POST",
		data: {
			action	: 'act_sfc_delete_user',
			id		: id
		},
		success: function(respone){
			show_all_subscriber_admin_func(paged);
		},
		error: function(){ /*Error Message Here!*/ }
    });
}