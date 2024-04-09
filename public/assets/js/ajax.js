// ############## filter for category ##############################
$(document).ready(function () 
{
  $("#category").on("change", function () 
  {
    // Récupère la catégorie sélectionnée
    var category = $(this).val();
    $.ajax(
      {
        url: $("#form").attr("action"),
        type: $("#form").attr("method"),

        // Envoie uniquement la catégorie sélectionnée
        data: { choix: category },
        dataType: "json",
        success: function (response) 
        {
          console.log(response);
          // Affiche les nouvelles chambres sans effacer le formulaire de catégorie
          $("#roomsContainer").html("");
          response.forEach(function (room) 
          {
            var roomElement = $(
            '<div class="card border mt-5 " style="width: 22rem;">' +
              '<div class="img_room">' +
              '<img src="' +
              UPLOAD_CHAMBRES_IMG +
              room.room_imgs +
              '" class="card-img-top" alt="image">' +
              "</div>" +
              '<div class="card-body bg-dark">' +
              '<p class="card-text fa-2x fw-medium link-light">' +
              room.price +
              "€/nuit</p>" +
              '<p class="card-text link-warning fa-xl fw-medium">' +
              room.category +
              "</p>" +
              '<p class="card-text fw-medium link-light">' +
              room.persons +
              " Personnes</p>" +
              //  le bouton "En savoir plus" est ajouté dynamiquement à la page après que le DOM soit chargé
              '<button type="submit" class="btn btn-outline-light fw-bolder border en-savoir-plus" data-room-id="' +
              room.id_room +
              '">En savoir plus</button>' +
              "</div>" +
              "</div>"
            );
            $("#roomsContainer").append(roomElement);
          });
        },
      });
  });
  // Délègue l'événement de clic pour les boutons "En savoir plus" aux éléments statiques
  $(document).on("click", ".en-savoir-plus", function (e) 
  {
    // Empêche le formulaire de se soumettre
    e.preventDefault();
    console.log("Bouton 'En savoir plus' cliqué.");
    // Récupère l'ID de la chambre à partir de l'attribut de données
    var roomId = $(this).data("room-id");
    // Redirige vers show.php avec l'ID de la chambre
    window.location.href = "rooms/show?id=" + roomId;
  });
});
