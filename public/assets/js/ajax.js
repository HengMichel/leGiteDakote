function addToCartAjax() {
  $(".add_cart").click(function () {
    var inputId = $(this).attr("id");
    var url_cart = "cart/addToCart/" + inputId;

    $.ajax({
      url: url_cart,
      data: "qte=1",
      dataType: "json",
      success: (data) => {
      // Récupérer le nombre actuel du panier
       let currentCount = parseInt($("#nombre").html()) || 0;

      // Mettre à jour le nombre dans la barre de navigation
      let newCount = currentCount + 1;
      $("#nombre").html(newCount);
      console.log("nb produits dans mon panier = " + newCount);

      if (data.error) {
          console.log("Erreur :", data.message);
      } else if (data.count !== null && typeof data.count !== 'undefined') {           
          $("#nombre").html(data.count);
          console.log("nb produits dans mon deuxième panier =", data.count);
      } else {
          console.log("Cas non géré dans la réponse du serveur");
      }

      },
      error: (jqXHR, status, error) => {
        console.log("ERREUR AJAX", status, error);
        console.log("Message d'erreur:", jqXHR.responseText);      
      },
    });
  });
}

function addRoomsToCartAjax(idRoom) {
  
  $("#form" + idRoom).on("click", (evtSubmit) => {
    evtSubmit.preventDefault();
    var url_cart = "cart/addToCart/" + idRoom;


//modif ici  
console.log("AJAX URL:", url_cart);
// #############################

    $.ajax({
      url: url_cart,
      data: "qte=" + $("#field" + idRoom).val(),
      dataType: "json",
      success: (data) => {

        if (data.error) {
          console.log("Erreur :", data.message);
        } else if (data.count !== null && typeof data.count !== 'undefined') {           
          $("#nombre").html(data.count);
          console.log("nb produits dans mon deuxième panier =", data.count);
        } else {
          console.log("Cas non géré dans la réponse du serveur");
        }
    },
      error: (jqXHR, status, error) => {
        console.log("ERREUR AJAX", status, error);
        console.log("Message d'erreur:", jqXHR.responseText);

      },
    });
  });
}
