<html>
	<head>
		<title>Admin</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	
	<style>
		table, th, td {
			border:1px solid black;
			text-align: left;
		}
		form {
			margin-top:20px;
		}
	</style>
	
	<body>
		<a href="index.php">Click here to go back</a><br/><br/>
		<div width="80%" Style="margin-top:30px">
			<table style="width:100%">
				<tr style="background-color: lightgrey;">
					<th>Zival</th>
					<th>Opis</th>
					<th>Id</th>
				</tr>
		<?php
			$conn = new mysqli('localhost', 'root', 'test1234', 'mydb');
			$conn->set_charset("UTF8");
		
			if(isset($_POST["delete"])){
					$id=$_POST["DId"];
					$conn->query("DELETE FROM mydb.Zivali WHERE id=$id");
					$_POST = array();
			}
			if(isset($_POST["add"])){
				$zival=$_POST["Aime"];
				$opis=$_POST["Aopis"];
				$x=$_POST["Ax"];
				$y=$_POST["Ay"];
				$conn->query("INSERT INTO mydb.zivali (zival, opis, datum, x, y) VALUES ('$zival', '$opis', NOW(), $x, $y);");
				$_POST = array();
			}
			if(isset($_POST["change"])){
				$id=$_POST["CId"];
				$zival=$_POST["Cime"];
				$opis=$_POST["Copis"];
				$x=$_POST["Cx"];
				$y=$_POST["Cy"];
				$conn->query("UPDATE mydb.Zivali SET zival='$zival', opis='$opis', datum=NOW(), x=$x, y=$y WHERE id=$id;");
				$_POST = array();
			}
		
		
			function f2(){
				global $conn;
				$x = $conn->query("SELECT * FROM Zivali");
				$tab = array();
				while($oglas = $x->fetch_object()){
					array_push($tab, $oglas);
				}
				return $tab;
			}
			foreach(f2() as $x){
				?>
					<tr>
						<th><?php echo $x->zival;?></th>
						<th><?php echo $x->opis;?></th>
						<th><?php echo $x->id;?></th>
					</tr>
				<?php
			}			
			
			
		?>	
				</table>
			</div>
			
			<div width="80%" Style="margin-top:30px">
				<table style="width:100%">
					<tr><form method="POST">
						<th><p>Delete</p></th>
						<th><label>Id: </label><input type="text" name="DId" />
						<input type="submit" name="delete"/></th>
					</form><tr>
					<tr><form method="POST">
						<th><p>Add</p></th>
						<th><label>Ime: </label><input type="text" name="Aime" />
						<label>Opis: </label><input type="text" name="Aopis" />
						<label>x: </label><input type="text" name="Ax" />
						<label>y: </label><input type="text" name="Ay" />
						<input type="submit" name="add"/> </th>
					</form></tr>
					<tr><form method="POST">
						<th><p>Change</p></th>
						<th><label>Id: </label><input type="text" name="CId" />
						<label>Ime: </label><input type="text" name="Cime" />
						<label>Opis: </label><input type="text" name="Copis" />
						<label>x: </label><input type="text" name="Cx" />
						<label>y: </label><input type="text" name="Cy" />
						<input type="submit" name="change"/> </th>
					</form></tr>
				</table>
			</div>
	</body>
</html>