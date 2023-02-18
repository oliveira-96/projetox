<?php
    require_once 'config.php';

    // Pegar parâmetro da URL.
    $m = filter_input(INPUT_GET, 'm', FILTER_DEFAULT);
    //@$m = $_GET['m'];
    if (empty($m)) {
        $m = 'home';
    } else {
        if (!in_array($m, array('home', 'artigo'))) {
            $m = '404';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= BLOG_NOME; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <style>
        body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
    </style>
</head>
<body class="w3-light-grey">

<!-- w3-content defines a container for fixed size centered content, 
    and is wrapped around the whole page content, except for the footer in this example -->
    <div class="w3-content" style="max-width:1400px">

        <!-- Header -->
        <header class="w3-container w3-center w3-padding-32"> 
            <h1><b><?= BLOG_NOME; ?></b></h1>
            <p>Bem-vindo(a) ao blog do <span class="w3-tag"><?= BLOG_AUTOR; ?></span></p>
        </header>

        <!-- Grid -->
        <div class="w3-row">

            <!-- Blog entries -->
            <div class="w3-col l8 s12">
            <?php
                include "{$m}.php";
            ?>
            </div>

            <!-- Introduction menu -->
            <div class="w3-col l4">
            <?php
                include 'sidebar.php';
            ?>
            </div>

            <!-- END GRID -->
        </div><br>

        <!-- END w3-content -->
    </div>

    <!-- Footer -->
    <footer class="w3-container w3-dark-grey w3-padding-32 w3-margin-top">
        <p>&copy;<?= date('Y'); ?>. Desenvolvido por <a href="javascript:void(0);"><?= BLOG_AUTOR; ?></a>.</p>
    </footer>

</body>
</html>