<!--
Poniższy skrypt PHP buduje (inicjalizuje) na różne sposoby tablicę zawierającą
cztery teksty (nazwy mebli): "tapczan", "szafa", "stół", "krzesło". Następnie
wyświetla zawartość tablicy (każdy element w osobnej linii) podając wartość
klucza (indeksu) i wartość elementu.
Przykład prezentuje różne techniki: pętle for i foreach, funkcję each(), funkcje
nawigacyjne po tablicach.
-->

<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Tablice - demo</title>
    <style>
        body {background-color: yellow; color: #000FFF}
    </style>
</head>
<body>
<?php
    // ------ sposoby budowania (inicjalizowania) tablicy: -----
    // 1a. automatyczne indeksy (od 0)
    $towary1a[] = "tapczan";
    $towary1a[] = "szafa";
    $towary1a[] = "stół";
    $towary1a[] = "krzesło";
    // 1b. za pomocą funkcji array
    $towary1b = array("tapczan", "szafa", "stół", "krzesło");
    // 1c. używając uproszczonej składni od wersji PHP 5.4
    $towary1c = ["tapczan", "szafa", "stół", "krzesło"];

    // 2a. dowolne własne indeksy
    $towary2a[11] = "tapczan";
    $towary2a[22] = "szafa";
    $towary2a[33] = "stół";
    $towary2a[44] = "krzesło";
    // 2b. za pomocą funkcji array
    $towary2b = array(11 => "tapczan", 22 => "szafa", 33 => "stół", 44 => "krzesło");
    // 2c. używając uproszczonej składni od wersji PHP 5.4
    $towary2c = [11 => "tapczan", 22 => "szafa", 33 => "stół", 44 => "krzesło"];

    // 3a. własne klucze dowolnego typu (np. stringowego)
    $towary3a['tap'] = "tapczan";
    $towary3a['sza'] = "szafa";
    $towary3a['st'] = "stół";
    $towary3a['kr'] = "krzesło";
    // 3b. za pomocą funkcji array
    $towary3b = array('tap' => "tapczan", 'sza' => "szafa", 'st' => "stół", 'kr' => "krzesło");
    // 3c. używając uproszczonej składni od wersji PHP 5.4
    $towary3c = ['tap' => "tapczan", 'sza' => "szafa", 'st' => "stół", 'kr' => "krzesło"];
    // --- sposoby przetwarzania tablicy (tu wyświetlania na stronie): ---
    // wybór tablicy do przetwarzania - spróbuj każdą
    $towary = $towary3a;
    // A. jak w języku C, funkcja count podaje liczbę elementów w tablicy
    // jednak nieodpowiednie dla tablicy utworzonej sposobem 2. i 3.
    echo "Klasyczny <b>for</b>:<br>";
    for ($i = 0; $i < count($towary); $i++)
        echo "indeks: " . $i . ", wartość: " . $towary[$i] . "<br>";
    echo "<br>";
    // B. użycie pętli foreach:
    // foreach(nazwa_tablicy as zmienna_dla_klucza_elementu => zmienna_dla_wartości_elementu)
    echo "Instrukcja <b>foreach</b>:<br>";
    foreach ($towary as $t => $towar)
        echo "klucz: " . $t . ", wartość: " . $towar . "<br>";
    echo "<br>";
    reset($towary); // cofa "wskaźnik" elementu tablicy na początek

    /*
    // Od wersji 8.0.0 nie można używać funkcji each()

    // C.1 użycie funkcji each:
    // wynik funkcji (w zmiennej $towar)
    // to tablica zawierająca kolejny element tablicy-argumentu
    // $towar[0] - klucz elementu, $towar[1] - wartość elementu
    echo "Funkcja <b>each</b>:<br>";
    while ($towar = each($towary))
        echo "klucz: " . $towar[0] . ", wartość: " . $towar[1] . "<br>";
    echo "<br>";
    reset($towary);
    // C.2 użycie funkcji each:
    // $towar['key'] - klucz elementu, $towar['value'] - wartość elementu
    echo "Funkcja <b>each</b>:<br>";
    while ($towar = each($towary))
        echo "klucz: " . $towar['key'] . ", wartość: " . $towar['value'] . "<br>";
    echo "<br>";
    reset($towary);
    */

    // Zamiast funkcji each() można używać funkcji key(), current(), next()
    echo "Funkcje <b>key, current, next</b>: funkcje nawigacyjne<br>";
    while ($wartosc = current($towary))
    {
        $klucz = key($towary);
        echo "klucz: " . $klucz . ", wartość: " . $wartosc . "<br>";
        next($towary);
    }
    reset($towary);
    echo "<br>";

    // D. użycie innych funkcji nawigacji po tablicach
    echo "Funkcje nawigacyjne:<br>";
    for ($i = 0; $i < count($towary); next($towary), $i++)
        echo "klucz: " . key($towary) . ", wartość: " . current($towary) . "<br>";
?>
</body>
</html>
