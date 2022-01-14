<!--
Utwórz bazę danych o dowolnej nazwie zawierającą tabelę ‘uzytkownicy’ o
strukturze odpowiadającej danym o użytkowniku (login, imię, nazwisko, płeć,
hasło) oraz wypełnij tabelę danymi testowymi.
Możesz też utworzyć plik wsadowy z poleceniami SQL i zaimportować go w środowisku
MySQL lub napisać odpowiedni skrypt PHP (np. instalacja.php) tworzący strukturę bazy
danych i uruchomić przed udostępnieniem właściwego serwisu (np. strony startowej)
-->

<?php
    include("funkcje_login.php");
?>
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
        if (!empty($_POST['login']))
        {
            $login_form = $_POST['login'];
            $haslo_form = $_POST['haslo'];
            $user_db = [];
            sprawdz_uzytkownika($user_db);
            zweryfikuj_haslo($user_db);
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
