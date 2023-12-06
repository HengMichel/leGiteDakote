<?php 
session_start();
// si $_SESSION["role"] est définie mais que sa valeur est différente de "admin" ou bien $_SESSION["role"] n'est pas définie
if(!isset($_SESSION["role"]) || $_SESSION["role"] != "admin"){
  header("Location: http://localhost/projetGite/login.php");
  // header("Location: http://projetGite.com/login.php");
}
include_once "../inc/header.php"; 
?>

<div class="admin container d-flex justify-content-around border border-3 border-warning bg-dark" >
   
    <div class="card mt-5 m-3 w-25 border-warning border-3" style="width: 18rem;">
      <i class="fa-solid fa-plus text-center mt-3 fs-4 link-dark mb-2"></i>  
      <div class="card-body bg-success link-warning">
        <h5 class="card-title mt-2">Ajout chambre</h5>
        <p class="card-text mt-3">Cliquez ici pour ajouter une chambre</p>
        <a href="add_room.php" class="btn btn-primary bg-warning border-2 border-warning fw-medium mx-lg-5 mt-2 link-dark container">Ajouter une chambre</a>
      </div>
    </div>
    <div class="card mt-5 m-3 w-25 border-warning border-2" style="width: 18rem;">
      <i class="fa-solid fa-list text-center mt-3 fs-4 link-dark mb-2"></i>
      <div class="card-body bg-success link-warning">
        <h5 class="card-title mt-2">Liste réservation</h5>
        <p class="card-text mt-3">Cliquez ici pour voir la liste des réservations</p>
        <a href="#" class="btn btn-primary bg-warning  border-2 border-warning fw-medium mx-lg-5 mt-2 link-dark container">Liste réservation</a>
      </div>
    </div>

    <div class="card mt-5 m-3 w-25 border-warning border-2" style="width: 18rem;">
      <i class="fa-solid fa-list text-center mt-3 fs-4 link-dark mb-2"></i>
      <div class="card-body bg-success link-warning">
        <h5 class="card-title mt-2">Liste chambre</h5>
        <p class="card-text mt-3">Cliquez ici pour voir la liste des chambres</p>
        <a href="room_list.php" class="btn btn-primary bg-warning border-2 border-warning fw-medium mx-lg-5 mt-2 link-dark container">Liste chambre</a>
      </div>
    </div>
</div>

<?php include_once "../inc/footer.php"; ?>