<!--
Napisz skrypt najlepsi.php: Powinien działać tak jak kandydaci.php zawierając
dodatkowo pole tekstowe i przycisk „Pokaż”. Po wpisaniu liczby i wciśnięciu
przycisku wyświetlanych jest tylko tylu najlepszych kandydatów (wg
sumarycznej liczby punktów) ile wpisano do pola.
-->

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Najlepsi studenci</title>
    <style>
        body {color: #000fff; background-color: yellow;}
        table {margin: 20px auto; border: 2px solid; border-collapse: collapse;}
        td {padding: 5px; font-family: sans-serif; border: 1px solid; }
        th {background-color: #000fff; color: white; padding: 10px; border: 1px solid;}
        form {border-bottom: 1px solid; padding: 15px; margin-bottom: 20px;
            display: flex; justify-content: center; gap: 15px}
        p, input {text-align: center;}
        ::placeholder {font-size: 10px}
    </style>
</head>
<body>
<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'zestaw3_przyklad1';
    // ----------- uzyskanie nazw wydziałów z bazy danych (w tablicy $wydzialy)
    // 1. połączenie z serwerem bazy
    $serwer = mysqli_connect($hostname, $username, $password)
    or exit("<p>Nie można połączyć się z serwerem bazy danych</p>");
    // 2. połączenie z bazą 'przyjęcia'
    $baza = mysqli_select_db($serwer, $database)
    or exit ("<p>Nie można połączyć się z bazą $database</p>");
    // 3. ustawienie kodowania znaków w komunikacji z bazą
    mysqli_set_charset($serwer, "utf8");
    // 4. wykonanie zapytania pobierającego symbole wydziałów (potrzebne do listy wyboru)
    $zapytanie1 = "SELECT DISTINCT wydzial FROM egzamin ORDER BY wydzial ASC";
    $wydzialy = mysqli_query($serwer, $zapytanie1)
    or exit ("<p>Źle sformułowane żądanie listy wydziałów</p>");
    $ilosc = $_GET['ilosc'] ?? '';
?>
<form action=''>
    <label for="ilosc">Lista</label>
    <input id="ilosc" name="ilosc" type="number" min="1" size="10" placeholder="Podaj liczbę"
           value="<?php echo $ilosc; ?>">
    <label for="wydz">najlepszych kandydatów na studia na wydziale:</label>
    <select name=wydz id="wydz">
        <?php
            // 5. ustawienie zmiennej przechowującej wybrany wydział (z formularza)
            //if(isset($_GET['wydz']) && $_GET['wydz'] != '') $wydz = $_GET['wydz'];
            $wydz = $_GET['wydz'] ?? '';

            // 6. w pętli wyświetlanie nazw wydziałów jako kolejne pozycje listy wyboru (znaczniki <option>)
            //    wykorzystuje wynik zapytania z pkt. 4.
            if ($wydz == '') echo "<option value=''>nie wybrano</option>";
            while ($wiersz = mysqli_fetch_array($wydzialy))
            {
                echo "<option value=$wiersz[0] "
                    . ($wydz == $wiersz[0] ? 'selected' : '')
                    . "> $wiersz[0] </option>";
            }
            // 7. zwalnianie wyniku zapytania
            mysqli_free_result($wydzialy);
        ?>
    </select>
    <input type=submit value='Wyświetl'>
</form>
<?php
    // wyświetla listę kandydatów na wybrany wydział (zmienna $wydz) ------------
    if ($wydz == '')
    {
        echo "<p>Proszę wybrać wydział</p>";
        return;
    }

    $limit = empty($ilosc) ? 'LIMIT $ilosc' : "";
    $zapytanie2 = "SELECT *, swiadectwo+mat+fiz+jezyk AS suma FROM egzamin"
        . " WHERE wydzial='$wydz' ORDER BY suma DESC, nazwisko ASC"
        . (empty($ilosc) ? "" : " LIMIT $ilosc");
    $wynik = mysqli_query($serwer, $zapytanie2)
    or exit ("<p>Źle sformułowane żądanie danych</p>");

    // wygenerowanie tabeli HTML i pierwszego wiersza z nagłówkami
    $naglowki = ["Lp.", "Nazwisko", "Imię", "Miasto", "Data urodzenia",
        "Wydział", "Świadectwo", "Mat.", "Fiz.", "Język", "Suma punktów"];
    echo "<table>";
    echo "<tr>";
    foreach ($naglowki as $naglowek) echo "<th>$naglowek</th>";
    echo "</tr>";
    $lp = 1;

    // wygenerowanie pozostałych wierszy na podstawie wyniku zapytania
    while ($wiersz = mysqli_fetch_array($wynik, MYSQLI_ASSOC))
    {
        echo "<tr><td style='text-align: center'>$lp</td>";
        foreach ($wiersz as $p => $pole)
        {
            if ($p == 'suma') echo "<td style='text-align: right'><b>$pole</b></td>";
            else echo "<td>$pole</td>";
        }

// ----------------------------------------------------------------------------------
        echo "</tr>";
        $lp++;
    }
    echo "</table>";

    mysqli_free_result($wynik);
    mysqli_close($serwer);
?>
</body>
</html>
