<?php 
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>
<div class="container5 container">
    <form method="post"  action="<?= addLink("users/updateUser", $users->getId_user()) ?>">
        <div class="form-group mt-4">
            <div class="form-floating col-md-6 m-auto">
                <input type="email" class="form-control bg-black link-light" placeholder="Votre email" id="email" name="email" value="<?= $users->getEmail() ?>">
                <label for="email">Votre email
                </label>
            </div>
        </div>
        <div class="form-group mt-4">
            <div class="form-floating col-md-6 m-auto">
                <input type="password" class="form-control bg-black link-light fs-5" placeholder="Votre mot de passe" id="password" name="password" value="<?= $users->getPassword() ?>">
                <label for="password">Votre mot de passe</label>
            </div>
        </div>
        <div class="form-group mt-4">
            <div class="form-floating col-md-6 m-auto">
                <input type="password" class="form-control bg-black link-light fs-5" placeholder="Confirmer le nouveau mot de passe" id="confirm_password" name="confirm_password" value="">
                <label for="confirm_password">Confirmer le nouveau mot de passe</label>
            </div>
        </div>
        <div class="form-group mt-4">
            <div class="form-floating col-md-6 m-auto">
                <input type="text" class="form-control bg-black link-light" placeholder="Votre adresse" name="address"  value="<?= $users->getAddress() ?>">
                <label>Votre adresse</label>
            </div>
        </div>
        <div class="form-group mt-4">
            <div class="form-floating col-md-6 m-auto">
                <input type="text" class="form-control bg-black link-light" placeholder="Votre n° de tel" name="phone_number" value="<?= $users->getPhone_number() ?>">
                <label>Votre n° de tel</label>
            </div>    
        </div>
        <div class="form-group mt-4 text-center">
            <button type="submit" id="bouton" class="btn bg-primary link-light border" name="add_room" value="submit">Valider
            </button>
        </div>
    </form>
</div>


