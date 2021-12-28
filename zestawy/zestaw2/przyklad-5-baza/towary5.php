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
    function netto($cbrutto, $v): float
    {
        return $cbrutto / (1 + $v / 100);
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
    // zapis towaru z formularza do pliku

    // napisz kod, który zapisuje prawidłowo wprowadzone dane towaru do pliku 'towary.dat'
    // pamiętaj o problemie dublowania zapisu przy odświeżaniu strony
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Zarządzanie towarami</title>
    <style>
        body { text-align: center; background-color: yellow; color: #000FFF; }
        input { text-align: center; }
        table {display: inline-table; margin-top: 30px; border: 1px solid black;}
        td { text-align: center; border: 1px solid black; padding: 5px}
    </style>
</head>
<body>
<form method=GET action=''>
    <table style="width: 70%;">
        <tr>
            <td style="width: 20%">
                <label for="nazwa">Nazwa produktu</label>
                <input type=text name='nazwa' id="nazwa" style='text-align: left;width: 200px'>
            </td>
            <td style="width: 20%">
                <label for="brutto">Cena brutto</label>
                <input type=text name='brutto' id="brutto" style="width: 100px">
                zł
            </td>
            <td style="width: 15%">
                <label for="vat">VAT [%]</label>
                <input type=text name='vat' id="vat" style="width: 50px">
            </td>
            <td style="width: 10%">
                <input type=submit value='Zapisz do pliku'>
            </td>
        </tr>
    </table>
</form>

<table style="width: 50%;">
    <?php
        // odczyt i prezentacja

        // napisz kod, który odczytuje dane towarów z pliku
        // i prezentuje je w wygenerowanej tabeli HTML
    ?>
</table>
</body>
</html>
