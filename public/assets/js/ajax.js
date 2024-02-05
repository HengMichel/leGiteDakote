// function addToCartAjax() {
//   $(".add_cart").click(function () {
//     var inputId = $(this).attr("id");
//     var url_cart = "cart/addToCart/" + inputId;

//     $.ajax({
//       url: url_cart,
//       data: "qte=1",
//       dataType: "json",
//       success: (data) => {
//         // Récupérer le nombre actuel du panier
//         let currentCount = parseInt($("#nombre").html()) || 0;
//         // Mettre à jour le nombre dans la barre de navigation
//         let newCount = currentCount + 1;
//         $("#nombre").html(newCount);

//         console.log("nb produits dans mon panier = " + newCount);

//         // Stocker le nombre dans le sessionStorage
//         sessionStorage.setItem("cartCount", newCount);

//         if (data.error) {
//             console.log("Erreur :", data.message);
//         } else if (data.count !== null && typeof data.count !== 'undefined') {           
//             $("#nombre").html(data.count);
//             console.log("nb produits dans mon deuxième panier =", data.count);
//         } else {
//             console.log("Cas non géré dans la réponse du serveur");
//         }

//         // Vérifie la valeur après la mise à jour du DOM
//         console.log("Nombre après mise à jour du DOM :", $("#nombre").html());

//         // Ajoute la nouvelle classe "cart-counter" pour référence future
//         $(".num").addClass("cart-counter");
//       },
//       error: (jqXHR, status, error) => {
//         console.log("ERREUR AJAX", status, error);
//         console.log("Message d'erreur:", jqXHR.responseText);      
//       },
//     });
//   });
// }

// function delectToCartAjax() {
//   $(".delect_cart").click(function(){
//     var inputId = $(this).attr("id");
//     var url_cart = "cart/delectToCart/" + inputId;

//     $.ajax({
//       url: url_cart,
//       data: "qte=1",
//       dataType: "json",
//       success: (data) => {
//         // Récupérer le nombre actuel du panier
//         let currentCount = parseInt($("#nombre").html()) || 0;

//         // Déclaration en dehors de la condition
//         let newCount = currentCount;

//         // Vérifie si le nombre est supérieur à 0 avant de décrémenter
//         if (currentCount > 0) {
//           // Décrémentez le nombre
//           newCount = currentCount - 1;
          
//           // Mettre à jour le nombre dans le DOM
//           $("#nombre").html(newCount);
          
//           console.log("nb produits dans mon panier = " + newCount);
          
//         }

//         // Mise à jour dans la sessionStorage si nécessaire
//         sessionStorage.setItem("cartCount", newCount || 0);

//         if (data.error) {

//           console.log("Erreur :", data.message);

//           // } else if (data.count !== null && typeof data.count !== 'undefined') { 
//           //   $("#nombre").html(data.count);
//           //   console.log("nb produits dans mon deuxième panier =", data.count);
//           // } else {
//           //   console.log("Cas non géré dans la réponse du serveur");
//           // }
//         } else if (
//           data.count !== null &&
//           typeof data.count !== "undefined"
//         ) {
//           $("#nombre").html(data.count);
//           console.log("nb produits dans mon deuxième panier =", data.count);
//         } else {
//           console.log("Cas non géré dans la réponse du serveur");
//         }

//           // Vérifie la valeur après la mise à jour du DOM
//           console.log("Nombre après mise à jour du DOM :", $("#nombre").html());
        
//           // Ajoute la nouvelle classe "cart-counter" pour référence future
//           $(".num").addClass("cart-counter");
//         },

//         error: (jqXHR, status, error) => {
//           console.log("ERREUR AJAX", status, error);
//           console.log("Message d'erreur:", jqXHR.responseText);      
//         },    
        
//     });
//   });
// }

// function addRoomToCartAjax(roomId) {
//   // console.log(roomId);
//   $("#form" + roomId).on("click", (evtSubmit) => {
//     evtSubmit.preventDefault();
//     var url_cart = "cart/addToCart/" + roomId;
//     $.ajax({
//       url: url_cart,
//       data: "qte=" + $("#field" + roomId).val(),
//       dataType: "json",
//       success: (data) => {
//         // data.count car data un un objet et non une  chaîne ou un nombre.
//         $("#nombre").html(data.count);
//         console.log("nb produits dans mon deuxième cart = " + data.count);
//       },
      
//       error: (jqXHR, status, error) => {
//         console.log("ERREUR AJAX", status, error);
//       },
//     });
//   });
// }




// Ajoute l'événement de changement de catégorie ici
$(document).ready(function() {

    $('#category').on('change',function(){

        //Récupère le contenu des attributs 'action' et 'method' du formulaire
        var action = $('#form').attr('action');
        var method = $('#form').attr('method');
        
        //Sérialise le contenu des champs du formulaire
        var formData = $('#form').serialize();

        //  pour déboguer
        // console.log(formData);

         //Utilisation de la méthode ajax de jQuery pour l'affichage de la réponse
         $.ajax({
             // Le fichier cible, celui qui fera le traitement
            url: action,

            // La méthode utilisée (POST, GET, etc.)
            type: method,

            // Les paramètres à fournir (champs sérialisés du formulaire)
            data: formData,

            // Le format des données attendues
            dataType: 'json', 
            success: function(response) {
        
                console.log("Response:", response);

    // Vérifiez si la réponse est un tableau
                if (Array.isArray(response)) { 

     // La fonction qui doit s'exécuter lors de la réussite de la communication Ajax
                    $('#resultat').html('');

    // Parcours chaque chambre dans le tableau
                    response.forEach(function(room) {

            // Créez un élément pour chaque chambre
                        var roomElement = $(
                            '<div class="card border-light border-3 mt-5" style="width: 22rem;">' +
                            '<div class="img_room">' +
                            '<img src="' + UPLOAD_CHAMBRES_IMG + room.room_imgs + '" class="card-img-top" alt="image">' +
                            '</div>' +
                            '<div class="card-body bg-dark">' +
                            '<p class="card-text fa-2x fw-medium link-light">' + room.price + '€/nuit</p>' +
                            '<p class="card-text link-warning fa-xl fw-medium">' + room.category + '</p>' +
                            '<p class="card-text fw-medium link-light">' + room.persons + ' Persons</p>' +
                            '<button type="submit" class="btn bg-warning fw-bolder border-black border-2">En savoir plus</button>' +
                            '</div>' +
                            '</div>'
                        );
                        
                        // Ajoutez l'élément de chambre au résultat
                        $('#resultat').append(roomElement);
                    });

                } else {

                    console.error('Réponse inattendue du serveur:', response);
                }
            },
        });
    });
})


