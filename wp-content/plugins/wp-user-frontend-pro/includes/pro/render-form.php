<?php

class WPUF_render_form_element extends WPUF_Render_Form {

    /**
     * Prints a repeatable field
     *
     * @param array $attr
     * @param int|null $post_id
     */
    public static function repeat( $attr, $post_id, $type, $form_id, $class, $obj) {

        $add    = plugins_url( 'assets/images/add.png', WPUF_FILE );
        $remove = plugins_url( 'assets/images/remove.png', WPUF_FILE );
        ?>

        <div class="wpuf-fields <?php echo ' wpuf_'.$attr['name'].'_'.$form_id; ?>">

            <?php if ( isset( $attr['multiple'] ) ) { ?>
                <table>
                    <thead>
                    <tr>
                        <?php
                        $num_columns = count( $attr['columns'] );
                        foreach ($attr['columns'] as $column) {
                            ?>
                            <th>
                                <?php echo $column; ?>
                            </th>
                        <?php } ?>

                        <th style="visibility: hidden;">
                            Actions
                        </th>
                    </tr>

                    </thead>
                    <tbody>

                    <?php
                    $items = $post_id ? $obj->get_meta( $post_id, $attr['name'], $type, false ) : array();


                    if ( $items ) {
                        foreach ($items as $item_val) {
                            $column_vals = explode( self::$separator, $item_val );
                            ?>

                            <tr>
                                <?php for ($count = 0; $count < $num_columns; $count++) { ?>
                                    <td>
                                        <input type="text" name="<?php echo $attr['name'] . '[' . $count . ']'; ?>[]" value="<?php echo esc_attr( $column_vals[$count] ); ?>" size="<?php echo esc_attr( $attr['size'] ) ?>" data-required="<?php echo $attr['required'] ?>" data-type="text"<?php $obj->required_html5( $attr ); ?> />
                                    </td>
                                <?php } ?>
                                <td>
                                    <img class="wpuf-clone-field" alt="<?php esc_attr_e( 'Add another', 'wpuf' ); ?>" title="<?php esc_attr_e( 'Add another', 'wpuf' ); ?>" src="<?php echo $add; ?>">
                                    <img class="wpuf-remove-field" alt="<?php esc_attr_e( 'Remove this choice', 'wpuf' ); ?>" title="<?php esc_attr_e( 'Remove this choice', 'wpuf' ); ?>" src="<?php echo $remove; ?>">
                                </td>
                            </tr>

                        <?php } //endforeach   ?>

                    <?php } else { ?>

                        <tr>
                            <?php for ($count = 0; $count < $num_columns; $count++) { ?>
                                <td>
                                    <input type="text" name="<?php echo $attr['name'] . '[' . $count . ']'; ?>[]" size="<?php echo esc_attr( $attr['size'] ) ?>" data-required="<?php echo $attr['required'] ?>" data-type="text"<?php $obj->required_html5( $attr ); ?> />
                                </td>
                            <?php } ?>
                            <td>
                                <img class="wpuf-clone-field" alt="<?php esc_attr_e( 'Add another', 'wpuf' ); ?>" title="<?php esc_attr_e( 'Add another', 'wpuf' ); ?>" src="<?php echo $add; ?>">
                                <img class="wpuf-remove-field" alt="<?php esc_attr_e( 'Remove this choice', 'wpuf' ); ?>" title="<?php esc_attr_e( 'Remove this choice', 'wpuf' ); ?>" src="<?php echo $remove; ?>">
                            </td>
                        </tr>

                    <?php } ?>

                    </tbody>
                </table>

            <?php } else { ?>


                <table>
                    <?php
                    $items = $post_id ? explode( self::$separator, $obj->get_meta( $post_id, $attr['name'], $type, true ) ) : array();

                    if ( $items ) {
                        foreach ($items as $item) {
                            ?>
                            <tr>
                                <td>
                                    <input id="wpuf-<?php echo $attr['name']; ?>" type="text" data-required="<?php echo $attr['required'] ?>" data-type="text"<?php $obj->required_html5( $attr ); ?> name="<?php echo esc_attr( $attr['name'] ); ?>[]" placeholder="<?php echo esc_attr( $attr['placeholder'] ); ?>" value="<?php echo esc_attr( $item ) ?>" size="<?php echo esc_attr( $attr['size'] ) ?>" />
                                </td>
                                <td>
                                    <img style="cursor:pointer; margin:0 3px;" alt="add another choice" title="add another choice" class="wpuf-clone-field" src="<?php echo $add; ?>">
                                    <img style="cursor:pointer;" class="wpuf-remove-field" alt="remove this choice" title="remove this choice" src="<?php echo $remove; ?>">
                                </td>
                            </tr>
                        <?php } //endforeach    ?>
                    <?php } else { ?>

                        <tr>
                            <td>
                                <input id="wpuf-<?php echo $attr['name']; ?>" type="text" data-required="<?php echo $attr['required'] ?>" data-type="text"<?php $obj->required_html5( $attr ); ?> name="<?php echo esc_attr( $attr['name'] ); ?>[]" placeholder="<?php echo esc_attr( $attr['placeholder'] ); ?>" value="<?php echo esc_attr( $attr['default'] ) ?>" size="<?php echo esc_attr( $attr['size'] ) ?>" />
                            </td>
                            <td>
                                <img style="cursor:pointer; margin:0 3px;" alt="add another choice" title="add another choice" class="wpuf-clone-field" src="<?php echo $add; ?>">
                                <img style="cursor:pointer;" class="wpuf-remove-field" alt="remove this choice" title="remove this choice" src="<?php echo $remove; ?>">
                            </td>
                        </tr>

                    <?php } ?>

                </table>
            <?php } ?>
            <span class="wpuf-help"><?php echo stripslashes( $attr['help'] ); ?></span>
        </div>
    <?php

    }

    /**
     * Prints a date field
     *
     * @param array $attr
     * @param int|null $post_id
     */
    public static function date( $attr, $post_id, $type, $form_id, $obj ) {

        $value = $post_id ? $obj->get_meta( $post_id, $attr['name'], $type, true ) : '';
        ?>

        <?php
        // if date field is assigned as publish date
        if ( isset ( $attr['is_publish_time'] ) && $attr['is_publish_time'] == 'yes' ) {
            ?>
            <input type="hidden" name="wpuf_is_publish_time" value="<?php echo $attr['name']; ?>" />
            <?php
        }
        ?>
        <div class="wpuf-fields">
            <input id="wpuf-date-<?php echo $attr['name']; ?>" type="text" class="datepicker <?php echo ' wpuf_'.$attr['name'].'_'.$form_id; ?>" data-required="<?php echo $attr['required'] ?>" data-type="text"<?php $obj->required_html5( $attr ); ?> name="<?php echo esc_attr( $attr['name'] ); ?>" value="<?php echo esc_attr( $value ) ?>" size="30" />
            <span class="wpuf-help"><?php echo stripslashes( $attr['help'] ); ?></span>
        </div>
        <script type="text/javascript">
            jQuery(function($) {
                <?php if ( $attr['time'] == 'yes' ) { ?>
                $("#wpuf-date-<?php echo $attr['name']; ?>").datetimepicker({ dateFormat: '<?php echo $attr["format"]; ?>' });
                <?php } else { ?>
                $("#wpuf-date-<?php echo $attr['name']; ?>").datepicker({ dateFormat: '<?php echo $attr["format"]; ?>' });
                <?php } ?>
            });
        </script>

    <?php
    }

    /**
     * Prints a file upload field
     *
     * @param array $attr
     * @param int|null $post_id
     */
    public static function file_upload( $attr, $post_id, $type, $form_id, $obj ) {
        $allowed_ext = '';
        $extensions = wpuf_allowed_extensions();

        if ( is_array( $attr['extension'] ) ) {
            foreach ($attr['extension'] as $ext) {
                $allowed_ext .= $extensions[$ext]['ext'] . ',';
            }
        } else {
            $allowed_ext = '*';
        }

        $uploaded_items = $post_id ? $obj->get_meta( $post_id, $attr['name'], $type, false ) : array();
        ?>

        <div class="wpuf-fields">
            <div id="wpuf-<?php echo $attr['name']; ?>-upload-container">
                <div class="wpuf-attachment-upload-filelist" data-type="file" data-required="<?php echo $attr['required']; ?>">
                    <a id="wpuf-<?php echo $attr['name']; ?>-pickfiles" data-form_id="<?php echo $form_id; ?>" class="button file-selector <?php echo ' wpuf_'.$attr['name'].'_'.$form_id; ?>" href="#"><?php _e( 'Select File(s)', 'wpuf' ); ?></a>

                    <ul class="wpuf-attachment-list thumbnails">
                        <?php
                        if ( $uploaded_items ) {
                            foreach ($uploaded_items as $attach_id) {
                                echo WPUF_Upload::attach_html( $attach_id, $attr['name'] );

                                if ( is_admin() ) {
                                    printf( '<a href="%s">%s</a>', wp_get_attachment_url( $attach_id ), __( 'Download File', 'wpuf' ) );
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div><!-- .container -->

            <span class="wpuf-help"><?php echo stripslashes( $attr['help'] ); ?></span>

        </div> <!-- .wpuf-fields -->

        <script type="text/javascript">
            jQuery(function($) {
                new WPUF_Uploader('wpuf-<?php echo $attr['name']; ?>-pickfiles', 'wpuf-<?php echo $attr['name']; ?>-upload-container', <?php echo $attr['count']; ?>, '<?php echo $attr['name']; ?>', '<?php echo $allowed_ext; ?>', <?php echo $attr['max_size'] ?>);
            });
        </script>
    <?php
    }

    /**
     * Prints a map field
     *
     * @param array $attr
     * @param int|null $post_id
     */
    public static function map( $attr, $post_id, $type, $form_id, $classname, $obj ) {

        $value = $post_id ? $obj->get_meta( $post_id, $attr['name'], $type, true ) : '';
        $type = $attr['show_lat'] == 'yes' ? 'text' : 'hidden';
        if ( empty( $value ) ) {
            $value = ',';
        }

        if ( $post_id ) {
            list( $def_lat, $def_long ) = explode( ',', $value );
        } else {
            list( $def_lat, $def_long ) = explode( ',', $attr['default_pos'] );
        }
        ?>

        <div class="wpuf-fields <?php echo ' wpuf_'.$attr['name'].'_'.$form_id; ?>">
            <input id="wpuf-map-lat-<?php echo $attr['name']; ?>" type="<?php echo $type; ?>" data-required="<?php echo $attr['required'] ?>" data-type="text" <?php $obj->required_html5( $attr ); ?> name="<?php echo esc_attr( $attr['name'] ); ?>" value="<?php echo esc_attr( $value ) ?>" size="30" />

            <?php if ( $attr['address'] == 'yes' ) { ?>
                <input id="wpuf-map-add-<?php echo $attr['name']; ?>" type="text" value="" name="find-address" placeholder="<?php _e( 'Type an address to find', 'wpuf' ); ?>" size="30" />
                <button class="wpuf-button button" id="wpuf-map-btn-<?php echo $attr['name']; ?>"><?php _e( 'Find Address', 'wpuf' ); ?></button>
            <?php } ?>

            <div class="google-map" style="margin: 10px 0; height: 250px; width: 450px;" id="wpuf-map-<?php echo $attr['name']; ?>"></div>
            <span class="wpuf-help"><?php echo stripslashes( $attr['help'] ); ?></span>
        </div>
        <script type="text/javascript">

            (function($) {
                $(function() {
                    var def_zoomval = <?php echo $attr['zoom']; ?>;
                    var def_longval = <?php echo $def_long ? $def_long : 0; ?>;
                    var def_latval = <?php echo $def_lat ? $def_lat : 0; ?>;
                    var curpoint = new google.maps.LatLng(def_latval, def_longval),
                        geocoder   = new window.google.maps.Geocoder(),
                        $map_area = $('#wpuf-map-<?php echo $attr['name']; ?>'),
                        $input_area = $( '#wpuf-map-lat-<?php echo $attr['name']; ?>' ),
                        $input_add = $( '#wpuf-map-add-<?php echo $attr['name']; ?>' ),
                        $find_btn = $( '#wpuf-map-btn-<?php echo $attr['name']; ?>' );

                    autoCompleteAddress();

                    $find_btn.on('click', function(e) {
                        e.preventDefault();
                        geocodeAddress( $input_add.val() );
                    });

                    var gmap = new google.maps.Map( $map_area[0], {
                        center: curpoint,
                        zoom: def_zoomval,
                        mapTypeId: window.google.maps.MapTypeId.ROADMAP
                    });

                    var marker = new window.google.maps.Marker({
                        position: curpoint,
                        map: gmap,
                        draggable: true
                    });

                    window.google.maps.event.addListener( gmap, 'click', function ( event ) {
                        marker.setPosition( event.latLng );
                        updatePositionInput( event.latLng );
                    } );

                    window.google.maps.event.addListener( marker, 'drag', function ( event ) {
                        updatePositionInput(event.latLng );
                    } );

                    function updatePositionInput( latLng ) {
                        $input_area.val( latLng.lat() + ',' + latLng.lng() );
                    }

                    function updatePositionMarker() {
                        var coord = $input_area.val(),
                            pos, zoom;

                        if ( coord ) {
                            pos = coord.split( ',' );
                            marker.setPosition( new window.google.maps.LatLng( pos[0], pos[1] ) );

                            zoom = pos.length > 2 ? parseInt( pos[2], 10 ) : 12;

                            gmap.setCenter( marker.position );
                            gmap.setZoom( zoom );
                        }
                    }

                    function geocodeAddress( address ) {
                        geocoder.geocode( {'address': address}, function ( results, status ) {
                            if ( status == window.google.maps.GeocoderStatus.OK ) {
                                updatePositionInput( results[0].geometry.location );
                                marker.setPosition( results[0].geometry.location );
                                gmap.setCenter( marker.position );
                                gmap.setZoom( 15 );
                            }
                        } );
                    }

                    function autoCompleteAddress(){
                        if (!$input_add) return null;

                        $input_add.autocomplete({
                            source: function(request, response) {
                                // TODO: add 'region' option, to help bias geocoder.
                                geocoder.geocode( {'address': request.term }, function(results, status) {
                                    response(jQuery.map(results, function(item) {
                                        return {
                                            label     : item.formatted_address,
                                            value     : item.formatted_address,
                                            latitude  : item.geometry.location.lat(),
                                            longitude : item.geometry.location.lng()
                                        };
                                    }));
                                });
                            },
                            select: function(event, ui) {

                                $input_area.val(ui.item.latitude + ',' + ui.item.longitude );

                                var location = new window.google.maps.LatLng(ui.item.latitude, ui.item.longitude);

                                gmap.setCenter(location);
                                // Drop the Marker
                                setTimeout( function(){
                                    marker.setValues({
                                        position    : location,
                                        animation   : window.google.maps.Animation.DROP
                                    });
                                }, 1500);
                            }
                        });
                    }

                });
            })(jQuery);
        </script>

    <?php
    }

    /**
     * Prints an Country List
     *
     * @param array $attr
     * @param int $post_id
     * @param string $type
     * @param @form_id
     */
    public static function country_list( $attr, $post_id, $type = 'post', $form_id = null, $classname, $obj ){
        $list_visibility_option = $attr['country_list']['country_list_visibility_opt_name'];
        $country_select_hide_list = isset( $attr['country_list']['country_select_hide_list'] ) && is_array( $attr['country_list']['country_select_hide_list'] )?$attr['country_list']['country_select_hide_list']:array();
        $country_select_show_list = isset( $attr['country_list']['country_select_show_list'] ) && is_array( $attr['country_list']['country_select_show_list'] )?$attr['country_list']['country_select_show_list']:array();
        if ( $obj->is_meta( $attr ) ) {
            $sel_val = $obj->get_meta( $post_id, $attr['name'], $type );
        }
        $value = !empty( $sel_val ) ? $sel_val : ( isset( $attr['country_list']['name'] ) ? $attr['country_list']['name'] : '' );
        ?>
        <div class="wpuf-fields">
            <select name="<?php echo $attr['name']; ?>">

            </select>
            <script>
                var field_name = '<?php echo $attr['name'];?>';
                var countries = <?php echo file_get_contents(WPUF_ASSET_URI . '/js/countries.json');?>;
                var banned_countries = JSON.parse('<?php echo json_encode($country_select_hide_list); ?>');
                var allowed_countries = JSON.parse('<?php echo json_encode($country_select_show_list); ?>');
                var list_visibility_option = '<?php echo $list_visibility_option; ?>';
                var sel_country = '<?php echo !empty( $value ) ? $value : '' ; ?>';

                var option_string = '<option value="">Select Country</option>';
                if( list_visibility_option == 'hide' ){
                    for(country in countries){
                        if( jQuery.inArray(countries[country].code,banned_countries) != -1 ){
                            continue;
                        }
                        option_string = option_string + '<option value="'+ countries[country].code +'" ' + ( sel_country == countries[country].code ? 'selected':'' ) + ' >'+ countries[country].name +'</option>';
                    }
                }else if ( list_visibility_option == 'show' ) {
                    for(country in countries){
                        if( jQuery.inArray(countries[country].code,allowed_countries) != -1 ){
                            option_string = option_string + '<option value="'+ countries[country].code +'" ' + ( sel_country == countries[country].code ? 'selected':'' ) + ' >'+ countries[country].name +'</option>';
                        }

                    }
                }else {
                    for (country in countries) {
                        option_string = option_string + '<option value="'+ countries[country].code +'" ' + ( sel_country == countries[country].code ? 'selected':'' ) + ' >'+ countries[country].name +'</option>';
                    }
                }

                jQuery('select[name="'+ field_name +'"]').html(option_string);
            </script>
        </div>
    <?php

    }

    public static function numeric_text( $attr, $post_id, $type = 'post', $form_id = null, $classname, $obj ) {
        // checking for user profile username
        $username = false;
        $taxonomy = false;

        if ( $post_id ) {

            if ( $obj->is_meta( $attr ) ) {
                $value = $obj->get_meta( $post_id, $attr['name'], $type );
            } else {

                // applicable for post tags
                if ( $type == 'post' && $attr['name'] == 'tags' ) {
                    $post_tags = wp_get_post_tags( $post_id );
                    $tagsarray = array();
                    foreach ($post_tags as $tag) {
                        $tagsarray[] = $tag->name;
                    }

                    $value = implode( ', ', $tagsarray );
                    $taxonomy = true;
                } elseif ( $type == 'post' ) {
                    $value = get_post_field( $attr['name'], $post_id );
                } elseif ( $type == 'user' ) {
                    $value = get_user_by( 'id', $post_id )->$attr['name'];

                    if ( $attr['name'] == 'user_login' ) {
                        $username = true;
                    }
                }
            }
        } else {
            $value = $attr['default'];

            if ( $type == 'post' && $attr['name'] == 'tags' ) {
                $taxonomy = true;
            }
        }

        ?>

        <div class="wpuf-fields wpuf-numeric_text_holder">
            <input class="textfield<?php echo $obj->required_class( $attr );  echo ' wpuf_'.$attr['name'].'_'.$form_id; ?>" id="<?php echo $numeric_field_id = $attr['name']; ?>" type="number" min="<?php echo $attr['min_value_field'];?>" max="<?php echo $attr['max_value_field']; ?>" step="<?php echo $attr['step_text_field']; ?>" data-required="<?php echo $attr['required'] ?>" data-type="text"<?php $obj->required_html5( $attr ); ?> name="<?php echo esc_attr( $attr['name'] ); ?>" placeholder="<?php echo esc_attr( $attr['placeholder'] ); ?>" value="<?php echo esc_attr( $value ) ?>" size="<?php echo esc_attr( $attr['size'] ) ?>" <?php echo $username ? 'disabled' : ''; ?> />
            <span class="wpuf-help"><?php echo stripslashes( $attr['help'] ); ?></span>
            <script>
                jQuery(function($) {
                    $("#<?php echo $numeric_field_id;?>").keydown(function (e) {
                        // Allow: backspace, delete, tab, escape, minus enter and . backspace = 8,delete=46,tab=9,enter=13,.=190,escape=27, minus = 189
                        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190, 189]) !== -1 ||
                            // Allow: Ctrl+A
                            (e.keyCode == 65 && e.ctrlKey === true) ||
                            // Allow: home, end, left, right, down, up
                            (e.keyCode >= 35 && e.keyCode <= 40)) {
                            // let it happen, don't do anything
                            return;
                        }
                        // Ensure that it is a number and stop the keypress
                        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                            e.preventDefault();
                        }
                    });
                });
            </script>

            <?php if ( $taxonomy ) { ?>
                <script type="text/javascript">
                    jQuery(function($) {
                        $('li.tags input[name=tags]').suggest( wpuf_frontend.ajaxurl + '?action=ajax-tag-search&tax=post_tag', { delay: 500, minchars: 2, multiple: true, multipleSep: ', ' } );


                    });
                </script>
            <?php } ?>
        </div>

    <?php
    }

    /**
     * Prints an address field
     *
     * @param array $attr
     * @param int $post_id
     * @param string $type
     * @param @form_id
     */
    public static function address_field( $attr, $post_id, $type = 'post', $form_id = null, $classname, $obj ){
        // checking for user profile username
        $username = false;
        $taxonomy = false;

        if ( $post_id ) {

            if ( $obj->is_meta( $attr ) ) {
                $value = $obj->get_meta( $post_id, $attr['name'], $type );
            } else {

                // applicable for post tags
                if ( $type == 'post' && $attr['name'] == 'tags' ) {
                    $post_tags = wp_get_post_tags( $post_id );
                    $tagsarray = array();
                    foreach ($post_tags as $tag) {
                        $tagsarray[] = $tag->name;
                    }

                    $value = implode( ', ', $tagsarray );
                    $taxonomy = true;
                } elseif ( $type == 'post' ) {
                    $value = get_post_field( $attr['name'], $post_id );
                } elseif ( $type == 'user' ) {
                    $value = get_user_by( 'id', $post_id )->$attr['name'];

                    if ( $attr['name'] == 'user_login' ) {
                        $username = true;
                    }
                }
            }
        } else {
            //$value = $attr['default'];

            if ( $type == 'post' && $attr['name'] == 'tags' ) {
                $taxonomy = true;
            }
        }
        ?>
        <div class="wpuf-fields">
            <span class="wpuf-help"><?php echo stripslashes( $attr['help'] ); ?></span>
        </div>
        <div class="clear"></div>

        <?php

        $address_fields_meta = isset( $value ) ? $value : array();
        $country_select_hide_list = isset( $attr['address']['country_select']['country_select_hide_list'] ) ? $attr['address']['country_select']['country_select_hide_list'] : array();
        $country_select_show_list = isset( $attr['address']['country_select']['country_select_show_list'] ) ? $attr['address']['country_select']['country_select_show_list'] : array();
        $list_visibility_option = $attr['address']['country_select']['country_list_visibility_opt_name'];

        foreach( $attr['address'] as $each_field => $field_array ){

            ?>
            <div class="wpuf-address-field">
                <?php

                if ( isset( $field_array['checked'] ) && !empty( $field_array['checked'] ) ) {
                    ?>
                    <div class="wpuf-label">
                        <label><?php echo $field_array['label']; ?></label>
                        <span class="required"><?php echo ( isset( $field_array['required'] ) && !empty($field_array['required']) ) ? '*' : ''; ?></span>
                    </div>

                    <div class="wpuf-fields">
                        <?php
                        if ( in_array($field_array['type'], array( 'text', 'hidden', 'email', 'password') ) ) {
                            ?>
                        <input type="<?php echo $field_array['type']; ?>" name="<?php  echo $attr['name'] . '[' . $each_field . ']'; ?>" value="<?php echo isset( $address_fields_meta[$each_field] )?esc_attr($address_fields_meta[$each_field]):$field_array['value']; ?>" placeholder="<?php echo $field_array['placeholder']?>" class="textfield" size="40" <?php echo isset( $field_array['required'] ) && !empty( $field_array['required'] ) ? 'required' : ''; ?> />
                        <?php
                        } elseif ( in_array($field_array['type'],array('textarea','select') ) ){
                        echo '<'.$field_array['type'].' name="'. $attr['name'] . '[' . $each_field . ']' . '" '.( isset( $field_array['required'] ) && !empty( $field_array['required'] ) ? 'required' : '').'>';
                        echo '</'.$field_array['type'].'>';

                        if ( $each_field == 'country_select' ) {

                        $address_fields_meta['country_select'] = isset($address_fields_meta['country_select'])?$address_fields_meta['country_select']:$field_array['value'];
                        ?>
                            <script>
                                var field_name        = '<?php echo $attr['name'] . '[' . $each_field . ']' ; ?>';
                                var countries         = <?php echo file_get_contents(WPUF_ASSET_URI . '/js/countries.json');?>;
                                var banned_countries  = JSON.parse('<?php echo json_encode( $country_select_hide_list ) ?>');
                                var allowed_countries = JSON.parse('<?php echo json_encode( $country_select_show_list ); ?>');
                                var list_visibility_option = '<?php echo $list_visibility_option; ?>';
                                var option_string     = '<option value="">Select Country</option>';
                                var sel_country = '<?php echo isset($address_fields_meta['country_select'])?$address_fields_meta['country_select']:''; ?>';


                                if ( list_visibility_option == 'hide' ) {
                                    for (country in countries){
                                        if ( jQuery.inArray(countries[country].code,banned_countries) != -1 ){
                                            continue;
                                        }
                                        option_string = option_string + '<option value="'+ countries[country].code +'" ' + ( sel_country == countries[country].code ? 'selected':'' ) + ' >'+ countries[country].name +'</option>';
                                    }
                                } else if( list_visibility_option == 'show' ) {
                                    for (country in countries){
                                        if ( jQuery.inArray(countries[country].code,allowed_countries) != -1 ) {
                                            option_string = option_string + '<option value="'+ countries[country].code +'" ' + ( sel_country == countries[country].code ? 'selected':'' ) + ' >'+ countries[country].name +'</option>';
                                        }

                                    }
                                } else {
                                    for (country in countries){
                                        option_string = option_string + '<option value="'+ countries[country].code +'" ' + ( sel_country == countries[country].code ? 'selected':'' ) + ' >'+ countries[country].name +'</option>';
                                    }
                                }

                                jQuery('select[name="'+ field_name +'"]').html(option_string);
                            </script>
                        <?php
                        }

                        }
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }

    }

    /**
     * fieldset start
     * @param $attr
     * @param $post_id
     * @param string $type
     * @param null $form_id
     */
    public static function step_start( $attr, $post_id, $type = 'post', $form_id = null, $multiform_start, $enable_multistep, $obj ) {

        if ( $obj->multiform_start == 1 && !empty( $obj->multiform_start ) ) {
            ?>

            </fieldset>
        <?php
        } else{
            $obj->multiform_start = 1;
        }

        if ( !empty( $enable_multistep ) ) {
            ?>
            <fieldset class="wpuf-multistep-fieldset">
                <legend>
                    <?php echo $attr['label'];?>
                </legend>
                <button class="wpuf-multistep-prev-btn btn btn-primary"><?php echo $attr['step_start']['prev_button_text']; ?></button>
                <button class="wpuf-multistep-next-btn btn btn-primary"><?php echo $attr['step_start']['next_button_text']; ?></button>

        <?php
        }
        //return $obj->multiform_start;
    }

    /**
     * Prints recaptcha field
     *
     * @param array $attr
     */
    public static function recaptcha( $attr, $post_id, $form_id ) {

        if ( $post_id ) {
            return;
        }
        if ( isset ( $attr['enable_no_captcha'] ) && $attr['enable_no_captcha'] == 'enabled' ) {
            $enable_no_captcha = true;
        } else {
            $enable_no_captcha = false;
        }
        ?>

        <div class="wpuf-fields <?php echo ' wpuf_'.$attr['name'].'_'.$form_id; ?>">
            <?php echo recaptcha_get_html( wpuf_get_option( 'recaptcha_public', 'wpuf_general' ), $enable_no_captcha, null, is_ssl() ); ?>
        </div>
    <?php
    }

    /**
     * Prints really simple captcha
     *
     * @param array $attr
     * @param int|null $post_id
     */
    public static function really_simple_captcha( $attr, $post_id, $form_id ) {

        if ( $post_id ) {
            return;
        }

        if ( !class_exists( 'ReallySimpleCaptcha' ) ) {
            ?>
            <div class="wpuf-fields <?php  echo ' wpuf_'.$attr['name'].'_'.$form_id; ?>">
                <?php
                _e( 'Error: Really Simple Captcha plugin not found!', 'wpuf' );
                ?>
            </div>
            <?php
            return;
        }



        $captcha_instance = new ReallySimpleCaptcha();
        $word = $captcha_instance->generate_random_word();
        $prefix = mt_rand();
        $image_num = $captcha_instance->generate_image( $prefix, $word );
        ?>
        <div class="wpuf-fields <?php  echo ' wpuf_'.$attr['name'].'_'.$form_id; ?>">
            <img src="<?php echo plugins_url( 'really-simple-captcha/tmp/' . $image_num ); ?>" alt="Captcha" />
            <input type="text" name="rs_captcha" value="" />
            <input type="hidden" name="rs_captcha_val" value="<?php echo $prefix; ?>" />
        </div>
    <?php
    }

    /**
     * Prints a action hook
     *
     * @param array $attr
     * @param int $form_id
     * @param int|null $post_id
     * @param array $form_settings
     */
    public static function action_hook( $attr, $form_id, $post_id, $form_settings ) {

        if ( !empty( $attr['label'] ) ) {
            do_action( $attr['label'], $form_id, $post_id, $form_settings );
        }
    }

    /**
     * Prints a HTML field
     *
     * @param array $attr
     */
    public static function toc( $attr, $post_id, $form_id ) {
        if ( $post_id ) {
            return;
        }
        ?>
        <div class="wpuf-label">
            &nbsp;
        </div>

        <div data-required="yes" data-type="radio" class="wpuf-fields <?php echo ' wpuf_'.$attr['name'].'_'.$form_id; ?>">

            <textarea rows="10" cols="40" disabled="disabled" name="toc"><?php echo $attr['description']; ?></textarea>
            <label>
                <input type="checkbox" name="wpuf_accept_toc" required="required" /> <?php echo $attr['label']; ?>
            </label>
        </div>
    <?php
    }

}