<div class="wrap">
<script type="text/javascript">
	jQuery(function() {
		show_all_subscriber_admin_func();
		jQuery('#admin_all_subscribers .pagination li.inactive').live('click',function(){
			var page = jQuery(this).attr('p');												  
			show_all_subscriber_admin_func(page);
		});
		
		jQuery('.status').live('click', function () {
			var id = jQuery(this).attr('id');
			sfc_change_status(id);
		});
		
		jQuery('.delete_user').live('click', function () {
			var id = jQuery(this).attr('id');
			sfc_delete_user(id);
		});
	});
</script>
    <h1>Subscribers</h1>
   <div id="admin_all_subscribers"></div>
</div>