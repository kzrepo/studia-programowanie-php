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

                    if (is_file($selectedPath))
                    {
                        $selectedFile = basename($selectedPath); // nazwa pliku
                        $selectedPath = dirname($selectedPath); // reszta ścieżki
                    }

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
                        else echo "<option value='$path'>$p [FILE]</option>";
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
    if (isset($selectedFile))
    {
        $lines = file($selectedPath . '/' . $selectedFile);
        foreach ($lines as $line_num => $line)
        {
            echo "<pre style='white-space: pre; margin:0'>" . ($line_num + 1) . " : " . htmlspecialchars($line) . "</pre>";
        }
    }
?>

</body>
</html>
