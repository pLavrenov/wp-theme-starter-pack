<?php

require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// проверяем активность плагина CF7
if(is_plugin_active( 'contact-form-7/wp-contact-form-7.php' )) :

add_filter('wpcf7_autop_or_not', '__return_false');


add_action('wp_footer', 'acf_listen_mail_sent');
function acf_listen_mail_sent() {
    ?>
    <script type="text/javascript">
        document.addEventListener( 'wpcf7mailsent', function( event ) {
            if (window.jQuery) {
                if(typeof $.fancybox !== "undefined") {
                    $.fancybox.open({
                        src  : '#modal-thank-you'
                    });
                }
            }
            /*
            if ( '123' == event.detail.contactFormId ) {
                //ga( 'send', 'event', 'Contact Form', 'submit' );
            }
            */
        }, false );
    </script>
    <?php
}




endif;