<!--
Zmień metodę przesyłania danych na POST. Zaobserwuj różnicę.
-->

<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Logowanie</title>

    <style>
        body {
            text-align: center;
            background-color: teal;
            color: #FFFFFF;
        }
        input[type="text"] { text-align: center }
        table { display: inline-table }
        td { padding: 5px }
    </style>

</head>

<body>
<?php
    $formularz = '
    <form action="" method=post>
        <table style="display: inline-table">
            <tr>
                <td>
                    <label for="imie">Imię</label>
                </td>
                <td>
                    <input name="imie" type=text id="imie" size=15 style="text-align: left">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nazwisko">Nazwisko</label>
                </td>
                <td>
                    <input name="nazwisko" type=text id="nazwisko" size=15 style="text-align: left">
                </td>
            </tr>
            <tr>
                <td rowspan="2">Płeć:</td>
                <td>
                    <input name="plec" type="radio" id="kobieta" value="t">
                    <label for="kobieta">Kobieta</label>
                </td></tr>
            <tr>
                <td>
                    <input name="plec" type="radio" id="mezczyzna" value="f">
                    <label for="mezczyzna">Mężczyzna</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="haslo"> Hasło</label>
                </td>
                <td>
                    <input name="haslo" type=password id="haslo" size=15 style="text-align: left">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type=submit style="width: 100%" value="Zaloguj się">
                </td>
            </tr>
        </table>
    </form>';
?>
<?php
    $haslo = $_POST['haslo'] ?? null;
    $imie = $_POST['imie'] ?? null;
    $nazwisko = $_POST['nazwisko'] ?? null;
    $plec = $_POST['plec'] ?? null;

    if ($haslo == null && $imie == null && $nazwisko == null && $plec == null)
        echo $formularz;
    else
    {
        $plec = $plec === 't' ? 'Panią' : 'Pana';
        if ($haslo == null || $imie == null || $nazwisko == null || $plec == null)
            echo 'Wróć do formularza logowania i podaj wszystkie dane';
        else if ($haslo === 'test')
            echo "$imie $nazwisko, witamy $plec w systemie";
        else echo 'Logowanie nieudane';
    }
?>
</body>
</html>
