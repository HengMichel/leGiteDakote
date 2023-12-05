<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./assets/css/style.css">

    <title>Acceuil</title>
</head>
<body class="bgAllpage">
  <!-- ici la navbar -->
  <nav class="navbar navbar-expand-lg mb-5 bg-dark">
    <div class="container-fluid ">
      <!-- <a class="navbar-brand table-group-divider fw-bold" href="https://autumn-drunk.000webhostapp.com "> -->
      <a class="navbar-brand fw-bold link-warning" href="http://localhost/projetGite/index.php">Le Gîte DAKOTÉ</a>
      <!-- <a class="navbar-brand fw-bold link-warning" href="http://projetGite.com/index.php">Le Gîte DAKOTÉ</a> -->
      <div class="navbar-collapse d-flex justify-content-end" id="navbarText">
        <ul class="navbar-nav  mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link fw-bolder link-warning" href="http://localhost/projetGite/aboutUs.php">À propos de nous</a>
            <!-- <a class="nav-link fw-bolder link-warning" href="http://projetGite.com/aboutUs.php">About Us</a> -->
          </li>
          <li class="nav-item">

          <?php
          if (isset($_SESSION['id_user'])) {
              echo '<li class="nav-item">';
              if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                  echo '<a class="nav-link fw-bolder link-warning" href="admin.php">Admin Home</a>';
              } else {
                  echo '<a class="nav-link fw-bolder link-warning" href="user_home.php">Home</a>';
              }
              echo '</li>';
          }
          ?>
          <li class="nav-item">
            <a class="nav-link fw-bolder link-warning" href="http://localhost/projetGite/service.php">Nos Services</a>
            <!-- <a class="nav-link fw-bolder link-warning" href="http://projetGite.com/service.php">Service</a> -->
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link active form-check-inline fw-bolder" aria-current="page" 
            href="https://autumn-drunk.000webhostapp.com/login.php">
            Login</a> -->
            <a class="nav-link active form-check-inline fw-bolder link-warning" aria-current="page" 
            href="http://localhost/projetGite/login.php">
            Se connecter</a>
            <!-- <a class="nav-link active form-check-inline fw-bolder link-warning" aria-current="page" 
            href="http://projetGite.com/login.php">
            Login</a> -->
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bolder link-warning" href="http://localhost/projetGite/register.php">S'inscrire</a>
            <!-- <a class="nav-link fw-bolder link-warning" href="http://projetGite.com/register.php">Sign up</a> -->
          </li>
          <!-- logout for user and admin 2 in 1 -->
          <?php
          if (isset($_SESSION['id_user']) || (isset($_SESSION['role']) && $_SESSION['role'] === 'admin')) {
              echo '<li class="nav-item">';
              echo '<a class="nav-link fw-bolder link-warning" href="logout.php">Logout</a>';
              echo '</li>';
          }
          ?>
          <?php
            ?>
        </ul>
      </div>
    </div>
  </nav>