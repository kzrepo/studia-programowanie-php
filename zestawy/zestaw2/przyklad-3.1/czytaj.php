<!--
Jak usunąć efekt powtarzania ostatniego wpisu przy każdorazowym
odświeżaniu strony? Spróbuj coś wymyśleć (zobacz np. na funkcję header()), a
potem poczytaj o problemie „double submit problem” i rozwiązującym go wzorcu
PRG (POST/REDIRECT/GET) Pattern (inna nazwa redirect after post)
-->

<?php
    $wpis = $_POST['wpis'] ?? null;
    $filename = 'chat.txt';

    if (!empty(trim($wpis)))
    {
        $plik = fopen($filename, 'a') or exit ("Nie można otworzyć pliku $filename");
        fputs($plik, $wpis . PHP_EOL);
        fclose($plik);

        header("Location: czytaj.php");
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        body {text-align: center}
    </style>
</head>
<body>
<form method="post" action="">
    <label for="wpis">Podaj wpis</label>
    <input id="wpis" type="text" size=40 name="wpis">
    <input type="submit" value="Wyślij">
</form>
</body>
</html>
