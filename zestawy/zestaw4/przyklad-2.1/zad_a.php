<?php
    session_start();
    $imie = $_SESSION["imie"];
    $nazwisko = $_SESSION["nazwisko"];

    // Aktualizacja danych gdy idą z B
    $_SESSION['miasto'] = $_GET['miasto'] ?? $_SESSION['miasto'];
    $_SESSION['data_ur'] = $_GET['data_ur'] ?? $_SESSION['data_ur'];
    $_SESSION['wydz'] = $_GET['wydz'] ?? $_SESSION['wydz'];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Wyniki egzaminu wstępnego - krok 1 z 4</title>
</head>
<body style='background-color: yellow; color: blue'>
<br>
<hr>
<div style='text-align:center'>
    <form action='zad_b.php'>
        <table style='display:inline'>
            <tr>
                <td>Imię:</td>
                <td>
                    <input type=text name=imie size=20 value="<?= $imie ?>">
                </td>
                <td>Nazwisko:</td>
                <td>
                    <input type=text name=nazwisko size=25 value="<?= $nazwisko ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type=submit value='Dalej'>
                </td>
            </tr>
        </table>
    </form>
</div>
<hr>
</body>
</html>
