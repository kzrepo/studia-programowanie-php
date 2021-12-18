<html>
<head>
    <meta charset="utf-8">
    <title>Towary</title>
    <style>
        body {
            background-color: yellow;
            color: #000FFF;
        }
    </style>
</head>

<body>

<?php
    $towary = [
            "t1" => ['dywanik', 60],
            "t2" => ['półka', 150],
            "t3" => ['regał', 1500],
            "t4" => ['umywalka', 520],
            "t5" => ['kran', 120],
    ];
?>

<form method='get'>
    <label>
        <select name='wybrany'>
            <?php
                $wybrany = $_GET['wybrany'] ?? 'noSelection';
                if ($wybrany == 'noSelection')
                    echo "<option value='noSelection' size=15>Wybierz z listy ...</option>";
                foreach ($towary as $key => $nazwaTowaru)
                    echo "<option value='$key'" . ($key == $wybrany ? ' selected' : '') . ">$nazwaTowaru[0]</option>";
            ?>
        </select>
    </label>
    <input type=submit value="Pokaż informacje">
    <?php
        if ($wybrany != 'noSelection')
        {
            $towar = $towary[$wybrany];
            $nazwa = ucfirst($towar[0]);
            $cena = number_format($towar[1], 2, ',', '');
            echo "<h1 class=\"towar\">$nazwa w cenie $cena zł</h1>";
        }
    ?>
</form>
</body>
</html>
