<div class="container5">
  <ul class="list-group col-6 fw-medium m-auto mt-1">
    <li class="list-group-item d-flex justify-content-between align-items-center m-auto">
    Mon profil
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Identifiant
      <span class="badge bg-white link-dark fs-5"><?= $users->getId_user() 
          ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Nom
      <span class="badge bg-white link-dark fs-5"><?= $users->getLast_name() ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Prénom
      <span class="badge bg-white link-dark fs-5"><?= $users->getFirst_name() ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Email
      <span class="badge bg-white link-dark fs-5"><?= $users->getEmail() ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Status
      <span class="badge bg-white link-dark fs-5"><?= $users->getRole() ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Anniversaire
      <span class="badge bg-white link-dark fs-5"><?= date("d-m-Y", strtotime($users->getBirthday())) ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Adresse
      <span class="badge bg-white link-dark fs-5"><?= $users->getAddress() ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    N° de tel
      <span class="badge bg-white link-dark fs-5"><?= $users->getPhone_number() ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    Civilité
      <span class="badge bg-white link-dark fs-5"><?= $users->getGender() ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center m-auto mx-md-0">
      <a href="<?= addLink("cart","detailCart") ?>" class="btn bg-primary link-light fw-medium">mon panier</a>
      <a href="<?= addLink("users","editUser", $users->getId_user()) ?>" class="btn bg-primary link-light fw-medium">modifier profil</a>
    </li>
  </ul>
</div>