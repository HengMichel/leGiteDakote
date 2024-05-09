    <div class="footer bgNav">

        <div class="row">
            <div class="col-md-6 m-auto mt-5 text-center fw-medium bgNav">
                <h3>Nous contacter</h3>
                <p>giteDAKOTE@gmail.com</p>
                <p>+33 123 456 789</p>
                <p>81 Rue Camille Groult, 94400 Vitry-sur-Seine</p>
            </div>
            <div class="col-md-6 m-auto mt-5 text-center justify-content-evenly bgNav">
                <h3>Navigation</h3>
                <P>
                    <a class="navfooter link-light fw-medium" href="<?= addLink("home") ?>">Accueil</a>
                </P>
                <P>
                    <a  class="nav2footer link-light fw-medium" href="<?= addLink("home","aboutUs") ?>">À propos de nous</a>
                </P>
                <p class="faq">FAQ</p>
             
            </div>
            
        </div>
        <div class="row">
            <div class="text-center m-auto fs-1 bgNav">
            <a href="https://www.linkedin.com/in/michel-h-47b3641b0">
                <i class="fa-brands fa-linkedin fa-bounce link-warning"></i>
            </a>
            <a href="https://github.com/HengMichel">
                <i class="fa-brands fa-github fa-flip link-light"></i>
            </a>
            <!-- <i class="fa-brands fa-square-snapchat fa-spin fa-spin-reverse link-success"></i> -->
            <!-- <i class="fa-brands fa-facebook fa-spin-pulse link-dark"></i> -->
            <!-- <i class="fa-brands fa-tiktok fa-shake link-info"></i> -->
            <!-- <i class="fa-brands fa-twitter fa-beat-fade link-primary"></i> -->
            <!-- <i class="fa-brands fa-square-instagram fa-spin link-danger"></i></div> -->
                <!-- <ul class="social-icons">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul> -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-center">© 2024 giteDAKOTE. Tous droits réservés.</p>
            </div>
        </div>
    </div>
    
    <!-- <div class="pied d-felx fa-2x text-sm-center mt-3">
        <a href="https://www.linkedin.com/in/michel-h-47b3641b0"><i class="fa-brands fa-linkedin fa-bounce link-warning"></i></a>
        <a href="https://github.com/HengMichel"><i class="fa-brands fa-github fa-flip link-light"></i></a>
        <i class="fa-brands fa-square-snapchat fa-spin fa-spin-reverse link-success"></i>
        <i class="fa-brands fa-facebook fa-spin-pulse link-dark"></i>
        <i class="fa-brands fa-tiktok fa-shake link-info"></i>
        <i class="fa-brands fa-twitter fa-beat-fade link-primary"></i>
        <i class="fa-brands fa-square-instagram fa-spin link-danger"></i></div>
    </div> -->









    
    <!-- modif ici ################## -->

         <!-- Initialiser le panier au chargement de la page -->
         <!-- <script>
                console.log("Script d'initialisation du panier chargé.");

            $(document).ready(function () {
                let cartCount = sessionStorage.getItem("cartCount");

                console.log("Nombre récupéré depuis sessionStorage :", cartCount);  -->

                 <!-- // Vérifier si l'élément #nombre est trouvé dans le DOM -->
        <!-- if ($("#nombre").length > 0) {
            console.log("#nombre trouvé dans le DOM.");
        } else {
            console.log("#nombre n'est pas trouvé dans le DOM.");
        }


                if (cartCount !== null && !isNaN(cartCount)) {
                    $("#nombre").html(parseInt(cartCount));
                    $("#nombre").html(parseInt(cartCount));

                }
            });
        </script> -->


        <!-- ######################### -->
</body>
</html> 