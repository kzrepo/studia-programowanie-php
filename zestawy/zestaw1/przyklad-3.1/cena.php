<!--
Budując skrypt napisz funkcję netto($brutto, $vat), która wylicza wartość
netto i użyj tej funkcji wywołując w odpowiednim miejscu kodu.
-->

<?php
    function oblicz_netto($brutto, $vat): float
    {
        return $brutto / (1 + $vat / 100);
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
                if (!empty($brutto) && !empty($vat))
                {
                    echo "<tr><td colspan=2 style=\"font-weight: bold\">";
                    echo "Cena netto: " . number_format(oblicz_netto($brutto, $vat), 2) . " zł";
                    echo "</td></tr>";
                }
            }
        ?>
    </table>
</form>
</body>
</html>
