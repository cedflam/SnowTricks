
// Ce code permet de faire le tri par catégories sur la page d'accueil
//Je gère l'affichage de tous les tricks
$('#tous').click(function (event) {
    event.preventDefault();
    //Classe courante au clic sur le badge
    $(this).addClass('current');
    //J'enlève la class hidden à tous les éléments
    $('.gallery').find('div.card').removeClass('hidden');
});
//Je gère l'affichage des grabs
$('#grab').click(function (event) {
    event.preventDefault();
    //Si le click est détécté alors j'ajoute la classe courante
    $(this).addClass('current');
    //J'enlève la classe hidden à l'ensemble des éléments 
    $('.gallery').find('div.card').removeClass('hidden');
    //J'ajoute la classe hidden à tous les éléments != grab 
    $('.gallery').find('div.card:not(.grab)').addClass('hidden');
});
//Je gère l'affichage des slides
$('#slide').click(function (event) {
    event.preventDefault();
    $(this).addClass('current');
    $('.gallery').find('div.card').removeClass('hidden');
    $('.gallery').find('div.card:not(.slide)').addClass('hidden');

});
//Je gère l'affichage des rotation
$('#rotation').click(function (event) {
    event.preventDefault();
    $(this).addClass('current');
    $('.gallery').find('div.card').removeClass('hidden');
    $('.gallery').find('div.card:not(.rotation)').addClass('hidden');
});
//Je gère l'affichage des flips
$('#flip').click(function (event) {
    event.preventDefault();
    $(this).addClass('current');
    $('.gallery').find('div.card').removeClass('hidden');
    $('.gallery').find('div.card:not(.flip)').addClass('hidden');
});
//Je gère l'affichage des old school
$('#old-school').click(function (event) {
    event.preventDefault();
    $(this).addClass('current');
    $('.gallery').find('div.card').removeClass('hidden');
    $('.gallery').find('div.card:not(.old-school)').addClass('hidden');
});


//Permet d'afficher les tricks par 4 et d'en 
//afficher plus en cliquant sur le bouton
$(".gallery").slice(0, 4).show();
if ($(".gallery:hidden").length != 0) {
    $("#loadMore").show();
}
$("#loadMore").on('click', function (e) {
    e.preventDefault();
    $(".gallery:hidden").slice(0, 4).slideDown();
    if ($(".gallery:hidden").length == 0) {
        $("#loadMore").fadeOut('fast');
    }
});