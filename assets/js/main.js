$(document).ready(function(){
    $(".p").click(function(){
        alert("adsf asdfsd f")
    });

    var path = window.location.href;
    $(".nave-link").each(function () {
        var hre = $(this).attr('href');

        if (path === decodeURIComponent(hre)){
            $(this).addClass('active');
            var parent = $(this).closest('.has-treeview');
            parent.addClass('menu-open');
            parent.find('nav-link').first().addClass('active')
        }
    })
});