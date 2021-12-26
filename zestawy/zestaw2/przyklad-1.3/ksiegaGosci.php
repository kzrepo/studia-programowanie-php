<!--
Wykorzystałem funkcję fgetcsv()
-->

<?php
    $wpis = $_GET['wpis'] ?? null;
    $imie = $_GET['imie'] ?? null;
    $filtr = explode(" ", trim($_GET['filtr'] ?? null));

    $filename = 'ksiega.txt';
    $wpis = str_replace("\r\n", "<br>", $wpis);

    $plik = fopen($filename, "a");
    if (!$imie == null)
    {
        fputs($plik, "\"$imie\";\"$wpis\"\n");
    }
    fclose($plik);
?>
<?php
    function drukuj_wpis()
    {
        global $licznik, $slowa, $wpis_wczytany;
        print("Wpis nr $licznik <br>");
        print("Imię: <b>$wpis_wczytany[0] </b><br>");
        print("Treść wpisu (ilość słów: " . count($slowa) . "):<br> <b>$wpis_wczytany[1]</b><br><hr>");
    }
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
<form action="ksiegaGosci.php" method="get">
    <label for="filtr"><i>Pokaż tylko wpisy zawierające frazę: </i></label>
    <input type="text" size="25" id="filtr" name="filtr">
    <input type="submit" value="Filtruj">
    <button type="button" onclick="window.location.href='http://studia' +
     '.localhost:8082/zestawy/zestaw2/przyklad-1.2/ksiegaGosci.html'">Dodaj wpis
    </button>
</form>
<hr>
<?php
    $licznik = 1;
    $plik = fopen($filename, "r")
    or exit("Problem z otwarciem pliku $filename.");
    while (1)
    {
        $wpis_wczytany = fgetcsv($plik, 1000, ";", "\"");
        $slowa = [];
        $zdanie = trim(str_replace('<br>', " ", $wpis_wczytany[1] ?? null));
        $kolejne_slowo = strtok($zdanie, " ");
        while ($kolejne_slowo !== false)
        {
            $slowa[] = $kolejne_slowo;
            $kolejne_slowo = strtok(" ");
        }
        if (feof($plik)) break;

        if (empty($filtr[0]))
        {
            drukuj_wpis();
        } else
        {
            // porównuje filtr z tablicą wpisu, filtr może mieć kilka słów
            if (array_intersect($filtr, $slowa) == $filtr)
            {
                drukuj_wpis();
            }
        }
        $licznik++;
    }
    fclose($plik);
?>
</body>
</html>