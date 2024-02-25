<table class="form-table">
	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Tracking', 'mailster' ) ?><p class="description"><?php esc_html_e( 'can be changed in each campaign', 'mailster' ) ?></p></th>
		<td>
		<p><label><input type="hidden" name="mailster_options[track_opens]" value=""><input type="checkbox" name="mailster_options[track_opens]" value="1" <?php checked( mailster_option( 'track_opens' ) );?>> <?php esc_html_e( 'Track opens in your campaigns', 'mailster' ) ?></label></p>
		<p><label><input type="hidden" name="mailster_options[track_clicks]" value=""><input type="checkbox" name="mailster_options[track_clicks]" value="1" <?php checked( mailster_option( 'track_clicks' ) );?>> <?php esc_html_e( 'Track clicks in your campaigns', 'mailster' ) ?></label></p>

		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Save Subscriber IP', 'mailster' ) ?></th>
		<td><label><input type="hidden" name="mailster_options[track_users]" value=""><input type="checkbox" name="mailster_options[track_users]" value="1" <?php checked( mailster_option( 'track_users' ) ) ?>> <?php esc_html_e( 'Save IP address and time of new subscribers', 'mailster' ) ?></label>
		<p class="description"><?php esc_html_e( 'In some countries it\'s required to save the IP address and the sign up time for legal reasons. Please add a note in your privacy policy if you save users data', 'mailster' ) ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">Do Not Track</th>
		<td><label><input type="hidden" name="mailster_options[do_not_track]" value=""><input type="checkbox" name="mailster_options[do_not_track]" value="1" <?php checked( mailster_option( 'do_not_track' ) ) ?>> <?php esc_html_e( 'Respect users "Do Not Track" option', 'mailster' ) ?></label>
		<p class="description"><?php printf( __( 'If enabled Mailster will respect users option for not getting tracked. Read more on the %s', 'mailster' ), '<a href="http://donottrack.us/" class="external">' . __( 'official website', 'mailster' ) . '</a>' ) ?></p>
		</td>
	</tr>
<?php
	$geoip = mailster_option( 'trackcountries' );
	$geoipcity = mailster_option( 'trackcities' );
if ( isset( $_GET['nogeo'] ) ) {
	$geoip = $geoipcity = false;
}

?>
	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Track Geolocation', 'mailster' ) ?>
		<div class="loading geo-ajax-loading"></div></th>
		<td>
		<p><label><input type="hidden" name="mailster_options[trackcountries]" value=""><input type="checkbox" id="mailster_geoip" name="mailster_options[trackcountries]" value="1" <?php checked( $geoip );?>> <?php esc_html_e( 'Track Countries in Campaigns', 'mailster' ) ?></label></p>
		<p><button id="load_country_db" class="button-primary" data-type="country" <?php disabled( ! $geoip );?>><?php ( is_file( mailster_option( 'countries_db' ) ) ) ? esc_html_e( 'Update Country Database', 'mailster' ) : esc_html_e( 'Load Country Database', 'mailster' );?></button> <?php esc_html_e( 'or', 'mailster' );?> <a id="upload_country_db_btn" href="#"><?php esc_html_e( 'upload file', 'mailster' );?></a>
		</p>
		<p id="upload_country_db" class="hidden">
			<input type="file" name="country_db_file"> <input type="submit" class="button" value="<?php esc_html_e( 'Upload', 'mailster' ) ?>" />
			<br><span class="description"><?php esc_html_e( 'upload the GeoIPv6.dat you can find in the package here:', 'mailster' );?> <a href="https://geolite.maxmind.com/download/geoip/database/GeoIPv6.dat.gz">https://geolite.maxmind.com/download/geoip/database/GeoIPv6.dat.gz</a></span>
		</p>

		<input id="country_db_path" type="text" name="mailster_options[countries_db]" class="widefat" value="<?php echo mailster_option( 'countries_db' ) ?>" placeholder="<?php echo MAILSTER_UPLOAD_DIR . '/GeoIPv6.dat' ?>">
		<p><label><input type="hidden" name="mailster_options[trackcities]" value=""><input type="checkbox" id="mailster_geoipcity" name="mailster_options[trackcities]" value="1" <?php checked( $geoipcity );?><?php disabled( ! $geoip );?>> <?php esc_html_e( 'Track Cities in Campaigns', 'mailster' ) ?></label></p>
		<p><button id="load_city_db" class="button-primary" data-type="city" <?php disabled( ! $geoipcity );?>><?php ( is_file( mailster_option( 'cities_db' ) ) ) ? esc_html_e( 'Update City Database', 'mailster' ) : esc_html_e( 'Load City Database', 'mailster' );?></button> <?php esc_html_e( 'or', 'mailster' );?> <a id="upload_city_db_btn" href="#"><?php esc_html_e( 'upload file', 'mailster' );?></a>
		</p>
		<p id="upload_city_db" class="hidden">
			<input type="file" name="city_db_file"> <input type="submit" class="button" value="<?php esc_html_e( 'Upload', 'mailster' ) ?>" />
			<br><span class="description"><?php esc_html_e( 'upload the GeoLiteCity.dat you can find in the package here:', 'mailster' );?> <a href="https://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz">https://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz</a></span>
		</p>
		<p class="description"><?php esc_html_e( 'The city DB is about 12 MB. It can take a while to load it', 'mailster' );?></p>
		<input id="city_db_path" type="text" name="mailster_options[cities_db]" class="widefat" value="<?php echo mailster_option( 'cities_db' ) ?>" placeholder="<?php echo MAILSTER_UPLOAD_DIR . '/GeoIPCity.dat' ?>">

		</td>
	</tr>
	<?php if ( $geoip && is_file( mailster_option( 'countries_db' ) ) ) : ?>
	<tr valign="top">
		<th scope="row"></th>
		<td>
	<?php if ( mailster_is_local() ) : ?>
	<div class="error inline"><p><strong><?php esc_html_e( 'Geolocation is not available on localhost!', 'mailster' ) ?></strong></p></div>
	<?php endif; ?>
		<p class="description"><?php esc_html_e( 'If you don\'t find your country down below the geo database is missing or corrupt', 'mailster' ) ?></p>
		<p>
		<strong><?php esc_html_e( 'Your IP', 'mailster' ) ?>:</strong> <?php echo mailster_get_ip() ?><br>
		<strong><?php esc_html_e( 'Your country', 'mailster' ) ?>:</strong> <?php echo mailster_ip2Country( '', 'name' ) ?><br>&nbsp;&nbsp;<strong><?php esc_html_e( 'Last update', 'mailster' ) ?>: <?php echo date( $timeformat, filemtime( mailster_option( 'countries_db' ) ) + $timeoffset ) ?> </strong><br>
	<?php if ( $geoipcity && is_file( mailster_option( 'cities_db' ) ) ) : ?>
		<strong><?php esc_html_e( 'Your city', 'mailster' ) ?>:</strong> <?php echo mailster_ip2City( '', 'city' ) ?><br>&nbsp;&nbsp;<strong><?php esc_html_e( 'Last update', 'mailster' ) ?>: <?php echo date( $timeformat, filemtime( mailster_option( 'cities_db' ) ) + $timeoffset ) ?></strong>
	<?php endif; ?>
		</p>
		<p class="description">This product includes GeoLite data created by MaxMind, available from <a href="http://www.maxmind.com" class="external">http://www.maxmind.com</a></p>
		</td>
	</tr>
	<?php
	endif;
	?>
	</table>
