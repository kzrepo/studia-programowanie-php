<html>
<head>
    <meta charset="utf-8">
    <title>Przeglądarka plików</title>
</head>

<body bgcolor=yellow text="#000FFF">
<br>
<center>
    <form method=GET action=''>
        <table border=0>
            <tr>

                <?php
                    // $selectedPath przechowuje obecnie wybraną ścieżkę
                    //(domyślnie ścieżka do naszego skryptu)
                    //if(isset($_GET['selectedPath'])) $selectedPath = $_GET['selectedPath']; else $selectedPath = realpath(".");
                    $selectedPath = $_GET['selectedPath'] ?? realpath(".");

                    echo "<td>Obecna ścieżka: $selectedPath</td></tr></table>";
                    $positionList = opendir($selectedPath);

                    // generujemy listę wyboru zawierającą pozycje z bieżącej ścieżki
                    echo "<table border=0><tr><td align=left>Wybierz plik lub folder: <select name='selectedPath'>";
                    while (false !== ($p = readdir($positionList)))
                    {
                        // $p reprezentuje jedną pozycję (plik lub folder)
                        $path = realpath($selectedPath . "/" . $p);
                        if (is_dir($path))
                            echo "<option value='$path'>$p [DIR]</option>";
                    }
                    closedir($positionList);
                    echo "</select></td>";
                    echo "<td align=center><input type=submit value='Pokaż'> </td>";
                ?>

            </tr>
        </table>
    </form>
</center>

<?php
    // TUTAJ KOD WYPISUJĄCY ZAWARTOŚĆ WYBRANEGO PLIKU
?>

</body>
</html>
