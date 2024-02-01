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
    var inputId = $(this).attr("id");
    var url_cart = "cart/delectToCart/" + inputId;

    $.ajax({
      url: url_cart,
      data: "qte=1",
      dataType: "json",
      success: (data) => {
        // Récupérer le nombre actuel du panier
        let currentCount = parseInt($("#nombre").html()) || 0;

        // Déclaration en dehors de la condition
        let newCount = currentCount;

        // Vérifie si le nombre est supérieur à 0 avant de décrémenter
        if (currentCount > 0) {
          // Décrémentez le nombre
          newCount = currentCount - 1;
          
          // Mettre à jour le nombre dans le DOM
          $("#nombre").html(newCount);
          
          console.log("nb produits dans mon panier = " + newCount);
          
        }

        // Mise à jour dans la sessionStorage si nécessaire
        sessionStorage.setItem("cartCount", newCount || 0);

        if (data.error) {

          console.log("Erreur :", data.message);

          // } else if (data.count !== null && typeof data.count !== 'undefined') { 
          //   $("#nombre").html(data.count);
          //   console.log("nb produits dans mon deuxième panier =", data.count);
          // } else {
          //   console.log("Cas non géré dans la réponse du serveur");
          // }
        } else if (
          data.count !== null &&
          typeof data.count !== "undefined"
        ) {
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

function addRoomToCartAjax(roomId) {
  // console.log(roomId);
  $("#form" + roomId).on("click", (evtSubmit) => {
    evtSubmit.preventDefault();
    var url_cart = "cart/addToCart/" + roomId;
    $.ajax({
      url: url_cart,
      data: "qte=" + $("#field" + roomId).val(),
      dataType: "json",
      success: (data) => {
        // data.count car data un un objet et non une  chaîne ou un nombre.
        $("#nombre").html(data.count);
        console.log("nb produits dans mon deuxième cart = " + data.count);
      },
      
      error: (jqXHR, status, error) => {
        console.log("ERREUR AJAX", status, error);
      },
    });
  });
}




// Ajoute l'événement de changement de catégorie ici
$('#room').change(function() {
  var selectedCategory = $(this).val();

  $.ajax({
      url: 'ajax.js', // Remplacez par votre script de traitement AJAX
      type: 'POST',
      data: { category: selectedCategory },
      dataType: 'html',
      success: function(response) {
          // Mettez à jour la liste des chambres avec la réponse du serveur
          $('.d-flex.flex-wrap.justify-content-around').html(response);
      },
      error: function(error) {
          console.log('Erreur AJAX', error);
      }
  });
});

// <?php
// // ajax.php

// // Incluez vos fichiers nécessaires ici
// require_once 'chemin/vers/votre/fichier/RoomsRepository.php'; // Assurez-vous d'ajuster le chemin
// require_once 'chemin/vers/votre/fichier/RoomController.php'; // Assurez-vous d'ajuster le chemin

// // Obtenez la catégorie sélectionnée depuis la requête POST
// $category = $_POST['category'] ?? null;

// // Initialisez votre RoomsRepository et RoomController (ajustez le chemin si nécessaire)
// $roomsRepository = new RoomsRepository();
// $roomController = new RoomController();

// // Récupérez la liste des chambres en fonction de la catégorie
// $roomList = $roomController->getRoomsByCategory($roomsRepository, $category);

// // Affichez la liste des chambres (ajustez le format de sortie si nécessaire)
// foreach ($roomList as $room) {
//     echo '<div class="card border-light border-2 mt-5" style="width: 22rem;">';
//     // ... Affichez le contenu de chaque chambre ...
//     echo '</div>';
// }
// ?>



