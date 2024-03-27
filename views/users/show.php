<div class="container5">
  <ul class="list-group col-3 fw-medium m-auto mt-1">
    <li class="list-group-item d-flex justify-content-between align-items-center m-auto">
    Mon profil
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Identifiant
      <span class="badge bg-primary fw-normal"><?= $users->getId_user() 
          ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Nom
      <span class="badge bg-primary fw-normal"><?= $users->getLast_name() ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Prénom
      <span class="badge bg-primary fw-normal"><?= $users->getFirst_name() ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Email
      <span class="badge bg-primary fw-normal"><?= $users->getEmail() ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Status
      <span class="badge bg-primary fw-normal"><?= $users->getRole() ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Anniversaire
      <span class="badge bg-primary fw-normal"><?= date("d-m-Y", strtotime($users->getBirthday())) ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Adresse
      <span class="badge bg-primary fw-normal"><?= $users->getAddress() ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    N° de tel
      <span class="badge bg-primary fw-normal"><?= $users->getPhone_number() ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Civilité
      <span class="badge bg-primary fw-normal"><?= $users->getGender() ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center m-auto">
    
      <a href="<?= addLink("cart","detailCart") ?>" class="btn bg-primary link-light fw-medium">mon panier</a>
    </li>
  </ul>
</div>