<!--
Utwórz stronę ze skryptem do podstawowej obsługi (dodawanie i wyświetlanie)
listy towarów.
a. Strona powinna zawierać formularz do wprowadzenia: nazwy, ceny netto i
stawki vat. Po wciśnięciu przycisku zatwierdzającego formularz dane
powinny zostać dopisane do pliku (każdy towar w nowej linii w formacie:
nazwa|cena|vat).
b. Poniżej formularza skrypt powinien wypisywać (w tabeli HTML) wszystkie
wcześniej dodane towary (przechowywane w pliku).
Pamiętaj o problemie dublowanego zapisu przy odświeżaniu strony, rozwiąż go
poprzez odpowiednie przekierowanie używając funkcji header().
Może się przydać: isset(), is_numeric(), fopen(), fclose(), fputs(), flock(), header(), fgetcsv(),
number_format().
Dodatek dla dociekliwych:
Spróbuj zabezpieczyć sytuację jednoczesnego zapisywania do pliku przez kilku
użytkowników strony. Wcześniej przeczytaj w manualu PHP o funkcji flock().
-->

<?php
    function netto($cena_brutto, $v): float
    {
        return $cena_brutto / (1 + ($v / 100));
    }

    function poprawna_cena($x): bool
    {
        return is_numeric($x) && $x >= 0;
    }

    function poprawny_vat($x): bool
    {
        return is_numeric($x) && $x >= 0 && $x <= 100;
    }
?>
<?php
    $nazwa_towaru = $_GET['nazwa'] ?? null;
    $cena_brutto = $_GET['brutto'] ?? null;
    $vat = $_GET['vat'] ?? null;
    $nazwa_pliku = 'towary.dat';

    if (!empty($nazwa_towaru) && !empty($cena_brutto) && !empty($vat)
        && poprawna_cena($cena_brutto) && poprawny_vat($vat))
    {
        $plik = fopen($nazwa_pliku, 'a') or exit("Nie można otworzyć pliku $nazwa_pliku");
        fputcsv($plik, [$nazwa_towaru, $cena_brutto, $vat], "|");
        fclose($plik);
        header("Location: towary5.php");
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Zarządzanie towarami</title>
    <style>
        body {padding-top: 5px; text-align: center; background-color: yellow; color: #000FFF; }
        label {margin-right: 5px}
        input { text-align: center; }
        table {display: inline-table; border: 1px solid black; border-collapse: collapse}
        td, th { text-align: right; border: 1px solid black; padding: 2px 5px}
        th {background-color: #000FFF; color: white}
        .center {text-align: center}
        .container {display: inline-flex; width: 100%; justify-content: center; gap: 40px; margin: 30px 0}
    </style>
</head>
<body>
<?php
    if (count($_GET))
    {
        if (empty($nazwa_towaru)) echo "Brakuje nazwy towaru<br>";
        if (empty($cena_brutto)) echo "Brakuje ceny brutto towaru<br>";
        else if (!poprawna_cena($cena_brutto)) echo "Niepoprawna cena towaru<br>";
        if (empty($vat)) echo "Brakuje VAT'u na towar<br>";
        else if (!poprawny_vat($vat)) echo "Niepoprawny VAT<br>";
        echo "<br>TOWAR NIE ZOSTAŁ ZAPISANY<br>";
    }
?>

<form method=GET action=''>
    <div class="container">
        <div>
            <label for="nazwa">Nazwa produktu</label>
            <input type=text name='nazwa' id="nazwa" style='text-align: left;width: 200px'>
        </div>
        <div>
            <label for="brutto">Cena brutto</label>
            <input type=text name='brutto' id="brutto" style="width: 100px">
            <label for="brutto">zł</label>
        </div>
        <div>
            <label for="vat">VAT [%]</label>
            <input type=text name='vat' id="vat" style="width: 50px">
        </div>
        <input type=submit value='Zapisz do pliku'>
    </div>
</form>
<h2>Lista towarów</h2>
<table style="width: 50%;">
    <?php
        if (file_exists($nazwa_pliku))
        {
            echo "<tr><th class='center'>Nazwa towaru</th>" .
                "<th class='center'>Cena netto</th>" .
                "<th class='center'>VAT</th>" .
                "<th class='center'>Cena brutto</th></tr>";

            $towary = file($nazwa_pliku);
            foreach ($towary as $towar)
            {
                $towar = str_getcsv($towar, '|');
                $cena_netto = number_format(netto($towar[1], $towar[2]), 2, '.', ',');
                $cena_brutto = number_format($towar[1], 2, '.', ',');
                echo "<tr><td class='center'>$towar[0]</td>" .
                    "<td>$cena_netto zł</td>" .
                    "<td>$towar[2] %</td>" .
                    "<td>$cena_brutto zł</td></tr>";
            }
        }
    ?>
</table>
</body>
</html>
