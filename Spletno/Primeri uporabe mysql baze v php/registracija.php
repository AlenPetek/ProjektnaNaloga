<?php
include_once('glava.php');

// Funkcija preveri, ali v bazi obstaja uporabnik z določenim imenom in vrne true, če obstaja.
function username_exists($username){
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$query = "SELECT * FROM users WHERE username='$username'";
	$res = $conn->query($query);
	return mysqli_num_rows($res) > 0;
}

// Funkcija ustvari uporabnika v tabeli users. Poskrbi tudi za ustrezno šifriranje uporabniškega gesla.
function register_user($username, $password, $name, $surname, $email,$telephone,$address,$gender,$age){
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$pass = sha1($password);
	$name = mysqli_real_escape_string($conn, $name);
	$surname = mysqli_real_escape_string($conn, $surname);
	$email = mysqli_real_escape_string($conn, $email);
	
	
	/* 
		Tukaj za hashiranje gesla uporabljamo sha1 funkcijo. V praksi se priporočajo naprednejše metode, ki k geslu dodajo naključne znake (salt).
		Več informacij: 
		http://php.net/manual/en/faq.passwords.php#faq.passwords 
		https://crackstation.net/hashing-security.htm
	*/
	
	$telephoneStr = isset($telephone) ? "'$telephone'" : "NULL";
	$addressStr = isset($address) ? "'$address'" : "NULL";
	$genderStr = isset($address) ? "'$gender'" : "NULL";
	$ageStr = isset($age) ? "'$age'" : "NULL";
	
	$query = "INSERT INTO users (username, password, name,surname,email, phoneNo,address,gender,age,administrator) VALUES ('$username', '$pass'
	,'$name','$surname','$email',$telephoneStr,$addressStr,$genderStr,$ageStr,0);";
	if($conn->query($query)){
		return true;
	}
	else{
		echo mysqli_error($conn);
		return false;
	}
}

function keepField ($value){
	if(isset($_POST[$value])){echo $_POST[$value]; } 
}

$error = "";
if(isset($_POST["poslji"])){
	/*
		VALIDACIJA: preveriti moramo, ali je uporabnik pravilno vnesel podatke (unikatno uporabniško ime, dolžina gesla,...)
		Validacijo vnesenih podatkov VEDNO izvajamo na strežniški strani. Validacija, ki se izvede na strani odjemalca (recimo Javascript), 
		služi za bolj prijazne uporabniške vmesnike, saj uporabnika sproti obvešča o napakah. Validacija na strani odjemalca ne zagotavlja
		nobene varnosti, saj jo lahko uporabnik enostavno zaobide (developer tools,...).
	*/
	
	$name=$_POST["nameBtn"];
	$surname=$_POST["surBtn"];
	$email=$_POST["emailBtn"];
	
	if($_POST["telBtn"]==''){
	$telephone=NULL;
	}
	
	else {
		$telephone=$_POST["telBtn"];
	}
	
    if($_POST["addrBtn"]==''){
	$address=NULL;
	}
	else{$address=$_POST["addrBtn"];  }
		
	
	if( !isset($_POST["gendBtn"])){
	$gender=NULL;
	}
	else {$gender=$_POST["gendBtn"];
	}
	

	if($_POST["ageBtn"]==''){
	$age=NULL;
	}
	else { $age=$_POST["ageBtn"];}
	
	
	
	if(strlen($name)==0 || strlen($surname)==0 ||  strlen($email)==0  || strlen($age)>3){
	
	$error="Vsa obvezna polja niso bila izpolnjena!";
	}
	
	//Preveri če se gesli ujemata
	else if($_POST["password"] != $_POST["repeat_password"]){
		$error = "Gesli se ne ujemata.";
	}
	//Preveri ali uporabniško ime obstaja
	else if(username_exists($_POST["username"])){
		$error = "Uporabniško ime je že zasedeno.";
	}
	//Podatki so pravilno izpolnjeni, registriraj uporabnika
	else if(register_user($_POST["username"], $_POST["password"],$name,$surname,$email,$telephone,$address,$gender,$age)){
		header("Location: prijava.php");
		die();
	}
	//Prišlo je do napake pri registraciji
	else{
		$error = "Prišlo je do napake med registracijo uporabnika.";
	}
}
?>
	<h2>Registracija</h2>
	<form action="registracija.php" method="POST">
		<label>Uporabniško ime: </label><input type="text" name="username" value="<?php keepField("username"); ?>" /> <br/>
		<label>Geslo: </label><input type="password" name="password" value="<?php keepField("password"); ?>" /> <br/>
		<label>Ponovi geslo: </label><input type="password" name="repeat_password" value="<?php keepField("repeat_password"); ?>" /> <br/>
		<label>Ime: </label><input type="text" name="nameBtn" value="<?php keepField("nameBtn"); ?>" /> <br/>
		<label>Priimek: </label><input type="text" name="surBtn" value="<?php keepField("surBtn"); ?>" /> <br/>
		<label>Email: </label><input type="text" name="emailBtn" value="<?php keepField("emailBtn"); ?>" /> <br/>
		<label>Tel.Št: </label><input type="text" name="telBtn" value="<?php keepField("telBtn"); ?>" /> <br/>
		<label>Naslov: </label><input type="text" name="addrBtn" value="<?php keepField("addrBtn"); ?>" /> <br/>
		<p>Spol: </p>
		

		  <input type="radio" id="g1" name="gendBtn"  <?php if (isset($_POST["gendBtn"]) && $_POST["gendBtn"]=="M") echo "checked";?>  value="M" >
          <label for="g1">M</label><br>
          <input type="radio" id="g2" name="gendBtn" <?php if (isset($_POST["gendBtn"]) && $_POST["gendBtn"]=="Ž") echo "checked";?> value="Ž">
          <label for="g2">Ž</label><br>  
		
		<label>Starost: </label><input type="text" name="ageBtn" value="<?php keepField("ageBtn"); ?>" /> <br/>
		
				
		<input type="submit" name="poslji" value="Pošlji" /> <br/>
		<label><?php echo $error; ?></label>
	</form>
<?php
include_once('noga.php');
?>