<?php 
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>
<div class="container5 container">
    <form method="post">

        <!-- <div class="form-group mt-5 mb-5 d-flex">
            <label class="me-xl-5 link-lght bg-dark fw-medium">Civilité :<sup>*</sup>
            </label>
            <div class="form-check">
                <input class="form-check-input border-warning border-3 bg-transparent mt-3 translate-middle-y " type="radio" name="gender" value="M"<?= $users->getGender() === 'M' ? 'checked' : '' ?>>
                <label class="form-check-label link-light bg-dark fw-medium lh-lg">Homme</label>
            </div>
            <div class="form-check">
                <input class="form-check-input border-warning border-3 bg-transparent mt-3 translate-middle-y m-0 float-md-none" type="radio" name="gender" value="F" <?= $users->getGender() === 'F' ? 'checked' : '' ?>>
                <label class="form-check-label link-light bg-dark fw-medium lh-lg">Femme</label>
            </div>
            <div class="form-check">
                <input class="form-check-input border-warning border-3 bg-transparent mt-3 translate-middle-y m-0 float-md-none" type="radio" name="gender" value="O" <?= $users->getGender() === 'O' ? 'checked' : '' ?>>
                <label class="form-check-label link-light bg-dark fw-medium lh-lg">Autre</label>
            </div>
        </div> -->

        
        <fieldset class="form-group col-md-6 m-auto">
          <legend class="mt-4 link-light">Civilité :<sup>*</sup></legend>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="gender" value="M"<?= $users->getGender() === 'M' ? 'checked' : '' ?>>
            <label class="form-check-label bg-dark link-light" for="flexCheckDefault">
            Homme
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="gender" value="F" <?= $users->getGender() === 'F' ? 'checked' : '' ?>>
            <label class="form-check-label bg-dark link-light" for="flexCheckChecked">
            Femme
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="gender" id="flexCheckChecked"  value="O" <?= $users->getGender() === 'O' ? 'checked' : '' ?>>
            <label class="form-check-label bg-dark link-light" for="flexCheckChecked">
              Autre
            </label>
          </div>
        </fieldset>

        <div class="row">
            
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="text" class="form-control border bg-black link-light" placeholder="Votre Nom" id="last_name" name="last_name"  value="<?= $users->getLast_name() ?>">
                    <label for="last_name">Votre nom</label>
                </div>
            </div>

            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="text" class="form-control border bg-black link-light " placeholder="Votre Prénom"  id="first_name" name="first_name" value="<?= $users->getFirst_name() ?>">
                    <label for="first_name"> Votre prénom
                    </label>
                </div>
            </div>

            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="email" class="form-control border bg-black link-light" placeholder="Votre email" id="email" name="email" value="<?= $users->getEmail() ?>">
                    <label for="email">Votre email
                    </label>
                </div>
            </div>

            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="password" class="form-control border bg-black link-light fs-5" placeholder="Votre mot de passe" id="password" name="password" value="<?= $users->getPassword() ?>">
                    <label for="password">Votre mot de passe</label>
                </div>
            </div>

            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="text" class="form-control border bg-black link-light" placeholder="Votre adresse" name="address"  value="<?= $users->getAddress() ?>">
                    <label for="address">Votre adresse</label>
                </div>
            </div>

            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="text" class="form-control border bg-black link-light" placeholder="Votre n° de tel" name="phone_number" value="<?= $users->getPhone_number() ?>">
                    <label for="phone_number" >Votre n° de tel</label>
                </div>    
            </div>

            <div class="form-group mt-2 col-md-3 m-auto">
                <label class="birthday bg-dark fw-semibold" for="birthday">Votre date de naissance<sup>*</sup></label>
                <input type="date" class="form-control fw-bold link-dark border border-3 border-dark bg-light" name="birthday" value="<?= $users->getBirthday() ?>">

                <!-- création de cette div pour que le btn soit visible (hoover +visible) -->
                <div class="form-group mt-2  m-auto bg-dark">
                    <button type="submit" id="bouton" class="btn btn-primary fw-bolder border-2 container" name="submit">Valider</button>
                </div>
            </div>

        </div>
    </form>
</div>


