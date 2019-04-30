<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <title>Thank You!</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="">
    </head>

    <body>
        <?php
        echo "Thank you, " . $_SESSION["name"] . ", for your updating the form!<br><br>";

        echo "Info Summary: <br>";

        ?>

        <?php
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
        ?>
    </body>
</html>
