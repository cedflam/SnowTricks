//Permet d'ajouter un nouveau champs image 
$('#add-image').click(function(){
    //Je récupère le nombre de champs
    const index = +$('#widgets-counter').val();
    //Je récupère le prototype des entrées
    const tmpl = $('#figure_images').data('prototype').replace(/__name__/g, index);
    //j'injecte le code dans la div 
    $('#figure_images').append(tmpl);
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
    const count = +$('#figure_images div.form-group').length;
    $('#widget-counter').val(count);
}

updateCounter();
handleDeleteButton();