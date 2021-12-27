<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="refresh" content="3">
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<?php
    $filename = 'chat.txt';
    if (file_exists($filename))
    {
        $wpisy = file($filename);
        foreach ($wpisy as $wpis) echo $wpis . "<br>";

        // Alternatywne rozwiązanie
        /*
        $plik = fopen($filename, 'r') or exit ("Nie można otworzyć pliku $filename");
        while (!feof($plik))
        {
            echo fgets($plik) . '<br>';
        }
        fclose($plik);
        */
    }
?>
</body>
</html> 