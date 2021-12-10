<?php
    function netto($cbrutto, $v)
    {
        return $cbrutto * 1 / (1 + $v / 100);
    }

    function poprawna_cena($x)
    {
        return is_numeric($x) && $x >= 0;
    }

    function poprawny_vat($x)
    {
        return is_numeric($x) && $x >= 0 && $x <= 100;
    }

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Oblicz cenę</title>
    <style>
        body {
            background-color: yellow;
            color: #000FFF;
        }

        input {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
</head>

<body>

<br>

<form method=GET action=''>
    <table width=70% border=1>
        <tr>
            <td width=20%>Cena brutto
                <input type=text name='brutto' size=15>
                zł
            </td>
            <td width=15%>VAT [%]
                <input type=text name='vat' size=5>
            </td>
            <td width=10%>
                <input type=submit value='Oblicz'>
            </td>
        </tr>

        <?php

            if (isset($_GET['brutto']))
            { // dane zostały wysłane, można generować odpowiedź

                // przypisuję zmiennym wartości z tablicy $_GET (czyli z formularza)
                $brutto = $_GET['brutto'];
                $vat = $_GET['vat'];

                // w zmiennej $output
                // przygotowuję treść tekstu do wiersza wynikowego (cena netto lub komunikaty o błędach)
                if (!poprawna_cena($brutto)) $output = "Nieprawidłowa cena brutto"; else $output = "";
                if (!poprawny_vat($vat)) $output .= (empty($output) ? "" : "<br>") . "Nieprawidłowa wartość VAT";
                if (empty($output)) $output = "Cena netto: " . number_format(netto($brutto, $vat), 2, ',', ' ') . " zł";

                // generuję wiersz tabeli HTML z zawartością zapisaną w zmiennej $output
                echo "<tr> <td colspan=2 align=center> <b>$output</b> </td></tr>";
            }
        ?>

    </table>
</form>

</body>
</html>
