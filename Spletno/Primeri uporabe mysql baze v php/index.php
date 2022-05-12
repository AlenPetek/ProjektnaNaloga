<?php
include_once('glava.php');

if(isset($_SESSION["ADMIN"])){
	if($_SESSION["ADMIN"]==1){
		
	echo	"<a href=\"nadzor.php";
	//echo   $oglas->id;
	echo "\"><button>NADZOR</button></a>";
	}
}


// Funkcija prebere oglase iz baze in vrne polje objektov
function get_oglasi(){
	global $conn;
	$query = "SELECT * FROM ads ORDER BY expiration DESC;";
	$res = $conn->query($query);
	$oglasi = array();
	while($oglas = $res->fetch_object()){
		array_push($oglasi, $oglas);
	}
	return $oglasi;
}

//Preberi oglase iz baze
$oglasi = get_oglasi();

//Izpiši oglase
//Doda link z GET parametrom id na oglasi.php za gumb 'Preberi več'
$currentDate=date('Y-m-d H:i:s');
$currDate=new DateTime();
$currDate->setTimezone(new DateTimeZone('Europe/Ljubljana'));
$currDate->format('Y-m-d H:i:s');


foreach($oglasi as $oglas){
	
	$prevDate = date_create_from_format('Y-m-d H:i:s', $oglas->expiration,new DateTimeZone('Europe/Ljubljana'));

	$prevDate->setTimezone(new DateTimeZone('Europe/Ljubljana'));
	
	
	$varified=false;
	
	if ( isset($_SESSION["USER_NAME"])){
	
		if(($_SESSION["USER_NAME"])==$oglas->author){
			$varified=true;
		}
	}
		if($currDate < $prevDate || $varified){
			if($currDate > $prevDate){echo "EXPIRED! ";}
			
			
	echo  "<div class=\"oglas\">";
	echo	"<h4>$oglas->title</h4>";
	echo	"<p>Opis: $oglas->description</p>";
	echo	"<p> Datum objave: $oglas->created</p>";
	echo	"<p> Kategorija: $oglas->category</p>";
	echo    "<p>Expiration: $oglas->expiration</p>";
	
	
	echo	"<a href=\"oglas.php?id=";
	echo   $oglas->id;
	echo "\"><button>Preberi več</button></a>";
	
	if($varified){
	if($_SESSION["USER_NAME"]==$oglas->author){
	echo "  <a href=\"odstrani.php?author=";
	echo $oglas->author;
	echo "&id=$oglas->id";
	echo"\"><button>Odstrani</button><a/>";
	echo "</div>";
	}
		}
echo "<hr/>";
	
}
}

include_once('noga.php');
?>