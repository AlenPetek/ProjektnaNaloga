<?php
include_once('glava.php');

function validate_login($username, $password){
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$pass = sha1($password);
	$query = "SELECT * FROM users WHERE username='$username' AND password='$pass'";
	$res = $conn->query($query);
	

	if($user_obj = $res->fetch_object()){
		echo "returning object";
		return $user_obj;
	}
	echo "not returning object";
	return -1;
}

$error="";
if(isset($_POST["poslji"])){
	//Preveri prijavne podatke
	if(($user = validate_login($_POST["username"], $_POST["password"])) != -1){
		//Zapomni si prijavljenega uporabnika v seji in preusmeri na index.php
		$_SESSION["USER_ID"] = $user->id;
		$_SESSION["USER_NAME"]=$user->name;
		$_SESSION["ADMIN"]=$user->administrator;
		header("Location: index.php");
		die();
	} else{
		$error = "Prijava ni uspela.";
	}
}
?>
	<h2>Prijava</h2>
	<form action="prijava.php" method="POST">
		<label>Uporabniško ime</label><input type="text" name="username" /> <br/>
		<label>Geslo</label><input type="password" name="password" /> <br/>
		<input type="submit" name="poslji" value="Pošlji" /> <br/>
		<label><?php echo $error; ?></label>
	</form>
<?php
include_once('noga.php');
?>