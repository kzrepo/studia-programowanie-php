<html>
<head>
    <meta charset="utf-8">
    <title>Tabliczka mnożenia</title>

    <style>
        body {
            background-color: teal;
            color: #FFFFFF;
        }

        input[type="text"] {
            text-align: center;
        }

        .wynik {
            background-color: blue;
            color: white;
            padding: 5px
        }

        .naglowek {
            color: yellow
        }
    </style>

</head>

<body>

<br>
<center>

    <p>Podaj zakres tabliczki mnożenia</p>

    <form method=GET action="">
        Od
        <input type=text name="od" size=10>
        Do
        <input type=text name="do" size=10>
        <input type=submit value="Pokaż tabliczkę">
    </form>

    <?php

        $od = $_GET['od'] ?? null;
        $do = $_GET['do'] ?? null;

        if ($od == null || $do == null)
            echo 'wypełnij wszystkie pola<br>';
    ?>

    <?php
        if (!is_numeric($od) && !is_numeric($do))
            echo "poprawny zakres składa się z dwóch liczb, a Ty podałeś od: $od oraz do: $do";
    ?>

    <?php
        if (is_numeric($od) && is_numeric($do))
        {
            echo '<table border=0>';
            for ($y = $od; $y <= ($do + 1); $y++)
            {
                //echo "zmienna y1 = $y<br>";
                if ($y === $od)
                {
                    //echo "zmienna y2 = $y<br>";
                    echo "<tr><th></th>";
                    for ($kolumna = $od; $kolumna <= $do; $kolumna++)
                    {
                        echo "<th class=\"naglowek\">$kolumna</th>";
                    }
                    echo "</tr>";
                } else
                {
                    $y_naglowek = $y - 1;
                    echo "<tr><th class=\"naglowek\">$y_naglowek</th>";
                    for ($x = $od; $x <= $do; $x++)
                    {
                        $wynik = $y_naglowek * $x;
                        echo "<th class=\"wynik\">$wynik</th>";
                    }
                    echo "</tr>";
                }
            }
            echo '</table>';
        }
    ?>

</center>

</body>
</html>
