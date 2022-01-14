<?php
    function otworz_polaczenie()
    {
        global $polaczenie, $baza;
        $serwer = "localhost";
        $uzytkownik = "root";
        $haslo = "";
        $baza = "zestaw3_przyklad2";
        
        $polaczenie = mysqli_connect($serwer, $uzytkownik, $haslo) or exit("Nieudane połączenie z serwerem");
        if (!mysqli_select_db($polaczenie, $baza))
        {
            if (mysqli_errno($polaczenie) == 1049)
            {
                utworz_baze();
                mysqli_select_db($polaczenie, $baza);
                utworz_tabele();
                wstaw_dane_testowe();
            } else echo("Połączenie z bazą danych $baza nieudane<br>");
        }
        mysqli_set_charset($polaczenie, "utf8");
    }
    
    function zamknij_polaczenie()
    {
        global $polaczenie;
        mysqli_close($polaczenie);
    }
    
    function utworz_baze()
    {
        global $polaczenie, $baza;
        echo "Tworzę bazę danych '$baza' ... <br>";
        mysqli_query($polaczenie, "CREATE DATABASE `$baza` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;")
        or exit("Błąd w zapytaniu tworzącym bazę");
    }
    
    function utworz_tabele()
    {
        global $polaczenie;
        $rozkaz = "CREATE TABLE uzytkownicy (" .
                "`login` varchar(20) NOT NULL, " .
                "`imie` varchar(20) NOT NULL, " .
                "`nazwisko` varchar(30) NOT NULL, " .
                "`plec` char(1) NOT NULL, " .
                "`haslo` varchar(60) NOT NULL, " .
                "PRIMARY KEY (`login`))";
        mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: $rozkaz");
    }
    
    function wstaw_dane_testowe()
    {
        global $polaczenie;
        mysqli_set_charset($polaczenie, "utf8");
        $rozkazy = ["INSERT INTO uzytkownicy VALUES('sophia', 'Zosia', 'Rozważna', 'k', 'zzooss');",
                "INSERT INTO uzytkownicy VALUES('tom', 'Tomek', 'Fajny', 'm', 'ttoomm');",];
        foreach ($rozkazy as $rozkaz)
            mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: " . $rozkaz);
    }
    