<!--
Uzupełnij poniższy kod (cena.php) tak, aby na stronie powstało narzędzie do
wyliczania ceny netto.
Na stronie zdefiniowano formularz zawierający 2 pola tekstowe do wpisania
ceny brutto i stawki podatku oraz przycisk OBLICZ po którego wciśnięciu
powinien pojawić się wynik: cena netto.
-->

<?php
    // tu napisz kody funkcji podanych w zadaniu
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
        <tr>
            <td colspan=2><b>
                    <?php
                        // tu napisz kod rozwiązujący zadanie
                        //(wykorzystaj napisane wcześniej funkcje)
                    ?>
                </b></td>
        </tr>
    </table>
</form>
</body>
</html>
