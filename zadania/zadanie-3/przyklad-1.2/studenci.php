<?php
    include('funkcje_db.php');
    function wypisz_studenci()
    {
        // zmienna przechowująca uchwyt do bazy
        // uzyskany jako wynik mysql_connect()
        global $polaczenie;

        $zapytanie = "SELECT * FROM studenci";
        $wynik = mysqli_query($polaczenie, $zapytanie);
        // gdy zapytanie nie wykona się poprawnie funkcja jest przerywana
        if (!$wynik) return;

        // generowanie formularza, nagłówków tabeli i przycisku dodawania nowego rekordu (studenta)
        $naglowki = ["Imię", "Nazwisko"];
        print("<h3>Studenci</h3>");
        print("<form method='POST'>");
        print("<table><tr>");
        foreach ($naglowki as $naglowek) print("<th>$naglowek</th>");
        // zapis name='przycisk[]' oznacza że po wysłaniu formularza
        // w tablicy danych przesyłanych metodą POST
        // w podtablicy o nazwie 'przycisk', pod pierwszym wolnym indeksem
        // zapisze się wartość 'Dodaj nowego' jeśli ten właśnie przycisk został wciśnięty
        print("<th><input type='submit' name='przycisk[-1]' value='Dodaj nowego'></th>");
        print("</tr>");
        // generowanie pozostałych wierszy tabeli zawierających dane studentów
        // oraz przyciski do wykonania operacji na każdym z nich
        while ($wiersz = mysqli_fetch_row($wynik))
        {
            print("<tr>");
            foreach ($wiersz as $p => $pole)
                if ($p != 0) print("<td>$pole</td>");
            // wciśnięcie przycisku ustawi odpowiednią nazwę operacji do wykonania
            // jako wartość elementu 'przycisk[id]', gdzie id jest kluczem głównym z tabeli studentów
            print("<td class='center'>
                <input type='submit' name='przycisk[$wiersz[0]]' value='Edytuj'>
                <input type='submit' name='przycisk[$wiersz[0]]' value='Usuń'></td>");
            print("</tr>");
        }
        print("</table>");
        print("</form>");
        mysqli_free_result($wynik);
    }
    function edytuj_studenta($nr = -1)
    {
        global $polaczenie;
        // poniższy fragment ustawia wartości zmiennych imie i nazwisko
        // wyciągając z bazy dla studenta o podanym w parametrze numerze
        if ($nr != -1)
        { // edycja
            $rozkaz = "select imie, nazwisko from studenci where numer=$nr;";
            $rekord = mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: " . $rozkaz);

            $student = mysqli_fetch_row($rekord);
            $imie = $student[0];
            $nazwisko = $student[1];

            //$imie = mysqli_result($rekord, 0, "imie");
            //$nazwisko = mysqli_result($rekord, 0, "nazwisko");
        } else
        { // dodanie nowego
            $imie = '';
            $nazwisko = '';
        }
        // generuje formularz do edycji imienia i nazwiska studenta
        echo "
        <form method=POST action=''>
            <table>
                <tr>
                    <th>Imię</th>
                    <td colspan=2>
                        <input type=text name='imie' value='$imie' size=15 style='text-align: left'>
                    </td>
                </tr>
                <tr>
                    <th>Nazwisko</th>
                    <td colspan=2>
                        <input type=text name='nazwisko' value='$nazwisko' size=15 style='text-align: left'>
                    </td>
                </tr>
                <tr>
                    <td colspan=3>
                        <input type=submit name='przycisk[$nr]' value='Zapisz' style='width:200px'>
                    </td>
                </tr>
            </table>
        </form>
        ";
    }
    function zapisz_studenta($nr)
    {
        global $polaczenie;
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        if ($nr != -1)
            $rozkaz = "update studenci set imie='$imie', nazwisko='$nazwisko' where numer=$nr;";
        else $rozkaz = "insert into studenci values(null, '$imie', '$nazwisko');";
        mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: " . $rozkaz);
        header('Location: studenci.php');
    }
    function usun_studenta($nr)
    {
        global $polaczenie;
        $rozkaz = "DELETE FROM studenci WHERE numer='$nr';";
        mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: " . $rozkaz);
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Obsługa studentów</title>
    <style>
        body {background-color: yellow; color: blue;}
        table {border: 2px solid; border-collapse: collapse;}
        td, th {border: 1px solid;padding: 5px 10px;}
        th {background-color: #000fff; color: white;}
        .center {text-align: center;}
        .container {display: flex; align-items: center; flex-direction: column;
            margin-top: 20px; padding-top: 10px; border-top: 2px solid;}
    </style>
</head>
<body>

<input type=button value=" STUDENCI " onClick="window.location='studenci.php'">
<br><br>
<form name=menu action='oceny.php'>
    <input type=submit value=" OCENY ">
</form>
<br>
<a href='przedmioty.php'> PRZEDMIOTY </a>

<div class="container">
    <?php
        echo "<p>";
        print_r($_POST);
        echo "</p>";

        $polecenie = '';
        if (isset($_POST['przycisk']))
        {
            $nr = key($_POST['przycisk']);
            $polecenie = $_POST['przycisk'][$nr];
        }

        otworz_polaczenie();

        switch ($polecenie)
        {
            case 'Edytuj':
                edytuj_studenta($nr);
                break;
            case 'Dodaj nowego':
                edytuj_studenta();
                break;
            case 'Zapisz':
                zapisz_studenta($nr);
                break;
            case 'Usuń':
                usun_studenta($nr);
        }

        wypisz_studenci();
        zamknij_polaczenie();
    ?>
</div>
</body>
</html>
