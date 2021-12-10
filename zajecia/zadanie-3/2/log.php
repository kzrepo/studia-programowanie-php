<html>
<head>
    <meta charset="utf-8">
    <title>Logowanie</title>
</head>
<body bgcolor=teal text="#FFFFFF">
<br>
<div>
    <?php
        /* $uzytkownicy = [];
        $plik = fopen("dostep.txt","r")
        or exit("Problem z otwarciem pliku.");
        while (1)
        {
        //Czytam linie
            $dane_uzytkownika = fgets($plik);
            if(feof($plik)) break;
        //Dodaje uzytkownika do tablicy uzytkownikow
            $uzytkownik = explode(';',$dane_uzytkownika);
            array_push($uzytkownicy, $uzytkownik);

            print("$uzytkownik");
            print("$uzytkownicy");
        }
        fclose($plik); */
    ?>

    <?php
        if (isset()

        while (1)
        {
            $linia = fgets($plik);
            $dostep = explode(";", $linia);
            $imie = $dostep[0];
            $nazwisko = $dostep[1];
            $haslo = $dostep[2];
            $gender = $dostep[3];
            if ($_POST['imie'] == $login)
            {
                $snaleziony = true;
            }
            if (fepf($plik)) break;
        }
    ?>

    <?php
        if (isset($_POST['nazwisko']))
        {
            if ($_POST['haslo'] == "test")
                echo $_POST['imie'] . " " . $_POST['nazwisko'] . ", witamy "
                        . ($_POST['plec'] == "t" ? "Panią" : "Pana") . " w systemie ";
            else echo "Logowanie nieudane";
        } else
        {
// formularz generuje tylko gdy dane jeszcze nie były wysyłane 
            ?>
            <form method=POST action=''>
                <table border=0 style="margin: 0 auto;">
                    <tr>
                        <td>Imię</td>
                        <td colspan=2>
                            <input type=text name='imie' size=15 style='text-align: left'>
                        </td>
                    </tr>
                    <!-- te pola nie będą potrzebne, zatem dopisz ten komentarz
                    <tr><td>Nazwisko</td><td colspan=2>
                    <input type=text name='nazwisko' size=15 style='text-align: left'></td>
                    </tr>
                    <tr><td>Płeć:</td><td>Kobieta</td>
                    <td><INPUT TYPE="radio" NAME="plec" value="t"></td>
                    </tr><tr><td></td>
                    <td>Mężczyzna</td><td><INPUT TYPE="radio" NAME="plec" value="f"> </td>
                    </tr>
                    -->
                    <tr>
                        <td>Hasło</td>
                        <td colspan=2>
                            <input type=password name='haslo' size=15 style='text-align:left'>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=3>
                            <input type=submit value='Zaloguj się' style='width:200'>
                        </td>
                    </tr>
                </table>
            </form>
        <?php } // koniec else ?>
</div>
</body>
</html>