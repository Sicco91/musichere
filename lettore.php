<?php
	include 'connessione.php';
	$id=$_POST['id'];
	// effettuiamo la query per prelevare l'id della canzone scelta dall'utente
	$search_traccia=mysql_query("select Canzoni from tracce where id_traccia='$id'");
	$canzone=mysql_fetch_array($search_traccia);
	// preleviamo il percorso della canzone
	$url=$canzone['Canzoni'];
	// stampiamo il player
	echo "<audio controls='controls' autoplay='autoplay'>
		    <source src='".$url."'  type='audio/mpeg' />
		   </audio>";	
?>
