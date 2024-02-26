<div class="container5">
    <table class="table table-hover mt-5">
      <thead>
        <tr>
          <th scope="col" class="profil bg-secondary link-light border align-middle text-center">Mon profil</th>
        </tr>
      </thead>
      <tbody>
        <tr class="table-active">
          <th scope="row" class="id_room bg-secondary link-light border align-middle text-center">Identifiant</th>
          <td class="idUser border bg-body-secondary fw-medium"><?= $users->getId_user() 
          ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="lastname bg-secondary link-light border align-middle text-center">Nom</th>
          <td class="last_name border  bg-dark-subtle fw-medium"><?= $users->getLast_name() ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="firstname bg-secondary  border align-middle text-center link-light">Prénom</th>
          <td class="firstname2 border bg-dark-subtle fw-medium"><?= $users->getFirst_name() ?></td>
        </tr>
        <tr class="table">
          <th scope="row"  class="email bg-secondary link-light border align-middle text-center">Email</th>
          <td class="email2 border  bg-dark-subtle fw-medium"><?= $users->getEmail() ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="password bg-secondary link-light border align-middle text-center">Mot de passe</th>
          <td class="password2 border  bg-dark-subtle fw-medium"><?= $users->getPassword() ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="role bg-secondary link-light border align-middle text-center">Role</th>
          <td class="role2 border  bg-dark-subtle fw-medium"><?= $users->getRole() ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="birthday bg-secondary link-light border align-middle text-center">Anniversaire</th>
          <td class="birthday2 border  bg-dark-subtle fw-medium"><?= date("d-m-Y", strtotime($users->getBirthday())) ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="adress bg-secondary link-light border align-middle text-center">Adresse</th>
          <td class="adress2 border  bg-dark-subtle fw-medium"><?= $users->getAddress() ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="phone_number bg-secondary link-light border align-middle text-center">Numéro de tel</th>
          <td class="phone_number2 border  bg-dark-subtle fw-medium"><?= $users->getPhone_number() ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="gender bg-secondary link-light border align-middle text-center">Civilité</th>
          <td class="gender2 border  bg-dark-subtle fw-medium"><?= $users->getGender() ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="dashboard bg-secondary link-light border align-middle text-center"> <a href="<?= addLink("users","dashUsers") ?>" class="btn btn-primary border fw-medium">dashboard
          </th>
        </tr>
      </tbody>
    </table>
</div>
