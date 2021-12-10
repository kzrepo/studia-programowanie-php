<?php
    $wpis = $_GET['wpis'];
    $imie = $_GET['imie'];
    //Tu na poczatku skryptu zapiszę dany wpis do pliku ksiega.txt
    //Zamieniam $wpis w jedną linię ze znacznikami <br>
    $wpis = str_replace("\n", "<br>", $wpis);
    //Poniższe by wszystko było ok pod Windows (\x0D to po prostu kod \r)
    $wpis = str_replace("\x0D", "", $wpis);
    $plik = fopen("ksiega.txt", "a");
    fputs($plik, "$imie\n");
    fputs($plik, "$wpis\n");
    fclose($plik);
    // Zakładam, że pojedynczy wpis zajmuje zawsze 2 linie
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Księga gości</title>
</head>
<body bgcolor="yellow">
<p>Ksiega Gości.</p>
Oto co zostało dotychczas wpisane.<br>
<hr>
<?php
    $licznik = 1;

    $plik = fopen("ksiega.txt", "r")
// Ta konstrukcja - albo fopen albo exit (gdy fopen byłoby false) 
// jest sposobem na obsługę niepowodzeń, znak @ przy nazwie wstrzymuje 
// wygenerowanie wbudowanego komunikatu o niepowodzeniu 
    or exit("Problem z otwarciem pliku.");
    while (1)
    {
//Czytam linie 
        $linia_1 = fgets($plik);
        $linia_2 = fgets($plik);
        if (feof($plik)) break;
//Wypisuję linie 
        print("Wpis nr $licznik <br>");
        print("Imię: <b>$linia_1 </b><br>");
        print("Treść wpisu:<br> <b>$linia_2</b><br><hr>");
        $licznik++;
    }
    fclose($plik);
?>
</body>
</html>