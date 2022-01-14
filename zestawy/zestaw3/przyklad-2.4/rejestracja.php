<?php
    include("funkcje_rejestracja.php");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Logowanie</title>
    <style>
        body {background-color: teal; color: white;}
        table {border: 0;}
        label {margin-right: 20px}
        a {color: white;}
        .button {width: 100%; margin-top: 10px;}
        .container {display: flex; flex-direction: column; align-items: center; margin: 50px;}
        .center {text-align: center; margin}
        .info {center ' style=' border: 1px solid; padding: 20px}
    </style>
</head>
<body>
<div class="container">
    <?php
        // Walidacja pustych pól w HTML
        // Definicja formularza w pliku funkcje_rejestracja.php

        if (!isset($_POST['login']))
            echo $form;
        else if (!empty($_POST['login']))
        {
            add_to_database($_POST);
            if (!$is_user_exist)
                echo $form;
        }
    ?>
</div>
</body>
</html>
