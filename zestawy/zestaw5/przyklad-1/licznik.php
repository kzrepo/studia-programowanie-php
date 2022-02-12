<?php

    $liczRok = $_COOKIE['licznikRok'] ?? 0;
    $liczDoba = $_COOKIE['licznikDoba'] ?? 0;
    $liczMin = $_COOKIE['licznikMin'] ?? 0;
    $ostatnio = $_COOKIE['ostatnio'] ?? '???';
    if (!isset($_COOKIE['guard']))
    {
        $liczRok++;
        $liczDoba++;
        $liczMin++;
    }

    setcookie('licznikRok', $liczRok, time() + 60 * 60 * 24 * 365);
    setcookie('licznikDoba', $liczDoba, time() + 60);
    setcookie('licznikMin', $liczMin, time() + 10);
    setcookie('ostatnio', date('d-F-y'), time() + 60 * 60 * 24 * 365);

    // Zabezpieczenie przed odświeżaniem
    setcookie('guard', 1); // ciastko sesyjne wygasa na koniec sesji
    //setcookie('guard') // ciastko bez wartości usuwa ciastko
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Licz odwiedziny</title>
    <style>
        body {background-color: yellow; color: #000fff}
    </style>
    <script>

    </script>
</head>

<body>
<br>Odwiedziłeś tę stronę:<br>
W ciągu roku <?= $liczRok ?> razy, ostatnia wizyta: <?= $ostatnio ?><br>
W ciągu doby <?= $liczDoba ?> razy<br>
W ciągu minuty <?= $liczMin ?> razy<br>
</body>
</html>
