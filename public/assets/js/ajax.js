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

        // Stocker le nombre dans le sessionStorage
        sessionStorage.setItem("cartCount", newCount);

        if (data.error) {
            console.log("Erreur :", data.message);
        } else if (data.count !== null && typeof data.count !== 'undefined') {           
            $("#nombre").html(data.count);
            console.log("nb produits dans mon deuxième panier =", data.count);
        } else {
            console.log("Cas non géré dans la réponse du serveur");
        }

        // Vérifie la valeur après la mise à jour du DOM
        console.log("Nombre après mise à jour du DOM :", $("#nombre").html());

        // Ajoute la nouvelle classe "cart-counter" pour référence future
        $(".num").addClass("cart-counter");
      },
      error: (jqXHR, status, error) => {
        console.log("ERREUR AJAX", status, error);
        console.log("Message d'erreur:", jqXHR.responseText);      
      },
    });
  });
}


function delectToCartAjax() {
  $(".delect_cart").click(function(){
  // Obtenez le nombre actuel du panier
  // ici pas bon .delect_cart 
  let currentCount = parseInt($(".delect_cart").html()) || 0;

  // Vérifiez si le nombre est supérieur à 0 avant de décrémenter
  if (currentCount > 0) {
    // Décrémentez le nombre
    let newCount = currentCount - 1;

    // Mettez à jour le nombre dans le DOM
      // ici pas bon .delect_cart 
    $(".delect_cart").html(newCount);

    // Mise à jour dans le sessionStorage si nécessaire
    sessionStorage.setItem("cartCount", newCount);
  }
});
}

