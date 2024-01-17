function addToCartAjax() {
  $(".add_cart").click(function () {
  
    var inputId = $(this).attr("id");
    var url_cart = "cart/addToCart/" + inputId;

    $.ajax({
      url: url_cart,

      // Utilisez un objet pour spécifier les données
      data: "qte=1",
      dataType: "json",
      success: (data) => {

        // console.log("Contenu de la réponse :", data);
        // console.log("Données reçues du serveur :", data);

        // Récupérer le nombre actuel du panier
        let currentCount = parseInt($("#nombre").html()) || 0;
        let newCount = currentCount + 1;
        $("#nombre").html(newCount);
        console.log("nb produits dans mon panier = " + newCount);

        // check erreur
        // console.log("Données reçues du serveur :", data);
        // console.log("nb produits dans mon cart = " + data);
      },
      error: (jqXHR, status, error) => {

        // console.log("Statut de la requête :", status);


        console.log("ERREUR AJAX", status, error);

        // Afficher le message d'erreur dans la console
        console.log("Message d'erreur:", jqXHR.responseText);

          // En cas d'erreur, afficher le contenu de la réponse pour le débogage
          console.log(jqXHR.responseText);
      },
    });
  });
}

function addRoomsToCartAjax(idRoom) {
  
  $("#form" + idRoom).on("click", (evtSubmit) => {
    evtSubmit.preventDefault();
    var url_cart = "cart/addToCart/" + idRoom;
    $.ajax({
      url: url_cart,
      data: "qte=" + $("#field" + idRoom).val(),
      dataType: "json",
      success: (data) => {

        if (data.error) {
          // Afficher un message d'erreur lorsque la chambre n'est pas trouvée
          console.log("Erreur :", data.message);
        } else if (data.count !== undefined && data.count !== null) {
          // La propriété count est définie, l'afficher
          $("#nombre").html(data.count);
          console.log("nb produits dans mon deuxième panier =", data.count);
        } else {
          // Gérer d'autres cas si nécessaire
          console.log("Cas non géré dans la réponse du serveur");
        }
    },

      error: (jqXHR, status, error) => {
        console.log("ERREUR AJAX", status, error);
      },
    });
  });
}
