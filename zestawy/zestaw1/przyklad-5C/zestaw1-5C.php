<!--
Dla każdego towaru dodaj jeszcze informację o stanie magazynu i stawce VAT.
Uzupełnij kod dodając do listy wyboru opcję wyświetlania na stronie tabeli
pokazującej wszystkie towary z tablicy (pozycja „wszystkie”).
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
    <label for="towar">Wybierz towar:</label>
    <select id="towar" name='wybrany'>
        <?php
            $wybrany = $_GET['wybrany'] ?? 'noSelection';
            if ($wybrany == 'noSelection')
                echo "<option value='noSelection'>Wybierz z listy ...</option>";
            echo "<option value='wszystkie'>Wszystkie</option>";
            foreach ($towary as $key => $nazwaTowaru)
            {
                $is_selected = ($key == $wybrany ? ' selected' : '');
                echo "<option value=\"$key\" $is_selected>$nazwaTowaru[0]</option>";
            }
        ?>
    </select>
    <input type=submit value="Pokaż informacje">
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
</form>
</body>
</html>
