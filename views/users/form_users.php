<?php 
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>
<div class="container5 container">
    <form method="post">

        <div class="form-group mt-5 mb-5 d-flex">
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
        </div>

        <div class="row">
            
            <div class="form-group link-light m-auto">

                <div class="form-floating col-md-5 m-auto">
                    <input type="text" class="form-control border-warning border-2 mt-2 bg-black link-light " placeholder="Votre Nom" id="last_name" name="last_name"  value="<?= $users->getLast_name() ?>">
                    <label class="nom fw-medium fs-5 lh-1" for="last_name">Votre nom</label>
                </div>
            </div>


                <div class="form-floating col-md-5 m-auto mt-5">
                    <input type="text" class="form-control border-warning border-2 bg-black link-light " placeholder="Votre Prénom"  id="first_name" name="first_name" value="<?= $users->getFirst_name() ?>">
                    <label class="prenom fs-5 fw-medium mx-lg-3" for="first_name"> Votre prénom
                    </label>
                </div>


                <div class="form-floating col-md-5 m-auto mt-5">
                    <input type="email" class="form-control border-warning border-2 bg-black link-light" placeholder="Votre email" id="email" name="email" value="<?= $users->getEmail() ?>">
                    <label class="email fs-5 fw-medium mx-lg-3" for="email">Votre email
                    </label>
                </div>

                <div class="form-floating mt-5 col-md-5 m-auto">
                    <input type="password" class="form-control border-warning border-2 bg-black fw-medium link-light align-middle text-center fw-medium fs-4" placeholder="Votre mot de passe" id="password" name="password" value="<?= $users->getPassword() ?>">
                    <label class="pass fs-5 fw-medium mx-lg-3" for="password">Votre mot de passe</label>
                </div>

                <div class="form-floating mt-5 col-md-5 m-auto">
                    <input type="text" class="form-control border-warning border-2 bg-black fw-medium link-light" placeholder="Votre adresse" name="address"  value="<?= $users->getAddress() ?>">
                    <label class="adress fs-5 fw-medium mx-lg-3" for="address">Votre adresse</label>
                </div>
                <div class="form-floating mt-5 col-md-5 m-auto">
                    <input type="text" class="form-control border-warning border-2 bg-black fw-medium link-light" placeholder="Votre n° de tel" name="phone_number" value="<?= $users->getPhone_number() ?>">
                    <label class="tel fs-5 fw-medium mx-lg-3" for="phone_number" >Votre n° de tel</label>
                </div>    
            </div>

            <div class="form-group mt-5 col-md-3 m-auto">
                <label class="birthday bg-dark fw-semibold" for="birthday">Votre date de naissance<sup>*</sup></label>
                <input type="date" class="form-control fw-bold link-dark border border-3 border-dark bg-light" name="birthday" value="<?= $users->getBirthday() ?>">
                <button type="submit" id="bouton" class="btn btn-outline-warning fw-bolder mt-5 border border-dark border-3" name="submit">Valider</button>
            </div>
        </div>
    </form>
</div>



    <fieldset class="form-group m-auto col-md-5">
      <legend class="mt-4 link-light">Civilité :<sup>*</sup></legend>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label bg-dark link-light" for="flexCheckDefault">
        Homme
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="">
        <label class="form-check-label bg-dark link-light" for="flexCheckChecked">
        Femme
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="">
        <label class="form-check-label bg-dark link-light" for="flexCheckChecked">
          Autre
        </label>
      </div>
    </fieldset>