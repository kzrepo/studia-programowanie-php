<?php
    function otworz_polaczenie()
    {
        global $polaczenie, $baza;
        $serwer = "127.0.0.1";
        $uzytkownik = "root";
        $haslo = "";
        $baza = "studia";
        
        $polaczenie = mysqli_connect($serwer, $uzytkownik, $haslo) or exit("Nieudane połączenie z serwerem");
        //mysqli_select_db($polaczenie, $baza) or exit("Nieudane połączenie z bazą $baza");
        if (!mysqli_select_db($polaczenie, $baza))
        {
            // 1049 oznacza że baza nie istnieje
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
        
        $rozkaz = "CREATE TABLE przedmioty " .
                "(numer int NOT NULL AUTO_INCREMENT ," .
                "nazwa varchar(32), " .
                "godzin int, PRIMARY KEY (`numer`))";
        mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: $rozkaz");
        
        $rozkaz = "CREATE TABLE studenci " .
                "(numer int NOT NULL AUTO_INCREMENT ," .
                "imie varchar(32), " .
                "nazwisko varchar(32), " .
                "PRIMARY KEY (`numer`))";
        mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: $rozkaz");
        
        $rozkaz = "CREATE TABLE oceny " .
                "(nr_stud int NOT NULL, " .
                "nr_przed int NOT NULL, " .
                "ocena float " .
                ")";
        mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: $rozkaz");
    }
    
    function wstaw_dane_testowe()
    {
        global $polaczenie;
        mysqli_set_charset($polaczenie, "utf8");
        $rozkazy = array("INSERT INTO przedmioty VALUES(NULL, 'Programowanie', 30);",
                "INSERT INTO przedmioty VALUES(NULL, 'Szydełkowanie', 20);",
                "INSERT INTO przedmioty VALUES(NULL, 'Pływanie', 50);");
        foreach ($rozkazy as $rozkaz)
            mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: " . $rozkaz);
        
        $rozkazy = array("INSERT INTO studenci VALUES(NULL, 'Jan', 'Smith');",
                "INSERT INTO studenci VALUES(NULL, 'Agnieszka', 'Bond');",
                "INSERT INTO studenci VALUES(NULL, 'Monika', 'Ratownik');");
        foreach ($rozkazy as $rozkaz)
            mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: " . $rozkaz);
        
        $rozkazy = array("INSERT INTO oceny VALUES(1, 1, 4.0);",
                "INSERT INTO oceny VALUES(1, 2, 5.5);",
                "INSERT INTO oceny VALUES(3, 3, 5.0);");
        foreach ($rozkazy as $rozkaz)
            mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: " . $rozkaz);
    }
    