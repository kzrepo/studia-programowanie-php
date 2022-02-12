<html>
<head>
    <meta charset="utf-8">
    <title>Wyniki egzaminu wstępnego - krok 4 z 4</title>
</head>
<body style='background-color: yellow; color: blue'>
<br>
<hr>
<div style='text-align:center'>

    <?php
        session_start();
        $_SESSION['sw'] = $sw = $_GET["sw"];
        $_SESSION['mat'] = $mat = $_GET["mat"];
        $_SESSION['fiz'] = $fiz = $_GET["fiz"];
        $_SESSION['jez'] = $jez = $_GET["jez"];

        $imie = $_SESSION["imie"];
        $nazwisko = $_SESSION["nazwisko"];
        $miasto = $_SESSION["miasto"];
        $data_ur = $_SESSION["data_ur"];
        $wydz = $_SESSION["wydz"];

        echo "
            Wprowadzono dane: <br><br>
            <b>$imie $nazwisko</b>, ur. $data_ur<br>
            Miejsce zamiedzkania: $miasto<br><br>
            Egzamin na wydział $wydz z następującym wynikiem:<br>
            Świadectwo: $sw<br>
            Matematyka: $mat<br>
            Fizyka: $fiz<br>
            Język obcy: $jez<br>";
    ?>
    <br>
    <input type=button OnClick="location='zad_c.php'" value='Wstecz'>
</div>
</body>
</html>
