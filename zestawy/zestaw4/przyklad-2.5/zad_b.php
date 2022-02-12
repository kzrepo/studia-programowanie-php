<html>
<head>
    <meta charset="utf-8">
    <title>Wyniki egzaminu wstępnego - krok 2 z 4</title>
</head>
<body style='background-color: yellow; color: blue'>
<br>
<hr>
<div style='text-align:center'>

    <?php
        session_start();
        // Tylko gdy dane przyszły z A
        if (isset ($_GET["imie"])) $_SESSION['imie'] = $_GET["imie"];
        if (isset ($_GET["nazwisko"])) $_SESSION['nazwisko'] = $_GET["nazwisko"];

        // Aktualizacja danych gdy przyszły z C
        $_SESSION['sw'] = $_GET['sw'] ?? $_SESSION['sw'];
        $_SESSION['mat'] = $_GET['mat'] ?? $_SESSION['mat'];
        $_SESSION['fiz'] = $_GET['fiz'] ?? $_SESSION['fiz'];
        $_SESSION['jez'] = $_GET['jez'] ?? $_SESSION['jez'];

        $imie = $_SESSION["imie"];
        $nazwisko = $_SESSION["nazwisko"];

        $miasto = $_SESSION['miasto'] ?? '';
        $data_ur = $_SESSION['data_ur'] ?? '';
        $wydz = $_SESSION['wydz'] ?? '';

        echo "<b>$imie $nazwisko</b><br>";
    ?>

    <form action='zad_c.php'>

        <table style='display:inline'>
            <tr>
                <td>Miasto:</td>
                <td>
                    <input type=text name=miasto size=20 value="<?= $miasto ?>">
                </td>
                <td>Data urodzenia:</td>
                <td>
                    <input type=text name=data_ur size=15 value="<?= $data_ur ?>">
                </td>
            </tr>
            <tr>

                <td>Wydział:</td>
                <td>
                    <input type=text name=wydz size=6 value="<?= $wydz ?>">
                </td>
                <td></td>
            </tr>
            <tr>

                <td>
                    <input type=submit value='Dalej'>
                    <input type=submit OnClick="action='zad_a.php'" value='Wstecz'>
                </td>
            </tr>
        </table>

    </form>
</div>
<hr>
</body>
</html>
