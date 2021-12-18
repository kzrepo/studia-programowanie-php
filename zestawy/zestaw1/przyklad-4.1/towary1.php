<html>
<head>
    <meta charset="utf-8">
    <title>Towary</title>
</head>
<body bgcolor=yellow text="#000FFF">

<?php
    // przygotowanie tablicy testowej
    /*
       $towary=array('tap'=>"tapczan",'sza'=>"szafa",
                     'st'=>"stół",'kr'=>"krzesło");
    */
    // od PHP5.4
    $towary = ["sza" => "szafa", "st" => "stół",
            "kr" => "krzesło", "tap" => "tapczan"];
?>

<form method='get'>
    <table>
        <tr>
            <td><select name='wybrany'>

                    <?php

                        //if(isset($_POST['wybrany'])) $wybrany = $_POST['wybrany']; else $wybrany = 'noSelection';
                        // albo od PHP7
                        $wybrany = $_GET['wybrany'] ?? 'noSelection';

                        // opcja 'pusta' jest generowana tylko jeśli nic wcześniej nie wybrano
                        if ($wybrany == 'noSelection') echo "<option value='noSelection'>Wybierz z listy ...</option>";
                        foreach ($towary as $key => $nazwaTowaru)
                            // atrybut selected jest dodawany dla opcji obecnie wybranej (w zmiennej $wybrany)
                            // żeby pozostawała ona w liście jako wybrana (inaczej po przeładowaniu strony w liście zawsze będzie pierwsza opcja)
                            echo "<option value='$key'" . ($key == $wybrany ? ' selected' : '') . ">$nazwaTowaru</option>";

                    ?>

                </select></td>
            <td>
                <input type=submit value="Pokaż informacje">
            </td>
        </tr>
        <tr>
            <td colspan=2 align=center><font size=6>

                    <?php
                        if ($wybrany != 'noSelection') echo "$towary[$wybrany]";
                    ?>

                </font></td>
        </tr>
    </table>
</form>

</body>
</html> 