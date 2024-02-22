<?php
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>
<div class="container5">
    <form method="post">
        <div class="row">

            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="email" class="form-control border- mt-3 bg-black link-light" placeholder="name@example.com" id="email fs-4" name="email" value="<?= $users->getEmail() ?>">
                    <label for="email">Votre email </label>
                </div>
            </div>

            <div class="form-group m-auto mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="password" class="form-control mt-3 bg-black link-light" id="password" name="password" placeholder="Votre mot de passe">
                    <label for="password">Votre mot de passe</label>

                    <div class="form-group mt-4 col-md-3 m-auto bg-dark">
                        <button type="submit" id="bouton" class="btn btn-primary fw-bolder  border-2 container " name="submit">Valider</button>
                    </div>
                </div>

            </div>

        </div>
    </form>
</div>

