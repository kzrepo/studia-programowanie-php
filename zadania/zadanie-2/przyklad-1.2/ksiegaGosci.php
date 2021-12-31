<!--
Zrobiłem to na bazie całych słów i porównywania tablic. Dzięki temu, mogę wyszukiwać
słowa, które nie występują po sobie.

Do wyszukiwania frazy wystarczy wpis zamienić
na string i wyszukać drugi string w postaci filtra.
-->

<?php
    $wpis = $_GET['wpis'] ?? null;
    $imie = $_GET['imie'] ?? null;
    $filtr = explode(" ", trim($_GET['filtr'] ?? null));

    $filename = 'ksiega.txt';
    $wpis = str_replace("\r\n", "<br>", $wpis);

    if (!empty($imie))
    {
        $plik = fopen($filename, "a");
        fputs($plik, "$imie\n");
        fputs($plik, "$wpis\n");
        fclose($plik);
        header("Location: ksiegaGosci.php");
    }
?>
<?php
    function drukuj_wpis()
    {
        global $lp, $linia_1, $slowa, $linia_2;
        print("Wpis nr $lp <br>");
        print("Imię: <b>$linia_1 </b><br>");
        print("Treść wpisu (ilość słów: " . count($slowa) . "):<br> <b>$linia_2</b><br><hr>");
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
    <button type="button" onclick="window.location.href='ksiegaGosci.html'">Dodaj wpis
    </button>
</form>
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