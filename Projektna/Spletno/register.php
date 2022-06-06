<html>
    <head>
        <title>Registracija</title>
		<link rel="stylesheet" href="css/style.css">
    </head>
	
	
    <body>
		<?php
			$conn = new mysqli('localhost', 'root', 'test1234', 'mydb');
			$conn->set_charset("UTF8");
			function obstaja($username){
				global $conn;
				$username = mysqli_real_escape_string($conn, $username);
				$baza = "SELECT * FROM mydb.uporabniki WHERE uporabnisko_ime='$username'";
				$x = $conn->query($baza);
				return mysqli_num_rows($x) > 0;
			}

			function register_user($username, $password){
				global $conn;
				$username = mysqli_real_escape_string($conn, $username);
				$baza = "INSERT INTO mydb.uporabniki (uporabnisko_ime, geslo, admin) VALUES ('$username', PASSWORD('$password'), FALSE);";
				if($conn->query($baza)){
					return true;
				}
				return false;
			}

			$error = "";
			if(isset($_POST["poslji"])){
				if($_POST["geslo"] != $_POST["ponovi"]){
					$error = "Gesli se ne ujemata.";
				}
				else if(obstaja($_POST["upo"])){
					$error = "Ime ".$_POST["upo"]." je že zasedeno.";
				}
				else if(register_user($_POST["upo"], $_POST["geslo"])){
					header("Location: index.php");
					die();
				}
				else{
					$error = "napaka";
				}
			}

			?>
	
        <a href="index.php">Click here to go back</a><br/><br/>
        <form action="register.php" method="POST">
			<label>Uporabniško ime: </label><input type="text" name="upo" /> <br/>
			<label>Geslo: </label><input type="password" name="geslo" /> <br/>
			<label>Ponovi geslo: </label><input type="password" name="ponovi" /> <br/>
			<input type="submit" name="poslji" value="Pošlji" /> <br/>
		<label><?php echo $error; ?></label>
		</form>

    </body>
</html>