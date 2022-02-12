<?php
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        body {
            background-color: yellow;
            color: #000fff;
        }
        table {
            border: 2px solid;
            border-collapse: collapse;
            margin: auto;
        }
        td, th {
            border: 1px solid;
            padding: 5px 10px;
        }
        th {background-color: #000fff; color: white;}

    </style>
</head>
<body>
<br>

<?php
    echo '
    <div style="text-align: center;">
        <form action="" method="get">
            <label for="srednia">Lista kandydatów ze średnią ocen powyżej: </label>
            <input name="srednia" type="text" id="srednia" size="10" style="text-align: left">
                  <br>
            Płeć:
            <input name="plec" type="radio" id="kobieta" value="t">
            <label for="kobieta">Kobieta</label>
            <input name="plec" type="radio" id="mezczyzna" value="f">
            <label for="mezczyzna">Mężczyzna</label>
            <br>
            <input type="submit" value="Pokaż">
        </form>
    </div>';
?>

<hr>

<?php
    // połączenie z serwerem i odpowiednią bazą

    $serwer = mysqli_connect("localhost", "root", "")
    or die("Nie można połączyć się z serwerem bazy danych");
    $baza = mysqli_select_db($serwer, "przyjeciaf")
    or die ("Nie można połączyć się z bazą PRZYJĘCIA");
    mysqli_set_charset($serwer, "utf8");

    // (zad 4.) Zastąp powyższe linie odczytaniem konfiguracji z pliku 'rekrutacja.conf'
    // i zrealizuj połączenie się z bazą używając wartości z pliku

    // (zad 3a.) skonstruuj i wykonaj odpowiednie zapytanie
    $zapytanie = "SELECT * FROM egzamin;";
    $wynik = mysqli_query($serwer, $zapytanie) or die ("Źle sformułowane żądanie danych: " . $zapytanie);
    $naglowki = ["Nazwisko", "Imię", "Miasto", "Data urodzenia", "Wydział", "Świadectwo", "Mat.", "Fiz.", "Język"];
    echo "<table>";
    echo "<tr>";
    foreach ($naglowki as $naglowek)
        echo "<th>$naglowek</th>";
    echo "</tr>";

    // (zad 3a.) wyświetlenie tabeli osób spełniających warunki
    $srednia_wpisana = $_GET['srednia'] ?? null;
    $plec_wpisana = $_GET['plec'] ?? null;

    while ($wiersz = mysqli_fetch_array($wynik, MYSQLI_ASSOC))
    {
        $suma = $wiersz['mat'] + $wiersz['fiz'] + $wiersz['jezyk'];
        $srednia = $suma / 3;

        if ($srednia > $srednia_wpisana)
        {
            if ($plec_wpisana == 'f')
            {
                echo "<tr>";
                foreach ($wiersz as $nazwa_pola => $pole) echo "<td>$pole</td>";
                echo "</tr>";
            }
        }
    }

    echo "</table>";

    // (zad 3a.) wyświetl liczbę osób spełniających warunki

    mysqli_free_result($wynik);
    mysqli_close($serwer);
?>

</body>
</html>
