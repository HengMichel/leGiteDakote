<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <base href="<?= ROOT; ?>">
        <link rel="stylesheet" href="public/assets/css/style.css">
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
        <!-- ceci me permet d'afficher les images lors du filtrage par catégorie -->
         <script>
            var UPLOAD_CHAMBRES_IMG = '<?= UPLOAD_CHAMBRES_IMG ?>';
        </script>
        <!--##################################################### -->
        <script src="public/assets/js/ajax.js"></script>
        <title><?= $h1 ?? "Le gîte DAKOTE" ?></title>
    </head>
    <body class="bgAllpage">
        <div class="container-fluid">
        <!-- <div class="container"> -->
                <div class="row text-white">
                    <?php include __DIR__ . "/nav.php"; ?>
                    <?php include __DIR__ . "/../views/messages.php";?>
                    <h1 class="titre link-light mt-4"><?= $h1 ?? " " ?></h1>

