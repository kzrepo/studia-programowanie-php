<!--
Tym razem załóżmy, że dane o użytkownikach są przechowywane w pliku
dostep.txt, w formacie imię;nazwisko;hasło;płeć;
Uruchom w przeglądarce i wykonaj ćwiczenia.

Zmodyfikowany skrypt powinien sprawdzać zgodność podanego w formularzu
imienia i hasła z tym zapisanym w pliku i wyświetlać powitanie lub informację o
odrzuceniu.
Mogą się przydać: explode(), fgetcsv()
-->

<?php
    //echo "<pre>";
    //$imie = $_POST['imie'] ?? null;
    //var_dump(empty($imie));
    //var_dump(isset($imie));
    //echo "</pre>";
    $imie_przeslane = $_POST['imie'] ?? null;
    $haslo_przeslane = $_POST['haslo'] ?? null;
    $filename = 'dostep.txt';
?>
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
    // wpuszcza mnie nawet przy pustym imieniu, ale nie przy pierwszym uruchomieniu
    if (isset($imie_przeslane))
    {
        $plik = fopen($filename, 'r')
        or exit("Problem z otwarciem pliku $filename");
        $znaleziony = false;
        while (1)
        {
            $dane_uzytkownika = fgetcsv($plik, 1000, ";");
            $imie_zapisane = $dane_uzytkownika[0];
            $nazwisko_zapisane = $dane_uzytkownika[1];
            $haslo_zapisane = $dane_uzytkownika[2];
            $plec_zapisana = $dane_uzytkownika[3];
            if ($imie_przeslane === $imie_zapisane)
            {
                $znaleziony = true;
                break;
            }
            if (feof($plik)) break;
        }

        if ($znaleziony)
        {
            if ($haslo_przeslane == $haslo_zapisane)
                echo "$imie_zapisane $nazwisko_zapisane, witamy "
                    . ($plec_zapisana == "t" ? "Panią" : "Pana") . " w systemie ";
            else
                echo "Hasło nieprawidłowe";
        } else
        {
            echo "Użytkownik nie został znaleziony";
        }
        fclose($plik);
    } else
    {
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
    }
?>
</body>
</html>
