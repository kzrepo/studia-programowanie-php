<!--
Poniżej kod strony (ze skryptem) logującej do systemu na podstawie danych o
dostępie zapisanych w pliku dostep.txt (jest to rozwiązanie przykładu z
poprzedniego zestawu uzupełnione o pole ‘login’).
-->

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Logowanie</title>
    <style>
        body {background-color: teal; color: white;}
        table {border: 0;}
        .button {width: 100%; margin-top: 10px;}
        .container {display: flex; justify-content: center; margin: 50px;}
    </style>
</head>
<body>
<div class="container">
    <?php
        if (isset($_POST['login']))
        {
            $plik = @fopen("dostep.txt", "r")
            or exit("Błąd w pliku z danymi użytkowników");

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
                    echo "$userData[1] $userData[2], witamy " . ($userData[4] == "k" ? "Panią" : "Pana") . " w systemie ";
                else echo "Logowanie nieudane";
            else echo "Brak podanego użytkownika";
        } else
        { ?>
            <form method=POST action=''>
                <table>
                    <tr>
                        <td>
                            <label for="login">Login</label>
                        </td>
                        <td colspan=2>
                            <input type=text name='login' size=15 id="login">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="haslo">Hasło</label>
                        </td>
                        <td colspan=2>
                            <input type=password name='haslo' size=15' id="haslo">
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type=submit value='Zaloguj się' class="button">
                        </td>
                    </tr>
                </table>
            </form>
        <?php } ?>
</div>
</body>
</html>
