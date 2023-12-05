<?php 
session_start();
include_once "inc/header.php"; ?>
<div class="container5 container">
    <form action="model/inscription.php" method="post">

        <div class="form-group mt-5 mb-5 d-flex">
            <label class="me-xl-5 link-warning bg-dark fw-medium">Gender :</label>
            <div class="form-check">
                <input class="form-check-input border-warning-subtle border-3 bg-transparent mt-3 translate-middle-y " type="radio" name="gender"  value="M">
                <label class="form-check-label link-warning bg-dark fw-medium lh-lg">Male</label>
            </div>
            <div class="form-check">
                <input class="form-check-input border-warning-subtle border-3 bg-transparent mt-3 translate-middle-y  m-0 float-md-none" type="radio" name="gender"  value="F">
                <label class="form-check-label link-warning bg-dark fw-medium lh-lg">Female</label>
            </div>
            <div class="form-check">
                <input class="form-check-input border-warning-subtle border-3 bg-transparent mt-3 translate-middle-y m-0 float-md-none" type="radio" name="gender" value="O">
                <label class="form-check-label link-warning bg-dark fw-medium lh-lg" >Other</label>
            </div>
        </div>

        <div class="row">

            <div class="form-group col-md-6">
                <label class="firstname bg-dark fw-medium link-warning" for="firstname">Firstname :</label>
                <input type="text" class="form-control border-success border-4 mt-3 bg-success-subtle fw-medium" id="firstname" name="firstname" >
            </div>
     
            <div class="form-group col-md-6">
                <label class="lastname link-warning bg-dark fw-medium" for="lastname">Lastname :</label>
                <input type="text" class="form-control border-success border-4 mt-3 bg-success-subtle fw-medium" id="lastname" name="lastname" >
            </div>

            <div class="form-group mt-3 col-md-6">
                <label class="email link-warning bg-dark fw-medium" for="email">Email :</label>
                <input type="email" class="form-control border-success border-4 mt-3 bg-success-subtle fw-medium" id="email" name="email" >
            </div>
            <div class="form-group mt-3 col-md-6">
                <label class="password link-warning bg-dark fw-medium" for="password">Password :</label>
                <input type="password" class="form-control border-success border-4 mt-3 bg-success-subtle fw-medium" id="password" name="password" >
            </div>

            <div class="form-group mt-3 col-md-6">
                <label class="address link-warning bg-dark fw-medium">Address :</label>
                <input type="text" class="form-control border-success border-4 mt-3 bg-success-subtle fw-medium" name="address" >
            </div>
            <div class="form-group mt-3 col-md-6">
                <label class="phoneN link-warning bg-dark fw-medium" >Phone number :</label>
                <input type="text" class="form-control border-success border-4 mt-3 bg-success-subtle fw-medium" name="phone" >
            </div>
        </div>
 
        <div class="form-group mt-3 col-md-5 m-auto">
            <label class="birthday link-warning bg-dark fw-medium" >Birthday:</label>
            <input type="date" class="form-control border-success border-4 mt-3 fw-medium link-dark bg-success-subtle fw-medium" name="birthday" >
        </div>
    
        <button type="submit" id="bouton" class="btn mt-5 mb-5 border-warning border-4 mt-2 bg-success link-warning m-auto" name="submit" value="submit">Submit</button>
    </form>
</div>
<?php include_once "inc/footer.php"; ?>