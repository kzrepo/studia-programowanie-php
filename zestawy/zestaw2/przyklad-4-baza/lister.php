<!--
Poniższy skrypt generuje kod strony HTML wyświetlającej listę wyboru (element
<select>) zawierającą nazwy podkatalogów pewnego, bieżącego katalogu. Po
wyborze jednego z katalogów i wciśnięciu przycisku „Wybierz” wybrana pozycja
staje się katalogiem bieżącym. Po przeładowaniu strony następuje aktualizacja
listy oraz bieżącej ścieżki.
Umieść skrypt na serwerze, uruchom i zaobserwuj działanie. Następnie wykonaj
ćwiczenia do przykładu.
-->

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Przeglądarka plików</title>
    <style>
        body {background-color: yellow; color: #000FFF; padding-top: 30px; text-align: center}
        table {border: 0}
    </style>
</head>
<body>
<form method=GET action=''>
    <table>
        <tr>
            <?php
                // włącza komunikaty o błędach
                error_reporting(E_ALL);

                // $selectedPath przechowuje obecnie wybraną ścieżkę
                //(domyślnie ścieżka do naszego skryptu)
                $selectedPath = $_GET['selectedPath'] ?? realpath(".");

                echo "<td>Obecna ścieżka: $selectedPath</td></tr></table>";
                $positionList = opendir($selectedPath);

                // generujemy listę wyboru zawierającą pozycje z bieżącej ścieżki
                echo "<table><tr><td style='text-align: left'>Wybierz plik lub folder: <select name='selectedPath'>";
                while (false !== ($p = readdir($positionList)))
                {
                    // $p reprezentuje jedną pozycję (plik lub folder)
                    $path = realpath($selectedPath . "/" . $p);
                    if (is_dir($path))
                        echo "<option value='$path'>$p [DIR]</option>";
                }
                closedir($positionList);
                echo "</select></td>";
                echo "<td style='text-align: center'><input type=submit value='Pokaż'> </td>";
            ?>
        </tr>
    </table>
</form>
<?php
    // TUTAJ KOD WYPISUJĄCY ZAWARTOŚĆ WYBRANEGO PLIKU
?>
</body>
</html>
