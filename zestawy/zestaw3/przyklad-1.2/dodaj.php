<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Najlepsi studenci</title>
    <style>
        body {color: #000fff; background-color: yellow;}
        table {margin: 20px auto; border: 2px solid; border-collapse: collapse;}
        td {padding: 5px; font-family: sans-serif; border: 1px solid; }
        th {background-color: #000fff; color: white; padding: 10px; border: 1px solid;}
        form {border-bottom: 1px solid; padding: 15px; margin-bottom: 20px;
            display: flex; justify-content: center; gap: 15px}
        p, input {text-align: center;}
        ::placeholder {font-size: 10px}
    </style>
</head>
<body>

<?php
    function is_valid(): bool
    {
        global $imie;
        // należy zrobić walidację dla wszystkich danych z $_POST
        return !empty($imie);
    }

    // Rozwiązanie z extract()
    extract($_POST);

    // Rozwiązanie z iteracją
    /*
    $student_details = 'null,';
    foreach ($_GET as $key => $field)
    {
        $student_details .= "'$field'" . ($key == 'jez' ? '' : ',');
    }
    */

    // Rozwiązanie ze zwykłym podstawianiem danych
    /*
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $miasto = $_POST['miasto'];
    $data_ur = $_POST['data_ur'];
    $wydz = $_POST['wydz'];
    $sw = $_POST['sw'];
    $mat = $_POST['mat'];
    $fiz = $_POST['fiz'];
    $jez = $_POST['jez'];
    */

    if (is_valid())
    {
        $host_name = 'localhost';
        $user_name = 'root';
        $password = '';
        $database_name = 'zestaw3_przyklad1';
        $server = mysqli_connect($host_name, $user_name, $password)
        or exit("<p>Nie można podłączyć się do serwera bazy danych: $host_name</p>");
        $database = mysqli_select_db($server, $database_name)
        or exit("<p>Nie można podłączyć się do bazy danych: $database_name</p>");
        mysqli_set_charset($server, 'utf8');// null na początku zastępuje podawanie wartości do id
        $student_details = "null, '$nazwisko', '$imie', '$miasto', '$data_ur', '$wydz', '$sw', '$mat', '$fiz', '$jez'";
        $query_text = "INSERT INTO egzamin VALUES ($student_details);";
        $query_to_database = mysqli_query($server, $query_text)
        or exit("<p>Źle sformułowane zapytanie do bazy danych.</p>");
        mysqli_close($server);

        header('Location: dodaj.php');
    }
?>

<form action="dodaj.html">
    <input type="submit" value="Dodaj kolejnego studenta">
</form>
<form action="menu.html">
    <input type="submit" value="Wyświetl menu">
</form>

</body>
</html>
