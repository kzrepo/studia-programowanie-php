<?php
    include_once("funkcje_db.php");
    
    function sprawdz_uzytkownika(&$user_db)
    {
        global $polaczenie, $login_form;
        otworz_polaczenie();
        
        $query = "SELECT * FROM uzytkownicy WHERE login='$login_form'";
        $user = mysqli_query($polaczenie, $query)
        or exit ("<p>Źle sformułowane żądanie o dane użytkownika</p>");
        $user_db = mysqli_fetch_assoc($user);
        mysqli_free_result($user);
        zamknij_polaczenie();
    }
    
    function zweryfikuj_haslo($user_db)
    {
        global $login_form, $haslo_form;
        if ($user_db)
            if ($haslo_form == $user_db['haslo'])
                echo "<p>" . $user_db['imie'] . " " . $user_db['nazwisko'] . ", witamy " . ($user_db['plec'] == "k" ?
                                "Panią" : "Pana") . " w systemie</p>";
            else echo "<p>Logowanie nieudane. Podano złe hasło!<br>
                <a href='log3.php'>Zaloguj się ponownie</a></p>";
        else echo "<p>Brak podanego użytkownika: $login_form<br>
                <a href='log3.php'>Zaloguj się ponownie</a></p>";
    }