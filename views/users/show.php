<div class="container">
    <table class="table table-hover mt-5">
      <thead>
        <tr>
          <th scope="col" class="profil bg-dark link-light border-3 border-warning">Mon profil</th>
        </tr>
      </thead>
      <tbody>
        <tr class="table-active">
          <th scope="row"  class="id_room bg-success link-light border-2 border-warning">Identifiant</th>
          <td class="idUser border-warning border-3 bg-success-subtle fw-bolder link-dark"><?= $users->getId_user() 
          ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="lastname bg-success link-light border-3 border-warning">Nom:<sup>*</sup></th>
          <td class="last_name border-3 border-warning bg-success-subtle fw-bolder link-dark"><?= $users->getLast_name() ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="firstname bg-success link-light border-3 border-warning">Prénom:<sup>*</sup></th>
          <td class="firstname2 border-warning border-3 bg-success-subtle fw-bolder link-dark"><?= $users->getFirst_name() ?></td>
        </tr>
        <tr class="table">
          <th scope="row"  class="email bg-success link-light border-3 border-warning">Email:<sup>*</sup></th>
          <td class="email2 border-warning border-3 bg-success-subtle fw-bolder link-dark"><?= $users->getEmail() ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="password bg-success link-light border-3 border-warning">Mot de passe:<sup>*</sup></th>
          <td class="password2 border-warning border-3 bg-success-subtle fw-bolder link-dark"><?= $users->getPassword() ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="role bg-success link-light border-3 border-warning">Role:<sup>*</sup></th>
          <td class="role2 border-warning border-3 bg-success-subtle fw-bolder link-dark"><?= $users->getRole() ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="birthday bg-success link-light border-3 border-warning">Anniversaire:<sup>*</sup></th>
          <td class="birthday2 border-warning border-3 bg-success-subtle fw-bolder link-dark"><?= date("d-m-Y", strtotime($users->getBirthday())) ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="adress bg-success link-light border-3 border-warning">Adresse:<sup>*</sup></th>
          <td class="adress2 border-warning border-3 bg-success-subtle fw-bolder link-dark"><?= $users->getAddress() ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="phone_number bg-success link-light border-3 border-warning">Numéro de tel:<sup>*</sup></th>
          <td class="phone_number2 border-warning border-3 bg-success-subtle fw-bolder link-dark"><?= $users->getPhone_number() ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="gender bg-success link-light border-3 border-warning">Civilité:<sup>*</sup></th>
          <td class="gender2 border-warning border-3 bg-success-subtle fw-bolder link-dark"><?= $users->getGender() ?></td>
        </tr>
        <tr class="table">
          <th scope="row" class="dashboard bg-success link-light border-3 border-warning">dashboard:<sup>*</sup></th>
          <td class="dashboard2 border-warning border-3 bg-success-subtle fw-medium link-dark">

            <a href="<?= addLink("users","dashUsers") ?>" class="btn btn-outline-warning  link-success fw-bolder">dashboard

          </td>
        </tr>
      </tbody>
    </table>
</div>
