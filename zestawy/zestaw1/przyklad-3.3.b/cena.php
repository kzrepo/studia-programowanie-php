<!--
Napisz bezparametrową wersję funkcji netto(), do obliczeń użyj
zmiennych globalnych.
-->

<?php
    $brutto = 0;
    $vat = 0;
    $netto = 0;
    function oblicz_netto()
    {
        global $brutto, $vat, $netto;
        $netto = $brutto / (1 + $vat / 100);
    }
    function czy_cena_poprawna($brutto): bool
    {
        return is_numeric($brutto) && $brutto >= 0;
    }
    function czy_vat_poprawny($vat): bool
    {
        return is_numeric($vat) && $vat >= 0 && $vat <= 23;
    }
?>

<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Oblicz cenę netto</title>
    <style>
        body {background-color: yellow; color: #000FFF; margin-top: 100px; text-align: center}
        table {display: inline-table; width: 70%; border: 1px solid blue}
        td {border: 1px solid blue; text-align: center; padding: 10px}
    </style>
</head>
<body>
<form method='GET' action=''>
    <table>
        <tr>
            <td style="width: 20%">
                <label for="brutto">Cena brutto</label>
                <input type=text name='brutto' id="brutto" size=15 style='text-align: left'>
                zł
            </td>
            <td style="width: 15%">
                <label for="vat">VAT [%]</label>
                <input type=text name='vat' id="vat" size=5 style='text-align: left'>
            </td>
            <td style="width: 10%">
                <input type=submit value='Oblicz'>
            </td>
        </tr>
        <?php
            if (isset($_GET['brutto']))
            {
                $brutto = $_GET['brutto'];
                $vat = $_GET['vat'];
                oblicz_netto();

                if (!czy_cena_poprawna($brutto))
                    $wynik = "Niepoprawna cena brutto"; else $wynik = "";
                if (!czy_vat_poprawny($vat))
                    $wynik .= (empty($wynik) ? "" : "<br>") . "Niepoprawny VAT";
                if (empty($wynik))
                    $wynik = "Cena netto: " . number_format($netto, 2, ',', " ") . " zł";
                echo "<tr><td colspan=2 style=\"font-weight: bold\">$wynik</td></tr>";
            }
        ?>
    </table>
</form>
</body>
</html>
