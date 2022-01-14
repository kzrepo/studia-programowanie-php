<?php
    function otworz_polaczenie()
    {
        global $polaczenie, $baza;
        $serwer = "localhost";
        $uzytkownik = "root";
        $haslo = "";
        $baza = "zestaw3_przyklad2_hash";
        
        $polaczenie = mysqli_connect($serwer, $uzytkownik, $haslo) or exit("<p>Nieudane połączenie z serwerem</p>");
        if (!mysqli_select_db($polaczenie, $baza))
        {
            if (mysqli_errno($polaczenie) == 1049)
            {
                utworz_baze();
                mysqli_select_db($polaczenie, $baza);
                utworz_tabele();
                wstaw_dane_testowe();
            } else echo("<p>Połączenie z bazą danych $baza nieudane</p>");
        }
        mysqli_set_charset($polaczenie, "utf8");
    }
    
    function utworz_baze()
    {
        global $polaczenie, $baza;
        echo "<p>Tworzę bazę danych '$baza' ... </p>";
        mysqli_query($polaczenie, "CREATE DATABASE `$baza` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;")
        or exit("<p>Błąd w zapytaniu tworzącym bazę</p>");
    }
    
    function utworz_tabele()
    {
        global $polaczenie;
        $query = "CREATE TABLE uzytkownicy (" .
                "`login` varchar(20) NOT NULL, " .
                "`imie` varchar(20) NOT NULL, " .
                "`nazwisko` varchar(30) NOT NULL, " .
                "`plec` char(1) NOT NULL, " .
                "`haslo` varchar(60) NOT NULL, " .
                "PRIMARY KEY (`login`))";
        mysqli_query($polaczenie, $query) or exit("<p>Błąd w zapytaniu: $query</p>");
    }
    
    function wstaw_dane_testowe()
    {
        global $polaczenie;
        mysqli_set_charset($polaczenie, "utf8");
        $pass_sophia = '$2y$10$IcSiLPHOlw.uh0YgvHd..edw3J3HlAmT8.QJKku8JqssIal.vSnh.';
        $pass_tom = '$2y$10$235ZSyTTD3SO2.gN1GmtpeFPQxBJbBnlaCvUdtdekHjOTrm6Ba8Hi';
        $query = ["INSERT INTO uzytkownicy VALUES('sophia', 'Zosia', 'Rozważna', 'k', '$pass_sophia');",
                "INSERT INTO uzytkownicy VALUES('tom', 'Tomek', 'Fajny', 'm', '$pass_tom');",];
        foreach ($query as $rozkaz)
            mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: $rozkaz</p>");
    }
    
    function zamknij_polaczenie()
    {
        global $polaczenie;
        mysqli_close($polaczenie);
    }