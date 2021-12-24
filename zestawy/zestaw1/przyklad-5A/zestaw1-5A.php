<!--
Poza informacją o nazwie towaru chcę pamiętać także jego cenę. Przekształć
tablicę towarów tak, aby nazwy towarów były kluczami a wartościami ich ceny.
Kod zmień tak, aby działał dla nowo określonej tablicy.
-->

<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Towary</title>
    <style>
        body {background-color: yellow; color: #000FFF}
    </style>
</head>
<body>

<?php
    $towary = ["sza" => ["szafa", 200],
        "st" => ["stół", 500],
        "kr" => ["krzesło", 250],
        "tap" => ["tapczan", 1500]];
?>

<form method='get' action="">
    <table>
        <tr>
            <td>
                <label for="towary">Towary:</label>
                <select id="towary" name='wybrany'>
                    <?php
                        $wybrany = $_GET['wybrany'] ?? 'noSelection';
                        // opcja 'pusta' jest generowana tylko jeśli nic wcześniej nie wybrano
                        if ($wybrany == 'noSelection')
                            echo "<option value='noSelection'>Wybierz z listy ...</option>";
                        foreach ($towary as $key => $nazwaTowaru)
                        {
                            // atrybut selected jest dodawany dla opcji obecnie wybranej (w zmiennej $wybrany)
                            // żeby pozostawała ona w liście jako wybrana (inaczej po przeładowaniu strony w liście zawsze będzie pierwsza opcja)
                            $is_selected = $key == $wybrany ? ' selected' : '';
                            echo "<option value='$key' $is_selected>$nazwaTowaru[0]</option>";
                        }
                    ?>
                </select>
            </td>
            <td>
                <input type=submit value="Pokaż informacje">
            </td>
        </tr>
        <tr>
            <td colspan=2 style="font-size: 30px; text-align: center; padding-top: 20px">
                <?php
                    if ($wybrany != 'noSelection')
                    {
                        $nazwa = $towary[$wybrany][0];
                        $price = number_format($towary[$wybrany][1], 2);
                        echo "$nazwa w cenie $price zł";
                    }
                ?>
            </td>
        </tr>
    </table>
</form>
</body>
</html>