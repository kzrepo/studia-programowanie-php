<html>
<head>
    <meta charset="utf-8">
    <title>Logowanie</title>
</head>

<body bgcolor=teal text="#FFFFFF">
<br>
<center>

    <?php

        $haslo = $_GET['haslo'];
        $imie = $_GET['imie'];
        $nazwisko = $_GET['nazwisko'];
        $plec = $_GET['plec'];

        if ($haslo == "test") echo $imie . " " . $nazwisko . ", witamy " .
                ($plec == "t" ? "Panią" : "Pana") . " w systemie ";
        else echo "Logowanie nieudane";

        // albo bez łączenia wszystkiego kropkami, zmienne umieszczając bezpośrednio w napisie (stringu)
        /*
        if($haslo == "test") echo "$imie $nazwisko, witamy".($plec=="t"?"Panią":"Pana")." w systemie ";
        else echo "Logowanie nieudane";
        */

        // można też bezpośrednio użyć tablicy superglobalnej $_GET, bez przypisywania do zmiennych
        // (choć to może niejednokrotnie uprościć kod)
        /*
        if($_GET['haslo']=="test") echo $_GET['imie']." ".$_GET['nazwisko'].", witamy ".
            ($_GET['plec']=="t"?"Panią":"Pana")." w systemie ";
        else echo "Logowanie nieudane";
        */
    ?>

</center>
</body>
</html>
