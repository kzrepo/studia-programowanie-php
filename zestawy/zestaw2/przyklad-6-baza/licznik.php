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

    // czyta wartość licznika z pliku

    // zwiększa wartość licznika (uważamy na zrobienie tego przy odświeżeniu strony)

    // zapisuje wartość licznika do pliku (chroniąc się przed jednoczesnym zapisem za pomocą funkcji flock())

    // uważamy na zwiększenie licznika przy odświeżeniu strony
    // zatem po zapisie robimy przekierowanie na tę samą stronę, ale z dodatkową flagą (zmienną o dowolnej wartości))
    // Jej obecność pozwoli nam sprawdzić czy strona jest faktycznie odwiedzana (flaga nieobecna)

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
<br>
<h1>Liczba odwiedzin na stronie: <b> (Tutaj aktualna wartość licznika) </b></h1>
</body>
</html>
