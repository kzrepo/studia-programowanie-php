<?php
    include('funkcje.php');

    function wypisz_oceny()
    {
        global $polaczenie;

        $zapytanie = "SELECT studenci.numer, przedmioty.numer, imie, nazwisko, nazwa, ocena FROM studenci,przedmioty,oceny
            WHERE studenci.numer=oceny.nr_stud AND przedmioty.numer=oceny.nr_przed;";
        $wynik = mysqli_query($polaczenie, $zapytanie);

        if (!$wynik) return;
        $naglowki = array("Imię", "Nazwisko", "Przedmiot", "Ocena");
        print("<h3>Oceny studentów</h3>");
        print("<form method='POST'>");
        print("<table><tr>");
        foreach ($naglowki as $naglowek)
            print("<th>$naglowek</th>");
        print("<th class='center'><input type='submit' name='przycisk[][]' value='Nowa ocena'></th>");
        print("</tr>");

        while ($wiersz = mysqli_fetch_row($wynik))
        {
            print("<tr>");
            foreach ($wiersz as $p => $pole)
                if ($p > 1) print("<td>" . $pole . "</td>");
            print("<td class='center'>
                <input type='submit' name='przycisk[$wiersz[0]][$wiersz[1]]' value='Edytuj'>
                <input type='submit' name='przycisk[$wiersz[0]][$wiersz[1]]' value='Usuń'></td>");
            print("</tr>");
        }
        print("</table>");
        print("</form>");
        mysqli_free_result($wynik);
    }
    function usun_ocene($nr_stud, $nr_przed)
    {
        global $polaczenie;

        $rozkaz = "delete from oceny where nr_stud=$nr_stud and nr_przed=$nr_przed;";
        mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: " . $rozkaz);
    }
    function edytuj_ocene($nr_stud, $nr_przed)
    {
        global $polaczenie;
        $rozkaz = "SELECT studenci.numer,przedmioty.numer, imie, nazwisko, nazwa, ocena
            FROM studenci, przedmioty, oceny
            WHERE studenci.numer=oceny.nr_stud
                AND przedmioty.numer=oceny.nr_przed
                AND studenci.numer=$nr_stud
                AND przedmioty.numer=$nr_przed;";
        $wynik = mysqli_query($polaczenie, $rozkaz) or exit("Błąd w zapytaniu: " . $rozkaz);

        $wiersz = mysqli_fetch_row($wynik);
        print "<form method='post' action=''><table>";
        print "<tr><th>Student:</th><td>$wiersz[2] $wiersz[3]</td></tr>";
        print "<tr><th>Przedmiot:</th><td>$wiersz[4]</td></tr>";
        print "<tr><th><label for='ocena'>Ocena:</label></th><td>
                    <input type='number' id='ocena' name='ocena' value='$wiersz[5]' size='4' min=1 max=5.5 step=0.5
                        autocomplete='no' style='text-align: center'>
                </td></tr>";
        print "<tr><td colspan='2'>
                   <input type='submit' name='przycisk[$wiersz[0]][$wiersz[1]]' value='Zapisz' style='width: 100%;'/>
               </td></tr>";
        print "</table></form>";
        mysqli_free_result($wynik);
    }
    function zapisz_ocene($nr_stud, $nr_przed, $ocena)
    {
        global $polaczenie;
        $rozkaz = "UPDATE oceny SET ocena=$ocena WHERE nr_stud=$nr_stud AND nr_przed=$nr_przed;";
        mysqli_query($polaczenie, $rozkaz);
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
            $nrStudenta = key($_POST['przycisk']);            // nr studenta
            $nrPrzedmiotu = key($_POST['przycisk'][$nrStudenta]);    // nr przedmiotu
            $polecenie = $_POST['przycisk'][$nrStudenta][$nrPrzedmiotu]; // jaka operacja
            $ocena = $_POST['ocena'] ?? null;
        }

        otworz_polaczenie();

        switch ($polecenie)
        {
            case 'Edytuj':
                edytuj_ocene($nrStudenta, $nrPrzedmiotu);
                break;
            case 'Usuń':
                usun_ocene($nrStudenta, $nrPrzedmiotu);
                break;
            case 'Zapisz':
                zapisz_ocene($nrStudenta, $nrPrzedmiotu, $ocena);
        }

        wypisz_oceny();
        zamknij_polaczenie();
    ?>
</div>
</body>
</html>
