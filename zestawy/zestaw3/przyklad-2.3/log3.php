<!--
Zbuduj skrypt rejestracja.php ładowany do przeglądarki po wybraniu odsyłacza
„Jeśli nie masz dostępu ZAREJESTRUJ SIĘ” (umieść go uprzednio na stronie
logowania). Wystarczy dodać linię:
<a href='rejestracja.php'> Jeśli nie masz dostępu ZAREJESTRUJ SIĘ </a>
Skrypt rejestracja.php powinien wyświetlać formularz z polami do
wprowadzenia loginu, imienia, nazwiska, płci oraz hasła a także przycisk
„Zarejestruj”. Po jego wciśnięciu dane użytkownika powinny dopisywać się do
pliku a na stronie powinien pojawić się odsyłacz do strony logowania.
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
        label {margin-right: 20px}
        a {color: white;}
        .button {width: 100%; margin-top: 10px;}
        .container {display: flex; justify-content: center; margin: 50px;}
        .center {text-align: center; margin}
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
                <h3 class="center">Logowanie</h3>
                <table>
                    <tr>
                        <td>
                            <label for="login">Login</label>
                        </td>
                        <td>
                            <input type=text name='login' size=15 id="login">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="haslo">Hasło</label>
                        </td>
                        <td>
                            <input type=password name='haslo' size=15' id="haslo">
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type=submit value='Zaloguj się' class="button">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="center">
                            <a href='rejestracja.php'> Jeśli nie masz dostępu<br> ZAREJESTRUJ SIĘ </a>
                        </td>
                    </tr>
                </table>
            </form>
        <?php } ?>
</div>
</body>
</html>
