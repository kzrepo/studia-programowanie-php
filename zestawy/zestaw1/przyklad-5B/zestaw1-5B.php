<!--
Gdybym chciał przechować więcej informacji o towarze tablica z zadania
poprzedniego nie wystarczy. Przekształć ją w tablicę dwuwymiarową tak, aby
kluczem każdego towaru było specjalne id (np. w naszym przypadku od 't01' do
't04') a wartościami tablice zawierające nazwę i cenę.
Użyj zagnieżdżonej składni, traktując tablicę jako tablicę tablic (np. postaci:
$tab2dim = [‘a’=>[a1, a2, … , an], ‘b’=>[b1, b2, …, bn]]), lub podobnie
zagnieżdżonej funkcji array(). Kod zmień tak, aby działał na tablicy
dwuwymiarowej.
-->

<html lang="pl">
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
                    echo "<option value='noSelection'>Wybierz z listy ...</option>";
                foreach ($towary as $key => $nazwaTowaru)
                {
                    $is_selected = $key == $wybrany ? ' selected' : '';
                    echo "<option value='$key' $is_selected>$nazwaTowaru[0]</option>";
                }
            ?>
        </select>
    </label>
    <input type=submit value="Pokaż informacje">
    <?php
        if ($wybrany != 'noSelection')
        {
            $towar = $towary[$wybrany];
            $nazwa = ucfirst($towar[0]);
            $cena = number_format($towar[1], 2);
            echo "<h1 class=\"towar\">$nazwa w cenie $cena zł</h1>";
        }
    ?>
</form>
</body>
</html>
