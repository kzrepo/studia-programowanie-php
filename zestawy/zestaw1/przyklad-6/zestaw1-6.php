<!--
Napisz skrypt, który generuje grupę przycisków radiowych z nazwami towarów
jak w zadaniu poprzednim, uzupełnioną o opcję „wszystkie”. Po kliknięciu
przycisku „Pokaż” powinna wyświetlać się informacja o wybranym produkcie
(lub o wszystkich, jeśli wybrano opcję „wszystkie”).
-->

<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Towary</title>
    <style>
        body { background-color: yellow; color: #000FFF; }
        table { margin-top: 20px; border-style: double; border-collapse: collapse }
        th { padding: 10px; font-size: 30px; border: 1px solid; font-weight: 100 }
        .naglowek { font-size: 15px; font-weight: bold }
        .nazwa { text-align: left }
    </style>
</head>
<body>
<?php
    $towary = ["t1" => ['dywanik', 60, 10, 23],
        "t2" => ['półka', 150, 22, 23],
        "t3" => ['regał', 1500, 7, 0],
        "t4" => ['umywalka', 520, 1, 23],
        "t5" => ['kran', 120, 5, 7],];
    function drukuj($towar)
    {
        $nazwa = ucfirst($towar[0]);
        $cena = number_format($towar[1], 2);
        $vat = number_format($towar[3], 0, '.', '');
        $ilosc = $towar[2];
        echo "
            <tr>
                <th class=\"nazwa\">$nazwa</th>
                <th>$cena zł</th>
                <th>$vat %</th>
                <th>$ilosc</th>
            </tr>";
    }
?>
<form method='get' action="">
    <p>Wybierz towar:</p>
    <?php
        $wybrany = $_GET['wybrany'] ?? 'noSelection';
        $is_checked = $wybrany == 'wszystkie' ? ' checked' : '';
        echo "<input type='radio' id='wszystkie' name='wybrany' value='wszystkie' $is_checked>
            <label for='wszystkie'>Wszystkie</label><br/>";
        foreach ($towary as $key => $nazwaTowaru)
        {
            $is_checked = $key == $wybrany ? ' checked' : '';
            echo "<input type='radio' id='$key' name='wybrany' value='$key' $is_checked/>
                <label for='$key'>$nazwaTowaru[0]</label><br/>";
        }
    ?>
    <input type=submit value="Pokaż informacje" style="margin-top: 10px">
</form>
<?php
    if ($wybrany != 'noSelection')
    {
        echo "<table>";
        echo "
            <tr>
                <th class=\"naglowek\">Nazwa</th>
                <th class=\"naglowek\">Cena</th>
                <th class=\"naglowek\">VAT</th>
                <th class=\"naglowek\">Stan magazynu</th>
            </tr>";
        if ($wybrany != 'wszystkie')
        {
            drukuj($towary[$wybrany]);
        } else
        {
            foreach ($towary as $towar)
                drukuj($towar);
        }
        echo "</table>";
    }
?>
</body>
</html>
