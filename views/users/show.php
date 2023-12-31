<div class="container">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col" class="profil bg-dark link-light border-2 border-warning">Mon profil</th>
        </tr>
      </thead>
      <tbody>
        <tr class="table-active">
          <th scope="row"  class="id_room bg-success link-light border-2 border-warning">Id user</th>
          <td class="idUser border-warning border-2 bg-success-subtle fw-bolder link-dark"><?= $user->getId_user() ?></td>
         
        </tr>
        <tr class="table-primary">
          <th scope="row" class="lastname bg-success link-light border-2 border-warning">Lastname:<sup>*</sup></th>
          <td class="last_name border-2 border-warning bg-success-subtle fw-bolder link-dark"><?= $user->getLast_name() ?></td>
        </tr>
        <tr class="table-primary">
          <th scope="row" class="firstname bg-success link-light border-2 border-warning">Firstname:<sup>*</sup></th>
          <td class="firstname2 border-warning border-2 bg-success-subtle fw-bolder link-dark"><?= $user->getFirst_name() ?></td>
        </tr>
        <tr class="table-primary">
          <th scope="row"  class="email bg-success link-light border-2 border-warning">Email:<sup>*</sup></th>
          <td class="email2 border-warning border-2 bg-success-subtle fw-bolder link-dark"><?= $user->getEmail() ?></td>
        </tr>
        <tr class="table-primary">
          <th scope="row" class="password bg-success link-light border-2 border-warning">Password:<sup>*</sup></th>
          <td class="password2 border-warning border-2 bg-success-subtle fw-bolder link-dark"><?= $user->getPassword() ?></td>
        </tr>
        <tr class="table-primary">
          <th scope="row" class="role bg-success link-light border-2 border-warning">Role:<sup>*</sup></th>
          <td class="role2 border-warning border-2 bg-success-subtle fw-bolder link-dark"><?= $user->getRole() ?></td>
        </tr>
        <tr class="table-primary">
          <th scope="row" class="birthday bg-success link-light border-2 border-warning">Birthday:<sup>*</sup></th>
          <td class="birthday2 border-warning border-2 bg-success-subtle fw-bolder link-dark"><?= date("d-m-Y", strtotime($user->getBirthday())) ?></td>
        </tr>
        <tr class="table-primary">
          <th scope="row" class="adress bg-success link-light border-2 border-warning">Address:<sup>*</sup></th>
          <td class="adress2 border-warning border-2 bg-success-subtle fw-bolder link-dark"><?= $user->getAddress() ?></td>
        </tr>
        <tr class="table-primary">
          <th scope="row" class="phone_number bg-success link-light border-2 border-warning">Phone number:<sup>*</sup></th>
          <td class="phone_number2 border-warning border-2 bg-success-subtle fw-bolder link-dark"><?= $user->getPhone_number() ?></td>
        </tr>
        <tr class="table-primary">
          <th scope="row" class="gender bg-success link-light border-2 border-warning">Gender:<sup>*</sup></th>
          <td class="gender2 border-warning border-2 bg-success-subtle fw-bolder link-dark"><?= $user->getGender() ?></td>
        </tr>
        <tr class="table-primary">
          <th scope="row" class="dashboard bg-success link-light border-2 border-warning">dashboard:<sup>*</sup></th>
          <td class="dashboard2 border-warning border-2 bg-success-subtle fw-medium link-dark"><a href="<?= addLink("users","dashUsers") ?>" class="btn btn-success bg-warning link-success fw-bolder">dashboard</td>
          <!-- <td>Column content</td>
          <td>Column content</td> -->
        </tr>
      </tbody>
    </table>
</div>
