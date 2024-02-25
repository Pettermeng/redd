jQuery( document ).ready( function() {

  ls_isotope_process();

});



jQuery(document).ajaxSuccess(function() {
  
  ls_isotope_process();

});

function ls_isotope_process() {

  var ls_maxHeight = -1;
  jQuery('.lshowcase-isotope').each(function() {
      if (jQuery(this).height() > ls_maxHeight) {
          ls_maxHeight = jQuery(this).height();
      }
  });

  // init Isotope
  var $container = jQuery('.lshowcase-isotope-container').isotope({
    itemSelector: '.lshowcase-isotope',
     layoutMode: 'cellsByRow',
       cellsByRow: {
        columnWidth: '.lshowcase-isotope' ,
        rowHeight: ls_maxHeight
      }
    });

  // layout Isotope after each image loads
    $container.imagesLoaded().progress( function() {
      $container.isotope('layout');
    });

  jQuery('ul#ls-isotope-filter-nav li#ls-all').addClass('ls-current-li');
  
  jQuery('ul#ls-isotope-filter-nav li').on( 'click', function() {
    var filterValue = jQuery(this).attr('data-filter');

     jQuery('#ls-isotope-filter-nav > li').removeClass('ls-current-li');
     jQuery(this).addClass('ls-current-li');

    $container.isotope({ filter: filterValue });
  });

}

