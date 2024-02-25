<?php
/*
Plugin Name: CIS Change & Delete Role Name
Plugin URI: http://www.cis.com.kh
Description: For Change CMS Roles Name.
Version: 1.0
Author: MEN Socheat
Author URI: http://www.cis.com.kh
License: Cam Info Services
*/

/*================================
Change & Delete WP Roles Name
Added by MEN Socheat 20170821
==================================*/
add_action('init', 'change_role_name');
function change_role_name() {
    global $wp_roles;
    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();
        //You can list all currently available roles like this...
        //$roles = $wp_roles->get_names();
        //print_r($roles);
		
        #Delete subscriber & contributor role
        if ( get_role( 'subscriber' ) ) remove_role( 'subscriber' );
		if(get_role('contributor')) remove_role('contributor');
	
        //You can replace "administrator" with any other role "editor", "author", "contributor" or "subscriber"...
        #$wp_roles->roles['subscriber']['name'] = 'ជាងជួសជុល';
        #$wp_roles->role_names['subscriber'] = 'ជាងជួសជុល';           
        
		#$wp_roles->roles['contributor']['name'] = 'ជាងជួសជុល';
        #$wp_roles->role_names['contributor'] = 'ជាងជួសជុល';   #level 1
		
		#Technical Support វិស្វករ បច្ចេកទេស
        $wp_roles->roles['author']['name'] = 'វិស្វករ បច្ចេកទេស';
        $wp_roles->role_names['author'] = 'វិស្វករ បច្ចេកទេស'; #level 2
		
		#Approval	ពិនិត្យអនុម័ត
        $wp_roles->roles['editor']['name'] = 'ពិនិត្យអនុម័ត';
        $wp_roles->role_names['editor'] = 'ពិនិត្យអនុម័ត'; #level 7
		
		#Administrator អ្នកគ្រប់គ្រង
        $wp_roles->roles['administrator']['name'] = 'អ្នកគ្រប់គ្រង';
        $wp_roles->role_names['administrator'] = 'អ្នកគ្រប់គ្រង'; #level 10
		
}#End of change_role_name
?>