<?php
//require_once('models/uporabniki.php');
//kontroler za delo z oglasi
class uporabniki_controller {

    //akcija, ki uporabniku prikaže vse oglase
  public function vsi() {

      //s pomočjo statične metode modela, dobimo seznam vseh oglasov
      //$oglasi bodo na voljo v pogledu za vse oglase index.php
    $uporabniki = Uporabnik::vsi();

      //pogled bo oblikoval seznam vseh oglasov v html kodo
    require_once('views/uporabniki/vsi.php');
  }
  public function brisi() {
   Uporabnik::brisi();
   
   $uporabniki = Uporabnik::vsi();
   require_once('views/uporabniki/vsi.php');
  }
  
    public function spremeni() {
		
	   $userId=$_GET['id'];
	   $db = Db::getInstance();
	   
	   
	$query = "SELECT* FROM users WHERE id='$userId'";
	$result = mysqli_query($db,$query);
	
	
	$selectedUser=mysqli_fetch_assoc($result);
    require_once('views/uporabniki/spremeni.php');
  }
  
  
     public function izvedi(){
	
	 echo "DO SEM";
	 $uporabniki = Uporabnik::vsi();

      //pogled bo oblikoval seznam vseh oglasov v html kodo
    require_once('views/uporabniki/vsi.php');
	
     }

  }
  ?>