<html>
<head>
  <meta charset="utf-8">
  <title>Wyniki egzaminu wstępnego</title>
</head>
<body bgcolor=yellow text="#000FFF">

<?php 
   // ----------- uzyskanie nazw wydziałów z bazy danych (w tablicy $wydzialy)   
    // 1. połączenie z serwerem bazy  
	$serwer = mysqli_connect("localhost", "root", "")
                or exit("Nie mozna połączyć się z serwerem bazy danych");
	// 2. połączenie z bazą 'przyjecia'
	$baza = mysqli_select_db($serwer, "przyjecia") 
                or exit ("Nie mozna połączyć się z bazą PRZYJĘCIA");
	// 3. ustawienie kodowania znaków w komunikacji z bazą
    mysqli_set_charset($serwer, "utf-8");
	// 4. wykonanie zapytania pobierającego symbole wydziałów (potrzebne do listy wyboru)
	$zapytanie1 = "select distinct wydzial from egzamin";      
	$wydzialy = mysqli_query($serwer, $zapytanie1)
                or exit ("Źle sformułowane żądanie listy wydziałów");   
                
 // --------------------------------------------------------------------------	
?>

<form action=''>
<br> Lista kandydatów na studia na wydziale: 
        <select name=wydz>
        
<?php 
		// 5. ustawienie zmiennej przechowującej wybrany wydział (z formularza)
		//if(isset($_GET['wydz']) && $_GET['wydz'] != '') $wydz = $_GET['wydz'];
		$wydz = $_GET['wydz'] ?? '';
		
		// 6. w pętli wyświetlanie nazw wydziałów jako kolejne pozycje listy wyboru (znaczniki <option>)
		//    wykorzystuje wynik zapytania z pkt. 4.
		if($wydz == '') echo "<option value=''>nie wybrano</option>";
        while($wiersz = mysqli_fetch_array($wydzialy)){
            echo "<option value=$wiersz[0] "				
				.($wydz==$wiersz[0]?'selected':'')
				."> $wiersz[0] </option>";
        }
		// 7. zwalnianie wyniku zapytania
        mysqli_free_result($wydzialy);
?> 
        </select>
        <input type=submit value='Wyświetl'>
</form>
<hr>


<?php // wyświetla listę kandydatów na wybrany wydział (zmienna $wydz) ------------

	if($wydz == '') { echo "Proszę wybrać wydział"; return; }                  
   
	$zapytanie = "select * from egzamin where wydzial='$wydz' order by nazwisko";      
	$wynik = mysqli_query($serwer, $zapytanie)
				or exit ("Źle sformułowane żądanie danych");   
	   
	// wygenerowanie tabeli HTML i pierwszego wiersza z nagłówkami
	$naglowki=["Nazwisko","Imię","Miasto","Data urodzenia",
					"Wydział","Świadectwo","Mat.","Fiz.","Język","Suma punktów"];   
	echo "<center><table border=1>";
	echo "<tr>";
	foreach($naglowki as $naglowek) echo "<td><b> $naglowek </b></td>";
	echo "</tr>";
	   
	// wygenerowanie pozostałych wierszy na podstawie wyniku zapytania
	while($wiersz = mysqli_fetch_array($wynik, MYSQLI_ASSOC)){
        echo "<tr>";
        foreach($wiersz as $p=>$pole) echo "<td style='font-family:Verdana'> $pole </td>";
                
// ---------------- dodatkowa komórka z obliczoną sumą punktów ----------------------
         echo "<td align=right><b>".($wiersz['swiadectwo']+$wiersz['mat']+
                      $wiersz['fiz']+$wiersz['jezyk'])."</b></td>";           
// ----------------------------------------------------------------------------------     
         echo "</tr>";
   }
   echo "</table></center>";
   
   mysqli_free_result($wynik);
   mysqli_close($serwer);    
?>

</body>
</html>
