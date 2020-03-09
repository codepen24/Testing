(function($) {

    $(document).ready(function() {

        $('.home .profile-achievements-listing').addClass('custom');

        $('.profile-achievements-listing .widget-achievements-listing-item').addClass('match-item');





        $('.badgeos_achievement_main_container').addClass('home_badge_os');

        $('.home_badge_os .badgeos-achievements-list-item').addClass('match-item');
 
        $(".match-item").matchHeight({
            byRow: false,
        });
       
        $(".match-all-item").matchHeight({
            byRow: false,
        });

    });

})(jQuery);
