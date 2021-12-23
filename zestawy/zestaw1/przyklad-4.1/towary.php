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
    $towary = ["sza" => "szafa", "st" => "stół", "kr" => "krzesło", "tap" => "tapczan"];
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
                            // atrybut selected jest dodawany dla opcji obecnie wybranej (w zmiennej $wybrany)
                            // żeby pozostawała ona w liście jako wybrana (inaczej po przeładowaniu strony w liście zawsze będzie pierwsza opcja)
                            echo "<option value='$key'" . ($key == $wybrany ? ' selected' : '') . ">$nazwaTowaru</option>";
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
                    if ($wybrany != 'noSelection') echo "$towary[$wybrany]";
                ?>
            </td>
        </tr>
    </table>
</form>
</body>
</html> 