//Permet d'afficher les commentaires par 10 et d'en 
//afficher 10 de plus en cliquant sur le bouton
$(".comments").slice(0, 4).show();
if ($(".comments:hidden").length !== 0) {
    $("#loadMore").show();
}
$("#loadMore").on('click', function (e) {
    e.preventDefault();
    $(".comments:hidden").slice(0, 4).slideDown();
    if ($(".comments:hidden").length === 0) {
        $("#loadMore").fadeOut('fast');
    }
});


//Permet d'afficher les tricks par 10 et d'en 
//afficher plus en cliquant sur le bouton sur écran d'ordinateur

/* Je récupère la largeur de l'écran */
var size = $(window).width() ;
/* Si la taille de l'ecran est < 768px je cache les medias  */
if(size < 768){
    $(".gallery-detail").slice(0, 0).show();
/* Sinon j'affiche les figures par 10 */
}else{
    $(".gallery-detail").slice(0, 10).show();
}

if ($(".gallery-detail:hidden").length !== 0) {
    $("#loadMoreMedia").show();
}
$("#loadMoreMedia").on('click', function (e) {
    e.preventDefault();
    $(".gallery-detail:hidden").slice(0, 10).slideDown();
    if ($(".gallery-detail:hidden").length === 0) {
        $("#loadMoreMedia").fadeOut('fast');
    }
});
