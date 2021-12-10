<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Logowanie</title>

    <style>
        body {
            background-color: teal;
            color: #FFFFFF;
        }

        input[type="text"] {
            text-align: center;
        }
    </style>

</head>

<body>
<?php
    $formularz = '
    <form method=GET action="">
        <table border=0>
            <tr>
                <td>Imię</td><td colspan=2><input type=text name="imie" size=15></td>
            </tr>
            <tr>
                <td>Nazwisko</td><td colspan=2><input type=text name="nazwisko" size=15></td>
            </tr>
            <tr>
                <td>Płeć:</td><td>Kobieta</td><td><INPUT TYPE="radio" NAME="plec" value="t"></td>
            </tr>
            <tr>
                <td></td><td>Mężczyzna</td><td><INPUT TYPE="radio" NAME="plec" value="f"> </td>
            </tr>
            <tr>
                <td>Hasło</td><td colspan=2><input type=password name="haslo" size=15 style="text-align: left"></td>
            </tr>
            <tr>
                <td colspan=3><input type=submit value="Zaloguj się" style="width:100%"></td>
            </tr>
        </table>
    </form>';
?>

<br>
<center>

    <?php

        $haslo = $_GET['haslo'] ?? null;
        $imie = $_GET['imie'] ?? null;
        $nazwisko = $_GET['nazwisko'] ?? null;
        $plec = $_GET['plec'] ?? null;

        if ($haslo == null && $imie == null && $nazwisko == null && $plec == null)
            echo $formularz;
        else
        {
            if ($haslo == null || $imie == null || $nazwisko == null || $plec == null)
                echo 'Wróć do formularza logowania i podaj wszystkie dane';
            else if ($haslo === 'test')
                echo $imie . ' ' . $nazwisko . ', witamy ' . ($plec === 't' ? 'Panią' : 'Pana') . ' w systemie ';
            else echo 'Logowanie nieudane';
        }

    ?>

</center>

</body>
</html>
