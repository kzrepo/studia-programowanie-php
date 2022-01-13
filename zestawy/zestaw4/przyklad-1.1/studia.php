<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Obsługa studentów</title>
    <style>
        body {background-color: yellow; color: blue}
    </style>
</head>
<!-- 1. przycisk ładujący stronę odpowiedzialną za zarządzanie studentami -->
<input type=button value=" STUDENCI "
       onClick="window.location='studenci.php'">
<br><br>
<!-- 2. formularz ładujący stronę odpowiedzialną za zarządzanie ocenami -->
<form name=menu action='oceny.php'>
    <input type=submit value=" OCENY ">
</form>
<br>
<!-- 3. odsyłacz (link) do strony odpowiedzialnej za zarządzanie przedmiotami -->
<a href='przedmioty.php'> PRZEDMIOTY </a>
<hr>
</body>
</html>
