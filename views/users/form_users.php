<?php 
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>
<div class="container5 container">
    <form method="post">

        <div class="form-group mt-5 mb-5 d-flex">
            <label class="me-xl-5 link-warning bg-dark fw-medium">Gender :<sup>*</sup>
            </label>
            <div class="form-check">
                <input class="form-check-input border-warning-subtle border-3 bg-transparent mt-3 translate-middle-y " type="radio" name="gender" value="M"<?= $users->getGender() === 'M' ? 'checked' : '' ?>>
                <label class="form-check-label link-warning bg-dark fw-medium lh-lg">Male</label>
            </div>
            <div class="form-check">
                <input class="form-check-input border-warning-subtle border-3 bg-transparent mt-3 translate-middle-y m-0 float-md-none" type="radio" name="gender" value="F" <?= $users->getGender() === 'F' ? 'checked' : '' ?>>
                <label class="form-check-label link-warning bg-dark fw-medium lh-lg">Female</label>
            </div>
            <div class="form-check">
                <input class="form-check-input border-warning-subtle border-3 bg-transparent mt-3 translate-middle-y m-0 float-md-none" type="radio" name="gender" value="O" <?= $users->getGender() === 'O' ? 'checked' : '' ?>>
                <label class="form-check-label link-warning bg-dark fw-medium lh-lg">Other</label>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label class="firstname bg-dark fw-medium link-warning" for="first_name">Firstname :<sup>*</sup>
                </label>
                <input type="text" class="form-control border-success border-4 mt-3 bg-success-subtle fw-medium" id="first_name" name="first_name" value="<?= $users->getFirst_name() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>
    
            <div class="form-group col-md-6">
                <label class="lastname link-warning bg-dark fw-medium" for="last_name">Lastname :<sup>*</sup></label>
                <input type="text" class="form-control border-success border-4 mt-3 bg-success-subtle fw-medium" id="last_name" name="last_name"  value="<?= $users->getLast_name() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>
            <div class="form-group mt-3 col-md-6">
                <label class="email link-warning bg-dark fw-medium" for="email">Email :<sup>*</sup>
                </label>
                <input type="email" class="form-control border-success border-4 mt-3 bg-success-subtle fw-medium" id="email" name="email" value="<?= $users->getEmail() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>
            <div class="form-group mt-3 col-md-6">
                <label class="password link-warning bg-dark fw-medium" for="password">Password :<sup>*</sup></label>
                <input type="password" class="form-control border-success border-4 mt-3 bg-success-subtle fw-medium" id="password" name="password" value="<?= $users->getPassword() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>
            <div class="form-group mt-3 col-md-6">
                <label class="address link-warning bg-dark fw-medium">Address :<sup>*</sup></label>
                <input type="text" class="form-control border-success border-4 mt-3 bg-success-subtle fw-medium" name="address"  value="<?= $users->getAddress() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>
            <div class="form-group mt-3 col-md-6">
                <label class="phoneN link-warning bg-dark fw-medium" >Phone number :<sup>*</sup></label>
                <input type="text" class="form-control border-success border-4 mt-3 bg-success-subtle fw-medium" name="phone_number" value="<?= $users->getPhone_number() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>    
        </div>

        <div class="form-group mt-3 col-md-5 m-auto">
            <label class="birthday link-warning bg-dark fw-medium" >Birthday:<sup>*</sup></label>
            <input type="date" class="form-control border-success border-4 mt-3 fw-medium link-dark bg-success-subtle fw-medium" name="birthday" value="<?= $users->getBirthday() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
        </div>
        <button type="submit" id="bouton" class="btn mt-5   mb-5 mt-2 bg-warning link-success fw-bolder m-auto" name="submit"><?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?>
        </button>
        <a href="<?= addLink("users/newUsers") ?>" class="btn btn-success bg-white mt-5 mb-5 link-success fw-medium">Annuler</a>
    </form>
</div>


