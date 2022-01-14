<?php
    include_once('funkcje_db.php');
    
    function add_to_database($post)
    {
        global $polaczenie, $login, $is_user_exist;
        extract($post);
        otworz_polaczenie();
        if ($is_user_exist = !is_user_exist())
        {
            $query = "INSERT INTO uzytkownicy VALUES ('$login','$imie','$nazwisko','$plec','$haslo')";
            mysqli_query($polaczenie, $query) or exit("<p>Błąd w zapytaniu: $query</p>");
            echo "<h3>Użytkownik został dodany</h3>
                <p class='result'>
                Login: $login<br>
                Imię: $imie<br>
                Nazwisko: $nazwisko<br>
                Płeć: $plec<br><br>
                <a href='log3.php'>Zaloguj się</a></p>";
        } else
        {
            echo "<p class='center result'>
                Nazwa użytkownika: <b>$login</b><br>
                jest już zajęta<br>
                podaj inny login<br></p>";
        }
        zamknij_polaczenie();
    }
    
    function is_user_exist(): bool
    {
        global $polaczenie, $login;
        $query = "SELECT login FROM uzytkownicy WHERE login='$login'";
        $result_query = mysqli_query($polaczenie, $query) or exit("Błąd w zapytaniu: $query</p>");
        $login_db = mysqli_fetch_assoc($result_query);
        return (bool)$login_db;
    }
    
    $form = '
        <h3 class="center">Wypełnij formularz</h3>
        <form method="POST" action="">
            <table>
                <tr>
                    <td>
                        <label for="login">Login</label>
                    </td>
                    <td>
                        <input type="text" name="login" size="15" id="login" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="haslo">Hasło</label>
                    </td>
                    <td>
                        <input type="password" name="haslo" size="15" id="haslo" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="imie">Imię</label>
                    </td>
                    <td>
                        <input type="text" name="imie" size="15" id="imie" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="nazwisko">Nazwisko</label>
                    </td>
                    <td>
                        <input type="text" name="nazwisko" size="15" id="nazwisko" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="plec">Płeć</label>
                    </td>
                    <td>
                        <input type="radio" id="kobieta" name="plec" value="k" required>
                        <label for="kobieta">kobieta</label>
                        <br>
                        <input type="radio" id="mezczyzna" name="plec" value="m">
                        <label for="mezczyzna">mężczyzna</label>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Zarejestruj się" class="button">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="center">
                        <a href="log3.php">Powrót do logowania</a>
                    </td>
                </tr>
            </table>
        </form>';