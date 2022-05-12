<h1>VSI UPORABNIKI</h1>
<br/>

<?php foreach($uporabniki as $uporabnik) { ?>

  <p><b>Username: <?php echo $uporabnik->username; ?></b></p>
  <p>Name: <?php echo $uporabnik->name; ?></p>
  <p>Surname:<?php echo $uporabnik->surname; ?></p>
  <p>Email:<?php echo $uporabnik->email; ?></p>
  <p>PhoneNO:<?php echo $uporabnik->phoneNo; ?></p>
  <p>Address:<?php echo $uporabnik->address; ?></p>
  <p>Age:<?php echo $uporabnik->age; ?></p>
  <p>Gender:<?php echo $uporabnik->gender; ?></p>
  <p>Admin:<?php echo $uporabnik->administrator; ?></p>
   <a href='?controller=uporabniki&action=brisi&id=<?php echo $uporabnik->id; ?>'><button>Brisi</button></a>
    <a href='?controller=uporabniki&action=spremeni&id=<?php echo $uporabnik->id; ?>'><button>Spremeni</button></a>
  <hr/>
 <br/>
 
 
<?php }

/*
  <td>
    <!-- pri vsakem oglasu dodamo povezavo na akcijo prikaži, z idjem oglasa. Uporabnik lahko tako proži novo akcijo s pritiskom na gumb.-->
    <a href='?controller=oglasi&action=prikazi&id=<?php echo $oglas->id; ?>'>Poglej vsebino</a>
	</td>
	<td><?php echo $oglas->datumObjave; ?></td>
*/
 ?>