<?php
include_once('glava.php');
date_default_timezone_set('Europe/Ljubljana');
// Funkcija vstavi nov oglas v bazo. Preveri tudi, ali so podatki pravilno izpolnjeni. 
// Vrne false, če je prišlo do napake oz. true, če je oglas bil uspešno vstavljen.

function keepField ($value){
	if(isset($_POST[$value])){echo $_POST[$value]; } 
}

function publish($title, $desc, $img, $category){
	global $conn;
	$title = mysqli_real_escape_string($conn, $title);
	$desc = mysqli_real_escape_string($conn, $desc);
	$user_id = $_SESSION["USER_ID"];

	$category=mysqli_real_escape_string($conn,$category);
	
	$date = date('Y-m-d H:i:s');
    $expiration= date("Y-m-d H:i:s", time() + 2592000);
	 
    echo $date;
	echo $title;
	$date=mysqli_real_escape_string($conn,$date);
	$author=$_SESSION["USER_NAME"];
	
	//Preberemo vsebino (byte array) slike
	$img_file = file_get_contents($img["tmp_name"]);
	//Pripravimo byte array za pisanje v bazo (v polje tipa LONGBLOB)
	$img_file = mysqli_real_escape_string($conn, $img_file);
	
	$query = "INSERT INTO ads (title, description, user_id, image,created,category,author,expiration)
				VALUES('$title', '$desc', '$user_id', '$img_file','$date','$category','$author','$expiration');";
	if($conn->query($query)){
		echo "CCCC";
		return true;
	}
	else{
		//Izpis MYSQL napake z: echo mysqli_error($conn); ;
		echo mysqli_error($conn);
		return false;
	}
	
	/*
	//Pravilneje bi bilo, da sliko shranimo na disk. Poskrbeti moramo, da so imena slik enolična. V bazo shranimo pot do slike.
	//Paziti moramo tudi na varnost: v mapi slik se ne smejo izvajati nobene scripte (če bi uporabnik naložil PHP kodo). Potrebno je urediti ustrezna dovoljenja (permissions).
		
		$imeSlike=$photo["name"]; //Pazimo, da je enolično!
		//sliko premaknemo iz začasne poti, v neko našo mapo, zaradi preglednosti
		move_uploaded_file($photo["tmp_name"], "slika/".$imeSlike);
		$pot="slika/".$imeSlike;		
		//V bazo shranimo $pot
	*/
}

$error = "";
if(isset($_POST["poslji"])){
	if(!empty($_FILES['image']['size'])){
	if(publish($_POST["title"], $_POST["description"], $_FILES["image"], $_POST["Categories"])){
		
		header("Location: index.php");
		die();
	}
	else{
		$error = "Prišlo je do našpake pri objavi oglasa.";
	}
	}
	else {
	$error="Izberite sliko.";
	}
}
?>
	<h2>Objavi oglas</h2>
	<form action="objavi.php" method="POST" enctype="multipart/form-data" id="formId">
		<label>Naslov</label><input type="text" name="title" value="<?php keepField("title"); ?>" /> <br/>
		<label>Vsebina</label><textarea name="description" rows="10" cols="50" ></textarea> <br/>
		<label>Slika</label><input type="file" name="image"/> <br/>
         
		
		<label for="Categories">Kategorija: </label>
          <select id="CategoriesId" name="Categories" form="formId">
           <option value="Prodaja nepremičnine">Prodaja nepremičnine</option>
		   <option value="Prodaja izdelka">Prodaja izdelka</option>
           <option value="Ponujanje poklica">Ponujanje poklica</option>
           <option value="Isaknje pomoči za delo">Isaknje pomoči za delo</option>
           </select>
            <br/>
	
		<input type="submit" name="poslji" value="Objavi" /> <br/>
		<label><?php echo $error; ?></label>
	</form>
<?php
include_once('noga.php');
?>