$(document).ready(function () {
    // apresentar ou ocultar o menu
    $('.sidebar-toggle').on('click', function () {
        $('.sidebar').toggleClass('toggled');
    });

    // carregar aberto o submenu
    var active = $('.sidebar .active');
    if (active.length && active.parent('collapse').length) {
        var parent = active.parent('collapse');

        parent.prev('a').atrr('aria-expanded', true);
        parent.addClass('show');
    }
});