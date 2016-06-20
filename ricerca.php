<html>
<head> <link rel="stylesheet" type="text/css" href="css/ricerca.css" /> 
	<script language="javascript"type="text/javascript" src="js/libreria1.js"></script>
	<script type="text/javascript" src="js/libreria2.js"></script>
	<script  type="text/javascript" src="js/lettore.js"></script>
</head>
<body>
	
<?php
include 'connessione.php';

$cerca=$_POST['ricerca'];
$testo=$_POST['testo'];

if($cerca=='1')  // ricerca per artista
{   //                                    utilizzo il join per unire le tabelle tracce e artista tramite il nome dell'artista che deve essere quello inserito dall'utente.    Asc sta per crescente
	$ricerca=mysql_query("SELECT id_traccia,Sfondo,copertina,album,nome,titolo,num_traccia,anno,genere FROM artisti JOIN tracce ON nome=artista WHERE nome LIKE '$testo%' ORDER BY album asc ,num_traccia asc");
	$riga=mysql_fetch_array($ricerca);                // seleziono la prima riga
	if(!$riga) echo("Nessun artista trovato con nome: ".$testo);   // controllo se l'artista è stato trovato
	else{
			echo "<div id='sfondo'><img src='".$riga['Sfondo']."'></div>";  // effettuo le stampe
			echo "<h1>".$riga['nome']."</h1>";
			echo "<div id='lettore'></div>";
			
			echo "<table id='discografia' cellspacing='13'>";
			echo "<caption>  
					<th>Cop.</th>
					<th>Num.</th>
					<th>Titolo</th>
					<th>Album</th>
					<th>Anno</th>
					<th>Genere</th>
				</caption>";   // utilizzo il tag caption per il titolo delle colonne e la spaziatura tra esse tramite il cellspacing
			while($riga){
				echo "<tr>";
				$copertina=$riga['copertina'];
				echo "<td><img src='$copertina' width='30px' heigth='30px'></td>";
				echo "<td>".$riga['num_traccia']."</td>";
				echo "<td>".$riga['titolo']."</td>";
				echo "<td>".$riga['album']."</td>";
				echo "<td>".$riga['anno']."</td>";
				echo "<td>".$riga['genere']."</td>";
				//                      nel momento in cui clicco nell'immagine, il lettore avvia la canzone con l'id corrispondente
				echo "<td><img src='play.png' id='play' onclick='mostra(".$riga['id_traccia'].");'></td>";		// immagine del tasto play [on click è un evento di javascript]
				
				$risultato=$riga['id_traccia'];  // preleviamo l'id della canzone per passare il valore alla variabile $risultato che useremo per la query string per il testo della canzone
			    echo "<td><a href='testi.php?id=".$risultato."' target='openlink1'>Testo</a></td>";
			    
				echo "</tr>";
				$riga=mysql_fetch_array($ricerca);
			    
			}
			
			echo "</table>";	
			
	}
}

if($cerca=='2')  // ricerca per album
{
	$ricerca=mysql_query("select id_traccia,album,nome,copertina,num_traccia,genere,anno,titolo from artisti join tracce on nome=artista where album='$testo' order by album");
	$riga=mysql_fetch_array($ricerca);
	if(!$riga) echo("Nessun album trovato con nome: ".$testo);
	else
		$copertina=$riga['copertina'];
		echo "<h1>".$riga['album']." - ".$riga['nome']."</h1>";
		echo'<div id="lettore"></div>';
			echo "<table id='discografia' cellspacing='13'>";
			echo "<caption>  
					<th>Cop.</th>
					<th>Num.</th>
					<th>Titolo</th>
					<th>Anno</th>
					<th>Genere</th>
				</caption>";   // utilizzo il tag caption per il titolo delle colonne e la spaziatura tra esse tramite il cellspacing
			while($riga){
				echo "<tr>";
				$copertina=$riga['copertina'];
				echo "<td><img src='$copertina' width='30px' heigth='30px'></td>";
				echo "<td>".$riga['num_traccia']."</td>";
				echo "<td>".$riga['titolo']."</td>";
				echo "<td>".$riga['anno']."</td>";
				echo "<td>".$riga['genere']."</td>";
				//                      nel momento in cui clicco nell'immagine, il lettore avvia la canzone con l'id corrispondente
				echo "<td><img src='play.png' id='play' onclick='mostra(".$riga['id_traccia'].");'></td>";		// immagine del tasto play [on click è un evento di javascript]	
				$risultato=$riga['id_traccia'];  // preleviamo l'id della canzone per passare il valore alla variabile $risultato che useremo per la query string per il testo della canzone
			    echo "<td><a href='testi.php?id=".$risultato."' target='openlink1'>Testo</a></td>"; 
				echo "</tr>";
			$riga=mysql_fetch_array($ricerca);
			    
			}
			
			echo "</table>";
}

if($cerca=='3') // ricerca per traccia
{
	$ricerca=mysql_query("select album ,id_traccia,nome,num_traccia,anno,genere,copertina,titolo from artisti join tracce on nome=artista where titolo='$testo' order by album");
	$riga=mysql_fetch_array($ricerca);
	if(!$riga) echo("Nessuna traccia trovata con nome: ".$testo);
	else {
		$copertina=$riga['copertina'];
		echo "<h1>".$riga['titolo']."</h1>";
		echo'<div id="lettore"></div>';
			echo "<table id='discografia' cellspacing='13'>";
			echo "<caption>  
					<th>Cop.</th>
					<th>Artista</th>
					<th>Num.</th>
					<th>Titolo</th>
					<th>Anno</th>
					<th>Genere</th>
				</caption>";   // utilizzo il tag caption per il titolo delle colonne e la spaziatura tra esse tramite il cellspacing
			while($riga){
				echo "<tr>";
				$copertina=$riga['copertina'];
				echo "<td><img src='$copertina' width='30px' heigth='30px'></td>";
				echo "<td>".$riga['nome']."</td>";
				echo "<td>".$riga['num_traccia']."</td>";
				echo "<td>".$riga['titolo']."</td>";
				echo "<td>".$riga['anno']."</td>";
				echo "<td>".$riga['genere']."</td>";
				//                      nel momento in cui clicco nell'immagine, il lettore avvia la canzone con l'id corrispondente
				echo "<td><img src='play.png' id='play' onclick='mostra(".$riga['id_traccia'].");'></td>";		// immagine del tasto play [on click è un evento di javascript]	
				$risultato=$riga['id_traccia'];  // preleviamo l'id della canzone per passare il valore alla variabile $risultato che useremo per la query string per il testo della canzone
			    echo "<td><a href='testi.php?id=".$risultato."' target='openlink1'>Testo</a></td>";
				 echo "</tr>";
			$riga=mysql_fetch_array($ricerca);
			    
			}
			
			echo "</table>";
     }
    }
	mysql_close($conn);
?>

</body>
</html>
