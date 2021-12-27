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
