<!--
Poniżej kod strony (ze skryptem) logującej do systemu (jest to rozwiązanie
przykładu 1 z poprzedniego zestawu).
Uruchom w przeglądarce i wykonaj ćwiczenia.
-->

<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Logowanie</title>
    <style>
        body {background-color: teal; color: white; text-align: center}
        table {display: inline-table}
    </style>
</head>
<body>
<br>
<?php
    if (isset($_POST['nazwisko']))
    {
        if ($_POST['haslo'] == "test")
            echo $_POST['imie'] . " " . $_POST['nazwisko'] . ", witamy "
                . ($_POST['plec'] == "t" ? "Panią" : "Pana") . " w systemie ";
        else
            echo "Logowanie nieudane";
    } else
    {
        // formularz generuje tylko gdy dane jeszcze nie były wysyłane
        ?>
        <form method=POST action=''>
            <table>
                <tr>
                    <td>
                        <label for="imie">Imię</label>
                    </td>
                    <td colspan=2>
                        <input id="imie" type=text name='imie' size=15 style='text-align: left'>
                    </td>
                </tr>
                <!-- te pola nie będą potrzebne, zatem dopisz ten komentarz
                <tr><td>Nazwisko</td><td colspan=2>
                <input type=text name='nazwisko' size=15 style='text-align: left'></td>
                </tr>
                <tr><td>Płeć:</td><td>Kobieta</td>
                <td><INPUT TYPE="radio" NAME="plec" value="t"></td>
                </tr><tr><td></td>
                <td>Mężczyzna</td><td><INPUT TYPE="radio" NAME="plec" value="f"> </td>
                </tr>
                -->
                <tr>
                    <td>
                        <label for="haslo">Hasło</label>
                    </td>
                    <td colspan=2>
                        <input id="haslo" type=password name='haslo' size=15 style='text-align:left'>
                    </td>
                </tr>
                <tr>
                    <td colspan=3 style="padding-top: 10px">
                        <input type=submit value='Zaloguj się' style='width:100%'>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        // koniec else
    }
?>
</body>
</html>
