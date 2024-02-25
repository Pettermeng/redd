<form method="get" class="td-search-form-widget" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div role="search">
        <!--<input class="td-widget-search-input" type="text" value="<?php /*echo get_search_query(); */?>" name="s" id="s" /><input class="wpb_button wpb_btn-inverse btn" type="submit" id="searchsubmit" value="<?php /*_etd('Search', TD_THEME_NAME)*/?>" />-->
        <input class="td-widget-search-input" placeholder="<?php _e('[:en]Enter key words ...[:km]ស្វែងរក...[:]');?>" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
        <button class="wpb_button btn" style="background: #FFF;border-bottom: 1px solid #e1e1e1;border-top: 1px solid #e1e1e1;border-right: 1px solid #e1e1e1;" type="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
    </div>
</form>