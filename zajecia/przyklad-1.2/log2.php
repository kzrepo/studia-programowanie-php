<html>
<head>
    <meta charset="utf-8">
    <title>Logowanie</title>
</head>

<body bgcolor=teal text="#FFFFFF">

<br>
<center>

    <?php

        $haslo = $_GET['haslo'] ?? null;
        $imie = $_GET['imie'] ?? null;
        $nazwisko = $_GET['nazwisko'] ?? null;
        $plec = $_GET['plec'] ?? null;

        if ($haslo == null || $imie == null || $nazwisko == null || $plec == null)
            echo 'Wróć do formularza logowania i podaj wszystkie dane';
        else if ($haslo === 'test')
            echo $imie . ' ' . $nazwisko . ', witamy ' . ($plec === 't' ? 'Panią' : 'Pana') . ' w systemie ';
        else echo 'Logowanie nieudane';

    ?>

</center>

</body>
</html>
