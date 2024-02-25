<!--

Header style 1

-->

<div class="td-header-wrap td-header-style-1">



    <div class="td-header-top-menu-full td-container-wrap <?php echo td_util::get_option('td_full_top_bar'); ?>">

        <div class="td-container td-header-row td-header-top-menu">

            <?php td_api_top_bar_template::_helper_show_top_bar() ?>

        </div>

    </div>



    <div class="td-banner-wrap-full td-logo-wrap-full td-container-wrap <?php echo td_util::get_option('td_full_header'); ?>">

        <div class="td-container td-header-row td-header-header">

            <div class="td-header-sp-logo">

                <?php locate_template('parts/header/logo-h1.php', true);?>

            </div>

            <div class="td-header-sp-recs">
            <?php 
                if ( is_user_logged_in() ) {
                    $current_user = wp_get_current_user();
            ?>
                <style>
                    .td-header-style-1 .td-header-sp-recs {
                        margin: 0px 0 9px 0;
                    }
                    .blockUser{
                        width: 100%;
                        text-align: right;
                    }
                    .blockUser ul{
                        list-style: none;
                        margin: 0px;
                        padding: 0px;
                    }
                    .blockUser ul li{
                        font-size: 14px;
                        color: #111;
                        padding: 5px 0px;
                        display: inline-block;
                        margin: 0px;
                    }
                    .blockUser ul li a{
                        color: #111;
                    }
                    li.textBig{
                        text-transform: uppercase;
                    }
                </style>
                <div class="blockUser">
                    <ul>
                        <li>welcome <b><?php echo $current_user->display_name;?></b></li>
                        <li>|</li>
                        <li class="textBig"><a href="<?php echo wp_logout_url(get_home_url().'/policies-and-strategies/redd-project-database.html'); ?>">Logout</a></li>
                    </ul>
                </div>
            <?php 
                }
            ?>

                <!--ADDED BY IMYMEMINE-->

                <div class="my_custom_header">

                    <?php if(function_exists('the_widget')) echo the_widget('qTranslateXWidget', array('type' => 'both', 'hide-title' => true) ); ?>

                    <?php locate_template('searchform.php', true); ?>

                    <?php echo do_shortcode("[social_icons_group id='130']")?>

                </div>

                <!--------------------->

                <?php //locate_template('parts/header/ads.php', true); ?>

            </div>

        </div>

    </div>



    <div class="td-header-menu-wrap-full td-container-wrap <?php echo td_util::get_option('td_full_menu'); ?>">

        <div class="td-header-menu-wrap td-header-gradient">

            <div class="td-container td-header-row td-header-main-menu">

                <?php locate_template('parts/header/header-menu.php', true);?>

            </div>

        </div>

    </div>



</div>