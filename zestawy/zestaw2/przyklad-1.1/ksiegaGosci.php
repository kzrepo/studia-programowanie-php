<?php
    $wpis = trim($_GET['wpis']);
    $imie = trim($_GET['imie']);
    $filename = 'ksiega.txt';
    $wpis = str_replace("\r\n", "<br>", $wpis);

    $plik = fopen($filename, "a");
    fputs($plik, "$imie\n");
    fputs($plik, "$wpis\n");
    fclose($plik);
?>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Księga gości</title>
    <style>
        body {background-color: yellow}
    </style>
</head>
<body>
<h2>Księga Gości.</h2>
<p>Oto co zostało dotychczas wpisane.</p>
<hr>
<?php
    $licznik = 1;
    $plik = fopen($filename, "r")
    or exit("Problem z otwarciem pliku $filename.");
    while (1)
    {
        $linia_1 = fgets($plik);
        $linia_2 = fgets($plik);
        $slowa = [];
        $zdanie = trim(str_replace('<br>', " ", $linia_2));
        $kolejne_slowo = strtok($zdanie, " ");
        while ($kolejne_slowo !== false)
        {
            $slowa[] = $kolejne_slowo;
            $kolejne_slowo = strtok(" ");
        }
        if (feof($plik)) break;
        print("Wpis nr $licznik <br>");
        print("Imię: <b>$linia_1 </b><br>");
        print("Treść wpisu (ilość słów: " . count($slowa) . "):<br> <b>$linia_2</b><br><hr>");
        $licznik++;
    }
    fclose($plik);
?>
</body>
</html>