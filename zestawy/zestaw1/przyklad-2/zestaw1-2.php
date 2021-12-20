<!--
Napisz stronę ze skryptem PHP generującym tabelkę HTML układającą się w
tabliczkę mnożenia dla dowolnego zakresu liczb (całkowitych). Zakres tabliczki
wprowadza się na formularzu złożonym z dwóch pól tekstowych.
-->

<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Tabliczka mnożenia</title>
    <style>
        body {
            background-color: teal;
            color: #FFFFFF;
            text-align: center;
            margin-top: 100px;
        }
        input[type="text"] { text-align: center }
        table {
            display: inline-table;
            text-align: center
        }
        .wynik {
            background-color: blue;
            color: white;
            padding: 5px
        }
        .naglowek { color: yellow }
    </style>
</head>

<body>
<p>Podaj zakres tabliczki mnożenia</p>

<form method=get action="">
    <label for="od">Od</label>
    <input type=text name="od" id="od" size=10>
    <label for="do">Do</label>
    <input type=text name="do" id="do" size=10>
    <input type=submit value="Pokaż tabliczkę">
</form>

<?php
    $od = $_GET['od'] ?? null;
    $do = $_GET['do'] ?? null;

    if ($od == null || $do == null)
        echo 'wypełnij obydwa pola<br>';
    else if (!is_numeric($od) || !is_numeric($do))
        echo "poprawny zakres składa się z dwóch liczb, a Ty podałeś od: $od oraz do: $do";
?>

<?php
    if (is_numeric($od) && is_numeric($do))
    {
        echo '<table>';
        // kolumn jest o jedną więcej niż zakresu, potrzebna numeracja kolumn
        for ($y = $od; $y <= ($do + 1); $y++)
        {
            if ($y === $od)
            {
                // pierwsza komórka w pierwszym wierszu musi być pusta
                echo "<tr><td></td>";
                for ($x = $od; $x <= $do; $x++)
                {
                    // numeracja kolumn w pierwszym wierszu
                    echo "<td class=\"naglowek\">$x</td>";
                }
            } else
            {
                // numeracja wierszy
                $y_naglowek = $y - 1;
                echo "<tr><td class=\"naglowek\">$y_naglowek</td>";
                for ($x = $od; $x <= $do; $x++)
                {
                    $wynik = $y_naglowek * $x;
                    echo "<td class=\"wynik\">$wynik</td>";
                }
            }
            echo "</tr>";
        }
        echo '</table>';
    }
?>
</body>
</html>
