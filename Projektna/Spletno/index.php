<!DOCTYPE html>
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
			<img src="images/maribor.png" alt="maribor" width="100%">
		</div>
		<div id="zemljevid" width="100%" height="2000">
			<p>Tabela živali</p>
			<?php/*
				$pasma = "pasma";
				$opis = "opis";
				$kraj = "kraj";
				$dbname = "mydb";

				$conn = new mysqli($servername, $username, $password, $dbname);
				if ($conn->connect_error) {
				  die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT * FROM zivali";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				  while($row = $result->fetch_assoc()) {
					echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
				  }
				} else {
				  echo "0 results";
				}
				$conn->close();*/
			?>
		</div>
    </body>
</html> 