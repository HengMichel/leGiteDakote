<?php 
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>
<div class="container5 container">
    <form method="post">
        <div class="btn-group col-md-6 bg-dark m-auto" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked="">
          <label class="btn btn-outline-dark" for="btnradio1">Civilité :<sup>*</sup></label>
          <input type="radio" class="btn-check" name="gender" id="btnradio3" autocomplete="off" value="F" <?= $users->getGender() === 'F' ? 'checked' : '' ?>>
          <label class="btn btn-outline-primary link-light" for="btnradio3">Femme</label>
          <input type="radio" class="btn-check" name="gender" id="btnradio2" autocomplete="off" value="M"<?= $users->getGender() === 'M' ? 'checked' : '' ?>>
          <label class="btn btn-outline-primary link-light" for="btnradio2">Homme</label>
          <input type="radio" class="btn-check" name="gender" id="btnradio4" autocomplete="off"  value="O" <?= $users->getGender() === 'O' ? 'checked' : '' ?>>
          <label class="btn btn-outline-primary link-light" for="btnradio4">Autre</label>
        </div>
        <div class="row"> 
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="text" class="form-control bg-dark link-light" placeholder="Votre Nom" id="last_name" name="last_name"  value="<?= $users->getLast_name() ?>">
                    <label for="last_name">Votre nom</label>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="text" class="form-control bg-dark link-light " placeholder="Votre Prénom"  id="first_name" name="first_name" value="<?= $users->getFirst_name() ?>">
                    <label for="first_name"> Votre prénom
                    </label>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="email" class="form-control bg-dark link-light" placeholder="Votre email" id="email" name="email" value="<?= $users->getEmail() ?>">
                    <label for="email">Votre email
                    </label>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="password" class="form-control bg-dark link-light fs-5" placeholder="Votre mot de passe" id="password" name="password" value="<?= $users->getPassword() ?>">
                    <label for="password">Votre mot de passe</label>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="text" class="form-control bg-dark link-light" placeholder="Votre adresse" name="address"  value="<?= $users->getAddress() ?>">
                    <label>Votre adresse</label>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="text" class="form-control bg-dark link-light" placeholder="Votre n° de tel" name="phone_number" value="<?= $users->getPhone_number() ?>">
                    <label>Votre n° de tel</label>
                </div>    
            </div>
            <div class="form-group mt-3 col-md-3 m-auto">
                <label class="birthday bg-dark" >Votre date de naissance<sup>*</sup></label>
                <input type="date" class="form-control fw-bold link-dark bg-light" name="birthday" value="<?= $users->getBirthday() ?>">
                <div class="form-group mt-2 text-center">
                    <button type="submit" id="bouton" class="btn bg-primary link-light fw-medium" name="submit">Valider</button>
                </div>
            </div>
        </div>
    </form>
</div>


