(function($) {
    'use strict';

    wp.customize.bind('ready', function() {

        //initialize
        social_links_check();


        function social_links_check() {

            // array controls ids
            var $control_ids = [
                'hikaru_pinterest_url_control',
                'hikaru_facebook_url_control',
                'hikaru_twitter_url_control',
                'hikaru_linkedin_url_control',
                'hikaru_google_url_control',
                'hikaru_whatsapp_number_control'

            ];

            console.log(wp.customize.instance('hikaru_show_menu_social').get());

            if (wp.customize.instance('hikaru_show_menu_social').get()) {
                $.each($control_ids, function(id, value) {
                    $('#customize-control-' + value).fadeIn();
                });
            } else {
                $.each($control_ids, function(id, value) {
                    $('#customize-control-' + value).fadeOut();
                });
            }
        }


        // on change values....
        wp.customize.control('hikaru_show_menu_social_control', function(control) {
            control.setting.bind(function(value) {
                // check state
                console.log('cahnge');
                social_links_check();
            });

        });



    });


})(jQuery);