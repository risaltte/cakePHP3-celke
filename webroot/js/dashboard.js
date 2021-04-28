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


function previewImagem() {
    var imagem = document.querySelector('input[name=imagem]').files[0];
    var preview = document.querySelector('#preview-img');

    var reader = new FileReader();
    reader.onloadend = function () {
        preview.src = reader.result;
    };

    var imagemAntiga = preview.src

    if (imagem) {
        reader.readAsDataURL(imagem);
    } else {
        preview.src = imagemAntiga;
    }
}
