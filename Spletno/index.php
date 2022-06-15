<!DOCTYPE html>
<html>
    <head>
        <title>Projektna</title>
		<link rel="stylesheet" href="css/style.css">
    </head>
	
	<style>
		table, th, td {
			border:1px solid black;
		}
		.popup {
			position: relative;
			display: inline-block;
			cursor: pointer;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		.popup .popuptext {
			visibility: hidden;
			width: 160px;
			background-color: #555;
			color: #fff;
			text-align: center;
			border-radius: 6px;
			padding: 8px 0;
			position: absolute;
			z-index: 1;
			bottom: 125%;
			left: 50%;
			margin-left: -80px;
		}

		.popup .popuptext::after {
			content: "";
			position: absolute;
			top: 100%;
			left: 50%;
			margin-left: -5px;
			border-width: 5px;
			border-style: solid;
			border-color: #555 transparent transparent transparent;
		}

		.popup .show {
			visibility: visible;
			-webkit-animation: fadeIn 1s;
			animation: fadeIn 1s;
		}
		@-webkit-keyframes fadeIn {
			from {opacity: 0;} 
			to {opacity: 1;}
		}

		@keyframes fadeIn {
			from {opacity: 0;}
			to {opacity:1 ;}
		}
	</style>
	
	<script>
		function popup(x) {
			var popup = document.getElementById("myPopup"+x);
			popup.classList.toggle("show");
		}
	</script>
	
    <body>
		<?php
			$conn = new mysqli('localhost', 'root', 'test1234', 'mydb');
			$conn->set_charset("UTF8");
			
			function validate_login($username, $password){
				global $conn;
				$upo = mysqli_real_escape_string($conn, $username);
				$baza = "SELECT * FROM mydb.uporabniki WHERE uporabnisko_ime='$upo' AND geslo=PASSWORD('$password')";
				$res = $conn->query($baza);
				if($user_obj = $res->fetch_object()){
					return $user_obj->admin;
				}
				return -1;
			}
			if(isset($_POST["poslji"]) && validate_login($_POST["upo"], $_POST["geslo"])!=-1){
				if(validate_login($_POST["upo"], $_POST["geslo"])==1){
					header("Location: admin.php");
					die();
				}
				if(validate_login($_POST["upo"], $_POST["geslo"])==0){
					header("Location: user.php");
					die();
				}
			}
		?>
	
        <div class="topnav">
			<a href="register.php" style="float: right">Register</a>
			<div class="login-container">
			<form method="POST">
				<input type="text" placeholder="Username" name="upo">
				<input type="text" placeholder="Password" name="geslo">
				<button type="submit" name="poslji" value="Pošlji">Login</button>
			</form>
			</div>
		</div>
		
		<div id="divid" style="position: relative; border:2px solid black; margin-top:30px"><img class="img1" src="images/maribor.png" width="100%" style="position: relative;"></div>
			<?php
			function f1(){
				global $conn;
				$x = $conn->query("SELECT * FROM Zivali WHERE x IS NOT NULL AND y IS NOT NULL");
				$tab = array();
				while($oglas = $x->fetch_object()){
					array_push($tab, $oglas);
				}
				return $tab;
			}
			$j=1;
			foreach(f1() as $i){
				global $conn;
				$img='
					<div class="popup" onclick="popup('.$j.')" style="position: absolute; top: '.$i->x.'px; left: '.$i->y.'px;">
						<img class="img2" src="images/marker.png" width="80px">
						<span class="popuptext" id="myPopup'.$j.'">
							<h3>'.$i->zival.'</h3>
							'.$i->opis.'
						</span>
					</div>';
				echo $img;
				$j++;
			}			
		?>
			
		</div>
		
		<div width="80%" Style="margin-top:30px">
			<table style="width:100%">
				<tr style="background-color: lightgrey;">
					<th>Zival</th>
					<th>Opis</th>
					<th>Povezava</th>
				</tr>
		<?php
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
						<th><button>Map</button></th>
					</tr>
				<?php
			}			
		?>
			
				
			</table>
		</div>
    </body>
</html> 