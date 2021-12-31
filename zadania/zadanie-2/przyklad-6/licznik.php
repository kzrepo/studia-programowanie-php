<!--
Napisz stronę zawierającą licznik odwiedzin. Aktualna liczba odwiedzin
przechowywana jest w pliku. Każde wejście na stronę uruchamia skrypt, który
odczytuje z pliku, zwiększa o jeden, wyświetla na stronie i zapisuje do pliku
zaktualizowaną wartość.
Odświeżenie strony nie powinno być traktowane jako osobna wizyta, aby temu
zapobiec zastosuj odpowiednie przekierowanie używając funkcji header().
Może się przydać: file_exists(), fopen(), fgets(), fputs(), fclose(), flock(), header()
-->

<?php
    $czy_odwiedziny = $_GET['odwiedziny'] ?? null;
    // czyta wartość licznika z pliku
    $nazwa_pliku = 'licznik.txt';
    $plik = fopen($nazwa_pliku, 'r') or exit("Nie można otworzyć pliku $nazwa_pliku");
    $licznik = fgets($plik);
    fclose($plik);

    // zwiększa wartość licznika (uważamy na zrobienie tego przy odświeżeniu strony)
    if (empty($czy_odwiedziny))
    {
        $licznik += 1;
    }

    // zapisuje wartość licznika do pliku (chroniąc się przed jednoczesnym zapisem za pomocą funkcji flock())
    $plik = fopen($nazwa_pliku, 'w') or exit("Nie można otworzyć pliku $nazwa_pliku");
    if (flock($plik, LOCK_EX))
    {
        fputs($plik, $licznik);
    } else
    {
        echo "Nie mogę zablokować pliku $nazwa_pliku";
    }
    // fclose() automatycznie zwalnia blokadę
    fclose($plik);

    // jeżeli $_GET['odwiedziny'] zawiera null (jest pusty) oznacza, że to są odwiedziny
    if (empty($czy_odwiedziny)) header("Location: licznik.php?odwiedziny=1");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Licz odwiedziny</title>
    <style>
        body {background-color: teal; color: #FFFFFF; text-align: center; padding-top: 50px}
    </style>
</head>
<body>
<h1>
    Liczba odwiedzin na stronie:
    <?php
        echo "<b>$licznik</b>";
    ?>
</h1>
</body>
</html>
