$(document).ready(function () {
    $('.settings__link').click(function (e) {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(e.target.hash).addClass('active');
        $(e.target.hash).siblings().removeClass('active');
    })

    $('.mobile-options').click(function () {
        $('.right-block').toggleClass('active');
    })

    $('.notifi-btn').click(function (e) {
        e.preventDefault();
        $('.notifications').toggleClass('show');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            type: "POST",
            url: window.location.origin + '/notify-mark',
            success: function () {
                $('.notifi-count').remove();
            }
        });
    })

    $('.notifications-delete').click(function (e) { 
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            type: "POST",
            url: window.location.origin + '/notify-delete',
            success: function () {
                $('.notification-item').remove();
            }
        });
    });

    $('#sidebar__toggle').click(function (e) { 
        e.preventDefault();

        let sidebar = $('#sidebar');
        
        if (window.innerWidth >= 1200) {
            $(sidebar).toggleClass('sidebar-min');
        } else if (window.innerWidth < 1200) {
            $(sidebar).toggleClass('sidebar-active');
        }
    });

    $('#user__menu-btn').click(function (e) { 
        e.preventDefault();
        
        let userMenu = $("#user__menu");
        $(userMenu).toggleClass('active');
    });
})