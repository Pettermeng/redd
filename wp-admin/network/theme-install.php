<?php
/**
 * Install theme network administration panel.
 *
 * @package CMS
 * @subpackage Multisite
 * @since 3.1.0
 */

if ( isset( $_GET['tab'] ) && ( 'theme-information' == $_GET['tab'] ) )
	define( 'IFRAME_REQUEST', true );

/** Load CMS Administration Bootstrap */
require_once( dirname( __FILE__ ) . '/admin.php' );

require( ABSPATH . 'wp-admin/theme-install.php' );
