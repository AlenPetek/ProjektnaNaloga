 <!DOCTYPE html>

 <?php

 $conn = new mysqli('localhost', 'root', 'artholus6*Databa5e', 'projekt');
 $conn->set_charset("UTF8");

 function get_animals(){
     global $conn;
     $query = "SELECT * FROM žival;";
     $res = $conn->query($query);
     $animals = array();
     while($animal = $res->fetch_object()){
         array_push($animals, $animal);
     }
     return $animals;
 }


 $animals = get_animals();

 //Izpiši oglase
 //Doda link z GET parametrom id na oglasi.php za gumb 'Preberi več'

echo "PRIMER IZPISA STOLPCA IME IZ TABELE ŽIVAL: (UPORABI SPLETNI STREŽNIK ZA TO (npr v www mapi v wamp)";
 foreach($animals as $animal){

         echo	"<h4>$animal->ime</h4>";
         echo	"<h4>$animal->starost</h4>";
         echo	"<h4>$animal->tel</h4>";
         echo	"---------------------";
 }
 ?>


<html>
    <head>
        <title>Projektna</title>
		<link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="topnav">
			<a href="login.php" style="float: right">Register</a>
			<div class="login-container">
			<form action="/action_page.php">
				<input type="text" placeholder="Username" name="username">
				<input type="text" placeholder="Password" name="psw">
				<button type="submit">Login</button>
			</form>
		  </div>
		</div>
		
		<div id="zemljevid" width="100%" height="2000">
			<p>Zemljevid</p>
		</div>
		<div id="zemljevid" width="100%" height="2000">
			<p>Tabela živali</p>
		</div>
    </body>
</html> 