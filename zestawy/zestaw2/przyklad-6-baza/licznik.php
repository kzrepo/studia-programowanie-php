<?php 
        
	// czyta wartość licznika z pliku
 
	// zwiększa wartość licznika (uważamy na zrobienie tego przy odświeżeniu strony)
            
	// zapisuje wartość licznika do pliku (chroniąc się przed jednoczesnym zapisem za pomocą funkcji flock())
	
	// uważamy na zwiększenie licznika przy odświeżeniu strony
	// zatem po zapisie robimy przekierowanie na tę samą stronę, ale z dodatkową flagą (zmienną o dowolnej wartości))
	// Jej obecność pozwoli nam sprawdzić czy strona jest faktycznie odwiedzana (flaga nieobecna)	
        
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Licz odwiedziny</title>
</head>

<body style='background-color: teal; color: #FFFFFF;'>
<br><h1>Liczba odwiedzin na stronie: <b> (Tutaj aktualna wartość licznika) </b></h1>
</body>
</html>
