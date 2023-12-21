$(document).ready(function() {
    // Lorsque le bouton "Détails" est cliqué
    $('.btn-details').click(function() {
        // Trouvez le bloc caché de la ligne parente (tr) du bouton cliqué
        var detailsRow = $(this).closest('tr').next('.details-row');

        // Alternez l'affichage du bloc caché en utilisant la méthode slideToggle()
        detailsRow.slideToggle();
    });
});
    
