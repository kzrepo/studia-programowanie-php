<html>
<head>
    <meta charset="utf-8">
    <title>Logowanie</title>
    <style>
        body { background-color: teal; color: #FFFFFF; }
    </style>
</head>
<body>
<br>
<div style='text-align: center'>
    <?php
        if (isset($_POST['login']))
        {
            $plik = @fopen("dostep.txt", "r")
            or exit("Błąd w pliku z danymi uzytkownikow</div></body></html>");

            $znaleziony = false;
            while (!feof($plik))
            {
                $userData = fgetcsv($plik, 0, ';');
                if ($userData[0] == $_POST['login'])
                {
                    $znaleziony = true;
                    break;
                }
            }
            fclose($plik);

            if ($znaleziony)
                if ($_POST['haslo'] == $userData[3])
                    echo $userData[1] . " " . $userData[2] . ", witamy " .
                        ($userData[4] == "k" ? "Panią" : "Pana") . " w systemie ";
                else echo "Logowanie nieudane";
            else echo "Brak podanego uzytkownika";
        } else
        { // formularz generuje tylko gdy dane jeszcze nie były wysyłane
            ?>

            <form method=POST action=''>
                <table border=0 style='display:inline'>
                    <tr>
                        <td>Imię</td>
                        <td colspan=2>
                            <input type=text name='login' size=15 style='text-align:center'>
                        </td>
                    </tr>
                    <tr>
                        <td>Hasło</td>
                        <td colspan=2>
                            <input type=password name='haslo' size=15 style='text-align:left'>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type=submit value='Zaloguj się' style='width:100%'>
                        </td>
                    </tr>
                </table>
            </form>
        <?php } // koniec else ?>
</div>
</body>
</html>
