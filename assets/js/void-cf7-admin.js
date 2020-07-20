(function($) {
    console.log('loaded admin js');
    // Hook into the "notice-my-class" class we added to the notice, so
    // Only listen to YOUR notices being dismissed
    $( document ).on( 'click', '.void-query-promotion-notice .notice-dismiss', function () {
        // Read the "data-notice" information to track which notice
        // is being dismissed and send it via AJAX
        var type = $( this ).closest( '.void-query-promotion-notice' ).data( 'notice' );
        // Make an AJAX call
        // Since WP 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.ajax( ajaxurl,
          {
            type: 'POST',
            data: {
              action: 'dismissed_promotional_notice_handler',
              type: type,
            }
          } );
      } );

})(jQuery);