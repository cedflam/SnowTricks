//Permet d'ajouter un nouveau champs image 
$('#add-video').click(function(){
   
    //Je récupère le nombre de champs
    const index = +$('#widgets-counter').val();
    //Je récupère le prototype des entrées
    const tmpl = $('#figure_videos').data('prototype').replace(/__name__/g, index);
    //j'injecte le code dans la div 
    $('#figure_videos').append(tmpl);
    //J'incrémente le compteur 
    $('#widgets-counter').val(index + 1);

    //appel à la function du bouton supprimer
    handleDeleteButton();

});

//Permet de supprimer une image 
function handleDeleteButton(){
    $('button[ data-action = "delete" ]').click(function(){
        const target = this.dataset.target;
        $(target).remove();
    });
}

//Permet de mettre à jour le compteur 
function updateCounter(){
    const count = +$('#figure_videos div.form-group').length;
    $('#widgets-counter').val(count);
}

updateCounter();
handleDeleteButton();