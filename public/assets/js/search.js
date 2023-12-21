$(document).ready(function() {
  var customLocalization = {
      "sSearch": "Rechercher",
      "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
      "sLengthMenu": "Afficher _MENU_ éléments",
      "sInfoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
      "sZeroRecords": "Aucun élément correspondant trouvé",
      "oPaginate": {
          "sFirst": "Premier",
          "sLast": "Dernier",
          "sNext": "Suivant",
          "sPrevious": "Précédent"
      },
  };

  var options = {
      language: customLocalization,
      paging: true,
      order: [],
      initComplete: function () {
        this.api().order([4, 'desc']).draw();
      },
      };

  $('#example').DataTable(options);
});

