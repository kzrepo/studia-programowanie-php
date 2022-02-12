<html>
<head>
    <meta charset="utf-8">
    <title>Wyniki egzaminu wstępnego - krok 3 z 4</title>
</head>
<body style='background-color: yellow; color: blue'>
<br>
<hr>
<div style='text-align:center'>

    <?php
        session_start();
        // tyko gdy dane przyszły z B
        if (isset ($_GET["miasto"])) $_SESSION['miasto'] = $miasto = $_GET["miasto"];
        if (isset ($_GET["data_ur"])) $_SESSION['data_ur'] = $data_ur = $_GET["data_ur"];
        if (isset ($_GET["wydz"])) $_SESSION['wydz'] = $wydz = $_GET["wydz"];

        $imie = $_SESSION["imie"];
        $nazwisko = $_SESSION["nazwisko"];

        $sw = $_SESSION['sw'] ?? '';
        $mat = $_SESSION['mat'] ?? '';
        $fiz = $_SESSION['fiz'] ?? '';
        $jez = $_SESSION['jez'] ?? '';

        echo "<b>$imie $nazwisko</b><br>";
    ?>

    <form action='zad_d.php'>
        <table style='display:inline'>
            <tr>
                <td><b>Punktacja:</b></td>
            </tr>
            <tr>
                <td>Świadectwo:</td>
                <td>
                    <input type=text name=sw size=4 value="<?= $sw ?>">
                </td>
                <td>Matematyka:</td>
                <td>
                    <input type=text name=mat size=4 value="<?= $mat ?>">
                </td>
            </tr>
            <tr>
                <td>Fizyka:</td>
                <td>
                    <input type=text name=fiz size=4 value="<?= $fiz ?>">
                </td>
                <td>Język obcy:</td>
                <td>
                    <input type=text name=jez size=4 value="<?= $jez ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type=submit value='Zakończ'>
                    <input type=submit OnClick="action='zad_b.php'" value='Wstecz'>
                </td>
            </tr>
        </table>
    </form>
    <hr>

</div>
</body>
</html>
