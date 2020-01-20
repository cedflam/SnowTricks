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