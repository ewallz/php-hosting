jQuery(document).ready(function($) {
	//Menu
        $('.menu-icon').on('click', function() {
                $('.menu-icon').toggleClass('glow');
                $('#header_top, #menu').slideToggle('medium');
                $('#header_top').insertAfter( $('#header_title'));

                $('#menu ul.dropdown li').click(function() {
                        $('#menu ul dropdown li ul.sub-menu').slideToggle('slow');
                });

                if($('#menu ul#menu-topmenu li').hasClass('current-menu-item')){
                        $('#menu ul#menu-topmenu li.current-menu-item ul.sub-menu, #menu ul#menu-topmenu li.current_page_parent ul.sub-menu').show();
                }
        });
})
