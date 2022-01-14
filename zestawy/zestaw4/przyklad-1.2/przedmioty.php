<?php
    include('funkcje_db.php');
    function wypisz_przedmioty()
    {
        global $polaczenie;

        $zapytanie = "SELECT * FROM przedmioty";
        $wynik = mysqli_query($polaczenie, $zapytanie);
        if (!$wynik) return;

        $naglowki = ["Nazwa", "Godziny"];
        print("<h3>Przedmioty</h3>");
        print("<form method='POST'>");
        print("<table><tr>");
        foreach ($naglowki as $naglowek) print("<th>$naglowek</th>");
        print("<th><input type='submit' name='przycisk[-1]' value='Dodaj nowy'></th>");
        print("</tr>");
        while ($wiersz = mysqli_fetch_row($wynik))
        {
            print("<tr>");
            foreach ($wiersz as $p => $pole)
                if ($p != 0) print("<td>$pole</td>");
            print("<td class='center'>
                <input type='submit' name='przycisk[$wiersz[0]]' value='Edytuj'>
                <input type='submit' name='przycisk[$wiersz[0]]' value='Usuń'></td>");
            print("</tr>");
        }
        print("</table>");
        print("</form>");
        mysqli_free_result($wynik);
    }
    function edytuj_przedmioty($nr = -1)
    {
        global $polaczenie;

        if ($nr != -1)
        { // edycja
            $rozkaz = "select nazwa, godziny from przedmioty where numer=$nr;";
            $rekord = mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: " . $rozkaz);

            $przedmiot = mysqli_fetch_row($rekord);
            $nazwa = $przedmiot[0];
            $godziny = $przedmiot[1];
        } else
        { // dodanie nowego
            $nazwa = '';
            $godziny = '';
        }
        echo "
        <form method=POST action=''>
            <table>
                <tr>
                    <th>Nazwa</th>
                    <td colspan=2>
                        <input type=text name='nazwa' value='$nazwa' size=15 style='text-align: left'>
                    </td>
                </tr>
                <tr>
                    <th>Godziny</th>
                    <td colspan=2>
                        <input type=text name='godziny' value='$godziny' size=15 style='text-align: left'>
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
    function zapisz_przedmioty($nr)
    {
        global $polaczenie;
        $nazwa = $_POST['nazwa'];
        $godziny = $_POST['godziny'];
        if ($nr != -1)
            $rozkaz = "update przedmioty set nazwa='$nazwa', godziny='$godziny' where numer=$nr;";
        else $rozkaz = "insert into przedmioty values(null, '$nazwa', '$godziny');";
        mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: " . $rozkaz);
        header('Location: przedmioty.php');
    }
    function usun_przedmiot($nr)
    {
        global $polaczenie;
        $rozkaz = "DELETE FROM przedmioty WHERE numer='$nr';";
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
        if (!empty($_POST['przycisk']))
        {
            $nr = key($_POST['przycisk']);
            $polecenie = $_POST['przycisk'][$nr];
        }

        otworz_polaczenie();

        switch ($polecenie)
        {
            case 'Edytuj':
                edytuj_przedmioty($nr);
                break;
            case 'Dodaj nowy':
                edytuj_przedmioty();
                break;
            case 'Zapisz':
                zapisz_przedmioty($nr);
                break;
            case 'Usuń':
                usun_przedmiot($nr);
        }

        wypisz_przedmioty();
        zamknij_polaczenie();
    ?>
</div>
</body>
</html>
