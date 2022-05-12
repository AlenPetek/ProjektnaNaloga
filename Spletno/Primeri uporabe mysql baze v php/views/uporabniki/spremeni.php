
<?php
/*if(isset($_POST["poslji"])){

}*/
?>


	<h2>SPREMENI</h2>
	<form action="spremeni.php" method="POST">
		<label>Uporabniško ime: </label><input type="text" name="username" value=<?php echo $selectedUser['username'] ?> /> <br/>
		<label>Geslo: </label><input type="password" name="password" value=<?php echo $selectedUser['password'] ?> /> <br/>
		<label>Ime: </label><input type="text" name="nameBtn" value=<?php echo $selectedUser['name'] ?> /> <br/>
		<label>Priimek: </label><input type="text" name="surBtn" value=<?php echo $selectedUser['surname'] ?> /> <br/>
		<label>Email: </label><input type="text" name="emailBtn" value=<?php echo $selectedUser['email'] ?> /> <br/>
		<label>Tel.Št: </label><input type="text" name="telBtn" value=<?php echo $selectedUser['phoneNo'] ?> /> <br/>
		<label>Naslov: </label><input type="text" name="addrBtn" value=<?php echo $selectedUser['address'] ?> /> <br/>
		<p>Spol: </p>
		

		  <input type="radio" id="g1" name="gendBtn"  <?php if ($selectedUser['gender']=="M") echo "checked";?>  value="M" >
          <label for="g1">M</label><br>
          <input type="radio" id="g2" name="gendBtn" <?php if ($selectedUser['gender']=="Ž") echo "checked";?> value="Ž">
          <label for="g2">Ž</label><br>  
		
		<label>Starost: </label><input type="text" name="ageBtn" value=<?php echo $selectedUser['age'] ?> /> <br/>
		
				
		<a href="?controller=uporabniki&action=izvedi"><input type="submit" name="poslji2" value="Spremeni" /> <br/></a>
		
		
	</form>





